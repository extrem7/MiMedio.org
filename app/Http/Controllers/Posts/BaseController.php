<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Services\PostsService;

class BaseController extends Controller
{
    protected $postsService;

    public function __construct()
    {
        parent::__construct();
        $this->postsService = new PostsService();
    }
}
