<?php


namespace Rate\Provider\ResponseHandler;


use Rate\Dto\RateDto;

interface ResponseHandlerInterface
{
    public function handle($response): RateDto;
}