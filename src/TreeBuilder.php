<?php

/*
 * Created by PhpStorm.
 * User: lukasm - vilnius.technology
 * Date: 15.5.1
 * Time: 18.55
 */

namespace VilniusTechnology\BootstrapMenuBuilder;

use VilniusTechnology\BootstrapMenuBuilder\EntryObject;
use VilniusTechnology\BootstrapMenuBuilder\MenuListObject;

/**
 * Class TreeBuilder.
 */
class TreeBuilder
{
    /**
     * Builds parent-child tree.
     *
     * @param array $elements
     * @param null  $parentId
     *
     * @return array
     */
    public static function buildTree($elements, $parentId = null)
    {
        $branch = [];
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = self::buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    /**
     * Creates nested object for bootstrap tree menu building.
     *
     * @param $elements
     * @param null $parentId
     *
     * @return array
     */
    public static function buildBootstrapTree($elements, $parentId = null)
    {
        $branch = [];
        foreach ($elements as $element) {
            if ($element->parent == $parentId) {
                $children = self::buildBootstrapTree($elements, $element->id);
                if ($children) {
                    $element = new MenuListObject($element->title, $children, $element->href);
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
}
