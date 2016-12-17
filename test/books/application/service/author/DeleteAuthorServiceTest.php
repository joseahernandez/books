<?php

namespace books\application\service\author;

use books\domain\model\author\AuthorId;
use books\domain\model\author\Author;
use books\domain\model\author\AuthorRepository;
use books\domain\model\book\Book;
use books\domain\model\book\BookId;
use books\domain\model\book\BookRepository;
use books\infrastructure\domain\model\author\MemoryAuthorRepository;
use books\infrastructure\domain\model\book\MemoryBookRepository;

class DeleteAuthorServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var AuthorId
     */
    private $authorId;

    /**
     * @var DeleteAuthorService
     */
    private $deleteAuthorService;

    protected function setUp() {
        $this->authorRepository    = new MemoryAuthorRepository();
        $this->bookRepository      = new MemoryBookRepository();
        $this->deleteAuthorService = new DeleteAuthorService($this->authorRepository, $this->bookRepository);

        $this->addFixturesToRepositories();
    }

    private function addFixturesToRepositories() {
        $this->authorId = new AuthorId();
        $this->authorRepository->save(
            new Author(
                $this->authorId,
                "William",
                "Shakespeare"
            )
        );
    }

    /**
     * @test
     */
    public function deleteAuthor() {
        $req = new DeleteAuthorRequest($this->authorId);
        $this->deleteAuthorService->execute($req);

        $this->assertSame(0, count($this->authorRepository->findAll()));
    }

    /**
     * @test
     * @expectedException \books\domain\model\author\AuthorHasBooksException
     */
    public function deleteAuthorWithBook() {
        $this->bookRepository->save(
            new Book(
                new BookId(),
                "Macbeth",
                $this->authorId
            )
        );

        $req = new DeleteAuthorRequest($this->authorId);
        $this->deleteAuthorService->execute($req);
    }
}
