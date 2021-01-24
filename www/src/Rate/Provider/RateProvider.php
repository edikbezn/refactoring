<?php


namespace Rate\Provider;


use GuzzleHttp\Client;
use Rate\Dto\RateDto;
use Rate\Provider\ResponseHandler\ResponseHandlerInterface;

class RateProvider implements RateProviderInterface
{

    /**
     * @var string $url
     */
    protected string $url;

    /**
     * @var ResponseHandlerInterface $responseHandler
     */
    protected ResponseHandlerInterface $responseHandler;

    public function __construct(string $url, ResponseHandlerInterface $responseHandler)
    {
        $this->url = $url;
        $this->responseHandler = $responseHandler;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @inheritDoc
     */
    public function get(): RateDto
    {
        $client = new Client(['base_uri' => $this->getUrl()]);
        $response = $client->request('GET');
        return $this->responseHandler->handle($response->getBody()->getContents());
    }
}