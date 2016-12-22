<?php

namespace books\application\service\book;

use books\domain\model\author\AuthorId;
use books\domain\model\book\Book;
use books\domain\model\book\BookId;
use books\domain\model\book\BookRepository;
use books\domain\model\book\RateRepository;
use books\domain\model\reader\Reader;
use books\domain\model\reader\ReaderId;
use books\domain\model\reader\ReaderRepository;
use books\infrastructure\domain\model\book\MemoryBookRepository;
use books\infrastructure\domain\model\book\MemoryRateRepository;
use books\infrastructure\domain\model\reader\MemoryReaderRepository;

class CreateRateServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var RateRepository
     */
    private $rateRepository;

    /**
     * @var ReaderRepository
     */
    private $readerRepository;

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var CreateRateService
     */
    private $createRateService;

    /**
     * @var ReaderId
     */
    private $readerId;

    /**
     * @var BookId
     */
    private $bookId;

    protected function setUp() {
        $this->readerRepository  = new MemoryReaderRepository();
        $this->rateRepository    = new MemoryRateRepository();
        $this->bookRepository    = new MemoryBookRepository();
        $this->createRateService = new CreateRateService(
            $this->bookRepository,
            $this->readerRepository,
            $this->rateRepository
        );

        $this->addFixturesToRepositories();
    }

    private function addFixturesToRepositories() {
        $this->readerId = new ReaderId();
        $this->readerRepository->save(
            new Reader(
                $this->readerId,
                "Jonathan"
            )
        );

        $this->bookId = new BookId();
        $this->bookRepository->save(
            new Book(
                $this->bookId,
                "Hamlet",
                new AuthorId()
            )
        );
    }

    /**
     * @test
     */
    public function createRate() {
        $rate = 5;
        $req  = new CreateRateRequest($this->bookId, $this->readerId, $rate);
        $this->createRateService->execute($req);

        $this->assertSame(1, count($this->rateRepository->findByBook($this->bookId)));
    }

    /**
     * @test
     * @expectedException \books\domain\model\reader\InvalidReaderException
     */
    public function createRateWithInvalidReader() {
        $invalidReaderId = new ReaderId();
        $rate            = 5;
        $req             = new CreateRateRequest($this->bookId, $invalidReaderId, $rate);
        $this->createRateService->execute($req);
    }

    /**
     * @test
     * @expectedException \books\domain\model\book\InvalidBookException
     */
    public function createRateWithInvalidBook() {
        $invalidBookId = new BookId();
        $rate          = 5;
        $req           = new CreateRateRequest($invalidBookId, $this->readerId, $rate);
        $this->createRateService->execute($req);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function createRateWithValueHigherThanMax() {
        $higherRate = 100;
        $req        = new CreateRateRequest($this->bookId, $this->readerId, $higherRate);
        $this->createRateService->execute($req);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function createRateWithValueLowerThanMin() {
        $lowerRate = 0;
        $req       = new CreateRateRequest($this->bookId, $this->readerId, $lowerRate);
        $this->createRateService->execute($req);
    }
}
