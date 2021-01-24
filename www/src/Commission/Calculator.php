<?php


namespace Commission;


use Transaction\Entity\Transaction;

class Calculator
{

    protected const EUR_COMMISSION = 0.01;
    protected const NON_EUR_COMMISSION = 0.02;
    protected const PRECISION = 2;

    /** @var float $rate */
    protected float $rate;

    /** @var bool $isEur */
    protected bool $isEur;

    /** @var float $amount */
    protected float $amount;

    public function __construct(float $rate, float $amount, bool $isEur)
    {
        $this->rate = $rate;
        $this->amount = $amount;
        $this->isEur = $isEur;
    }

    /**
     * @return float
     */
    protected function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @return bool
     */
    protected function isEur(): bool
    {
        return $this->isEur;
    }

    /**
     * @return float
     */
    protected function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function calculate(): float
    {
        if ($this->isEur() || $this->getRate() === 0) {
            $fixedAmount = $this->getAmount();
        }

        if (!$this->isEur() || $this->getRate() > 0) {

            if ($this->getRate() == 0) {
                throw new \InvalidArgumentException('Rate = 0');
            }

            $fixedAmount = $this->getAmount() / $this->getRate();
        }

        return round(
            $fixedAmount *
                ($this->isEur() ? self::EUR_COMMISSION : self::NON_EUR_COMMISSION), self::PRECISION
        );
    }
}