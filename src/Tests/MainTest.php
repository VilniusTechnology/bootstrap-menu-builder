<?php

namespace VilniusTechnology\BootstrapMenuBuilder\Tests;

use VilniusTechnology\BootstrapMenuBuilder\BootstrapMenuBuilder;
use VilniusTechnology\BootstrapMenuBuilder\EntryObject;
use VilniusTechnology\BootstrapMenuBuilder\MenuListObject;

class MainTest extends \PHPUnit_Framework_TestCase
{
    /**
     *  Test method.
     *
     * @return string
     */
    public function testMenuBuild()
    {
        $mbc = new BootstrapMenuBuilder(false);

        $text = new EntryObject('id1', 'parent1', 'Url1_', 'Title 1');
        $text2 = new EntryObject('id2', 'parent2', 'Url2_', 'Title 2' );

        $list = new MenuListObject('Menu List', [$text2, $text]);

        $contents = [
                $text,
                $list,
                $text2,
        ];

        $menu = $mbc->buildMenu($contents);

        $resultString = '<ul><li><a href="Url1_">Title 1</a></li><li><a href="">Menu List</a><ul><li><a href="Url2_">Title 2</a></li><li><a href="Url1_">Title 1</a></li></ul></li><li><a href="Url2_">Title 2</a></li></ul>
';

        $this->assertEquals($resultString, $menu, 'Menu results');
    }
}