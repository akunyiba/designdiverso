<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable custom logo
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-logo
     */
    add_theme_support('custom-logo');

    /**
     * Enable wide alignment
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment
     */
    add_theme_support('align-wide');

    /**
     * Register custom colors in block Color Palettes
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment
     */
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('Primary', 'sage'),
            'slug'  => 'primary',
            'color' => '#ed5b00',
        ),
        array(
            'name'  => __('Black', 'sage'),
            'slug'  => 'black',
            'color' => '#000',
        ),
        array(
            'name'  => __('Grey Dark', 'sage'),
            'slug'  => 'grey-dark',
            'color' => '#11100e',
        ),
        array(
            'name'  => __('White', 'sage'),
            'slug'  => 'white',
            'color' => '#fff',
        ),
        array(
            'name'  => __('Grey Light', 'sage'),
            'slug'  => 'grey-light',
            'color' => '#f4f4f4',
        ),
        array(
            'name'  => __('Transparent', 'sage'),
            'slug'  => 'transparent',
            'color' => 'transparent',
        ),
        array(
            'name'  => __('Gradient 1', 'sage'),
            'slug'  => 'gradient-1',
            'color' => 'linear-gradient(135deg,#ff7715,#ff6227 20%,#ff4f35 40%,#ff3945 60%,#ff1d58 80%,#ff0d63)',
        ),
        array(
            'name'  => __('Gradient 2', 'sage'),
            'slug'  => 'gradient-2',
            'color' => 'linear-gradient(135deg,#ff7815,#fb720f 20%,#f56705 40%,#f05e02 60%,#ed5900 80%,#e95300)',
        ),
    ));

    /**
     * Disable custom colors in block Color Palettes
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-colors-in-block-color-palettes
     */
    // add_theme_support('disable-custom-colors');


    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

/**
 * Gutenberg scripts and styles
 * @link https://developer.wordpress.org/reference/hooks/enqueue_block_editor_assets/
 */
add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_script('sage/gutenberg.js', asset_path('scripts/gutenberg.js'), array('wp-blocks', 'wp-dom'), false, true); // filemtime(asset_path('scripts/gutenberg.js'))
    wp_enqueue_style('sage/gutenberg.css', asset_path('styles/gutenberg.css'), false, null);
});

/**
 * Register Custom Post Types
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 */
add_action('init', function () {
    $labels = array(
        'name'                  => _x('Case Studies', 'Post Type General Name', 'sage'),
        'singular_name'         => _x('Case Study', 'Post Type Singular Name', 'sage'),
        'menu_name'             => __('Case Studies', 'sage'),
        'name_admin_bar'        => __('Case Studies', 'sage'),
        'archives'              => __('Item Archives', 'sage'),
        'attributes'            => __('Item Attributes', 'sage'),
        'parent_item_colon'     => __('Parent Item:', 'sage'),
        'all_items'             => __('All Items', 'sage'),
        'add_new_item'          => __('Add New Item', 'sage'),
        'add_new'               => __('Add New', 'sage'),
        'new_item'              => __('New Item', 'sage'),
        'edit_item'             => __('Edit Item', 'sage'),
        'update_item'           => __('Update Item', 'sage'),
        'view_item'             => __('View Item', 'sage'),
        'view_items'            => __('View Items', 'sage'),
        'search_items'          => __('Search Item', 'sage'),
        'not_found'             => __('Not found', 'sage'),
        'not_found_in_trash'    => __('Not found in Trash', 'sage'),
        'featured_image'        => __('Featured Image', 'sage'),
        'set_featured_image'    => __('Set featured image', 'sage'),
        'remove_featured_image' => __('Remove featured image', 'sage'),
        'use_featured_image'    => __('Use as featured image', 'sage'),
        'insert_into_item'      => __('Insert into item', 'sage'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'sage'),
        'items_list'            => __('Items list', 'sage'),
        'items_list_navigation' => __('Items list navigation', 'sage'),
        'filter_items_list'     => __('Filter items list', 'sage'),
    );
    $args = array(
        'label'                 => __('Case Study', 'sage'),
        'description'           => __('Case Study', 'sage'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'taxonomies'            => array('case_study_category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type('case_study', $args);
}, 0);

/**
 * Register Custom Taxonomies
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 */
add_action('init', function () {
    $labels = array(
        'name'                       => _x('Categories', 'Taxonomy General Name', 'sage'),
        'singular_name'              => _x('Category', 'Taxonomy Singular Name', 'sage'),
        'menu_name'                  => __('Categories', 'sage'),
        'all_items'                  => __('All Items', 'sage'),
        'parent_item'                => __('Parent Item', 'sage'),
        'parent_item_colon'          => __('Parent Item:', 'sage'),
        'new_item_name'              => __('New Item Name', 'sage'),
        'add_new_item'               => __('Add New Item', 'sage'),
        'edit_item'                  => __('Edit Item', 'sage'),
        'update_item'                => __('Update Item', 'sage'),
        'view_item'                  => __('View Item', 'sage'),
        'separate_items_with_commas' => __('Separate items with commas', 'sage'),
        'add_or_remove_items'        => __('Add or remove items', 'sage'),
        'choose_from_most_used'      => __('Choose from the most used', 'sage'),
        'popular_items'              => __('Popular Items', 'sage'),
        'search_items'               => __('Search Items', 'sage'),
        'not_found'                  => __('Not Found', 'sage'),
        'no_terms'                   => __('No items', 'sage'),
        'items_list'                 => __('Items list', 'sage'),
        'items_list_navigation'      => __('Items list navigation', 'sage'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
    );
    register_taxonomy('case_study_category', array('case_study'), $args);
}, 0);
