<?php
/**
 * This file is part of Trinity package.
 */

namespace Trinity\Bundle\AdminBundle\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class EmptyTest
 * @package Trinity\Bundle\AdminBundle\Tests
 */
class EmptyTest extends TestCase
{

    public function testEmpty(): void
    {
        static::assertEquals(1, 1);
    }
}
