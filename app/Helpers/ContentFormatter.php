<?php

namespace App\Helpers;

use DOMDocument;
use DOMXPath;

class ContentFormatter
{
    /**
     * Automatically formats rich text so that all content text is pure black (#000000),
     * while completely preserving the color of internal links (<a> tags) and removing
     * any accidental black styling from links.
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
            return $html;
        }

        $result = '';
        foreach ($wrapper->childNodes as $child) {
            $result .= $dom->saveHTML($child);
        }

        return $result;
    }
}
