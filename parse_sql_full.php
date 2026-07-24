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
        if (strpos($line, ";") !== false && strpos($line, "INSERT INTO") === false) {
            break;
        }
    }
}
fclose($handle);

// Remove the INSERT INTO prefix
$buffer = preg_replace('/INSERT INTO `add_category` \([^)]+\) VALUES/i', '', $buffer);
$buffer = trim(trim($buffer), ';');

// Parse individual tuple rows: ( ... ), ( ... )
$rows = [];
$len = strlen($buffer);
$inString = false;
$quoteChar = '';
$current = '';
$depth = 0;

for ($i = 0; $i < $len; $i++) {
    $c = $buffer[$i];
    if ($inString) {
        $current .= $c;
        if ($c === $quoteChar && $buffer[$i - 1] !== '\\') {
            $inString = false;
        }
    } else {
        if ($c === "'" || $c === '"') {
            $inString = true;
            $quoteChar = $c;
            $current .= $c;
        } elseif ($c === '(') {
            if ($depth === 0) {
                $current = '';
            } else {
                $current .= $c;
            }
            $depth++;
        } elseif ($c === ')') {
            $depth--;
            if ($depth === 0) {
                $rows[] = $current;
            } else {
                $current .= $c;
            }
        } else {
            if ($depth > 0) {
                $current .= $c;
            }
        }
    }
}

echo "Total Raw Rows Parsed: " . count($rows) . "\n\n";

$categories = [];
foreach ($rows as $r) {
    $cols = str_getcsv($r, ',', "'");
    if (count($cols) >= 8) {
        $categories[] = [
            'id' => trim($cols[0]),
            'name' => trim($cols[1]),
            'url' => trim($cols[2]),
            'parent' => trim($cols[7]),
            'image' => trim($cols[8] ?? ''),
            'icon' => trim($cols[14] ?? ''),
            'show_in_nav' => trim($cols[25] ?? '1')
        ];
    }
}

echo "Total Valid Categories Extracted: " . count($categories) . "\n\n";

$parents = [];
$children = [];

foreach ($categories as $cat) {
    if (empty($cat['parent']) || $cat['parent'] === '0') {
        $parents[$cat['id']] = $cat;
    } else {
        $children[$cat['parent']][] = $cat;
    }
}

echo "Top Level Parent Categories (" . count($parents) . "):\n";
foreach ($parents as $pid => $p) {
    $childList = $children[$pid] ?? [];
    echo "📌 Parent [ID: $pid]: {$p['name']} (URL: {$p['url']}) -> Has " . count($childList) . " children\n";
    foreach ($childList as $ch) {
        echo "     └─ Child [ID: {$ch['id']}]: {$ch['name']} (URL: {$ch['url']})\n";
    }
    echo "\n";
}

// Print orphaned children if any
foreach ($children as $pid => $clist) {
    if (!isset($parents[$pid])) {
        echo "⚠️ Parent ID $pid (Not in parent array) has " . count($clist) . " children:\n";
        foreach ($clist as $ch) {
            echo "     └─ Child [ID: {$ch['id']}]: {$ch['name']} (URL: {$ch['url']})\n";
        }
        echo "\n";
    }
}

