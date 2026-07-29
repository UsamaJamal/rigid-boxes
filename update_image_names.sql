-- SQL to update image names in database
-- Run this if these images are added to products or categories tables

-- Update Products Table
UPDATE admin_products SET image = 'uploads/corrugated-divider.webp' WHERE image LIKE '%Corrugated-Box-Divider-Inserts%';
UPDATE admin_products SET image = 'uploads/folding-divider.webp' WHERE image LIKE '%Folding-Carton-Box-Divider-Inserts%';
UPDATE admin_products SET image = 'uploads/hips-insert.webp' WHERE image LIKE '%HIPS-Blister-Insert%';
UPDATE admin_products SET image = 'uploads/kraft-corrugated.webp' WHERE image LIKE '%Natural-Kraft-Corrugated-Insert%';
UPDATE admin_products SET image = 'uploads/kraft-paperboard.webp' WHERE image LIKE '%Natural-Kraft-Paperboard-Insert%';
UPDATE admin_products SET image = 'uploads/petg-insert.webp' WHERE image LIKE '%PETG-Blister-Insert%';
UPDATE admin_products SET image = 'uploads/pvc-insert.webp' WHERE image LIKE '%PVC-Blister-Insert%';
UPDATE admin_products SET image = 'uploads/white-corrugated.webp' WHERE image LIKE '%Standard-White-Corrugated-Insert%';

-- Update Categories Table
UPDATE admin_categories SET image = 'uploads/corrugated-divider.webp' WHERE image LIKE '%Corrugated-Box-Divider-Inserts%';
UPDATE admin_categories SET image = 'uploads/folding-divider.webp' WHERE image LIKE '%Folding-Carton-Box-Divider-Inserts%';
UPDATE admin_categories SET image = 'uploads/hips-insert.webp' WHERE image LIKE '%HIPS-Blister-Insert%';
UPDATE admin_categories SET image = 'uploads/kraft-corrugated.webp' WHERE image LIKE '%Natural-Kraft-Corrugated-Insert%';
UPDATE admin_categories SET image = 'uploads/kraft-paperboard.webp' WHERE image LIKE '%Natural-Kraft-Paperboard-Insert%';
UPDATE admin_categories SET image = 'uploads/petg-insert.webp' WHERE image LIKE '%PETG-Blister-Insert%';
UPDATE admin_categories SET image = 'uploads/pvc-insert.webp' WHERE image LIKE '%PVC-Blister-Insert%';
UPDATE admin_categories SET image = 'uploads/white-corrugated.webp' WHERE image LIKE '%Standard-White-Corrugated-Insert%';

-- Update Pages Table (if applicable)
UPDATE admin_pages SET image = 'uploads/corrugated-divider.webp' WHERE image LIKE '%Corrugated-Box-Divider-Inserts%';
UPDATE admin_pages SET image = 'uploads/folding-divider.webp' WHERE image LIKE '%Folding-Carton-Box-Divider-Inserts%';
UPDATE admin_pages SET image = 'uploads/hips-insert.webp' WHERE image LIKE '%HIPS-Blister-Insert%';
UPDATE admin_pages SET image = 'uploads/kraft-corrugated.webp' WHERE image LIKE '%Natural-Kraft-Corrugated-Insert%';
UPDATE admin_pages SET image = 'uploads/kraft-paperboard.webp' WHERE image LIKE '%Natural-Kraft-Paperboard-Insert%';
UPDATE admin_pages SET image = 'uploads/petg-insert.webp' WHERE image LIKE '%PETG-Blister-Insert%';
UPDATE admin_pages SET image = 'uploads/pvc-insert.webp' WHERE image LIKE '%PVC-Blister-Insert%';
UPDATE admin_pages SET image = 'uploads/white-corrugated.webp' WHERE image LIKE '%Standard-White-Corrugated-Insert%';
