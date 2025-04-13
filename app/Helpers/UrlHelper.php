<?php

namespace App\Helpers;

class UrlHelper
{
    /**
     * Get the URL fragment (hash) from the current URL
     * 
     * @return string|null
     */
    public static function getUrlFragment()
    {
        return isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_FRAGMENT) : null;
    }
} 