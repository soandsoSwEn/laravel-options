<?php

namespace Soandso\LaravelOptions\Tests\Unit\Models;

use Illuminate\Database\QueryException;
use Soandso\LaravelOptions\Models\Option;
use Soandso\LaravelOptions\Tests\TestCase;

class OptionTest extends TestCase
{
    private $option;

    protected function setUp(): void
    {
        parent::setUp();

        $this->option = new Option();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->option);
    }

    public function testIsOptionModel()
    {
        $this->assertInstanceOf(Option::class, $this->option);
    }

    public function testSuccessCreateModel()
    {
        $option = Option::create([
            'key' => 'key-1',
            'value' => 'value-data-1',
        ]);

        $this->assertInstanceOf(Option::class, $option);
    }

    public function testErrorCreateModel()
    {
        $this->expectException(QueryException::class);

        Option::create([
            'key' => 'key-1',
        ]);
    }

    public function testSuccessGetModelData()
    {
        Option::create([
            'key' => 'key-2',
            'value' => 'value-data-2',
        ]);

        $valueData = Option::where('key', 'key-2')->first();

        $this->assertEquals($valueData->value, 'value-data-2');
    }

    public function testSuccessUpdateModelData()
    {
        Option::create([
            'key' => 'key-1',
            'value' => 'value-data-1',
        ]);

        Option::where('key', 'key-1')->update(['value' => 'value-data-1-updated']);

        $this->assertEquals(Option::where('key', 'key-1')->first()->value, 'value-data-1-updated');
    }

    public function testSErrorUpdateModelData()
    {
        Option::create([
            'key' => 'key-1',
            'value' => 'value-data-1',
        ]);

        Option::where('key', 'key-1')->update(['value' => 'value-data-1-updated']);

        $this->assertNotEquals(Option::where('key', 'key-1')->first()->value, 'value-data-1');
    }
}