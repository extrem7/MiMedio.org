<?php

namespace App\Http\Controllers;

use Butschster\Head\Contracts\MetaTags\MetaInterface as Meta;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $meta;

    public function __construct()
    {
        $this->meta = app(Meta::class);
    }
}
