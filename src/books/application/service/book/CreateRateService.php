<?php

namespace books\application\service\book;

use books\domain\model\book\BookRepository;
use books\domain\model\book\RateRepository;
use books\domain\model\reader\ReaderRepository;

class CreateRateService {
    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var ReaderRepository
     */
    private $readerRepository;

    /**
     * @var RateRepository
     */
    private $rateRepository;

    /**
     * @param BookRepository   $bookRepository
     * @param ReaderRepository $readerRepository
     * @param RateRepository   $rateRepository
     */
    public function __construct(
        BookRepository $bookRepository,
        ReaderRepository $readerRepository,
        RateRepository $rateRepository
    ) {
        $this->bookRepository   = $bookRepository;
        $this->readerRepository = $readerRepository;
        $this->rateRepository   = $rateRepository;
    }

    /**
     * @param CreateRateRequest $req
     */
    public function execute(CreateRateRequest $req) {
        $book   = $this->bookRepository->findById($req->book());
        $reader = $this->readerRepository->findById($req->reader());
        $rate   = $book->rate($reader->id(), $req->rate());
        $this->rateRepository->save($rate);
    }
}
