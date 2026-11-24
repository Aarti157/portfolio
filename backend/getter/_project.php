<?php

function get_project_by_id(int $id): array {
    // -> collect data
    $title = get_the_title($id);
    $video = carbon_get_post_meta($id, 'video');
    $thumbnail_id = carbon_get_post_meta($id, 'thumbnail');
    $thumbnail = get_media_by_id($thumbnail_id);
    $client = carbon_get_post_meta($id, 'client');
    $release_date = carbon_get_post_meta($id, 'release_date');
    $description = carbon_get_post_meta($id, 'description');
    $credits = carbon_get_post_meta($id, 'credits');

    // -> Datum lesbar machen, z. B. "September 2025"
    $date = $release_date ? date_i18n('F Y', strtotime($release_date)) : '';

    // -> Vimeo-ID aus dem Link holen, z. B. https://vimeo.com/123456789 → 123456789
    preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $video, $matches);
    $vimeo_id = $matches[1] ?? '';

    // -> return data
    return [
        'id' => $id,
        'title' => $title,
        'link' => get_permalink($id),
        'video' => $video,
        'vimeo_id' => $vimeo_id,
        'thumbnail' => $thumbnail,
        'client' => $client,
        'date' => $date,
        'description' => $description,
        'credits' => $credits,
    ];
}