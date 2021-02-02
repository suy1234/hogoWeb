<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;

class Share extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'data' => [],
        'data_view' => [],
        'blade' => 1
    ];

    public function run()
    {
        $socials = [
            [
                'icon' => 'fa fa-facebook',
                'link' => 'http://www.facebook.com/share.php?u=[URL]&t=[TITLE]'
            ],
            [
                'icon' => 'fa fa-twitter',
                'link' => 'https://twitter.com/share?url=[URL]&via=[TITLE]&text=[DESCRIPTION]'
            ],
            [
                'icon' => 'fa fa-pinterest',
                'link' => 'https://www.pinterest.com/pin/create/button/?url=[URL]&media=[IMG]'
            ],
            [
                'icon' => 'fa fa-google-plus',
                'link' => 'https://plus.google.com/share?url=[URL]'
            ],
            [
                'icon' => 'fa fa-reddit',
                'link' => 'http://www.reddit.com/submit?url=[URL]&title=[TITLE]'
            ],
            [
                'icon' => 'fa fa-tumblr',
                'link' => 'http://www.tumblr.com/share?v=3&u=[URL]&t=[TITLE]'
            ],
            [
                'icon' => 'fa fa-linkedin',
                'link' => 'http://www.linkedin.com/shareArticle?mini=true&url=[URL]&title=[TITLE]&source='.url('/')
            ],
            [
                'icon' => 'fa fa-digg',
                'link' => 'http://www.digg.com/submit?phase=2&url=[URL]&title=[TITLE]'
            ],
            [
                'icon' => 'fa fa-stumbleupon-circle',
                'link' => 'http://www.stumbleupon.com/submit?url=[URL]&title=[TITLE]'
            ],
        ];
        return view('widgets.share.'.$this->config['blade'], [
            'id' => $this->config['data']['id'],
            'data' => $this->config['data_view'],
            'url' => url('/').'/'.$this->config['data_view']['alias'],
            'socials' => $socials
        ]);
    }
}