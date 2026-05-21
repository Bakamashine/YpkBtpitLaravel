<?php


if (!function_exists('get_image_or_default')) {
    function get_image_or_default(?string $path_to_image): string {
        return $path_to_image ? asset('storage/' . $path_to_image) : asset('/img/default_image.jpg');
    }
}
