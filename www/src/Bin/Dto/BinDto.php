<?php

namespace Bin\Dto;

/**
 *
 * Class for transfer BIN data into the app.
 * It can be expanded if needed
 *
 * Class BinDto
 * @package Bin\Dto
 */
class BinDto
{
    protected BinCountry $country;

    /**
     * @return BinCountry
     */
    public function getCountry(): BinCountry
    {
        return $this->country;
    }

    /**
     * @param BinCountry $country
     * @return BinDto
     */
    public function setCountry(BinCountry $country): BinDto
    {
        $this->country = $country;
        return $this;
    }


}