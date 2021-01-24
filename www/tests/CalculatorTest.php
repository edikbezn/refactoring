<?php


use Commission\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * @covers \Commission\Calculator::calculate
     */
    public function testEurSuccess()
    {
        $calculator = new Calculator(
            1, 1000, true
        );

        self::assertEquals(10.00, $calculator->calculate());
    }

    /**
     * @covers \Commission\Calculator::calculate
     */
    public function testNonEurSuccess()
    {
        $calculator = new Calculator(
            1, 1000, false
        );

        self::assertEquals(20.00, $calculator->calculate());
    }

    /**
     * @covers \Commission\Calculator::calculate
     */
    public function testNonEurZeroRate()
    {
        $calculator = new Calculator(
            0, 1000, false
        );
        self::expectExceptionMessage('Rate = 0');
        $calculator->calculate();
    }

    /**
     * @covers \Commission\Calculator::calculate
     */
    public function testEurZeroRate()
    {
        $calculator = new Calculator(
            0, 1000, true
        );
        self::assertEquals(10.00, $calculator->calculate());
    }
}