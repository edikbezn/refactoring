<?php


namespace Tests\Builder;


use Transaction\Entity\Transaction;

class TransactionBuilder
{

    /**
     * @return Transaction
     */
    public function getEurTransaction(): Transaction
    {
        return new Transaction('45717360', 'EUR', '100.00');
    }

    /**
     * @return Transaction
     */
    public function getNonEurTransaction(): Transaction
    {
        return new Transaction('516793', 'USD', '100.00');
    }

    /**
     * @return Transaction
     */
    public function getEmptyFieldTransaction(): Transaction
    {
        return new Transaction('516793', 'USD', '');
    }
}