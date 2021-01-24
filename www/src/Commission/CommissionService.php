<?php

namespace Commission;


use Bin\Dto\BinCountry;
use Bin\Dto\BinDto;
use Bin\Provider\BinProvider;
use Bin\Service\BinService;
use Rate\Dto\RateDto;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;
use Transaction\Entity\Transaction;

class CommissionService
{
    protected const MAIN_CURRENCY = 'EUR';

    /** @var Transaction $transaction */
    protected Transaction $transaction;

    /** @var BinService $binService */
    protected BinService $binService;

    /** @var RateDto $rate */
    protected RateDto $rate;

    /** @var BinProvider $binProvider */
    protected BinProvider $binProvider;

    public function __construct(Transaction $transaction, BinProvider $binProvider, RateDto $rate)
    {
        $this->transaction = $transaction;
        $this->binService = new BinService();
        $this->rate = $rate;
        $this->binProvider = $binProvider;
    }

    /**
     * @return Transaction
     */
    protected function getTransaction(): Transaction
    {
        return $this->transaction;
    }

    /**
     * @return BinProvider
     */
    protected function getBinProvider(): BinProvider
    {
        return $this->binProvider;
    }


    /**
     * @return float
     * @throws GuzzleException
     */
    public function getCommission(): float
    {
        $rate = $this->prepareRateForCurrentTransaction();
        $binData = $this->prepareBinData($this->getTransaction());
        return $this->calculateCommission($binData, $rate);
    }

    /**
     * @param BinDto $binData
     * @param float $rate
     * @return float
     */
    protected function calculateCommission(BinDto $binData, float $rate): float
    {
        return (new Calculator(
                    $rate,
                    $this->getTransaction()->getAmount(),
                    $this->binService->isBinEur($binData->getCountry()->getAlpha2())
                ))->calculate();

    }

    /**
     * @param Transaction $transaction
     * @return BinDto
     * @throws GuzzleException
     */
    protected function prepareBinData(Transaction $transaction): BinDto
    {
        return $this->getBinProvider()->get($transaction->getBin());
    }

    /**
     * @return float
     */
    protected function prepareRateForCurrentTransaction(): float
    {
        if ($this->transaction->getCurrency() === self::MAIN_CURRENCY) {
            return 1;
        }

        if (!isset($this->rate->getRates()[$this->transaction->getCurrency()])) {
            throw new RuntimeException(sprintf('Empty rate value for %s', $this->transaction->getCurrency()));
        }

        return (float)$this->rate->getRates()[$this->transaction->getCurrency()];
    }
}