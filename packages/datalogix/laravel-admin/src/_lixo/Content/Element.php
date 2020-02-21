<?php

namespace Datalogix\Admin\Content;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;

class Element implements Renderable
{
    protected $tag = 'div';

    protected $elements = [];

    protected $attributes = [];

    public static function make(array $elements = [], array $attributes = [])
    {
        return new static($elements, $attributes);
    }

    public function __construct(array $elements = [], array $attributes = [])
    {
        $this->elements($elements);
        $this->attributes($attributes);
    }

    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    public function elements(array $elements = [])
    {
        $this->elements = $elements;

        return $this;
    }

    public function element(...$element)
    {
        array_push($this->elements, ...$element);

        return $this;
    }

    public function attributes(array $attributes = [])
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function attribute($key, $value = true)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    protected function renderElements()
    {
        return collect($this->elements)->map(function($element) {
            if ($element instanceof Renderable) {
                return $element->render();
            }

            if ($element instanceof Htmlable) {
                return $element->toHtml();
            }

            return $element;
        })->join('');
    }

    protected function renderAttributes()
    {
        return collect($this->attributes)->map(function($value, $key) {
            if (is_numeric($key)) {
                return $value;
            }

            if (is_bool($value) && $key !== 'value') {
                return $value ? $key : '';
            }

            if (is_array($value) && $key === 'class') {
                return 'class="' . implode(' ', $value) . '"';
            }

            if (! is_null($value)) {
                return $key . '="' . e($value, false) . '"';
            }
        })->join('');
    }

    public function getTag()
    {
        if (method_exists($this, 'tag')) {
            return $this->tag();
        }

        return $this->tag;
    }

    public function render()
    {
        $tag = $this->getTag();
        $elements = $this->renderElements();
        $attributes = $this->renderAttributes();

        return "<{$tag} {$attributes}>{$elements}</{$tag}>";
    }

    public function __call($name, $arguments)
    {
        return $this->attribute(Str::kebab($name), ...$arguments);
    }

    public function __toString()
    {
        return $this->render();
    }
}
