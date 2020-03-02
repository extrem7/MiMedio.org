<?php

use App\Models\User;

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

function share_buttons(string $link): string
{
    $raw = Share::page($link, null, ['class' => 'button btn-silver-light'], '', '')
        ->twitter()
        ->facebook();
    return str_replace(['<li>', '</li>'], '', $raw);
}

function is_following(User $user): string
{
    if (Auth::check()) {
        return Auth::getUser()->isFollowing($user) ? 'true' : 'false';
    }
    return 'false';
}

function is_current_user(User $user): bool
{
    if (Auth::check() && Auth::id() === $user->id) {
        return true;
    }
    return false;
}
