<?php

namespace App;

use App\Controllers\App;

/**
 * Return if Shortcodes already exists.
 */
if (class_exists('Shortcodes')) {
    return;
}

/**
 * Shortcodes
 */
class Shortcodes
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $shortcodes = [
            'box'
        ];

        return collect($shortcodes)
            ->map(function ($shortcode) {
                return add_shortcode($shortcode, [$this, strtr($shortcode, ['-' => '_'])]);
            });
    }

    /**
     * Social Links
     * Uses Social URLs specified in Yoast SEO. See SEO > Social
     * @param  array  $atts
     * @param  string $content
     * @return string
     */
    public function box($atts, $content = null)
    {
        return '<h1 class="box">321</h1>';
    }
}

new Shortcodes();
