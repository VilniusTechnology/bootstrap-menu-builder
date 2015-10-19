<?php

/*
 * Created by PhpStorm.
 * User: lukasm - vilnius.technology
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
    public function createMenu($contents)
    {
        $ul  = $this->dom->createElement('ul');
        if ($this->decorate) {
            $class = $this->dom->createAttribute('class');
            $class->value = 'dropdown-menu';
            $ul->appendChild($class);
        }

        foreach($contents as $item) {
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
     * @param MenuListObject $contents
     *
     * @return \DOMNode
     */
    public function createSubMenu($contents)
    {
        $li  = $this->dom->createElement('li');
        if ($this->decorate) {
            $class = $this->dom->createAttribute('class');
            $class->value = 'dropdown-submenu';
            $li->appendChild($class);
        }

        $title = new EntryObject('', '', $contents->href, $contents->title);

        // Create heading.
        $li->appendChild($this->createLink($title));

        // If has no children add some content to wrap it up, and stop nesting.
        if (count($contents->children) == 0) {
            $stopper  = $this->dom->createElement('li');
            $li->appendChild($stopper);

            return $li;
        }

        // Add menu, that will act as container.
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
     * Create ROOT element
     */
    public function createRoot()
    {
        $ul  = $this->dom->createElement('ul');

        if ($this->decorate) {
            $class = $this->dom->createAttribute('class');
            $class->value = 'dropdown-menu';
        }

        $ul->appendChild($class);
        $newNode = $this->dom->appendChild($ul);

        return $newNode;
    }

    /**
     * Create simple <li> entry.
     *
     * @param $item
     * @return \DOMElement
     */
    public function createEntry($item)
    {
        $li  = $this->dom->createElement('li');
        $li->appendChild($this->createLink($item));

        return $li;
    }

    /**
     * Create link <a>.
     *
     * @param $item
     * @return \DOMElement
     */
    public function createLink($item)
    {
        $aElement = $this->dom->createElement('a', $item->title);
        $hrefAttribute = $this->dom->createAttribute('href');
        $hrefAttribute->value = $item->href;
        $aElement->appendChild($hrefAttribute);

        return $aElement;
    }

    /**
     *  Test method.
     *
     * @param $contents
     * @return string
     */
    public function testBuild($contents)
    {
        $this->dom = new \DOMDocument();

        $text = new EntryObject('id1', 'parent1', 'Url1_', 'Title 1');
        $text2 = new EntryObject('id2', 'parent2', 'Url2_', 'Title 2' );


//        $list = new MenuListObject('LIST', [$text2]);
        $list = new MenuListObject('Menu List', [$text2, $text]);

//        $contents = [
//                $text,
//                $list,
//                $text2,
//        ];

        $menu = $this->createMenu($contents);

        $this->dom->appendChild($menu);
        $result = $this->dom->saveXML();

//        echo $result;
//        exit;

        return $result;
    }
}
