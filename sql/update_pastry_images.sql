-- ============================================
-- Update Pastry Product Images
-- For NextCafe Coffee Shop
-- ============================================

USE `nextcafe_ecomms`;

-- Update Banana Bread
UPDATE `products` 
SET `image_url` = 'images/bananabread.jpg', `updated_at` = NOW() 
WHERE `product_name` = 'Banana Bread';

-- Update Cinnamon Roll
UPDATE `products` 
SET `image_url` = 'images/cinnamonrolls.jpg', `updated_at` = NOW() 
WHERE `product_name` = 'Cinnamon Roll';

-- Update Chocolate Muffin
UPDATE `products` 
SET `image_url` = 'images/chocolatemuffins.webp', `updated_at` = NOW() 
WHERE `product_name` = 'Chocolate Muffin';

-- Update Butter Croissant
UPDATE `products` 
SET `image_url` = 'images/buttercroissants.jpg', `updated_at` = NOW() 
WHERE `product_name` = 'Butter Croissant';

-- Update Blueberry Muffin
UPDATE `products` 
SET `image_url` = 'images/blueberrymuffins.jpg', `updated_at` = NOW() 
WHERE `product_name` = 'Blueberry Muffin';

-- Verify updates (optional, for manual check)
-- SELECT product_name, image_url FROM products WHERE category = 'Pastries';
