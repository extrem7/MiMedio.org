<?php


namespace App\Interfaces;

interface Likeable
{
    public function likes();

    public function dislikes();

    public function getLikesCountAttribute();

    public function getDislikesCountAttribute();

    public function getCurrentLikeAttribute();
}
