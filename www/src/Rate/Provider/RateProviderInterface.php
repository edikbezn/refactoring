<?php


namespace Rate\Provider;


use Rate\Dto\RateDto;

interface RateProviderInterface
{

    /**
     * @return RateDto
     */
    public function get(): RateDto;
}