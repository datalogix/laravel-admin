<?php

namespace Datalogix\Admin\Content;

use Illuminate\Contracts\Support\Renderable;

class MenuItem implements Renderable
{
    protected $title;
    protected $subtitle;
    protected $icon;
    protected $iconAlign;
    protected $href;
    protected $to;
    protected $target;

    public static function make($title)
    {
        return new static($title);
    }

    public function __construct($title)
    {
        $this->title($title);
    }

    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    public function subtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function icon($icon, $iconAlign = 'left')
    {
        $this->icon = $icon;
        $this->iconAlign = $iconAlign;

        return $this;
    }

    public function href($href, $target = false)
    {
        $this->href = $href;

        return $this->target($target);
    }

    public function to($to, $target = false)
    {
        $this->to = $to;

        return $this->target($target);
    }

    public function target($target)
    {
        $this->target = is_bool($target) && $target ? '_blank' : $target;

        return $this;
    }

    public function render()
    {
        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'icon' => $this->icon,
            'iconAlign' => $this->iconAlign,
            'href' => $this->href,
            'to' => $this->to,
            'target' => $this->target,
        ];

        return view('admin::content.menu-item', $data)->render();
    }

    public function __toString()
    {
        return $this->render();
    }
}
