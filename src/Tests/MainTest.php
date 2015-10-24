<?php

namespace VilniusTechnology\BootstrapMenuBuilder\Tests;

use VilniusTechnology\BootstrapMenuBuilder\BootstrapMenuBuilder;
use VilniusTechnology\BootstrapMenuBuilder\EntryObject;
use VilniusTechnology\BootstrapMenuBuilder\MenuListObject;
use VilniusTechnology\BootstrapMenuBuilder\TreeBuilder;

class MainTest extends \PHPUnit_Framework_TestCase
{
    /**
     *  Test method.
     *
     * @return string
     */
    public function testMenuBuild()
    {
        $resultString = '<ul class="dropdown-menu"><li><a href="Url1_">Title 1</a></li><li class="dropdown-submenu"><a href="">Menu List</a><ul class="dropdown-menu"><li><a href="Url2_">Title 2</a></li><li class="dropdown-submenu"><a href="">Menu List A</a><ul class="dropdown-menu"><li><a href="Url2_">Title 2</a></li><li><a href="Url1_">Title 1</a></li></ul></li><li><a href="Url1_">Title 1</a></li></ul></li><li><a href="Url2_">Title 2</a></li></ul>
';
        $resultStringNot = '<ul><li><a href="Url1_">Title 1</a></li><li><a href="">Menu List</a><ul><li><a href="Url2_">Title 2</a></li><li><a href="">Menu List A</a><ul><li><a href="Url2_">Title 2</a></li><li><a href="Url1_">Title 1</a></li></ul></li><li><a href="Url1_">Title 1</a></li></ul></li><li><a href="Url2_">Title 2</a></li></ul>
';

        $cases = [
            [true, $resultString],
            [false, $resultStringNot],
        ];

        $text1 = new EntryObject('id1', 'parent1', 'Url1_', 'Title 1');
        $text2 = new EntryObject('id2', 'parent2', 'Url2_', 'Title 2' );
        $listA = new MenuListObject('Menu List A', [$text2, $text1]);
        $listB = new MenuListObject('Menu List', [$text2, $listA, $text1]);

        $contents = [
                $text1,
                $listB,
                $text2,
        ];

        foreach ($cases as $case) {
            $mbc = new BootstrapMenuBuilder($case[0]);
            $menu = $mbc->buildMenu($contents);

            $this->assertEquals($case[1], $menu, 'Menu <ul> results');
        }

    }

    public function testTreeBuilder()
    {
        $result = [
            0 => [
                'id' => 1,
                'parent_id' => 0,
                'children' => [
                    0 => [
                        'parent_id' => 1,
                        'id' => 2,
                    ],
                ],
            ],
        ];

        $array = [
            ['id' => 1, 'parent_id' => 0],
            ['id' => 2, 'parent_id' => 1],
        ];

        $this->assertEquals(TreeBuilder::buildTree($array), $result, 'Tree Menu results');
    }

}