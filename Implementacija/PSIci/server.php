<?php
<<<<<<< HEAD
=======

>>>>>>> a28b661de57d085bb5de4dfdf6de03027dcde910
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */
<<<<<<< HEAD
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);
=======

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

>>>>>>> a28b661de57d085bb5de4dfdf6de03027dcde910
// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}
<<<<<<< HEAD
require_once __DIR__.'/public/index.php';
=======

require_once __DIR__.'/public/index.php';
>>>>>>> a28b661de57d085bb5de4dfdf6de03027dcde910
