<?php

namespace Datalogix\Admin\Content;

use Illuminate\Contracts\Support\Renderable;

class MenuItemGroup implements Renderable
{
    protected $title;
    protected $subtitle;
    protected $icon;
    protected $subgroup;
    protected $opened;
    protected $elements;

    public static function make($title, array $elements = [])
    {
        return new static($title, $elements);
    }

    public function __construct($title, array $elements = [])
    {
        $this->title($title);
        $this->elements($elements);
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

    public function icon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function subgroup($subgroup = true)
    {
        $this->subgroup = $subgroup;

        return $this;
    }

    public function opened($opened = true)
    {
        $this->opened = $opened;

        return $this;
    }

    public function elements(array $elements = [])
    {
        $this->elements = $elements;

        return $this;
    }

    public function render()
    {
        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'icon' => $this->icon,
            'subgroup' => $this->subgroup,
            'opened' => $this->opened,
            'elements' => $this->elements,
        ];

        return view('admin::content.menu-item-group', $data)->render();
    }

    public function __toString()
    {
        return $this->render();
    }
}
