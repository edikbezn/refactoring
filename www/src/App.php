<?php


use Bin\Provider\BinProvider;
use Bin\Provider\ResponseHandler\JsonResponseHandler as BinJsonResponseHandler;
use Commission\CommissionService;
use Dotenv\Dotenv;
use Rate\Dto\RateDto;
use Rate\Provider\RateProvider;
use Rate\Provider\ResponseHandler\JsonResponseHandler;
use Transaction\Builder\JsonTransactionBuilder;

class App
{

    /** @var string $fileName */
    protected string $fileName;


    /** @var RateDto $rateDto */
    protected RateDto $rateDto;

    /** @var string $appDir */
    protected string $appDir;

    /** @var JsonTransactionBuilder $transactionBuilder */
    protected JsonTransactionBuilder $transactionBuilder;

    public function __construct(?string $fileName = '', string $appDir = __DIR__)
    {
        $this->fileName = $fileName ?? '';
        $this->appDir = $appDir;
        $this->transactionBuilder = new JsonTransactionBuilder();
    }

    /**
     * @return RateDto
     */
    public function getRateDto(): RateDto
    {
        return $this->rateDto;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function run()
    {
        try {
            $this->prepareDotEnv();
            $this->prepareRates();

            $fileReader = $this->getFileReader();

            foreach ($fileReader->getLine() as $line) {
                $this->processLine($line);
            }
        } catch (Throwable $e) {
            $this->print($e->getMessage());
        }
    }

    /**
     * @return FileReader
     */
    protected function getFileReader(): FileReader
    {
        if (empty($this->getFileName())) {
            throw new InvalidArgumentException('Empty filename');
        }
        return new FileReader($this->getFileName());
    }

    protected function prepareDotEnv()
    {
        $dotEnv = Dotenv::createImmutable($this->appDir);
        $dotEnv->load();
    }

    protected function prepareRates()
    {
        $this->rateDto = (new RateProvider(
            $_ENV['RATE_PROVIDER_URL'],
            new JsonResponseHandler())
        )->get();

        if (empty($this->getRateDto()->getRates())) {
            throw new RuntimeException('Empty rates');
        }
    }

    /**
     * @param string $line
     */
    protected function processLine(string $line): void
    {
        try {
            $transaction = $this->transactionBuilder->build($line);

            $commissionService = new CommissionService(
                $transaction,
                new BinProvider($_ENV['BIN_PROVIDER_URL'], new BinJsonResponseHandler()),
                $this->getRateDto()
            );
            $this->print($commissionService->getCommission());
        } catch (Throwable $e) {
            $this->print($e->getMessage());
        }
    }

    /**
     * @param string $message
     */
    protected function print(string $message): void
    {
        echo $message;
        echo PHP_EOL;
    }
}