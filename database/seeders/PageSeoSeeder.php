<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * SEO meta for the main public pages.
 *
 * Writes an SEO-optimised meta_title (<= 55 chars) and meta_description
 * (<= 150 chars) for each listed page. Category / product / page records
 * are matched by slug across the admin_* content tables, so the seeder
 * can be run on any environment (local or hosting) and will only update
 * the rows that actually exist there.
 *
 * The homepage "special" pages (About Us, FAQ) keep their meta in the
 * homepage_contents key/value table, so those are updated there.
 *
 * Run with:  php artisan db:seed --class=Database\\Seeders\\PageSeoSeeder
 */
class PageSeoSeeder extends Seeder
{
    /**
     * slug => [meta_title, meta_description]
     * Lives in admin_categories / admin_products / admin_pages.
     */
    private array $meta = [
        // ── Category / landing pages ──────────────────────────────
        'round-boxes' => [
            'Custom Round Boxes | Cylinder Rigid Packaging',
            'Custom round and cylinder rigid boxes built for gifts, candles and cosmetics. Premium printing, custom sizes, low minimums and fast turnaround.',
        ],
        'box-by-material' => [
            'Boxes by Material | Custom Packaging Stocks',
            'Explore custom boxes by material, from kraft and corrugated to rigid board. Compare stocks, printing and finishes, then request a wholesale quote.',
        ],
        'two-piece-boxes' => [
            'Custom Two Piece Boxes | Rigid Lid & Base',
            'Custom two piece rigid boxes with a separate lid and base for a premium unboxing. Any size, custom printing and finishes with low minimum orders.',
        ],
        'kraft-boxes' => [
            'Custom Kraft Boxes | Eco Rigid Packaging',
            'Custom kraft boxes made from recyclable stock for an eco-friendly, natural look. Custom sizes, printing and finishes with fast, reliable turnaround.',
        ],
        'box-by-style' => [
            'Boxes by Style | Custom Rigid Box Styles',
            'Browse custom boxes by style, from magnetic and two piece to drawer and mailer. Find the right structure and request a tailored wholesale quote.',
        ],
        'luxury-rigid-boxes' => [
            'Luxury Rigid Boxes | Premium Custom Packaging',
            'Luxury rigid boxes for prestige brands with premium board, custom printing and refined finishes. Low minimums, free design help and fast turnaround.',
        ],
        'box-by-industry' => [
            'Boxes by Industry | Custom Packaging Solutions',
            'Find custom packaging by industry, from cosmetics and cannabis to food and jewelry. Purpose-built rigid boxes with custom printing and finishes.',
        ],
        'luxury-watch-boxes' => [
            'Custom Luxury Watch Boxes | Premium Packaging',
            'Custom luxury watch boxes with cushioned inserts and premium finishes to protect and present timepieces. Custom sizes, printing and low minimums.',
        ],

        // ── Product pages ─────────────────────────────────────────
        'chocolate-bomb-boxes' => [
            'Custom Chocolate Bomb Boxes | Rigid Packaging',
            'Custom chocolate bomb boxes with protective inserts and food-safe printing. Keep hot cocoa bombs secure and on-brand. Low MOQ and fast turnaround.',
        ],
        'pre-roll-cone-packaging' => [
            'Custom Pre Roll Cone Packaging | Rigid Boxes',
            'Custom pre roll cone packaging with child-resistant and tube options. Keep cones fresh and compliant with custom printing, finishes and low minimums.',
        ],
        'christmas-chocolate-boxes' => [
            'Custom Christmas Chocolate Boxes | Gift Packaging',
            'Custom Christmas chocolate boxes with festive printing and inserts for a premium holiday gift. Custom sizes, finishes and fast seasonal turnaround.',
        ],
        'blunt-packaging' => [
            'Custom Blunt Packaging | Rigid Boxes',
            'Custom blunt packaging with child-resistant, pop-top and tube options. Keep products fresh and compliant with bold custom printing and low minimums.',
        ],
        'votive-candle-boxes' => [
            'Custom Votive Candle Boxes | Rigid Packaging',
            'Custom votive candle boxes with snug inserts and premium printing to protect and showcase candles. Any size, custom finishes and low minimum orders.',
        ],
        'invitation-boxes' => [
            'Custom Invitation Boxes | Luxury Rigid Packaging',
            'Custom invitation boxes for weddings and events with luxury finishes and inserts. Make a lasting first impression. Custom sizes and low minimums.',
        ],
        'pencil-boxes' => [
            'Custom Pencil Boxes | Rigid Packaging',
            'Custom pencil boxes with durable board and custom printing for stationery brands. Any size, premium finishes, low minimums and fast turnaround.',
        ],
        'baseball-boxes' => [
            'Custom Baseball Boxes | Rigid Display Packaging',
            'Custom baseball boxes with protective inserts and clear display options for collectibles. Custom sizes, printing and finishes with low minimums.',
        ],
        'cardboard-cigarette-boxes' => [
            'Custom Cardboard Cigarette Boxes | Packaging',
            'Custom cardboard cigarette boxes with durable stock and sharp custom printing. Any size, premium finishes, low minimums and fast turnaround.',
        ],
        'noodle-boxes' => [
            'Custom Noodle Boxes | Food-Safe Packaging',
            'Custom noodle boxes with food-grade stock, leak-resistant build and custom printing. Great for takeout brands. Low minimums and fast turnaround.',
        ],
        'christmas-candle-boxes' => [
            'Custom Christmas Candle Boxes | Gift Packaging',
            'Custom Christmas candle boxes with festive printing and protective inserts for holiday gifting. Custom sizes, finishes and fast seasonal lead times.',
        ],
        'pre-roll-display-boxes' => [
            'Custom Pre Roll Display Boxes | Retail Packaging',
            'Custom pre roll display boxes built for retail counters with slots and bold branding. Boost shelf appeal with custom printing and low minimums.',
        ],
        'book-boxes' => [
            'Custom Book Boxes | Rigid Packaging',
            'Custom book-style rigid boxes with magnetic or lid closures for a premium shelf look. Any size, custom printing, finishes and low minimum orders.',
        ],
        'scar-gel-boxes' => [
            'Custom Scar Gel Boxes | Rigid Packaging',
            'Custom scar gel boxes with secure inserts and clean, compliant printing for skincare brands. Custom sizes, premium finishes and low minimums.',
        ],
        'pendant-boxes' => [
            'Custom Pendant Boxes | Jewelry Packaging',
            'Custom pendant boxes with soft inserts and luxury finishes to protect and present jewelry. Any size, custom printing and low minimum orders.',
        ],
        'facemask-boxes' => [
            'Custom Facemask Boxes | Rigid Packaging',
            'Custom facemask boxes with hygienic, durable stock and custom printing for skincare and medical brands. Custom sizes, finishes and low minimums.',
        ],
        'burger-boxes' => [
            'Custom Burger Boxes | Food-Safe Packaging',
            'Custom burger boxes with grease-resistant, food-grade stock and custom printing. Keep burgers fresh and branded. Low minimums and fast turnaround.',
        ],
        'bracelet-boxes' => [
            'Custom Bracelet Boxes | Jewelry Packaging',
            'Custom bracelet boxes with cushioned inserts and premium finishes to showcase jewelry. Any size, custom printing and low minimum orders.',
        ],
        'capsule-boxes' => [
            'Custom Capsule Boxes | Supplement Packaging',
            'Custom capsule boxes with secure inserts and compliant printing for supplement brands. Custom sizes, premium finishes and low minimum orders.',
        ],
        'toothpaste-boxes' => [
            'Custom Toothpaste Boxes | Rigid Packaging',
            'Custom toothpaste boxes with durable stock and sharp custom printing for oral care brands. Any size, premium finishes and low minimum orders.',
        ],
        'basketball-boxes' => [
            'Custom Basketball Boxes | Display Packaging',
            'Custom basketball boxes with protective inserts and display options for sports brands. Custom sizes, printing and finishes with low minimums.',
        ],
        'golf-ball-boxes' => [
            'Custom Golf Ball Boxes | Rigid Packaging',
            'Custom golf ball boxes with snug inserts and premium printing for gifts and retail. Any size, custom finishes and low minimum orders.',
        ],
        'sports-shoe-boxes' => [
            'Custom Sports Shoe Boxes | Rigid Packaging',
            'Custom sports shoe boxes with sturdy board and bold custom printing for footwear brands. Any size, premium finishes and low minimum orders.',
        ],
        'lip-balm-boxes' => [
            'Custom Lip Balm Boxes | Cosmetic Packaging',
            'Custom lip balm boxes with secure inserts and vibrant printing for beauty brands. Custom sizes, premium finishes and low minimum orders.',
        ],
        'soap-gift-boxes' => [
            'Custom Soap Gift Boxes | Rigid Packaging',
            'Custom soap gift boxes with premium finishes and inserts for handmade and luxury soaps. Any size, custom printing and low minimum orders.',
        ],
        'supplement-boxes' => [
            'Custom Supplement Boxes | Rigid Packaging',
            'Custom supplement boxes with secure inserts and compliant printing for nutrition brands. Custom sizes, premium finishes and low minimums.',
        ],
        'heart-shaped-chocolate-boxes' => [
            'Custom Heart Shaped Chocolate Boxes | Packaging',
            'Custom heart shaped chocolate boxes with inserts and luxury finishes for Valentine and gift lines. Custom printing and low minimum orders.',
        ],
        'bangle-boxes' => [
            'Custom Bangle Boxes | Jewelry Packaging',
            'Custom bangle boxes with cushioned inserts and premium finishes to present jewelry. Any size, custom printing and low minimum orders.',
        ],
        'necklace-boxes' => [
            'Custom Necklace Boxes | Jewelry Packaging',
            'Custom necklace boxes with soft inserts and luxury finishes to protect and display jewelry. Any size, custom printing and low minimums.',
        ],
        'swimwear-boxes' => [
            'Custom Swimwear Boxes | Rigid Packaging',
            'Custom swimwear boxes with premium finishes and custom printing for apparel brands. Any size, durable stock and low minimum orders.',
        ],
        'pre-rolled-joint-boxes' => [
            'Custom Pre Rolled Joint Boxes | Rigid Packaging',
            'Custom pre rolled joint boxes with child-resistant and tube options. Keep products fresh and compliant with custom printing and low minimums.',
        ],
        'popcorn-boxes' => [
            'Custom Popcorn Boxes | Food-Safe Packaging',
            'Custom popcorn boxes with food-grade stock and bold custom printing for cinemas and snacks. Any size, premium finishes and low minimums.',
        ],
        'candle-tube-packaging' => [
            'Custom Candle Tube Packaging | Rigid Tubes',
            'Custom candle tube packaging with sturdy walls and premium printing to protect and present candles. Custom sizes, finishes and low minimums.',
        ],
        'press-on-nail-packaging-boxes' => [
            'Custom Press On Nail Boxes | Rigid Packaging',
            'Custom press on nail packaging with secure inserts and vibrant printing for beauty brands. Custom sizes, premium finishes and low minimums.',
        ],
        'pill-boxes' => [
            'Custom Pill Boxes | Pharma Rigid Packaging',
            'Custom pill boxes with secure inserts and compliant printing for pharma and supplement brands. Custom sizes, finishes and low minimum orders.',
        ],
        'crayon-boxes' => [
            'Custom Crayon Boxes | Rigid Packaging',
            'Custom crayon boxes with durable stock and bright custom printing for kids and craft brands. Any size, premium finishes and low minimums.',
        ],
        'lighter-boxes' => [
            'Custom Lighter Boxes | Rigid Display Packaging',
            'Custom lighter boxes with display slots and bold custom printing for retail counters. Custom sizes, premium finishes and low minimum orders.',
        ],
        'gift-boxes-with-lids' => [
            'Custom Gift Boxes With Lids | Rigid Packaging',
            'Custom gift boxes with lids for a premium unboxing, with inserts and luxury finishes. Any size, custom printing and low minimum orders.',
        ],
        'anklet-boxes' => [
            'Custom Anklet Boxes | Jewelry Packaging',
            'Custom anklet boxes with soft inserts and premium finishes to present jewelry. Any size, custom printing and low minimum orders.',
        ],
        'lingerie-boxes' => [
            'Custom Lingerie Boxes | Luxury Rigid Packaging',
            'Custom lingerie boxes with luxury finishes and inserts for a premium apparel unboxing. Any size, custom printing and low minimum orders.',
        ],
        'pillar-candle-boxes' => [
            'Custom Pillar Candle Boxes | Rigid Packaging',
            'Custom pillar candle boxes with protective inserts and premium printing to showcase candles. Any size, custom finishes and low minimums.',
        ],
        'cbd-pre-roll-packaging' => [
            'Custom CBD Pre Roll Packaging | Rigid Boxes',
            'Custom CBD pre roll packaging with child-resistant and tube options. Keep products fresh and compliant with custom printing and low minimums.',
        ],
        'pasta-boxes' => [
            'Custom Pasta Boxes | Food-Safe Packaging',
            'Custom pasta boxes with food-grade stock and clear window options. Keep pasta fresh and branded with custom printing and low minimum orders.',
        ],
        'nugget-boxes' => [
            'Custom Nugget Boxes | Food-Safe Packaging',
            'Custom nugget boxes with grease-resistant, food-grade stock and custom printing for takeout brands. Any size, finishes and low minimums.',
        ],
        'game-boxes' => [
            'Custom Game Boxes | Rigid Packaging',
            'Custom game boxes with sturdy rigid board and custom printing for board and card games. Any size, premium finishes and low minimum orders.',
        ],
        'stapler-boxes' => [
            'Custom Stapler Boxes | Rigid Packaging',
            'Custom stapler boxes with durable stock and sharp custom printing for stationery brands. Any size, premium finishes and low minimum orders.',
        ],
        'medicine-boxes' => [
            'Custom Medicine Boxes | Pharma Packaging',
            'Custom medicine boxes with secure inserts and compliant printing for pharma brands. Custom sizes, premium finishes and low minimum orders.',
        ],
        'gummies-boxes' => [
            'Custom Gummies Boxes | Rigid Packaging',
            'Custom gummies boxes with food-safe inserts and bold custom printing for edibles and supplements. Custom sizes, finishes and low minimums.',
        ],
        'small-jewelry-boxes' => [
            'Custom Small Jewelry Boxes | Rigid Packaging',
            'Custom small jewelry boxes with soft inserts and luxury finishes for rings and studs. Any size, custom printing and low minimum orders.',
        ],
        'chocolate-milk-boxes' => [
            'Custom Chocolate Milk Boxes | Food Packaging',
            'Custom chocolate milk boxes with food-grade stock and vibrant printing for beverage brands. Any size, premium finishes and low minimums.',
        ],
        'hemp-pre-roll-boxes' => [
            'Custom Hemp Pre Roll Boxes | Rigid Packaging',
            'Custom hemp pre roll boxes with child-resistant and tube options. Keep products fresh and compliant with custom printing and low minimums.',
        ],
        'ring-boxes' => [
            'Custom Ring Boxes | Luxury Jewelry Packaging',
            'Custom ring boxes with cushioned inserts and premium finishes for proposals and retail. Any size, custom printing and low minimum orders.',
        ],
        'hemp-oil-boxes' => [
            'Custom Hemp Oil Boxes | Rigid Packaging',
            'Custom hemp oil boxes with secure dropper inserts and compliant printing for CBD brands. Custom sizes, premium finishes and low minimums.',
        ],
        'underwear-boxes' => [
            'Custom Underwear Boxes | Rigid Packaging',
            'Custom underwear boxes with premium finishes and custom printing for apparel brands. Any size, durable stock and low minimum orders.',
        ],
        'vial-boxes' => [
            'Custom Vial Boxes | Rigid Packaging',
            'Custom vial boxes with secure foam inserts and compliant printing for pharma and lab brands. Custom sizes, finishes and low minimum orders.',
        ],
        'chocolate-bar-boxes' => [
            'Custom Chocolate Bar Boxes | Food Packaging',
            'Custom chocolate bar boxes with food-grade stock and premium printing for confectionery brands. Any size, finishes and low minimum orders.',
        ],
        'cannabis-boxes' => [
            'Custom Cannabis Boxes | Compliant Packaging',
            'Custom cannabis boxes with child-resistant options and compliant printing. Keep products fresh and on-brand with custom sizes and low minimums.',
        ],
        'earring-boxes' => [
            'Custom Earring Boxes | Jewelry Packaging',
            'Custom earring boxes with soft inserts and luxury finishes to protect and present jewelry. Any size, custom printing and low minimums.',
        ],
        'tennis-ball-boxes' => [
            'Custom Tennis Ball Boxes | Rigid Packaging',
            'Custom tennis ball boxes with snug inserts and bold printing for sports brands. Any size, premium finishes and low minimum orders.',
        ],
        'football-boxes' => [
            'Custom Football Boxes | Rigid Packaging',
            'Custom football boxes with protective inserts and display options for sports brands. Custom sizes, printing and finishes with low minimums.',
        ],
        'mushroom-chocolate-bar-boxes' => [
            'Custom Mushroom Chocolate Bar Boxes | Packaging',
            'Custom mushroom chocolate bar boxes with food-safe stock and compliant printing. Custom sizes, premium finishes and low minimum orders.',
        ],
        'pantyhose-boxes' => [
            'Custom Pantyhose Boxes | Rigid Packaging',
            'Custom pantyhose boxes with premium finishes and custom printing for hosiery brands. Any size, durable stock and low minimum orders.',
        ],
    ];

    /**
     * Meta for the "special" pages that store SEO in homepage_contents.
     * section => [ titleKey => value, descKey => value ]
     */
    private array $homepageContentMeta = [
        'about_us_page' => [
            'about_meta_title' => 'About The Rigid Boxes | Custom Packaging Makers',
            'about_meta_description' => 'Learn about The Rigid Boxes, a custom packaging partner for 500+ brands. Premium materials, in-house design and fast, reliable worldwide delivery.',
        ],
        'faq_page' => [
            'faq_meta_title' => 'FAQs | Custom Rigid Box Packaging Answers',
            'faq_meta_description' => 'Answers to common questions about custom rigid boxes: sizes, materials, printing, minimum orders, turnaround, samples, shipping and pricing.',
        ],
    ];

    public function run(): void
    {
        $tables = ['admin_categories', 'admin_products', 'admin_pages'];
        $updated = [];
        $missing = [];

        foreach ($this->meta as $slug => [$title, $description]) {
            $hit = false;

            foreach ($tables as $table) {
                if (!Schema::hasTable($table)) {
                    continue;
                }

                $affected = DB::table($table)->where('slug', $slug)->update([
                    'meta_title' => $title,
                    'meta_description' => $description,
                    'robots' => 'index,follow',
                    'updated_at' => now(),
                ]);

                if ($affected > 0) {
                    $hit = true;
                    $updated[] = "{$slug} ({$table})";
                }
            }

            if (!$hit) {
                $missing[] = $slug;
            }
        }

        // Special pages stored in the homepage_contents key/value table.
        if (Schema::hasTable('homepage_contents')) {
            foreach ($this->homepageContentMeta as $section => $fields) {
                foreach ($fields as $key => $value) {
                    DB::table('homepage_contents')->updateOrInsert(
                        ['section' => $section, 'field_key' => $key],
                        ['value' => $value]
                    );
                }
                $updated[] = "{$section} (homepage_contents)";
            }
        }

        $this->command->info('PageSeoSeeder: updated ' . count($updated) . ' record(s).');
        foreach ($updated as $line) {
            $this->command->line('  ✔ ' . $line);
        }

        if ($missing) {
            $this->command->warn('Not found in this database (slug has no matching row here): ' . count($missing));
            foreach ($missing as $slug) {
                $this->command->line('  – ' . $slug);
            }
        }
    }
}
