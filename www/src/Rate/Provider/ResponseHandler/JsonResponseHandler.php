<?php


namespace Rate\Provider\ResponseHandler;


use Rate\Dto\RateDto;

class JsonResponseHandler implements ResponseHandlerInterface
{

    protected const JSON_RATE_FIELD = 'rates';
    protected const JSON_BASE_FIELD = 'base';
    protected const JSON_DATE_FIELD = 'date';

    /** @var string $json */
    protected string $json;

    /**
     * @param $response
     * @return RateDto
     * @throws \JsonException
     */
    public function handle($response): RateDto
    {
        $responseArray = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        return $this->prepareRateDto($responseArray);
    }

    /**
     *
     * @param array $responseArray
     * @return RateDto
     */
    protected function prepareRateDto(array $responseArray): RateDto
    {

        return (new RateDto())
            ->setRates($responseArray[self::JSON_RATE_FIELD] ?? [])
            ->setBase($responseArray[self::JSON_BASE_FIELD])
            ->setDate($responseArray[self::JSON_DATE_FIELD]);
    }
}