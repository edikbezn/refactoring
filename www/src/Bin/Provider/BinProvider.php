<?php


namespace Bin\Provider;


use Bin\Dto\BinDto;
use Bin\Provider\ResponseHandler\ResponseHandlerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class BinProvider implements BinProviderInterface
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
     * @param string $bin
     * @return BinDto
     * @throws GuzzleException
     */
    public function get(string $bin): BinDto
    {
        $client = new Client(['base_uri' => $this->getUrl()]);
        $response = $client->request('GET', $bin);
        return $this->responseHandler->handle($response->getBody()->getContents());
    }
}