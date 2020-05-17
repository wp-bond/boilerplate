<?php

use Bond\Utils\Cast;
use Bond\Utils\Image;
use Bond\Utils\Str;
use Bond\Settings\Languages;

/**
 * RSS2 Feed Template for displaying RSS2 Posts feed.
 *
 * Customized from original WP: wp-includes/feed-rss2.php
 */

function the_feed_content($post)
{
    $post = Cast::post($post);
    $result = '';

    // vars
    $image_id = $post->image();
    $content = $post->content ?: $post->post_content;

    // format html
    $result .= '<a href="' . get_permalink($post->ID) . '">';
    if ($image_id) {
        $result .= '<p>';
        $result .= Image::imageTag(
            $image_id,
            'meta'
        );
        $result .= '</p>';
    }
    $result .= '</a>';

    // text
    if (!empty($content)) {
        $result .= '<p>' . Str::clean($content, 90) . '</p>';
    }

    // link
    $result .= '<p><a href="' . get_permalink($post->ID) . '">[Link]</a></p>';


    // output enconded content
    echo '<content:encoded><![CDATA[' . $result . ']]></content:encoded>';

    // output excerpt
    if (!empty($content)) {
        echo '<description>' . Str::clean($content, 40) . '</description>';
    }
}


// begin output
header('Content-Type: ' . feed_content_type('rss-http') . '; charset=UTF-8', true);

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

?><rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/">

    <channel>
        <title><?= config('app.name') ?></title>
        <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
        <link><?= config()->url() ?></link>
        <description><?= get_field('description' . Languages::fieldsSuffix(), 'options') ?></description>
        <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
        <language><?= Languages::htmlAttribute() ?></language>
        <sy:updatePeriod>hourly</sy:updatePeriod>
        <sy:updateFrequency>4</sy:updateFrequency>

        <image>
            <url><?= config()->themeUrl() . '/images/rss.png' ?></url>
            <title><?= config('app.name') ?></title>
            <link><?= config()->url() ?></link>
            <width>144</width>
            <height>144</height>
            <description><?= '' ?></description>
        </image>
        <copyright>© <?= date('Y') . ' ' . config('app.name') ?>. <?= t('All rights reserved') ?>.</copyright>

        <?php
        global $post;
        while (have_posts()) : the_post();
        ?>
            <item>
                <title><?php the_title_rss() ?></title>
                <link><?php the_permalink_rss() ?></link>
                <pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
                <dc:creator>
                    <![CDATA[<?php the_author() ?>]]>
                </dc:creator>
                <?php the_category_rss('rss2') ?>

                <guid><?= get_permalink(); ?></guid>

                <?php the_feed_content($post) ?>

                <?php rss_enclosure(); ?>

            </item>
        <?php endwhile; ?>
    </channel>
</rss>
