<?php

namespace Soandso\LaravelOptions\Tests\Feature\Helpers;

use ArgumentCountError;
use Soandso\LaravelOptions\Tests\TestCase;

class Option extends TestCase
{
    public function testSuccessCreateOption()
    {
        $this->assertTrue(setOption('key-1', 'value-data-1'));
    }

    public function testErrorCreateOption()
    {
        $this->expectException(ArgumentCountError::class);
        setOption('', '');
    }

    public function testSuccessUpdateOption()
    {
        setOption('key-1', 'value-data-1');
        setOption('key-1', 'value-data-1-updated');

        $this->assertEquals(getOption('key-1'), 'value-data-1-updated');
    }

    public function testErrorUpdateOption()
    {
        setOption('key-1', 'value-data-1');
        setOption('key-1', 'value-data-1-updated');

        $this->assertNotEquals(getOption('key-1'), 'value-data-1');
    }

    public function testNotDefinedOption()
    {
        $this->assertFalse(getOption('key-1'));
    }
}