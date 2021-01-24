<?php

namespace Transaction\Builder;


use Transaction\Entity\Transaction;

interface TransactionBuilderInterface
{
    /**
     * @return Transaction
     */
    public function build($data): Transaction;
}