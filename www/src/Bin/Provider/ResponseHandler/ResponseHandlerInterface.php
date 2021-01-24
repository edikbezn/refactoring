<?php


namespace Bin\Provider\ResponseHandler;


use Bin\Dto\BinDto;

interface ResponseHandlerInterface
{
    public function handle($response): BinDto;
}