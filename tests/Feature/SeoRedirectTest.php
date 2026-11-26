<?php

namespace Tests\Feature;

use App\Http\Middleware\HandleSeoRedirects;
use App\Support\RedirectManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SeoRedirectTest extends TestCase
{
    private ?string $cacheBackup = null;

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('database.default', 'sqlite');
        Config::set('database.connections.sqlite.database', ':memory:');
        DB::purge('sqlite');

        // Minimal tables required by AppServiceProvider view composers & RedirectManager
        if (!Schema::hasTable('admin_categories')) {
            Schema::create('admin_categories', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->string('slug')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->string('icon')->nullable();
                $table->boolean('show_in_nav')->default(false);
                $table->string('status')->default('published');
            });
        }

        if (!Schema::hasTable('homepage_contents')) {
            Schema::create('homepage_contents', function (Blueprint $table) {
                $table->id();
                $table->string('section')->nullable();
                $table->string('field_key')->nullable();
                $table->text('value')->nullable();
                $table->string('value_type')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('admin_products')) {
            Schema::create('admin_products', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->nullable();
                $table->string('status')->default('published');
            });
        }

        if (!Schema::hasTable('admin_pages')) {
            Schema::create('admin_pages', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->nullable();
                $table->string('status')->default('published');
            });
        }

        RedirectManager::ensureTable();

        $cachePath = RedirectManager::cachePath();
        $this->cacheBackup = is_file($cachePath) ? file_get_contents($cachePath) : null;
        RedirectManager::syncCache();
    }

    protected function tearDown(): void
    {
        $cachePath = RedirectManager::cachePath();
        if ($this->cacheBackup !== null) {
            @file_put_contents($cachePath, $this->cacheBackup);
        } elseif (is_file($cachePath)) {
            @unlink($cachePath);
        }

        parent::tearDown();
    }

    public function test_source_and_target_normalization(): void
    {
        $this->assertSame('/old-box/', RedirectManager::normalizeSource('https://therigidboxes.com/old-box/'));
        $this->assertSame('/old-box?a=1', RedirectManager::normalizeSource('old-box?a=1'));
        $this->assertSame('/new-box/', RedirectManager::normalizeTarget('new-box/', 301));
        $this->assertNull(RedirectManager::normalizeTarget('/anything/', 410));
    }

    public function test_exact_match_handles_trailing_slash_and_preserves_query_string(): void
    {
        $rules = [
            [
                'id' => 1,
                'source_url' => '/old-cereal-boxes/',
                'target_url' => '/cereal-boxes/',
                'status_code' => 301,
                'match_type' => 'exact',
                'is_active' => true,
                'preserve_query' => true,
            ],
        ];

        $request = Request::create('/old-cereal-boxes?gclid=abc123', 'GET');
        $match = RedirectManager::matchRequest($request, $rules);

        $this->assertNotNull($match);
        $this->assertSame(301, $match['status_code']);
        $this->assertSame('/cereal-boxes/?gclid=abc123', $match['location']);
    }

    public function test_wildcard_prefix_and_regex_matching(): void
    {
        $rules = [
            [
                'id' => 10,
                'source_url' => '/legacy-cat/*',
                'target_url' => '/packaging/*',
                'status_code' => 302,
                'match_type' => 'prefix',
                'is_active' => true,
                'preserve_query' => true,
            ],
            [
                'id' => 11,
                'source_url' => '^/item-([0-9]+)/(.*)$',
                'target_url' => '/box/$2',
                'status_code' => 308,
                'match_type' => 'regex',
                'is_active' => true,
                'preserve_query' => false,
            ],
        ];

        $wildMatch = RedirectManager::matchRequest(Request::create('/legacy-cat/mailer-boxes/', 'GET'), $rules);
        $this->assertNotNull($wildMatch);
        $this->assertSame(302, $wildMatch['status_code']);
        $this->assertSame('/packaging/mailer-boxes/', $wildMatch['location']);

        $regexMatch = RedirectManager::matchRequest(Request::create('/item-42/watch-box/?ref=x', 'GET'), $rules);
        $this->assertNotNull($regexMatch);
        $this->assertSame(308, $regexMatch['status_code']);
        $this->assertSame('/box/watch-box/', $regexMatch['location']);
    }

    public function test_validation_blocks_loops_self_redirects_and_protected_paths(): void
    {
        $existing = [
            [
                'id' => 1,
                'source_url' => '/page-a/',
                'target_url' => '/page-b/',
                'status_code' => 301,
                'match_type' => 'exact',
                'is_active' => true,
            ],
        ];

        $this->assertNotNull(RedirectManager::validateRule('/', '/new/', 301, 'exact', null, $existing));
        $this->assertNotNull(RedirectManager::validateRule('/admin/products', '/new/', 301, 'exact', null, $existing));
        $this->assertNotNull(RedirectManager::validateRule('.*', '/new/', 301, 'regex', null, $existing));
        $this->assertNotNull(RedirectManager::validateRule('/same/', '/same', 301, 'exact', null, $existing));
        $this->assertNotNull(RedirectManager::validateRule('/page-a', '/other/', 301, 'exact', null, $existing));
        $this->assertNotNull(RedirectManager::validateRule('/page-b/', '/page-a/', 301, 'exact', null, $existing));
        $this->assertNull(RedirectManager::validateRule('/brand-new-old/', '/target/', 301, 'exact', null, $existing));
    }

    public function test_bulk_line_parser_supports_htaccess_arrow_and_csv(): void
    {
        $input = implode("\n", [
            '# comment line',
            'Redirect 301 /old-one/ /new-one/',
            '/old-two/ -> /new-two/ [302]',
            '/old-three/, /new-three/, 307',
            '/old-four/, , 410',
        ]);

        $parsed = RedirectManager::parseBulkLines($input, 301);

        $this->assertCount(4, $parsed);
        $this->assertSame(['/old-one/', '/new-one/', 301], [$parsed[0]['source_url'], $parsed[0]['target_url'], $parsed[0]['status_code']]);
        $this->assertSame(['/old-two/', '/new-two/', 302], [$parsed[1]['source_url'], $parsed[1]['target_url'], $parsed[1]['status_code']]);
        $this->assertSame(['/old-three/', '/new-three/', 307], [$parsed[2]['source_url'], $parsed[2]['target_url'], $parsed[2]['status_code']]);
        $this->assertSame(['/old-four/', null, 410], [$parsed[3]['source_url'], $parsed[3]['target_url'], $parsed[3]['status_code']]);
    }

    public function test_full_admin_crud_bulk_import_and_live_http_redirections_end_to_end(): void
    {
        // 1. Unauthenticated access must redirect to admin login
        $this->get('/admin/redirects')->assertRedirect(route('admin.login'));

        $adminSession = ['admin_logged_in' => true, 'admin_email' => 'admin@rigidboxes.com', 'admin_name' => 'Admin'];

        // 2. Admin UI loads cleanly with Redirections tab
        $uiResp = $this->withSession($adminSession)->get('/admin/redirects');
        $uiResp->assertStatus(200);
        $uiResp->assertSee('Add Redirection');
        $uiResp->assertSee('Bulk Import');
        $uiResp->assertSee('Export CSV');

        // 3. Create 301 Exact, 302 Prefix, 308 Regex, and 410 Gone rules
        $this->withSession($adminSession)->post('/admin/redirects', [
            'source_url' => 'https://therigidboxes.com/old-cereal/',
            'target_url' => '/cereal-boxes/',
            'status_code' => 301,
            'match_type' => 'exact',
            'is_active' => '1',
            'preserve_query' => '1',
            'notes' => 'SEO merge',
        ])->assertRedirect(route('admin.redirects.index'));

        $this->withSession($adminSession)->post('/admin/redirects', [
            'source_url' => '/legacy-cat/*',
            'target_url' => '/new-cat/*',
            'status_code' => 302,
            'match_type' => 'prefix',
            'is_active' => '1',
            'preserve_query' => '1',
        ])->assertRedirect(route('admin.redirects.index'));

        $this->withSession($adminSession)->post('/admin/redirects', [
            'source_url' => '^/sku-([0-9]+)/?$',
            'target_url' => '/product-$1/',
            'status_code' => 308,
            'match_type' => 'regex',
            'is_active' => '1',
            'preserve_query' => '0',
        ])->assertRedirect(route('admin.redirects.index'));

        $this->withSession($adminSession)->post('/admin/redirects', [
            'source_url' => '/removed-box/',
            'target_url' => '',
            'status_code' => 410,
            'match_type' => 'exact',
            'is_active' => '1',
            'preserve_query' => '1',
        ])->assertRedirect(route('admin.redirects.index'));

        $this->assertSame(4, DB::table('admin_redirects')->count());

        // 4. Validation blocks loop & protected path
        $this->withSession($adminSession)->post('/admin/redirects', [
            'source_url' => '/cereal-boxes/',
            'target_url' => '/old-cereal/',
            'status_code' => 301,
            'match_type' => 'exact',
        ])->assertSessionHasErrors('redirect');

        $this->withSession($adminSession)->post('/admin/redirects', [
            'source_url' => '/admin/dashboard',
            'target_url' => '/',
            'status_code' => 301,
            'match_type' => 'exact',
        ])->assertSessionHasErrors('redirect');

        // 5. Live HTTP Kernel Middleware executes redirects + increments hits
        $r301 = $this->get('/old-cereal/?gclid=test123');
        $r301->assertStatus(301);
        $this->assertSame('/cereal-boxes/?gclid=test123', $r301->headers->get('Location'));

        $kernel = app(\Illuminate\Contracts\Http\Kernel::class);
        $r302 = $kernel->handle(Request::create('/legacy-cat/watch-boxes/', 'GET'));
        $this->assertSame(302, $r302->getStatusCode());
        $this->assertSame('/new-cat/watch-boxes/', $r302->headers->get('Location'));
        $this->assertStringContainsString('no-store', (string) $r302->headers->get('Cache-Control'));

        $r308 = $this->get('/sku-987/?ref=strip');
        $r308->assertStatus(308);
        $this->assertSame('/product-987/', $r308->headers->get('Location'));

        $r410 = $this->get('/removed-box/');
        $r410->assertStatus(410);
        $r410->assertSee('410 GONE');
        $this->assertStringContainsString('noindex', (string) $r410->headers->get('X-Robots-Tag'));

        $cerealRule = DB::table('admin_redirects')->where('source_url', '/old-cereal/')->first();
        $this->assertSame(1, (int) $cerealRule->hits);
        $this->assertNotNull($cerealRule->last_hit_at);

        // 6. Toggle Pause -> Rule no longer intercepts (passes through to router -> 404)
        $this->withSession($adminSession)->post('/admin/redirects/' . $cerealRule->id . '/toggle')->assertRedirect();
        $this->assertSame(0, (int) DB::table('admin_redirects')->where('id', $cerealRule->id)->value('is_active'));
        $pausedResp = $kernel->handle(Request::create('/old-cereal/', 'GET'));
        $this->assertSame(404, $pausedResp->getStatusCode());

        // 7. Re-enable & Edit to 307 -> /updated-target/
        $this->withSession($adminSession)->put('/admin/redirects/' . $cerealRule->id, [
            'source_url' => '/old-cereal/',
            'target_url' => '/updated-target/',
            'status_code' => 307,
            'match_type' => 'exact',
            'is_active' => '1',
            'preserve_query' => '0',
            'notes' => 'Updated note',
        ])->assertRedirect(route('admin.redirects.index'));

        $r307 = $this->get('/old-cereal/?ignored=1');
        $r307->assertStatus(307);
        $this->assertSame('/updated-target/', $r307->headers->get('Location'));

        // 8. Test URL endpoint
        $this->withSession($adminSession)->postJson('/admin/redirects/test-url', [
            'test_url' => '/old-cereal/',
        ])->assertStatus(200)->assertJson([
            'matched' => true,
            'status_code' => 307,
            'location' => '/updated-target/',
        ]);

        // 9. Bulk Import (.htaccess + CSV)
        $this->withSession($adminSession)->post('/admin/redirects/bulk-import', [
            'bulk_lines' => "Redirect 301 /ht-old/ /ht-new/\n/csv-old/, /csv-new/, 302",
            'default_status' => 301,
        ])->assertRedirect(route('admin.redirects.index'));
        $this->assertSame(6, DB::table('admin_redirects')->count());

        // 10. CSV Export
        $csvResp = $this->withSession($adminSession)->get('/admin/redirects/export');
        $csvResp->assertStatus(200);
        $this->assertStringContainsString('text/csv', (string) $csvResp->headers->get('Content-Type'));
        $csvContent = $csvResp->streamedContent();
        $this->assertStringContainsString('/ht-old/', $csvContent);
        $this->assertStringContainsString('/updated-target/', $csvContent);

        // 11. Delete rule
        $this->withSession($adminSession)->delete('/admin/redirects/' . $cerealRule->id)->assertRedirect();
        $this->assertSame(5, DB::table('admin_redirects')->count());
    }
}
