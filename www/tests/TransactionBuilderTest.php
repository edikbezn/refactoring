<?php


use PHPUnit\Framework\TestCase;
use Transaction\Builder\JsonTransactionBuilder;

class TransactionBuilderTest extends TestCase
{
    /** @var JsonTransactionBuilder $jsonTransactionBuilder */
    protected JsonTransactionBuilder $jsonTransactionBuilder;


    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->jsonTransactionBuilder = new JsonTransactionBuilder();
    }

    /**
     * @covers \Transaction\Builder\JsonTransactionBuilder::build
     */
    public function testSuccess()
    {
        $transaction = $this->jsonTransactionBuilder->build('{"bin":"45717360","amount":"100.00","currency":"EUR"}');

        self::assertEquals('45717360', $transaction->getBin());
        self::assertEquals(100.00, $transaction->getAmount());
        self::assertEquals('EUR', $transaction->getCurrency());
    }

    /**
     * @covers \Transaction\Builder\JsonTransactionBuilder::build
     */
    public function testJsonError()
    {
        self::expectExceptionMessage('Transaction processing error. Invalid json format');
        $this->jsonTransactionBuilder->build('"bin":"45717360","amount":"100.00","currency":"EUR"}');
    }

    /**
     * @covers \Transaction\Builder\JsonTransactionBuilder::build
     */
    public function testEmptyField()
    {
        self::expectExceptionMessage('Undefined field "currency"');
        $this->jsonTransactionBuilder->build('{"bin":"45717360","amount":"100.00","currency":""}');
    }
}