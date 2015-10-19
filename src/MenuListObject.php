<?php

namespace VilniusTechnology\BootstrapMenuBuilder;

class MenuListObject
{
    public $href;
    public $title;
    public $children;

    public function __construct($title, $children, $href = '')
    {
        $this->title = $title;
        $this->children = $children;
        $this->href = $href;
    }

}