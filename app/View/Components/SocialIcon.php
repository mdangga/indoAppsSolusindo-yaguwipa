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

        if (!$host) {
            return 'fa-solid fa-globe';
        }

        $host = Str::lower($host);

        $knownBrands = [
            'facebook',
            'instagram',
            'youtube',
            'twitter',
            'x', // untuk x.com
            'linkedin',
            'tiktok',
            'whatsapp',
            'telegram',
            'github',
            'reddit',
            'pinterest',
            'snapchat',
            'discord',
            'medium',
            'tumblr',
            'dribbble',
            'behance',
            'microsoft'
        ];

        foreach ($knownBrands as $brand) {
            if (Str::contains($host, $brand)) {
                return 'fab fa-' . ($brand === 'x' ? 'x-twitter' : $brand);
            }
        }

        return 'fa-solid fa-globe';
    }

    public function render()
    {
        return view('components.social-icon');
    }
}
