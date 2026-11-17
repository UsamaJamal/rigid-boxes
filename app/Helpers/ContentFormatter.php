<?php

namespace App\Helpers;

use DOMDocument;
use DOMXPath;

class ContentFormatter
{
    /**
     * Known image filename to clean alt text mappings.
     */
    protected static $knownImageAlts = [
        'folding-carton-packaging-structure' => 'Folding Carton Packaging Structure',
        'rigid-box-packaging-construction' => 'Rigid Box Packaging Construction',
        'rigid-boxes-vs-other-packaging-types' => 'Rigid Boxes vs Other Packaging Types',
        'luxury-watch-boxes' => 'Luxury Watch Boxes',
        'custom-magnetic-gift-boxes' => 'Custom Magnetic Gift Boxes',
        'custom-cufflink-boxes' => 'Custom Cufflink Boxes',
        'personalized-makeup-boxes' => 'Personalized Makeup Boxes',
        'custom-bra-boxes' => 'Custom Bra Boxes',
        'coffee-boxes' => 'Custom Coffee Boxes',
        'trusted-true-girl' => 'TrueGirl',
        'trusted-jeeter-mart' => 'Jeeter Mart',
        'trusted-bass-pro-shop' => 'Bass Pro Shops',
        'trusted-hulu-motor' => 'The Hulu Motel',
        'trusted-red-bull-logo' => 'Red Bull',
        'trusted-kinky' => 'Kinky',
        'trusted-voli-logo' => 'Voli',
        'trusted-burger-bar' => 'Burger Bar',
        'trusted-flowgardens-logo' => 'Flowgardens',
        'trusted-her-piece-peace-logo' => 'Her Piece Peace',
        'trusted-neat-logo' => 'Neat',
        'trusted-springtastic-logo' => 'Springtastic',
    ];

    /**
     * Ensures every <img> tag has a meaningful, non-empty alt attribute.
     */
    public static function ensureImageAlts(?string $html): string
    {
        if (empty($html) || !is_string($html)) {
            return (string) $html;
        }

        if (stripos($html, '<img') === false) {
            return $html;
        }

        $dom = new DOMDocument();
        $previousValue = libxml_use_internal_errors(true);

        $wrapped = '<?xml encoding="utf-8" ?><div>' . $html . '</div>';
        $loaded = $dom->loadHTML($wrapped, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        libxml_use_internal_errors($previousValue);

        if (!$loaded) {
            return $html;
        }

        $imgs = $dom->getElementsByTagName('img');
        if ($imgs->length === 0) {
            return $html;
        }

        foreach ($imgs as $img) {
            $alt = trim($img->getAttribute('alt'));
            if ($alt === '') {
                $src = $img->getAttribute('src');
                $filename = pathinfo(parse_url($src, PHP_URL_PATH) ?? '', PATHINFO_FILENAME);
                
                $generatedAlt = '';
                if ($filename) {
                    if (isset(self::$knownImageAlts[$filename])) {
                        $generatedAlt = self::$knownImageAlts[$filename];
                    } else {
                        // Title case cleaned filename
                        $cleaned = preg_replace('/[-_]+/', ' ', $filename);
                        $cleaned = preg_replace('/\s+/', ' ', trim($cleaned));
                        $generatedAlt = ucwords(strtolower($cleaned));
                    }
                }

                if ($generatedAlt === '') {
                    $generatedAlt = 'Rigid Boxes Packaging';
                }

                $img->setAttribute('alt', $generatedAlt);
            }
        }

        $wrapper = $dom->getElementsByTagName('div')->item(0);
        if (!$wrapper) {
            return $html;
        }

        $result = '';
        foreach ($wrapper->childNodes as $child) {
            $result .= $dom->saveHTML($child);
        }

        return $result;
    }

    /**
     * Checks if a CSS color value is an empty, default, or accidental pasted grey/black shade.
     */
    protected static function isPastedGreyOrEmpty(?string $col): bool
    {
        if (empty($col)) {
            return true;
        }
        $c = strtolower(trim($col));
        if (in_array($c, ['#000', '#000000', 'black', 'rgb(0, 0, 0)', 'rgb(0,0,0)'])) {
            return true;
        }
        // Match 3-digit or 6-digit repeating hex codes (#333, #555555, etc.)
        if (preg_match('/^#([0-9a-f])\1\1$/i', $c) || preg_match('/^#([0-9a-f]{2})\1\1$/i', $c)) {
            return true;
        }
        // Match rgb/rgba grey shades where r, g, b are very close to each other
        if (preg_match('/^rgba?\((\d+),\s*(\d+),\s*(\d+)/', $c, $m)) {
            $r = (int) $m[1];
            $g = (int) $m[2];
            $b = (int) $m[3];
            if (abs($r - $g) <= 15 && abs($g - $b) <= 15 && abs($r - $b) <= 15) {
                return true;
            }
        }
        return false;
    }

    /**
     * Automatically formats rich text so that content text defaults to pure black (#000000),
     * while completely preserving:
     * 1. The color of internal links (<a> tags)
     * 2. Any custom table heading or table text colors (<th>, <td>, <table>) from code or user selection
     * Also ensures all <img> tags have valid alt text.
     */
    public static function autoBlackenContent(?string $html): string
    {
        if (empty($html) || !is_string($html)) {
            return (string) $html;
        }

        $dom = new DOMDocument();
        $previousValue = libxml_use_internal_errors(true);

        // UTF-8 wrapper to prevent character encoding degradation
        $wrapped = '<?xml encoding="utf-8" ?><div>' . $html . '</div>';
        $loaded = $dom->loadHTML($wrapped, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        libxml_use_internal_errors($previousValue);

        if (!$loaded) {
            return $html;
        }

        $xpath = new DOMXPath($dom);

        // 1. Text elements OUTSIDE of <a> and OUTSIDE of <table>: ensure default black #000000
        $textTags = ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'li', 'blockquote', 'strong', 'b', 'em', 'i', 'u', 'span'];
        $query = '//' . implode('[not(ancestor-or-self::a) and not(ancestor-or-self::table)] | //', $textTags) . '[not(ancestor-or-self::a) and not(ancestor-or-self::table)]';
        $nodes = $xpath->query($query);

        if ($nodes) {
            foreach ($nodes as $node) {
                $style = $node->getAttribute('style');
                // Extract current color if present
                $curColor = '';
                if (preg_match('/color\s*:\s*([^;]+);?/i', $style, $cm)) {
                    $curColor = trim($cm[1]);
                }

                $tagName = strtolower($node->nodeName);
                $isBlock = in_array($tagName, ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'li', 'blockquote']);

                // If no color, or if it is an accidental pasted grey/black shade, or if it's a standard block element: set #000000
                if ($isBlock || self::isPastedGreyOrEmpty($curColor)) {
                    $style = preg_replace('/color\s*:\s*[^;]+;?/i', '', $style);
                    $style = trim($style);
                    if ($style !== '' && substr($style, -1) !== ';') {
                        $style .= ';';
                    }
                    $node->setAttribute('style', trim($style . ' color: #000000;'));
                }
            }
        }

        // 2. Links (<a>) and anything inside <a>: remove any forced black color so link color is preserved!
        $linkNodes = $xpath->query('//a | //a//*');
        if ($linkNodes) {
            foreach ($linkNodes as $linkNode) {
                if ($linkNode->hasAttribute('style')) {
                    $style = $linkNode->getAttribute('style');
                    $cleanStyle = preg_replace('/color\s*:\s*(#000000|#000|rgb\(0,\s*0,\s*0\)|black)\s*;?/i', '', $style);
                    $cleanStyle = trim($cleanStyle);
                    if ($cleanStyle === '') {
                        $linkNode->removeAttribute('style');
                    } else {
                        $linkNode->setAttribute('style', $cleanStyle);
                    }
                }
            }
        }

        // Note: Elements inside <table> (th, td, tr, thead, etc.) are NOT touched by the query above,
        // so any custom text color, heading color, or background color in tables remains 100% preserved!

        $wrapper = $dom->getElementsByTagName('div')->item(0);
        if (!$wrapper) {
            return self::ensureImageAlts($html);
        }

        $result = '';
        foreach ($wrapper->childNodes as $child) {
            $result .= $dom->saveHTML($child);
        }

        return self::ensureImageAlts($result);
    }
}
