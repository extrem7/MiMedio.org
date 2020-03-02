<?php

namespace App\Traits;

use Illuminate\Pagination\Paginator;

Trait PaginateTrait
{
    public static function scopePaginateUri($query, $items, $page)
    {

        $action = app('request')->route()->getActionName();
        $parameters = app('request')->route()->parameters();
        $parameters['page'] = '##';
        if (isset($parameters['category'])) {
            $parameters['category'] = $parameters['category']->slug;
        }
        $current_url = action(str_replace('App\Http\Controllers\\', '', $action), $parameters);
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });
        $paginate = $query->paginate($items);

        $links = preg_replace('@href="(.*/?page=(\d+))"@U', 'href="' . str_replace('##', '$2', $current_url) . '"', $paginate->render());
        $paginate->linksUri = $links;
        return $paginate;
    }
}
