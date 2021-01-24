<?php

namespace Transaction\Entity;


final class Transaction
{

    /** @var string $bin */
    private string $bin;

    /** @var string $currency */
    private string $currency;

    /** @var float $amount */
    private float $amount;

    public function __construct(string $bin, string $currency, float $amount)
    {
        $this->bin = $bin;
        $this->currency = $currency;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getBin(): string
    {
        return $this->bin;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}