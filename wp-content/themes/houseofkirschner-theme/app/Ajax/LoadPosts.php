<?php

namespace App\Ajax;

use Illuminate\Mail\Mail;
use Illuminate\Ajax;

class LoadPosts extends Ajax
{
	static function privMethod()
	{
        global $query_args;
        $query_args = $_POST['query_args'];
        include get_stylesheet_directory() . '/views/general/posts.php';
        die;
    }
}
