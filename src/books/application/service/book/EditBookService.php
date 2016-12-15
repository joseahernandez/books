<?php

namespace books\application\service\book;

use books\domain\model\author\AuthorId;
use books\domain\model\author\AuthorRepository;
use books\domain\model\book\Book;
use books\domain\model\book\BookRepository;

class EditBookService {
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
     * @param EditBookRequest $req
     */
    public function execute(EditBookRequest $req) {
        $this->assertAuthorExists($req->author());
        $book = $this->bookRepository->findById($req->book());

        $this->bookRepository->save(
            new Book(
                $book->id(),
                $req->title(),
                $req->author()
            )
        );
    }

    /**
     * @param AuthorId $authorId
     */
    private function assertAuthorExists(AuthorId $authorId) {
        $this->authorRepository->findById($authorId);
    }
}
