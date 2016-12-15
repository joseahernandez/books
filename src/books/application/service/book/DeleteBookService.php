<?php

namespace books\application\service\book;

use books\domain\model\book\BookRepository;

class DeleteBookService {
    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository) {
        $this->bookRepository   = $bookRepository;
    }

    /**
     * @param DeleteBookRequest $req
     */
    public function execute(DeleteBookRequest $req) {
        $this->bookRepository->delete($req->book());
    }
}
