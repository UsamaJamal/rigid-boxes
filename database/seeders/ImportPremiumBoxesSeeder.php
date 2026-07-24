<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportPremiumBoxesSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('admin_category_product')->truncate();
        DB::table('admin_category_faqs')->truncate();
        DB::table('admin_product_faqs')->truncate();
        DB::table('admin_products')->truncate();
        DB::table('admin_categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $structure = [
            'Box by Industry' => [
                'hero_title' => 'Custom Packaging Boxes by Industry',
                'hero_badge' => 'Industry-Tailored Packaging',
                'hero_description' => 'Discover custom luxury rigid boxes designed specifically for your industry vertical—from bakeries to retail and luxury gift packaging.',
                'description' => '<p>At <strong>The Rigid Boxes</strong>, we engineer industry-specific packaging solutions that protect your products while maximizing shelf impact. Whether you need food-grade bakery packaging or high-end retail presentation boxes, our custom rigid boxes are crafted to match your exact brand standards.</p>',
                'image' => 'uploads/Box-by-industry-Banner-.webp',
                'children' => [
                    'Bakery Boxes' => [
                        'hero_title' => 'Custom Printed Bakery Packaging Boxes',
                        'hero_badge' => 'Food-Grade & Freshness Lock',
                        'hero_description' => 'Elevate your bakery brand with custom printed bakery boxes. Engineered with food-grade paperboard to protect pastries, cakes, and treats during transit.',
                        'description' => '<p>Our <strong>Bakery Boxes</strong> combine sturdy structural design with vibrant custom printing. Ideal for bakeries, confectioneries, and sweet shops looking for grease-resistant, eco-friendly, and beautifully branded bakery packaging.</p>',
                        'image' => 'uploads/Bakery-Boxes.webp',
                        'faqs' => [
                            ['question' => 'Are your bakery boxes food-safe?', 'answer' => 'Yes! All our bakery boxes are manufactured using 100% food-grade, FDA-compliant paperboard and non-toxic soy-based inks.'],
                            ['question' => 'What is the minimum order quantity for custom bakery boxes?', 'answer' => 'Our MOQ starts at just 100 units, making it easy for small artisan bakeries and large brands alike.']
                        ],
                        'products' => [
                            [
                                'title' => 'Bakery Boxes',
                                'image' => 'uploads/Bakery-Boxes.webp',
                                'box_style' => 'Tuck End Auto-Lock Bakery Box',
                                'material' => '350 GSM Food-Grade White Cardboard',
                                'printing' => 'Full-Color CMYK Offset Printing',
                                'finishing' => 'Grease-Proof Gloss Lamination',
                                'dimensions' => 'Custom Sizes (e.g. 10" x 10" x 5")',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Durable and food-safe bakery packaging boxes with optional clear window for displaying cakes, donuts, and fresh baked goods.',
                                'long_description' => '<h3>Premium Custom Bakery Packaging Boxes</h3><p>Make your bakery items stand out with custom printed bakery boxes from <strong>The Rigid Boxes</strong>. Constructed with high-strength food-safe cardstock, these boxes ensure your delicates arrive fresh and intact. Features custom die-cut windows, custom sizing, and grease-resistant coatings.</p>',
                            ],
                            [
                                'title' => 'Cake Boxes',
                                'image' => 'uploads/industry-box-with-lid.jfif',
                                'box_style' => 'Two-Piece Telescopic Cake Box with Lid',
                                'material' => '1000 GSM Heavy-Duty Rigid Board',
                                'printing' => 'CMYK + PMS Spot Color Printing',
                                'finishing' => 'Soft-Touch Matte Lamination',
                                'dimensions' => 'Custom (e.g. 12" x 12" x 8")',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Sturdy two-piece rigid cake boxes designed to support multi-tiered cakes and celebration treats safely.',
                                'long_description' => '<h3>Luxury Two-Piece Custom Cake Boxes</h3><p>Ensure your specialty cakes remain immaculate with heavy-duty rigid cake packaging. Built with rigid board walls and a reinforced base, these boxes offer supreme structural integrity alongside elegant custom branding.</p>',
                            ],
                            [
                                'title' => 'Cupcake Boxes',
                                'image' => 'uploads/category-custom-shaped-box.jfif',
                                'box_style' => 'Die-Cut Window Cupcake Box with Custom Insert',
                                'material' => '350 GSM Recycled Cardstock',
                                'printing' => 'Full-Color CMYK Printing',
                                'finishing' => 'Matte Lamination + Clear PVC Window',
                                'dimensions' => 'Single, 4-Pack, 6-Pack, 12-Pack Custom Sizes',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Custom cupcake packaging boxes with secure die-cut inserts to hold cupcakes in place during delivery.',
                                'long_description' => '<h3>Custom Cupcake Boxes with Inserts</h3><p>Highlight your cupcakes while holding them firmly in place. Our custom cupcake boxes feature removable inserts that prevent sliding and topping damage, paired with a crystal-clear display window.</p>',
                            ]
                        ]
                    ],
                    'Gift Boxes' => [
                        'hero_title' => 'Custom Luxury Gift Packaging Boxes',
                        'hero_badge' => 'Premium Unboxing Experience',
                        'hero_description' => 'Create an unforgettable unboxing moment with custom rigid gift boxes featuring luxury foil stamping, spot UV, and velvet inserts.',
                        'description' => '<p>Elevate corporate gifts, luxury merchandise, and promotional giveaways with custom <strong>Gift Boxes</strong> from <strong>The Rigid Boxes</strong>. Engineered with heavyweight rigid chipboard for ultimate elegance and durability.</p>',
                        'image' => 'uploads/Gift-Boxes.webp',
                        'faqs' => [
                            ['question' => 'Can I add custom ribbon closures or velvet inserts to gift boxes?', 'answer' => 'Absolutely! We offer custom ribbon ties, magnetic closures, foam inserts, velvet lining, and metallic foil accents.'],
                            ['question' => 'What finishing options are available for gift boxes?', 'answer' => 'Options include Soft-Touch Matte, Gloss Lamination, Spot UV, Gold/Silver Foil Stamping, Embossing, and Debossing.']
                        ],
                        'products' => [
                            [
                                'title' => 'Gift Card Boxes',
                                'image' => 'uploads/Gift-Boxes.webp',
                                'box_style' => 'Rigid Presentation Gift Card Box with Tray',
                                'material' => '1000 GSM Rigid Chipboard + Premium Art Paper Wrap',
                                'printing' => 'CMYK Offset + Gold Foil Stamping',
                                'finishing' => 'Soft-Touch Matte Lamination',
                                'dimensions' => 'Custom Gift Card Dimensions',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Compact luxury rigid gift card boxes featuring a custom foam or cardstock tray insert for elegant presentation.',
                                'long_description' => '<h3>Luxury Rigid Gift Card Boxes</h3><p>Transform standard gift cards into a luxury gift experience. Built with dense rigid chipboard and wrapped in soft-touch printed art paper with gold foil logos.</p>',
                            ],
                            [
                                'title' => 'Luxury Gift Boxes',
                                'image' => 'uploads/industry-custom-luxury-box.jfif',
                                'box_style' => 'Magnetic Shoulder Neck Luxury Gift Box',
                                'material' => '1200 GSM Premium Heavyweight Rigid Board',
                                'printing' => 'PMS Metallic Spot Color + Foil Stamping',
                                'finishing' => 'Soft-Touch Matte + Embossed Logo',
                                'dimensions' => 'Custom Sizing Available',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'High-end luxury gift boxes featuring magnetic snap closure and custom shoulder-neck construction for premium items.',
                                'long_description' => '<h3>Premium Magnetic Shoulder Luxury Gift Boxes</h3><p>Designed for high-end luxury retail items, watches, jewelry, and executive corporate gifts. Offers maximum protection and a distinct tactile feel.</p>',
                            ],
                            [
                                'title' => 'Favor Boxes',
                                'image' => 'uploads/addon-gold-inside-box.jfif',
                                'box_style' => 'Custom Two-Piece Favor Box',
                                'material' => '800 GSM Rigid Board with Foil Interior Wrap',
                                'printing' => 'Full-Color CMYK Printing',
                                'finishing' => 'Gold Metallic Interior Coating + Satin Finish',
                                'dimensions' => 'Custom Compact Sizes',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Elegant custom favor boxes designed for weddings, VIP events, and luxury brand giveaways.',
                                'long_description' => '<h3>Custom Event & Brand Favor Boxes</h3><p>Delight your event attendees with custom rigid favor boxes. Available with metallic interior foils, satin ribbon pulls, and custom printed exteriors.</p>',
                            ]
                        ]
                    ]
                ]
            ],
            'Box by Material' => [
                'hero_title' => 'Custom Packaging Boxes by Material',
                'hero_badge' => 'High-Grade Sustainable Stocks',
                'hero_description' => 'Select from premium packaging materials including eco-friendly cardboard, heavy-duty greyboard, kraft stock, and metallic paperboard.',
                'description' => '<p>The foundation of great packaging lies in material selection. At <strong>The Rigid Boxes</strong>, we offer high-grade eco-friendly cardboard and rigid greyboard stock tailored to your weight, durability, and print finish requirements.</p>',
                'image' => 'uploads/Box-by-Material.webp',
                'children' => [
                    'Cardboard Boxes' => [
                        'hero_title' => 'Custom Printed Cardboard Boxes',
                        'hero_badge' => 'Versatile & Cost-Effective',
                        'hero_description' => 'Durable, lightweight, and versatile custom cardboard packaging boxes suitable for retail products, subscription boxes, and shipping.',
                        'description' => '<p>Our <strong>Cardboard Boxes</strong> provide the perfect balance of structural protection and cost-effective printability. Available in various cardstock thicknesses with full-color CMYK printing.</p>',
                        'image' => 'uploads/CardBoard-Boxes.webp',
                        'faqs' => [
                            ['question' => 'What thickness of cardboard stock do you offer?', 'answer' => 'We offer cardboard stock ranging from 14pt (300 GSM) up to 24pt (450 GSM), as well as corrugated fluting for heavy shipping.'],
                            ['question' => 'Can cardboard boxes be fully printed inside and outside?', 'answer' => 'Yes! We support full double-sided CMYK/PMS color printing inside and out.']
                        ],
                        'products' => [
                            [
                                'title' => 'Cardboard Boxes',
                                'image' => 'uploads/CardBoard-Boxes.webp',
                                'box_style' => 'Straight Tuck End Cardboard Box',
                                'material' => '350 GSM Premium White SBS Cardstock',
                                'printing' => 'Full-Color CMYK Printing',
                                'finishing' => 'Matte Lamination',
                                'dimensions' => 'Custom Length x Width x Height',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Standard high-quality custom cardboard boxes for cosmetics, electronics, pharmaceuticals, and retail goods.',
                                'long_description' => '<h3>Custom Printed Cardboard Product Boxes</h3><p>Versatile and economical packaging solutions for retail products. Easily assembled, highly printable, and eco-friendly.</p>',
                            ],
                            [
                                'title' => 'Printed Cardboard Boxes',
                                'image' => 'uploads/industry-two-piece-box.jfif',
                                'box_style' => 'Two-Piece Custom Printed Cardboard Box',
                                'material' => '400 GSM Heavy Cardstock',
                                'printing' => 'Vibrant High-Definition CMYK Offset',
                                'finishing' => 'Gloss Lamination + Spot UV Accent',
                                'dimensions' => 'Custom Sizes Available',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Custom printed cardboard boxes featuring high-definition graphics, brand patterns, and crisp color accuracy.',
                                'long_description' => '<h3>High-Definition Printed Cardboard Packaging</h3><p>Showcase your brand colors with high-precision offset printing on premium cardboard. Ideal for retail shelves and subscription boxes.</p>',
                            ],
                            [
                                'title' => 'Custom Cardboard Boxes',
                                'image' => 'uploads/industry-rigid-plain-white-box.jfif',
                                'box_style' => 'Custom Die-Cut Cardboard Box',
                                'material' => '350 GSM Recycled Cardboard',
                                'printing' => 'CMYK / PMS Color Matching',
                                'finishing' => 'Matte Soft-Touch Finish',
                                'dimensions' => 'Tailored to Product Spec',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Fully customizable die-cut cardboard packaging tailored to fit your specific product dimensions.',
                                'long_description' => '<h3>Bespoke Custom Cardboard Boxes</h3><p>Get custom-engineered cardboard packaging built to your exact product dimensions with zero die-cutting fees and fast turnaround times.</p>',
                            ]
                        ]
                    ],
                    'Greyboard Boxes' => [
                        'hero_title' => 'Heavy-Duty Custom Greyboard Rigid Boxes',
                        'hero_badge' => 'Unmatched Structural Integrity',
                        'hero_description' => 'Engineered with dense, high-thickness greyboard chipboard for luxury presentation boxes that resist bending, crushing, and damage.',
                        'description' => '<p><strong>Greyboard Boxes</strong> are the ultimate choice for luxury rigid packaging. Made from dense recycled chipboard (800 GSM to 1800 GSM), greyboard provides a solid, premium structure that gives luxury products an authentic heavyweight feel.</p>',
                        'image' => 'uploads/Grey-Board-Boxes.webp',
                        'faqs' => [
                            ['question' => 'What is greyboard and why is it used for rigid boxes?', 'answer' => 'Greyboard (also called chipboard) is a thick, highly compressed paperboard that creates rigid, solid box structures that do not collapse.'],
                            ['question' => 'Can greyboard boxes be wrapped in textured or metallic paper?', 'answer' => 'Yes, greyboard cores can be wrapped with soft-touch art paper, linen paper, black kraft, holographic paper, or leatherette.']
                        ],
                        'products' => [
                            [
                                'title' => 'Custom Greyboard Boxes',
                                'image' => 'uploads/Grey-Board-Boxes.webp',
                                'box_style' => 'Rigid Setup Greyboard Box',
                                'material' => '1200 GSM (2mm Thick) Solid Greyboard Chipboard',
                                'printing' => 'Offset Printing on 157 GSM Art Paper Wrap',
                                'finishing' => 'Matte Lamination + Debossed Brand Name',
                                'dimensions' => 'Custom Sizing',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Rigid custom greyboard setup boxes designed to protect luxury retail goods with solid structural walls.',
                                'long_description' => '<h3>Solid Greyboard Rigid Setup Boxes</h3><p>Built with 1200 GSM greyboard, these rigid boxes maintain their shape under pressure, delivering a true luxury unboxing experience for retail products.</p>',
                            ],
                            [
                                'title' => 'Printed Greyboard Boxes',
                                'image' => 'uploads/industry-custom-shoulder-box.jfif',
                                'box_style' => 'Shoulder Neck Rigid Greyboard Box',
                                'material' => '1400 GSM Dense Greyboard + Printed Wrap',
                                'printing' => 'Full-Color CMYK + Foil Stamping',
                                'finishing' => 'Soft-Touch Matte + Foil Stamped Accents',
                                'dimensions' => 'Custom Dimensions',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Custom printed rigid greyboard shoulder boxes with a neck extension for seamless closure alignment.',
                                'long_description' => '<h3>Custom Shoulder Neck Printed Greyboard Boxes</h3><p>Features a distinct internal neck structure wrapped in contrasting metallic or printed art paper for an extra touch of sophistication.</p>',
                            ],
                            [
                                'title' => 'Rigid Greyboard Packaging Boxes',
                                'image' => 'uploads/industry-rigid-presentation-box.jfif',
                                'box_style' => 'Presentation Style Rigid Greyboard Box',
                                'material' => '1500 GSM Heavy Greyboard Chipboard',
                                'printing' => 'PMS Spot Color Printing',
                                'finishing' => 'Gloss Spot UV + Gold Foil Logo',
                                'dimensions' => 'Custom Presentation Sizes',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Heavyweight presentation greyboard boxes equipped with custom foam inserts for high-value merchandise.',
                                'long_description' => '<h3>Executive Presentation Rigid Greyboard Packaging</h3><p>Maximum protection meets high design. Designed for executive gift sets, high-end electronics, cosmetics, and luxury apparel.</p>',
                            ]
                        ]
                    ]
                ]
            ],
            'Box by Style' => [
                'hero_title' => 'Custom Packaging Boxes by Box Style',
                'hero_badge' => 'Innovative Structural Styles',
                'hero_description' => 'Explore innovative rigid box styles including magnetic closure boxes, collapsible foldable boxes, two-piece telescopic boxes, and shoulder boxes.',
                'description' => '<p>The structural style of your box defines how customers interact with your product. At <strong>The Rigid Boxes</strong>, we offer precision-engineered box styles—from magnetic flip tops to space-saving collapsible rigid boxes.</p>',
                'image' => 'uploads/Maganetic-Closure-Boxes.webp',
                'children' => [
                    'Magnetic Closure Boxes' => [
                        'hero_title' => 'Custom Magnetic Closure Rigid Boxes',
                        'hero_badge' => 'Snap-Shut Magnetic Elegance',
                        'hero_description' => 'Premium magnetic flip-top rigid boxes with hidden concealed magnet closures that snap shut with a satisfying click.',
                        'description' => '<p>Our <strong>Magnetic Closure Boxes</strong> feature hidden magnetic catches built directly into the front flap, offering an effortless snap-shut lid that adds immediate perceived value to your brand.</p>',
                        'image' => 'uploads/Maganetic-Closure-Boxes.webp',
                        'faqs' => [
                            ['question' => 'How strong are the hidden magnetic catches?', 'answer' => 'We use high-potency neodymium concealed magnets that hold the lid shut tightly during handling and transit.'],
                            ['question' => 'Can magnetic closure boxes be shipped flat?', 'answer' => 'Yes! We offer both assembled magnetic rigid boxes and collapsible magnetic boxes that ship flat to save shipping costs.']
                        ],
                        'products' => [
                            [
                                'title' => 'Magnetic Closure Rigid Boxes',
                                'image' => 'uploads/Maganetic-Closure-Boxes.webp',
                                'box_style' => 'Magnetic Flip Top Rigid Box',
                                'material' => '1200 GSM Rigid Chipboard + Concealed Neodymium Magnets',
                                'printing' => 'CMYK Offset + Metallic Foil Accent',
                                'finishing' => 'Soft-Touch Matte Lamination',
                                'dimensions' => 'Custom Sizes Available',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Classic magnetic flip-top rigid box featuring concealed magnetic closure for luxury products and gift sets.',
                                'long_description' => '<h3>Premium Magnetic Flip Top Rigid Packaging</h3><p>Unmatched convenience and luxury. Built with 1200 GSM rigid board and concealed magnets that secure your items with a tactile snap.</p>',
                            ],
                            [
                                'title' => 'Custom Magnetic Closure Boxes',
                                'image' => 'uploads/addon-premium-foil-custom-box.jfif',
                                'box_style' => 'Book-Style Magnetic Rigid Box',
                                'material' => '1200 GSM Board + Custom Printed Wrap',
                                'printing' => 'Full-Color CMYK + Foil Stamping',
                                'finishing' => 'Gold Foil Stamping + Spot UV',
                                'dimensions' => 'Custom Specifications',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Book-style magnetic closure boxes that open like a hardcover book, ideal for luxury cosmetics and jewelry.',
                                'long_description' => '<h3>Bespoke Book-Style Magnetic Boxes</h3><p>Designed with a wraparound spine and concealed front magnets, creating a hardcover book unboxing experience for premium retail goods.</p>',
                            ],
                            [
                                'title' => 'Premium Magnetic Gift Boxes',
                                'image' => 'uploads/industry-custom-luxury-box.jfif',
                                'box_style' => 'Magnetic Box with Ribbon & Foam Insert',
                                'material' => '1400 GSM Heavy Chipboard + Satin Ribbon',
                                'printing' => 'PMS Spot Color Printing',
                                'finishing' => 'Matte Finish + Custom Foam Insert',
                                'dimensions' => 'Custom Tailored Dimensions',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Premium magnetic gift boxes featuring satin ribbon tie accents and custom high-density foam inserts.',
                                'long_description' => '<h3>Luxury Magnetic Gift Boxes with Satin Ribbon</h3><p>Combine magnetic closure security with decorative satin ribbon ties and custom die-cut foam inserts for high-end luxury products.</p>',
                            ]
                        ]
                    ],
                    'Collapsible Rigid Boxes' => [
                        'hero_title' => 'Custom Collapsible Foldable Rigid Boxes',
                        'hero_badge' => 'Space-Saving Flat-Ship Design',
                        'hero_description' => 'Enjoy the luxury of a rigid box with the freight savings of a flat-shipping foldable design. Assembles in seconds with self-adhesive corner stickers.',
                        'description' => '<p><strong>Collapsible Rigid Boxes</strong> combine luxury rigid structure with space-saving logistics. Shipped flat to dramatically cut down freight and warehouse storage costs, they assemble easily into a solid rigid box.</p>',
                        'image' => 'uploads/Collapsible-Rigid-Boxes.webp',
                        'faqs' => [
                            ['question' => 'How do collapsible rigid boxes assemble?', 'answer' => 'They ship flat with pre-applied 3M peel-and-stick adhesive corners. Simply peel the backing and pop the box into shape in seconds!'],
                            ['question' => 'How much storage space do collapsible rigid boxes save?', 'answer' => 'Collapsible rigid boxes reduce storage and shipping volume by up to 75% compared to pre-assembled rigid boxes.']
                        ],
                        'products' => [
                            [
                                'title' => 'Collapsible Rigid Boxes',
                                'image' => 'uploads/Collapsible-Rigid-Boxes.webp',
                                'box_style' => 'Collapsible Foldable Magnetic Box',
                                'material' => '1200 GSM Heavy Board + 3M Peel & Stick Adhesive Corners',
                                'printing' => 'Full-Color CMYK Printing',
                                'finishing' => 'Soft-Touch Matte Lamination',
                                'dimensions' => 'Custom Sizes Available',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Foldable magnetic rigid box that ships flat and pops up into a sturdy rigid box within seconds.',
                                'long_description' => '<h3>Flat-Shipping Collapsible Rigid Boxes</h3><p>Reduce shipping costs by up to 75% without sacrificing luxury. Features self-adhesive corners and magnetic closure for fast, flawless assembly.</p>',
                            ],
                            [
                                'title' => 'Custom Collapsible Boxes',
                                'image' => 'uploads/industry-two-piece-box.jfif',
                                'box_style' => 'Custom Printed Foldable Rigid Box',
                                'material' => '1000 GSM Foldable Rigid Chipboard',
                                'printing' => 'CMYK + Foil Stamped Logo',
                                'finishing' => 'Gloss Lamination + Metallic Foil',
                                'dimensions' => 'Tailored Product Sizes',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Custom branded collapsible rigid packaging printed with your artwork and foil-stamped logos.',
                                'long_description' => '<h3>Custom Printed Foldable Packaging</h3><p>Personalize your flat-ship collapsible rigid boxes with custom interior and exterior artwork, foil stamping, and magnetic closures.</p>',
                            ],
                            [
                                'title' => 'Foldable Collapsible Rigid Boxes',
                                'image' => 'uploads/industry-rigid-plain-white-box.jfif',
                                'box_style' => 'Collapsible Rigid Box with Ribbon Closure',
                                'material' => '1200 GSM Rigid Board + Satin Ribbon Pull',
                                'printing' => 'PMS Spot Color Printing',
                                'finishing' => 'Soft-Touch Matte Lamination',
                                'dimensions' => 'Custom Dimensions',
                                'moq' => '100 Units',
                                'turnaround' => '8 - 10 Business Days',
                                'description' => 'Foldable rigid box equipped with integrated satin ribbon ties and magnetic front closure flap.',
                                'long_description' => '<h3>Foldable Rigid Gift Packaging with Ribbon</h3><p>An elegant space-saving rigid box featuring decorative ribbon closures. Perfect for luxury apparel, e-commerce, and high-end gifts.</p>',
                            ]
                        ]
                    ]
                ]
            ]
        ];

        foreach ($structure as $parentName => $pData) {
            $parentId = DB::table('admin_categories')->insertGetId([
                'title' => $parentName,
                'slug' => Str::slug($parentName),
                'parent_id' => null,
                'status' => 'published',
                'show_in_nav' => true,
                'show_home' => true,
                'image' => $pData['image'],
                'icon' => null,
                'hero_image' => $pData['image'],
                'banner_image' => $pData['image'],
                'hero_title' => $pData['hero_title'],
                'hero_badge' => $pData['hero_badge'],
                'hero_description' => $pData['hero_description'],
                'description' => $pData['description'],
                'feature_title' => 'Custom Sizes, Finishes & Fast Turnaround',
                'why_choose_title' => 'Why Choose The Rigid Boxes?',
                'why_choose_description' => 'At The Rigid Boxes, we combine high-precision structural craftsmanship with premium finishing options to deliver packaging that elevates your brand and protects your products.',
                'meta_title' => "{$parentName} | Custom Rigid Packaging | The Rigid Boxes",
                'meta_description' => "Shop custom {$parentName} at wholesale prices. Free design support and fast shipping across USA & Canada.",
                'meta_keywords' => strtolower($parentName) . ', custom rigid boxes, wholesale packaging',
                'robots' => 'index,follow',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($pData['children'] as $childName => $cData) {
                $childId = DB::table('admin_categories')->insertGetId([
                    'title' => $childName,
                    'slug' => Str::slug($childName),
                    'parent_id' => $parentId,
                    'status' => 'published',
                    'show_in_nav' => true,
                    'show_home' => true,
                    'image' => $cData['image'],
                    'icon' => null,
                    'hero_image' => $cData['image'],
                    'banner_image' => $cData['image'],
                    'hero_title' => $cData['hero_title'],
                    'hero_badge' => $cData['hero_badge'],
                    'hero_description' => $cData['hero_description'],
                    'description' => $cData['description'],
                    'feature_title' => 'Key Packaging Features',
                    'why_choose_title' => 'Why Choose The Rigid Boxes?',
                    'why_choose_description' => 'We offer 100% customizable rigid packaging with free design support, no die-cut charges, low MOQs, and reliable fast shipping.',
                    'meta_title' => "{$childName} | Custom Printed Packaging | The Rigid Boxes",
                    'meta_description' => "Get instant wholesale quotes for custom {$childName}. Premium materials, vibrant printing, and foil stamping.",
                    'meta_keywords' => strtolower($childName) . ', custom boxes, rigid packaging',
                    'robots' => 'index,follow',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Insert Category FAQs
                foreach ($cData['faqs'] as $faq) {
                    DB::table('admin_category_faqs')->insert([
                        'category_id' => $childId,
                        'question' => $faq['question'],
                        'answer' => $faq['answer'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Insert 3 Products per Child Category
                foreach ($cData['products'] as $p) {
                    $prodDbId = DB::table('admin_products')->insertGetId([
                        'title' => $p['title'],
                        'slug' => Str::slug($p['title']),
                        'status' => 'published',
                        'show_home' => true,
                        'image' => $p['image'],
                        'images' => json_encode([$p['image']]),
                        'box_style' => $p['box_style'],
                        'material' => $p['material'],
                        'printing' => $p['printing'],
                        'finishing' => $p['finishing'],
                        'dimensions' => $p['dimensions'],
                        'moq' => $p['moq'],
                        'turnaround' => $p['turnaround'],
                        'description' => $p['description'],
                        'long_description' => $p['long_description'],
                        'alt_text' => $p['title'] . ' - The Rigid Boxes',
                        'meta_title' => "{$p['title']} | Custom Wholesale Packaging | The Rigid Boxes",
                        'meta_description' => "Order custom {$p['title']} with premium finishes and free design support. Wholesale pricing available.",
                        'meta_keywords' => strtolower($p['title']) . ', custom rigid boxes, wholesale packaging',
                        'robots' => 'index,follow',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Insert Product Pivot
                    DB::table('admin_category_product')->insert([
                        'product_id' => $prodDbId,
                        'category_id' => $childId,
                    ]);

                    // Insert Product FAQs
                    DB::table('admin_product_faqs')->insert([
                        'product_id' => $prodDbId,
                        'question' => "Can I customize the dimensions and print design of {$p['title']}?",
                        'answer' => "Yes! Every aspect of {$p['title']} can be customized including exact dimensions, cardstock thickness, printing colors, and special finishes.",
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
