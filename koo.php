
<?php

/**
 * Automatic Posting a Koo
 */
function so_post_40744782($new_status, $old_status, $post)
{
    if ($new_status == 'publish' && $old_status != 'publish') {
        $data = [
            'koo' => substr(
                strip_tags(
                    get_post_field('post_content', $post->ID)
                ),
                0,
                340
            ) . ' ...',
            'language' => 'hi',
            'link' => get_the_permalink($post->ID)
        ];

        $url = 'https://api.kooapp.com/api/post/koo';
        $response = wp_remote_post(
            $url,
            array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'sslverify' => false,
                'blocking' => false,
                'headers' => array(
                    'Content-Type' => 'application/json',
                    'X-KOO-API-TOKEN' => 'xxxxxxxxx-xxx-xxxxxx-xxxx',
                    'Accept' => 'application/json',
                ),
                'body' => json_encode($data),
                'cookies' => array()
            )
        );
    }
}
add_action('transition_post_status', 'so_post_40744782', 10, 3);
