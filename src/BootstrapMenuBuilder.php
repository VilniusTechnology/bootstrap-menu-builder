<?php

/*
 * Created by PhpStorm.
 * User: Lukas Mikelionis - http://vilnius.technology
 * Date: 15.5.1
 * Time: 18.55
 */

namespace VilniusTechnology\BootstrapMenuBuilder;

/**
 * Class TreeBuilder.
 *
 * @package VilniusTechnology\Blog\Models
 */
class BootstrapMenuBuilder
{
    const SUB_MENU = 'sub-menu';
    const MENU = 'menu';

    /** @var \DOMDocument $dom */
    public $dom;

    /** @var boolean $decorate */
    public $decorate;

    public function __construct($decorate = true)
    {
        $this->decorate = $decorate;
    }

    public function buildMenu($contents)
    {
        $this->dom = new \DOMDocument();

        $menu = $this->createMenu($contents);
        $this->dom->appendChild($menu);
        $result = $this->dom->saveHTML();

        return $result;
    }

    /**
     * @param array $contents
     *
     * @return \DOMNode
     */
    private function createMenu($contents)
    {
        $ul  = $this->dom->createElement('ul');
        $this->addMenuClass($ul, self::MENU);

        foreach($contents as $item) {
            $element = null;
            if ($item instanceof MenuListObject) {
                $element = $this->createSubMenu($item);
            }

            if ($item instanceof EntryObject) {
                $element = $this->createEntry($item);
            }

            $ul->appendChild($element);
        }

        return $ul;
    }

    /**
     * @param MenuListObject|array $contents
     *
     * @return \DOMNode
     */
    private function createSubMenu($contents)
    {
        $li  = $this->dom->createElement('li');
        $this->addMenuClass($li, self::SUB_MENU);

        $title = new EntryObject('', '', $contents->href, $contents->title);

        // Create heading.
        $li->appendChild($this->createLink($title));

        // If has no children add some content to wrap it up, and stop nesting.
        if (count($contents->children) == 0) {
            $stopper  = $this->dom->createElement('li');
            $li->appendChild($stopper);

            return $li;
        }

        foreach ($contents as $item) {
            if (is_array($item)) {
                $element = $this->createMenu($item);
                $li->appendChild($element);
            }

            if ($item instanceof MenuListObject) {
                $element = $this->createSubMenu($item);
                $li->appendChild($element);
            }

            if ($item instanceof EntryObject) {
                $element = $this->createEntry($item);
                $li->appendChild($element);
            }
        }

        return $li;
    }

    /**
     * Create ROOT element.
     */
    public function createRoot()
    {
        $ul  = $this->dom->createElement('ul');
        $this->addMenuClass($ul, self::MENU);
        $newNode = $this->dom->appendChild($ul);

        return $newNode;
    }

    /**
     * Create simple <li> entry.
     *
     * @param EntryObject $item
     *
     * @return \DOMElement
     */
    private function createEntry($item)
    {
        $li  = $this->dom->createElement('li');
        $li->appendChild($this->createLink($item));

        return $li;
    }

    /**
     * Create link <a>.
     *
     * @param EntryObject $item
     *
     * @return \DOMElement
     */
    private function createLink($item)
    {
        $aElement = $this->dom->createElement('a', $item->title);
        $hrefAttribute = $this->dom->createAttribute('href');
        $hrefAttribute->value = $item->href;
        $aElement->appendChild($hrefAttribute);

        return $aElement;
    }

    /**
     * Adds class that represents menu element.
     *
     * @param \DOMElement $obj
     * @param string $type
     *
     * @return boolean|null
     */
    private function addMenuClass($obj, $type)
    {
        if ($this->decorate) {
            $class = $this->dom->createAttribute('class');

            if($type == self::SUB_MENU) {
                $class->value = 'dropdown-submenu';
            } else {
                $class->value = 'dropdown-menu';
            }

            $obj->appendChild($class);

            return true;
        }
    }
}
