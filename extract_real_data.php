<?php

$sqlFile = '/Users/mac/Downloads/premium-boxes (4).sql';
if (!file_exists($sqlFile)) {
    die("File not found: $sqlFile\n");
}

$sql = file_get_contents($sqlFile);

// Parse add_category table
preg_match('/INSERT INTO `add_category` \((.*?)\) VALUES\s*(.*?);/s', $sql, $catMatch);

$categories = [];
if (!empty($catMatch[2])) {
    $valuesStr = $catMatch[2];
    // Match rows: (val1, val2, ...)
    preg_match_all('/\((.*?)\)(?:,|\s*$)/s', $valuesStr, $rows);
    foreach ($rows[1] as $rowStr) {
        $cols = str_getcsv($rowStr, ',', "'");
        if (count($cols) >= 8) {
            $catId = trim($cols[0]);
            $name = trim($cols[1]);
            $url = trim($cols[2]);
            $parent = trim($cols[7]);
            $image = trim($cols[8] ?? '');
            $icon = trim($cols[14] ?? '');
            $showNav = trim($cols[25] ?? '1');

            $categories[] = [
                'cat_id' => $catId,
                'name' => $name,
                'url' => $url,
                'parent' => $parent,
                'image' => $image,
                'icon' => $icon,
                'show_in_nav' => $showNav
            ];
        }
    }
}

echo "Found " . count($categories) . " categories from premium-boxes (4).sql:\n";
print_r(array_slice($categories, 0, 15));

// Parse product / products table
preg_match('/INSERT INTO `product` \((.*?)\) VALUES\s*(.*?);/s', $sql, $prodMatch);
if (empty($prodMatch[2])) {
    preg_match('/INSERT INTO `products` \((.*?)\) VALUES\s*(.*?);/s', $sql, $prodMatch);
}

$products = [];
if (!empty($prodMatch[2])) {
    $valuesStr = $prodMatch[2];
    preg_match_all('/\((.*?)\)(?:,|\s*$)/s', $valuesStr, $rows);
    foreach ($rows[1] as $rowStr) {
        $cols = str_getcsv($rowStr, ',', "'");
        if (count($cols) >= 4) {
            $products[] = [
                'id' => trim($cols[0]),
                'name' => trim($cols[1]),
                'url' => trim($cols[2] ?? ''),
                'cat_id' => trim($cols[3] ?? ''),
                'image' => trim($cols[4] ?? '')
            ];
        }
    }
}

echo "Found " . count($products) . " products from premium-boxes (4).sql:\n";
print_r(array_slice($products, 0, 15));

