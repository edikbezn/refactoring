<?php


namespace Tests\Builder;


use Bin\Dto\BinCountry;
use Bin\Dto\BinDto;

class BinDtoBuilder
{

    /**
     * @return string
     */
    public function getEurDto(): BinDto
    {
        $countryDto = (new BinCountry())->setAlpha2('FR');
        return (new BinDto())->setCountry($countryDto);
    }
}