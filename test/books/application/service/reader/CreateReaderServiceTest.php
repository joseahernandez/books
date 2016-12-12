<?php

namespace books\application\service\reader;

use books\infrastructure\domain\model\reader\MemoryReaderRepository;

class CreateReaderServiceTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var CreateReaderService
     */
    private $createReaderService;

    /**
     * @var ReaderRepository
     */
    private $readerRepository;

    protected function setUp() {
        $this->readerRepository    = new MemoryReaderRepository();
        $this->createReaderService = new CreateReaderService($this->readerRepository);
    }

    /**
     * @test
     */
    public function createReader() {
        $readerName          = "Jonathan";
        $createReaderRequest = new CreateReaderRequest($readerName);

        $this->createReaderService->execute($createReaderRequest);

        $this->assertSame(1, count($this->readerRepository->findAll()));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function createReaderWithEmptyName() {
        $emptyName           = "";
        $createReaderRequest = new CreateReaderRequest($emptyName);
        $this->createReaderService->execute($createReaderRequest);
    }
}
