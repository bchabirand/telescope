<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue();
    bundle('blocks')->enqueue();
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('app')->enqueue();
    bundle('blocks')->enqueue();
    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    // add_theme_support('soil', [
    //     'clean-up',
    //     'nav-walker',
    //     'nice-search',
    //     'relative-urls',
    // ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'secondary_navigation' => __('Secondary Navigation', 'sage'),
        'footer_1' => __('Footer 1', 'sage'),
        'footer_2' => __('Footer 2', 'sage'),
        'footer_3' => __('Footer 3', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');

    // Images sizes
    add_image_size( 'post-thumbnail', 328, 200, true );
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */

// add_action('widgets_init', function () {
//     $config = [
//         'before_widget' => '<section class="widget %1$s %2$s">',
//         'after_widget' => '</section>',
//         'before_title' => '<h3>',
//         'after_title' => '</h3>',
//     ];

//     register_sidebar([
//         'name' => __('Primary', 'sage'),
//         'id' => 'sidebar-primary',
//     ] + $config);

//     register_sidebar([
//         'name' => __('Footer', 'sage'),
//         'id' => 'sidebar-footer',
//     ] + $config);
// });


/**
 * Render callback for ACF $blocks
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

function acf_block_render_callback( $block ) {
  $slug = str_replace('acf/', '', $block['name']);
  $block['slug'] = $slug;
  echo \Roots\view("blocks/${slug}", ['block' => $block])->render();
}


add_action('acf/init', function() {
  if( function_exists('acf_register_block') ) {
    // Look into views/blocks
    $dir = new \DirectoryIterator(locate_template("resources/views/blocks/"));

    // Loop through found blocks
    foreach ($dir as $fileinfo) {
      if (!$fileinfo->isDot()) {
        $slug = str_replace('.blade.php', '', $fileinfo->getFilename());

        // Get infos from file
        $file_path = locate_template("resources/views/blocks/${slug}.blade.php");
        $file_headers = get_file_data($file_path, [
          'title' => 'Title',
          'description' => 'Description',
          'category' => 'Category',
          'icon' => 'Icon',
          'keywords' => 'Keywords',
        ]);

        if( empty($file_headers['title']) ) {
          die( _e('This block needs a title: ' . $file_path));
        }

        if( empty($file_headers['category']) ) {
          die( _e('This block needs a category: ' . $file_path));
        }

        // Register a new block
        $datas = [
          'name' => $slug,
          'title' => $file_headers['title'],
          'description' => $file_headers['description'],
          'category' => $file_headers['category'],
          'icon' => $file_headers['icon'],
          'keywords' => explode(' ', $file_headers['keywords']),
          'render_callback'  => 'App\acf_block_render_callback',
        ];

        acf_register_block($datas);
      }
    }
  }
});

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}