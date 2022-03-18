<?php

namespace Soandso\LaravelOptions\Tests\Feature;

use Exception;
use Soandso\LaravelOptions\OptionService;
use Soandso\LaravelOptions\Tests\TestCase;

class OptionServiceTest extends TestCase
{
    public function testFirst()
    {
        $this->assertTrue(true);
    }

    public function testSuccessCreateOption()
    {
        $reflector = new \ReflectionClass(OptionService::class);
        $method = $reflector->getMethod('createData');
        $method->setAccessible(true);
        $data = [
            'key-1', 'value-data-1',
        ];
        $result = $method->invokeArgs($this->optionService, $data);

        $this->assertEquals($result, 1);
    }

    public function testErrorCreateOption()
    {
        $reflector = new \ReflectionClass(OptionService::class);
        $method = $reflector->getMethod('createData');
        $method->setAccessible(true);
        $data = [
            'key-1', 'value-data-1',
        ];
        $result = $method->invokeArgs($this->optionService, $data);

        $this->assertNotEquals($result, 2);
    }

    public function testSuccessUpdateData()
    {
        $reflector = new \ReflectionClass(OptionService::class);
        $method = $reflector->getMethod('createData');
        $method->setAccessible(true);
        $data = [
            'key-1', 'value-data-1',
        ];
        $method->invokeArgs($this->optionService, $data);

        $updateData = [
            'key-1', 'value-data-updated',
        ];
        $updateMethod = $reflector->getMethod('updateData');
        $updateMethod->setAccessible(true);
        $updateResult = $updateMethod->invokeArgs($this->optionService, $updateData);

        $this->assertEquals($updateResult, 1);
    }

    public function testSuccessIsValidArrayData()
    {
        $reflector = new \ReflectionClass(OptionService::class);
        $method = $reflector->getMethod('isValidData');
        $method->setAccessible(true);
        $data = [
            ['data1' => 'value-data-1'],
            ['data2' => 'value-data-2'],
        ];
        $result = $method->invokeArgs($this->optionService, $data);

        $this->assertTrue($result);
    }

    public function testSuccessIsValidStringData()
    {
        $reflector = new \ReflectionClass(OptionService::class);
        $method = $reflector->getMethod('isValidData');
        $method->setAccessible(true);
        $data = ['value-data-1'];
        $result = $method->invokeArgs($this->optionService, $data);

        $this->assertTrue($result);
    }

    public function testErrorIsValidData()
    {
        $reflector = new \ReflectionClass(OptionService::class);
        $method = $reflector->getMethod('isValidData');
        $method->setAccessible(true);
        $data = [1];
        $result = $method->invokeArgs($this->optionService, $data);

        $this->assertFalse($result);
    }

    public function testSuccessSetDataForCreateMethod()
    {
        $this->assertEquals($this->optionService->setData('key-1', 'value-data-1'), 1);
    }

    public function testSuccessSetDataForUpdateMethod()
    {
        $this->optionService->setData('key-1', 'value-data-1');
        $this->assertEquals($this->optionService->setData('key-1', 'value-data-2'), 1);
    }

    public function testNotValidDataSetData()
    {
        $this->expectException(Exception::class);
        $this->optionService->setData('key-1', 1);
    }

    public function testSuccessGetData()
    {
        $this->optionService->setData('key-1', 'value-data-1');
        $this->assertEquals($this->optionService->getData('key-1'), 'value-data-1');
    }

    public function testErrorGetData()
    {
        $this->optionService->setData('key-1', 'value-data-1');
        $this->assertNotEquals($this->optionService->getData('key-1'), 'value-data-2');
    }
}