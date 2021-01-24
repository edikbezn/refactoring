<?php


namespace Rate\Dto;


class RateDto
{

    /** @var array $rates */
    protected array $rates = [];

    /** @var string $base */
    protected string $base;

    /** @var string $date */
    protected string $date;

    /**
     * @return array
     */
    public function getRates(): array
    {
        return $this->rates;
    }

    /**
     * @param array $rates
     * @return RateDto
     */
    public function setRates(array $rates): RateDto
    {
        $this->rates = $rates;
        return $this;
    }

    /**
     * @return string
     */
    public function getBase(): string
    {
        return $this->base;
    }

    /**
     * @param string $base
     * @return RateDto
     */
    public function setBase(string $base): RateDto
    {
        $this->base = $base;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return RateDto
     */
    public function setDate(string $date): RateDto
    {
        $this->date = $date;
        return $this;
    }


}