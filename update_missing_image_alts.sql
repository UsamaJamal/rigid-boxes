-- SQL queries to update missing alt text in the database for the 21 audited images

-- 1. Blog Post Images (in admin_blogs table content)
UPDATE admin_blogs 
SET content = REPLACE(content, 'src="https://therigidboxes.com/folding-carton-packaging-structure.webp" alt=""', 'src="https://therigidboxes.com/folding-carton-packaging-structure.webp" alt="Folding Carton Packaging Structure"')
WHERE content LIKE '%folding-carton-packaging-structure.webp%';

UPDATE admin_blogs 
SET content = REPLACE(content, 'src="https://therigidboxes.com/rigid-box-packaging-construction.webp" alt=""', 'src="https://therigidboxes.com/rigid-box-packaging-construction.webp" alt="Rigid Box Packaging Construction"')
WHERE content LIKE '%rigid-box-packaging-construction.webp%';

UPDATE admin_blogs 
SET content = REPLACE(content, 'src="https://therigidboxes.com/rigid-boxes-vs-other-packaging-types.webp" alt=""', 'src="https://therigidboxes.com/rigid-boxes-vs-other-packaging-types.webp" alt="Rigid Boxes vs Other Packaging Types"')
WHERE content LIKE '%rigid-boxes-vs-other-packaging-types.webp%';

-- Also support local or relative paths if present
UPDATE admin_blogs 
SET content = REPLACE(content, 'folding-carton-packaging-structure.webp" alt=""', 'folding-carton-packaging-structure.webp" alt="Folding Carton Packaging Structure"')
WHERE content LIKE '%folding-carton-packaging-structure.webp%';

UPDATE admin_blogs 
SET content = REPLACE(content, 'rigid-box-packaging-construction.webp" alt=""', 'rigid-box-packaging-construction.webp" alt="Rigid Box Packaging Construction"')
WHERE content LIKE '%rigid-box-packaging-construction.webp%';

UPDATE admin_blogs 
SET content = REPLACE(content, 'rigid-boxes-vs-other-packaging-types.webp" alt=""', 'rigid-boxes-vs-other-packaging-types.webp" alt="Rigid Boxes vs Other Packaging Types"')
WHERE content LIKE '%rigid-boxes-vs-other-packaging-types.webp%';

-- 2. Product Images (in admin_products table alt_text column)
UPDATE admin_products SET alt_text = 'Luxury Watch Boxes' WHERE image LIKE '%luxury-watch-boxes.webp%' AND (alt_text IS NULL OR alt_text = '');
UPDATE admin_products SET alt_text = 'Custom Magnetic Gift Boxes' WHERE image LIKE '%custom-magnetic-gift-boxes.webp%' AND (alt_text IS NULL OR alt_text = '');
UPDATE admin_products SET alt_text = 'Custom Cufflink Boxes' WHERE image LIKE '%custom-cufflink-boxes.webp%' AND (alt_text IS NULL OR alt_text = '');
UPDATE admin_products SET alt_text = 'Personalized Makeup Boxes' WHERE image LIKE '%personalized-makeup-boxes.webp%' AND (alt_text IS NULL OR alt_text = '');
UPDATE admin_products SET alt_text = 'Custom Bra Boxes' WHERE image LIKE '%custom-bra-boxes.webp%' AND (alt_text IS NULL OR alt_text = '');
UPDATE admin_products SET alt_text = 'Custom Coffee Boxes' WHERE image LIKE '%coffee-boxes.webp%' AND (alt_text IS NULL OR alt_text = '');
