<?php
/*
 * (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Modulework Framework Tests
 * License: View distributed LICENSE file
 *
 * 
 * This file is meant to be used in PHPUnit Tests
 */

use DaGardner\Frontage\ArrayCase;

/**
* PHPUnit Test
*/
class ArrayCaseTest extends PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $this->assertInstanceOf('DaGardner\Frontage\ArrayCase', ArrayCase::make());
    }
}