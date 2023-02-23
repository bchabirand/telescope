<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'siteName' => $this->siteName(),
            'posts' => $this->getPosts(),
            'socialNetworks' => $this->getSocialNetworks()
        ];
    }

    /**
     * Returns the site name.
     *
     * @return string
     */
    public function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    /**
     * Get posts
     *
     * @return string
     */
    public function getPosts()
    {
        $posts = get_posts([
            'post_type' => 'post',
            'numberposts' => -1,
        ]);

        foreach($posts as $post) {
            $post->url = get_permalink($post->ID);
            $post->date = date_i18n('j M Y', strtotime(get_the_date('Y-m-d H:i:s')));
            $post->thumbnail = get_the_post_thumbnail($post->ID, 'post-thumbnail');
        }

        return $posts;
    }

    /**
     * Get social networks
     *
     * @return string
     */
    public function getSocialNetworks()
    {
        $socialNetworks = [
            'facebook' => get_field('facebook', 'options') ?: null,
            'instagram' => get_field('instagram', 'options') ?: null,
            'twitter' => get_field('twitter', 'options') ?: null,
            'twitch' => get_field('twitch', 'options') ?: null,
        ];

        return $socialNetworks;
    }
}
