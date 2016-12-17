<?php

namespace books\application\service\author;

use books\domain\model\author\AuthorId;
use books\domain\model\author\AuthorRepository;
use books\domain\model\author\AuthorHasBooksException;
use books\domain\model\book\BookRepository;

class DeleteAuthorService {
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @param AuthorRepository $authorRepository
     * @param BookRepository   $bookRepository
     */
    public function __construct(AuthorRepository $authorRepository, BookRepository $bookRepository) {
        $this->authorRepository = $authorRepository;
        $this->bookRepository   = $bookRepository;
    }

    public function execute(DeleteAuthorRequest $req) {
        $this->assertAuthorHasNoBooks($req->author());
        $this->authorRepository->delete($req->author());
    }

    /**
     * @param AuthorId $authorId
     *
     * @throws AuthorHasBooksException
     */
    private function assertAuthorHasNoBooks(AuthorId $authorId) {
        if (count($this->bookRepository->findByAuthor($authorId)) !== 0) {
            throw new AuthorHasBooksException(
                sprintf("Author %s still contains books", $authorId)
            );
        }
    }
}
