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
     * Automatically formats rich text so that all content text is pure black (#000000),
     * while completely preserving the color of internal links (<a> tags) and removing
     * any accidental black styling from links. Also ensures all <img> tags have valid alt text.
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

        // 1. Text elements that are NOT <a> and NOT descendants of <a>: ensure color: #000000
        $textTags = ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'li', 'td', 'th', 'blockquote', 'strong', 'b', 'em', 'i', 'u', 'span'];
        $query = '//' . implode('[not(ancestor-or-self::a)] | //', $textTags) . '[not(ancestor-or-self::a)]';
        $nodes = $xpath->query($query);

        if ($nodes) {
            foreach ($nodes as $node) {
                $style = $node->getAttribute('style');
                // Remove existing color definition
                $style = preg_replace('/color\s*:\s*[^;]+;?/i', '', $style);
                $style = trim($style);
                if ($style !== '' && substr($style, -1) !== ';') {
                    $style .= ';';
                }
                $node->setAttribute('style', trim($style . ' color: #000000;'));
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
