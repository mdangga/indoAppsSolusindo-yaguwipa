<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class SocialIcon extends Component
{
    public $link;

    public function __construct($link)
    {
        $this->link = $link;
    }

    public function iconClass(): string
    {
        $host = parse_url($this->link, PHP_URL_HOST);
        $base = Str::before(Str::after($host, 'www.'), '.');

        $knownBrands = ['facebook', 'instagram', 'youtube', 'twitter', 'x', 'linkedin', 'tiktok'];

        if (in_array($base, $knownBrands)) {
            return 'fa-brands fa-' . ($base === 'x' ? 'x-twitter' : $base);
        }

        return 'fa-solid fa-globe';
    }

    public function render()
    {
        return view('components.social-icon');
    }
}