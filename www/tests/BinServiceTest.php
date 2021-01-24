<?php


use Bin\Service\BinService;
use PHPUnit\Framework\TestCase;

class BinServiceTest extends TestCase
{

    /**
     * @covers \Bin\Service\BinService::isBinEur
     */
    public function testIsEur()
    {
        $binService = new BinService();
        self::assertTrue($binService->isBinEur('CZ'));
    }

    /**
     * @covers \Bin\Service\BinService::isBinEur
     */
    public function testIsNonEur()
    {
        $binService = new BinService();
        self::assertFalse($binService->isBinEur('CZ1'));
    }

    /**
     * @covers \Bin\Service\BinService::isBinEur
     */
    public function testEmptyCode()
    {
        $binService = new BinService();
        self::assertFalse($binService->isBinEur(''));
    }
}