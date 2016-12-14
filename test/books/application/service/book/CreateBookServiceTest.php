<?php

namespace books\application\service\book;

use books\domain\model\author\Author;
use books\domain\model\author\AuthorId;
use books\domain\model\author\AuthorRepository;
use books\domain\model\book\BookRepository;
use books\infrastructure\domain\model\author\MemoryAuthorRepository;
use books\infrastructure\domain\model\book\MemoryBookRepository;

class CreateBookServiceTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @var AuthorId
     */
    private $authorId;

    /**
     * @var CreateBookService
     */
    private $createBookService;

    protected function setUp() {
        $this->bookRepository    = new MemoryBookRepository();
        $this->authorRepository  = new MemoryAuthorRepository();
        $this->createBookService = new CreateBookService($this->bookRepository, $this->authorRepository);

        $this->addFixturesToRepositories();
    }

    private function addFixturesToRepositories() {
        $this->authorId = new AuthorId();
        $author         = new Author($this->authorId, "William", "Shakespeare");
        $this->authorRepository->save($author);
    }

    /**
     * @test
     */
    public function createBook() {
        $title = "Hamlet";
        $req   = new CreateBookRequest($title, $this->authorId);
        $this->createBookService->execute($req);

        $this->assertSame(1, count($this->bookRepository->findAll()));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function createBookWithEmptyTitle() {
        $emptyTitle = "";
        $req        = new CreateBookRequest($emptyTitle, $this->authorId);
        $this->createBookService->execute($req);
    }

    /**
     * @test
     * @expectedException \books\domain\model\author\InvalidAuthorException
     */
    public function createBookWithInvalidAuthor() {
        $title         = "Hamlet";
        $invalidAuthor = new AuthorId();
        $req           = new CreateBookRequest($title, $invalidAuthor);
        $this->createBookService->execute($req);
    }
}
