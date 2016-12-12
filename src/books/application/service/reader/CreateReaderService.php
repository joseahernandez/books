<?php

namespace books\application\service\reader;

use books\domain\model\reader\Reader;
use books\domain\model\reader\ReaderId;
use books\domain\model\reader\ReaderRepository;

class CreateReaderService {

    /**
     * @ReaderRepository
     */
    private $readerRepository;

    /**
     * @param ReaderRepository $readerRepository
     */
    public function __construct(ReaderRepository $readerRepository) {
        $this->readerRepository = $readerRepository;
    }

    /**
     * @param CreateReaderRequest $req
     */
    public function execute(CreateReaderRequest $req) {
        $this->readerRepository->save(new Reader(new ReaderId(), $req->name()));
    }
}
