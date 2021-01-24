<?php


namespace Bin\Provider\ResponseHandler;


use Bin\Dto\BinCountry;
use Bin\Dto\BinDto;

class JsonResponseHandler implements ResponseHandlerInterface
{

    /**
     * @var string $json
     */
    protected string $json;

    /**
     * @param $response
     * @return BinDto
     * @throws \JsonException
     */
    public function handle($response): BinDto
    {
        $responseArray = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        return $this->prepareBinDto($responseArray);
    }

    /**
     *
     * There is no need to create BinDto with it parts in test task
     * But if we want to parse all bin response, we must be able to parse and
     * store all response fields
     *
     * @param array $responseArray
     * @return BinDto
     */
    protected function prepareBinDto(array $responseArray): BinDto
    {
        $binCountry = (new BinCountry())
                        ->setAlpha2($responseArray['country']['alpha2'] ?? '');

        return (new BinDto())
                        ->setCountry($binCountry);
    }
}