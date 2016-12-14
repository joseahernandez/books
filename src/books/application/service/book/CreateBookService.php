<?php

namespace books\application\service\book;

use books\domain\model\author\AuthorId;
use books\domain\model\author\AuthorRepository;
use books\domain\model\book\Book;
use books\domain\model\book\BookId;
use books\domain\model\book\BookRepository;

class CreateBookService {

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @param BookRepository   $bookRepository
     * @param AuthorRepository $authorRepository
     */
    public function __construct(BookRepository $bookRepository, AuthorRepository $authorRepository) {
        $this->bookRepository   = $bookRepository;
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param CreateBookRequest $req
     */
    public function execute(CreateBookRequest $req) {
        $this->assertAuthorExists($req->author());
        $book = new Book(new BookId(), $req->title(), $req->author());

        $this->bookRepository->save($book);
    }

    /**
     * @param AuthorId $authorId
     */
    private function assertAuthorExists(AuthorId $authorId) {
        $this->authorRepository->findById($authorId);
    }
}
