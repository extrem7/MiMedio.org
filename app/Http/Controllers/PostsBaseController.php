<?php

namespace App\Http\Controllers;

use App\Services\PostsService;
use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Illuminate\Http\Request;

class PostsBaseController extends Controller
{
    protected $postsService;

    public function __construct(MetaInterface $meta)
    {
        parent::__construct($meta);
        $this->postsService = new PostsService();
    }
}
