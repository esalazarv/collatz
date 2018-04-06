<?php

namespace Tests\Unit;

use App\CollatzRecord;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollatzRecordTest extends TestCase
{

    /**
     * Check if a number is peer, return true if is peer else return false
     */
    public function testCheckIfANumberIsPeer()
    {
        $collatzRecord = new CollatzRecord();
        $reflection = new \ReflectionClass(CollatzRecord::class);
        $method = $reflection->getMethod('isPeer');
        $method->setAccessible(true);
        $this->assertFalse($method->invoke($collatzRecord, 1));
        $this->assertTrue($method->invoke($collatzRecord, 2));
        $this->assertTrue($method->invoke($collatzRecord, 4));
        $this->assertTrue($method->invoke($collatzRecord, 6));
        $this->assertFalse($method->invoke($collatzRecord, 31));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCalculateNextValue()
    {
        $collatzRecord = new CollatzRecord();
        $reflection = new \ReflectionClass(CollatzRecord::class);
        $method = $reflection->getMethod('calculateNextValue');
        $method->setAccessible(true);

        $this->assertEquals(5, $method->invoke($collatzRecord, 10));
        $this->assertEquals(16, $method->invoke($collatzRecord, 5));
        $this->assertEquals(8, $method->invoke($collatzRecord, 16));
        $this->assertEquals(4, $method->invoke($collatzRecord, 8));
        $this->assertEquals(2, $method->invoke($collatzRecord, 4));
        $this->assertEquals(1, $method->invoke($collatzRecord, 2));
    }

    /**
     * Test get all iterations for a number
     */
    public function testCalulateIterations()
    {
        $collatzRecord = new CollatzRecord();

        $iterations = $collatzRecord->calculateIterations(27);
        $this->assertTrue(is_array($iterations));
        $this->assertCount(111, $iterations);

        $iterations = $collatzRecord->calculateIterations(10);
        $this->assertTrue(is_array($iterations));
        $this->assertCount(6, $iterations);
        $this->assertEquals([5, 16, 8, 4, 2, 1], $iterations);
    }

    public function testCalculateForTwoNumbers()
    {
        $collatzRecord = new CollatzRecord();

        $result = $collatzRecord->calculateForTwoNumbers(10, 27);
        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('range', $result);
        $this->assertArrayHasKey('max', $result);
        $this->assertArrayHasKey('calculations', $result);

        $this->assertEquals([10, 27], $result['range']);
        $this->assertEquals(27, $result['max']['number']);
        $this->assertEquals(111, $result['max']['iterations']);
        $this->assertTrue(is_array($result['max']['steps']));
        $this->assertCount(2, $result['calculations']);
    }
}
