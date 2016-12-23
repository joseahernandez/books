<?php

namespace books\application\service\book;

use books\domain\model\book\BookId;
use books\domain\model\book\Rate;
use books\domain\model\book\RateRepository;
use books\domain\model\reader\ReaderId;
use books\infrastructure\domain\model\book\MemoryRateRepository;

class EditRateServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var RateRepository
     */
    private $rateRepository;

    /**
     * @var EditRateService
     */
    private $editRateService;

    /**
     * @var BookId
     */
    private $bookId;

    /**
     * @var ReaderId
     */
    private $readerId;

    protected function setUp() {
        $this->rateRepository  = new MemoryRateRepository();
        $this->editRateService = new EditRateService($this->rateRepository);

        $this->addFixturesToRepositories();
    }

    private function addFixturesToRepositories() {
        $this->bookId   = new BookId();
        $this->readerId = new ReaderId();
        $this->rateRepository->save(
            new Rate(
                $this->bookId,
                $this->readerId,
                3
            )
        );
    }

    /**
     * @test
     */
    public function editRate() {
        $rate = 5;
        $req  = new EditRateRequest($this->bookId, $this->readerId, $rate);
        $this->editRateService->execute($req);

        $rateSaved = $this->rateRepository->findReaderRateForBook($this->readerId, $this->bookId);
        $this->assertSame($rate, $rateSaved->rate());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function editRateWithValueHigherThanMax() {
        $higherRate = 100;
        $req        = new EditRateRequest($this->bookId, $this->readerId, $higherRate);
        $this->editRateService->execute($req);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function editRateWithValueLowerThanMin() {
        $lowerRate = 0;
        $req       = new EditRateRequest($this->bookId, $this->readerId, $lowerRate);
        $this->editRateService->execute($req);
    }
}
