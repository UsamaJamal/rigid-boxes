<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'The Art of Magnetic Closure Rigid Boxes: Unboxing Luxury in 2026',
                'slug' => 'art-of-magnetic-closure-rigid-boxes',
                'status' => 'published',
                'show_home' => true,
                'image' => 'uploads/industry-magnetic-closure-boxes.webp',
                'author_name' => 'Ahmed Khan',
                'publish_date' => '2026-03-03',
                'blog_category' => 'packaging',
                'tags' => 'magnetic closure, rigid boxes, luxury packaging, unboxing',
                'excerpt' => 'Discover how magnetic closure mechanisms elevate premium gift packaging, create tactile satisfaction, and drive customer retention.',
                'content' => '<p>The luxury packaging landscape is shifting faster than ever. Magnetic closure rigid boxes represent the peak of structural elegance and satisfying tactile feedback. Embedded neodymium magnets create a crisp snap upon closing, giving customers an instant impression of high quality and security.</p><h2>Why Magnetic Closures Define Modern Luxury</h2><p>Quiet luxury isn’t about flashy design — it’s about precision engineering. Hidden magnetic catches integrated into 2mm thick rigid chipboard ensure seamless closure without visible latches or ribbons. Combined with soft-touch matte lamination and custom foam inserts, these boxes elevate cosmetics, jewelry, and high-end tech products.</p>',
                'author_description' => 'Packaging specialist and lead structural designer at The Rigid Boxes.',
                'alt_text' => 'Magnetic Closure Luxury Rigid Box',
                'meta_title' => 'The Art of Magnetic Closure Rigid Boxes | The Rigid Boxes',
                'meta_description' => 'Discover how magnetic closure mechanisms elevate premium gift packaging and drive customer retention.',
                'meta_keywords' => 'magnetic box, custom rigid boxes, luxury gift packaging',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Eco-Friendly Rigid Packaging: Sustainable Materials Without Compromise',
                'slug' => 'eco-friendly-rigid-packaging-sustainable-materials',
                'status' => 'published',
                'show_home' => true,
                'image' => 'uploads/eco-go-green.png',
                'author_name' => 'Joe Danley',
                'publish_date' => '2026-03-10',
                'blog_category' => 'sustainability',
                'tags' => 'sustainable packaging, eco friendly, recycled greyboard, FSC certified',
                'excerpt' => 'Explore how 100% recyclable chipboard, soy-based inks, and FSC-certified papers are redefining luxury eco-packaging.',
                'content' => '<p>Sustainability is no longer an afterthought — it is a core expectation for discerning shoppers. Today’s eco-friendly rigid boxes deliver high structural strength using 100% recycled greyboard and FSC-certified art paper, eliminating single-use plastics without compromising premium aesthetics.</p><h2>Zero-Plastic Finishes and Biodegradable Inks</h2><p>With water-based soft touch coatings, foil stamping made from recyclable metallic films, and soy-based CMYK printing, eco-luxury packaging achieves deep color saturation while remaining fully repulpable in standard recycling streams.</p>',
                'author_description' => 'Sustainability consultant specializing in green packaging materials and circular supply chains.',
                'alt_text' => 'Eco-Friendly Rigid Box Packaging Solutions',
                'meta_title' => 'Eco-Friendly Rigid Packaging Solutions | The Rigid Boxes',
                'meta_description' => 'Explore how 100% recyclable chipboard and FSC-certified papers are redefining luxury eco-packaging.',
                'meta_keywords' => 'eco friendly boxes, sustainable rigid packaging, FSC certified box',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'How Custom Inserts & Trays Protect Delicate Products During Shipping',
                'slug' => 'custom-inserts-trays-protect-products-shipping',
                'status' => 'published',
                'show_home' => true,
                'image' => 'uploads/addon-gold-inside-box.jfif',
                'author_name' => 'Ahmed Khan',
                'publish_date' => '2026-03-15',
                'blog_category' => 'design',
                'tags' => 'custom inserts, EVA foam, velvet trays, packaging design',
                'excerpt' => 'From EVA foam to molded paper pulp, learn how engineered box inserts combine shock absorption with elegant unboxing presentation.',
                'content' => '<p>A beautiful box is only half the equation — the interior insert ensures fragile products arrive in pristine condition. Custom die-cut EVA foam, velvet-covered thermoformed plastic trays, and molded paper pulp inserts hold products firmly in place during transit.</p><h2>Matching Insert Density to Product Needs</h2><p>Heavy glassware requires high-density foam with precise finger-notches for easy retrieval, while organic cosmetics thrive in contoured paper pulp inserts that convey natural purity. Proper insert engineering minimizes transit damage while creating a dramatic presentation when opened.</p>',
                'author_description' => 'Packaging specialist and lead structural designer at The Rigid Boxes.',
                'alt_text' => 'Custom Box Insert with Luxury Velvet Tray',
                'meta_title' => 'Custom Box Inserts & Trays for Product Protection | The Rigid Boxes',
                'meta_description' => 'Learn how engineered box inserts combine shock absorption with elegant unboxing presentation.',
                'meta_keywords' => 'box inserts, custom foam trays, velvet insert packaging',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($blogs as $blog) {
            DB::table('admin_blogs')->updateOrInsert(
                ['slug' => $blog['slug']],
                $blog
            );
        }
    }
}
