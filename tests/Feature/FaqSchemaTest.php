<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FaqSchemaTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Config::set('database.default', 'sqlite');
        Config::set('database.connections.sqlite.database', ':memory:');
        DB::purge('sqlite');
    }

    private function extractSchemas(string $html): array
    {
        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $matches);
        $decoded = [];
        foreach ($matches[1] ?? [] as $json) {
            $parsed = json_decode(trim($json), true);
            if (is_array($parsed)) {
                $decoded[] = $parsed;
            }
        }
        return $decoded;
    }

    public function test_faq_page_sections_auto_generate_faqpage_schema(): void
    {
        $html = view('components.schemas', [
            'title' => 'Frequently Asked Questions',
            'settings' => [
                'faq_page_title' => 'Frequently Asked Questions',
                'faq_page_sections' => [
                    [
                        'heading' => 'Orders & Pricing',
                        'faqs' => [
                            ['question' => 'What is your minimum order?', 'answer' => 'We have no minimum order quantity.'],
                            ['question' => 'Do you charge setup fees?', 'answer' => 'No, we have zero die or setup fees.'],
                        ],
                    ],
                    [
                        'heading' => 'Shipping',
                        'faqs' => [
                            ['question' => 'How fast do you deliver?', 'answer' => 'Standard turnaround is 7 to 8 business days.'],
                        ],
                    ],
                ],
            ],
        ])->render();

        $schemas = $this->extractSchemas($html);
        $this->assertNotEmpty($schemas);

        $graph = $schemas[0]['@graph'] ?? [];
        $faqNodes = array_values(array_filter($graph, fn ($n) => ($n['@type'] ?? '') === 'FAQPage'));

        $this->assertCount(1, $faqNodes);
        $this->assertCount(3, $faqNodes[0]['mainEntity']);
        $this->assertSame('What is your minimum order?', $faqNodes[0]['mainEntity'][0]['name']);
        $this->assertSame('How fast do you deliver?', $faqNodes[0]['mainEntity'][2]['name']);
    }

    public function test_category_and_product_faqs_auto_generate_schema_even_with_custom_schema(): void
    {
        $customSchema = json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => 'Custom Category',
        ]);

        $html = view('components.schemas', [
            'category' => [
                'title' => 'Rigid Boxes',
                'slug' => 'rigid-boxes',
                'schema' => $customSchema,
            ],
            'faqs' => [
                ['question' => 'Are rigid boxes customizable?', 'answer' => 'Yes, sizes, colors and finishes are custom.'],
            ],
        ])->render();

        $schemas = $this->extractSchemas($html);
        $this->assertCount(2, $schemas);
        $this->assertSame('CollectionPage', $schemas[0]['@type'] ?? '');
        $this->assertSame('FAQPage', $schemas[1]['@type'] ?? '');
        $this->assertSame('Are rigid boxes customizable?', $schemas[1]['mainEntity'][0]['name']);
    }

    public function test_homepage_faqs_continue_to_auto_generate_faqpage_schema(): void
    {
        $html = view('components.schemas', [
            'settings' => [
                'faqs' => [
                    ['question' => 'Do you offer free mockups?', 'answer' => 'Yes, free 3D digital mockups are included.'],
                ],
            ],
        ])->render();

        $schemas = $this->extractSchemas($html);
        $graph = $schemas[0]['@graph'] ?? [];
        $faqNodes = array_values(array_filter($graph, fn ($n) => ($n['@type'] ?? '') === 'FAQPage'));

        $this->assertCount(1, $faqNodes);
        $this->assertSame('Do you offer free mockups?', $faqNodes[0]['mainEntity'][0]['name']);
    }
}
