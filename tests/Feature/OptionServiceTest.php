<?php

namespace Soandso\LaravelOptions\Tests\Feature;

use ArgumentCountError;
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

        $this->assertTrue($result);
    }

    public function testErrorCreateOption()
    {
        $this->expectException(ArgumentCountError::class);
        $reflector = new \ReflectionClass(OptionService::class);
        $method = $reflector->getMethod('createData');
        $method->setAccessible(false);
        $data = [];
        $method->invokeArgs($this->optionService, $data);
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
        $this->assertEquals($this->optionService->set('key-1', 'value-data-1'), 1);
    }

    public function testSuccessSetDataForUpdateMethod()
    {
        $this->optionService->set('key-1', 'value-data-1');
        $this->assertEquals($this->optionService->set('key-1', 'value-data-2'), 1);
    }

    public function testNotValidDataSetData()
    {
        $this->expectException(Exception::class);
        $this->optionService->set('key-1', 1);
    }

    public function testSuccessGetData()
    {
        $this->optionService->set('key-1', 'value-data-1');
        $this->assertEquals($this->optionService->get('key-1'), 'value-data-1');
    }

    public function testErrorGetData()
    {
        $this->optionService->set('key-1', 'value-data-1');
        $this->assertNotEquals($this->optionService->get('key-1'), 'value-data-2');
    }

    public function testSuccessAllDestroy()
    {
        $this->optionService->set('key-1', 'value-data-1');
        $this->optionService->destroy();

        $this->assertFalse($this->optionService->get('key-1'));
    }

    public function testSuccessOneDestroy()
    {
        $this->optionService->set('key-1', 'value-data-1');
        $this->optionService->destroy('2022-03-23');

        $this->assertFalse($this->optionService->get('key-1'));
    }

    public function testSuccessDestroy()
    {
        $this->optionService->set('key-1', 'value-data-1');
        $this->optionService->destroy('2022-03-22');

        $this->assertEquals($this->optionService->get('key-1'), 'value-data-1');
    }
}