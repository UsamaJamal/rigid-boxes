<?php

namespace Tests\Feature;

use App\Http\Middleware\RedirectTrailingSlash;
use Illuminate\Http\Request;
use Tests\TestCase;

class TrailingSlashTest extends TestCase
{
    public function test_public_page_urls_redirect_to_the_trailing_slash_version(): void
    {
        foreach (['/box-by-industry', '/contact-us', '/blog/example-post'] as $path) {
            $request = Request::create($path, 'GET');
            $response = (new RedirectTrailingSlash())->handle($request, function () {
                return response('next middleware');
            });

            $this->assertSame(301, $response->getStatusCode());
            $this->assertSame($path . '/', $response->headers->get('Location'));
        }
    }

    public function test_sitemap_xml_redirects_to_the_no_trailing_slash_version(): void
    {
        $request = Request::create('/sitemap.xml/', 'GET');
        $response = (new RedirectTrailingSlash())->handle($request, function () {
            return response('next middleware');
        });

        $this->assertSame(301, $response->getStatusCode());
        $this->assertSame('/sitemap.xml', $response->headers->get('Location'));
    }
}
