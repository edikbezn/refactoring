<?php


use Bin\Provider\BinProvider;
use Commission\CommissionService;
use PHPUnit\Framework\TestCase;
use Rate\Dto\RateDto;
use Tests\Builder\BinDtoBuilder;
use Tests\Builder\TransactionBuilder;

class CommissionServiceTest extends TestCase
{

    /** @var TransactionBuilder $transactionBuilder*/
    protected TransactionBuilder $transactionBuilder;

    /** @var BinDtoBuilder $binDtoBuilder */
    protected BinDtoBuilder $binDtoBuilder;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->transactionBuilder = new TransactionBuilder();
        $this->binDtoBuilder = new BinDtoBuilder();
    }

    /**
     * @covers \Commission\CommissionService::getCommission
     */
    public function testEurSuccess()
    {
        $transaction = $this->transactionBuilder->getEurTransaction();

        $rate = $this->createMock(RateDto::class);
        $rate->method('getRates')
                ->willReturn([]);

        $binProvider = $this->createMock(BinProvider::class);
        $binProvider->method('get')
                    ->willReturn($this->binDtoBuilder->getEurDto());

        $commissionService = new CommissionService(
            $transaction,
            $binProvider,
            $rate
        );

        self::assertEquals(1, $commissionService->getCommission());
    }

    /**
     * @covers \Commission\CommissionService::getCommission
     */
    public function testNonEurWithoutRate()
    {
        $transaction = $this->transactionBuilder->getNonEurTransaction();

        $rate = $this->createMock(RateDto::class);
        $rate->method('getRates')
            ->willReturn([]);

        $binProvider = $this->createMock(BinProvider::class);
        $binProvider->method('get')
            ->willReturn($this->binDtoBuilder->getEurDto());

        $commissionService = new CommissionService(
            $transaction,
            $binProvider,
            $rate
        );
        self::expectExceptionMessage(sprintf('Empty rate value for %s', $transaction->getCurrency()));
        $commissionService->getCommission();
    }

    /**
     * @covers \Commission\CommissionService::getCommission
     */
    public function testNonEurWithRate()
    {
        $transaction = $this->transactionBuilder->getNonEurTransaction();

        $rate = $this->createMock(RateDto::class);
        $rate->method('getRates')
            ->willReturn([
                'USD' => 1.1
            ]);

        $binProvider = $this->createMock(BinProvider::class);
        $binProvider->method('get')
            ->willReturn($this->binDtoBuilder->getEurDto());

        $commissionService = new CommissionService(
            $transaction,
            $binProvider,
            $rate
        );

        self::assertEquals(0.91, $commissionService->getCommission());

    }
}