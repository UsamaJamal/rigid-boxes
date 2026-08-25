<?php

namespace Tests\Feature;

use App\Http\Middleware\RedirectTrailingSlash;
use Illuminate\Http\Request;
use Tests\TestCase;

class TrailingSlashTest extends TestCase
{
    public function test_public_get_urls_redirect_to_the_no_trailing_slash_version(): void
    {
        foreach (['/box-by-industry/', '/sitemap.xml/', '/contact-us/'] as $path) {
            $request = Request::create($path, 'GET');
            $response = (new RedirectTrailingSlash())->handle($request, function () {
                return response('next middleware');
            });

            $this->assertSame(301, $response->getStatusCode());
            $this->assertSame('http://localhost' . rtrim($path, '/'), $response->headers->get('Location'));
        }
    }
}
