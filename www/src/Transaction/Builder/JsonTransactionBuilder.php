<?php

namespace Transaction\Builder;

use InvalidArgumentException;
use Transaction\Entity\Transaction;

class JsonTransactionBuilder implements TransactionBuilderInterface
{

    protected const JSON_BIN_FIELD = 'bin';
    protected const JSON_AMOUNT_FIELD = 'amount';
    protected const JSON_CURRENCY_FIELD = 'currency';

    /**
     * @return Transaction
     * @throws InvalidArgumentException
     */
    public function build($data): Transaction
    {
        try {
            $transactionArray = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
            $this->validateTransactionArray($transactionArray);

            return new Transaction(
                $transactionArray[self::JSON_BIN_FIELD],
                $transactionArray[self::JSON_CURRENCY_FIELD],
                (float)$transactionArray[self::JSON_AMOUNT_FIELD]
            );
        } catch (\JsonException $exception) {
            throw new InvalidArgumentException('Transaction processing error. Invalid json format');
        }
    }

    /**
     * @param array $transactionArray
     * @throws InvalidArgumentException
     */
    protected function validateTransactionArray(array $transactionArray)
    {
        $errors = [];

        if (empty($transactionArray[self::JSON_BIN_FIELD])) {
            $errors[] = 'Undefined field "bin"';
        }

        if (empty($transactionArray[self::JSON_AMOUNT_FIELD])) {
            $errors[] = 'Undefined field "amount"';
        }

        if (empty($transactionArray[self::JSON_CURRENCY_FIELD])) {
            $errors[] = 'Undefined field "currency"';
        }

        if (!empty($errors)) {
            throw new InvalidArgumentException(implode('; ', $errors));
        }
    }
}