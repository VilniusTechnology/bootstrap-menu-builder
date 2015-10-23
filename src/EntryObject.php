<?php

namespace VilniusTechnology\BootstrapMenuBuilder;

class EntryObject {

    public $id;

    public $parent;

    public $href;

    public $title;


    public function __construct($id, $parent, $href = '', $title = '')
    {
        $this->id = $id;
        $this->parent = $parent;
        $this->href = $href;
        $this->title = $title;
    }

}