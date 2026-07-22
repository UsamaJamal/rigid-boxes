<?php

$file = '/Users/mac/Downloads/premium-boxes (4).sql';
$handle = fopen($file, "r");
$buffer = '';
$recording = false;

while (($line = fgets($handle)) !== false) {
    if (strpos($line, "INSERT INTO `add_category`") !== false) {
        $recording = true;
    }
    if ($recording) {
        $buffer .= $line;
        if (strpos($line, ";") !== false) {
            break;
        }
    }
}
fclose($handle);

// Extract values
preg_match_all("/\(\s*([0-9]+)\s*,\s*'([^']+)'\s*,\s*'([^']+)'\s*,\s*'([^']*)'\s*,\s*'([^']*)'\s*,\s*'([^']*)'\s*,\s*'([^']*)'\s*,\s*'([^']*)'/s", $buffer, $matches, PREG_SET_ORDER);

echo "Total Categories Extracted: " . count($matches) . "\n\n";

$byParent = [];
foreach ($matches as $m) {
    $id = $m[1];
    $name = $m[2];
    $url = $m[3];
    $parent = $m[8];

    $byParent[$parent][] = [
        'id' => $id,
        'name' => $name,
        'url' => $url,
        'parent' => $parent
    ];
}

foreach ($byParent as $p => $children) {
    echo "Parent ID: '$p' (" . count($children) . " categories):\n";
    foreach ($children as $c) {
        echo "   - [ID: {$c['id']}] {$c['name']} (URL: {$c['url']})\n";
    }
    echo "\n";
}
