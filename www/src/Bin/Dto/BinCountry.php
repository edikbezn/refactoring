<?php


namespace Bin\Dto;

/**
 * The part of BinDto structure
 *
 * Class BinCountry
 * @package Bin\Dto
 */
class BinCountry
{

    /**
     * @var string $alpha2
     */
    protected string $alpha2;

    /**
     * @return string
     */
    public function getAlpha2(): string
    {
        return $this->alpha2;
    }

    /**
     * @param string $alpha2
     * @return BinCountry
     */
    public function setAlpha2(string $alpha2): BinCountry
    {
        $this->alpha2 = $alpha2;
        return $this;
    }

}