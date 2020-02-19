<?php

if (!function_exists('get_option')) {

    function get_option(string $name)
    {
        return setting()->get($name);
    }
}

if (!function_exists('get_image')) {

    function get_image(string $name)
    {
        return url('/') . '/storage/' . setting()->get($name);
    }
}

if (!function_exists('get_svg')) {
    function get_svg(string $name)
    {
        //todo asset()
        $icon = file_get_contents("assets/img/icons/$name.svg");

        return $icon;
    }
}

if (!function_exists('was_validated')) {
    function was_validated(Illuminate\Support\ViewErrorBag $errors)
    {
        return $errors->isNotEmpty() ? 'was-validated' : '';
    }
}

if (!function_exists('valid_class')) {
    function valid_class(string $name, Illuminate\Support\ViewErrorBag $errors)
    {
        if ($errors->isNotEmpty()) return $errors->has($name) ? 'is-invalid' : 'is-valid';
    }
}

function selected($condition = false): string
{
    if ($condition) {
        echo 'selected';
    }
    return '';
}
