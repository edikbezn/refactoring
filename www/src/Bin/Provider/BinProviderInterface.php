<?php


namespace Bin\Provider;


use Bin\Dto\BinDto;

interface BinProviderInterface
{

    /**
     * @param string $bin
     * @return BinDto
     */
    public function get(string $bin): BinDto;
}