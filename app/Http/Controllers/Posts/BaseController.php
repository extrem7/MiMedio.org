<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Services\PostsService;
use Butschster\Head\Contracts\MetaTags\MetaInterface;

class BaseController extends Controller
{
    protected $postsService;

    public function __construct(MetaInterface $meta)
    {
        parent::__construct($meta);
        $this->postsService = new PostsService();
    }
}
