<?php

namespace books\application\service\book;

use books\domain\model\author\Author;
use books\domain\model\author\AuthorId;
use books\domain\model\author\AuthorRepository;
use books\domain\model\book\Book;
use books\domain\model\book\BookId;
use books\domain\model\book\BookRepository;
use books\infrastructure\domain\model\author\MemoryAuthorRepository;
use books\infrastructure\domain\model\book\MemoryBookRepository;

class EditBookServiceTest extends \PHPUnit_Framework_TestCase {
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
     * @var BookId
     */
    private $bookId;

    /**
     * @var EditBookService
     */
    private $editBookService;

    protected function setUp() {
        $this->bookRepository   = new MemoryBookRepository();
        $this->authorRepository = new MemoryAuthorRepository();
        $this->editBookService  = new EditBookService($this->bookRepository, $this->authorRepository);

        $this->addFixturesToRepositories();
    }

    private function addFixturesToRepositories() {
        $this->authorId = new AuthorId();
        $author         = new Author($this->authorId, "William", "Shakespeare");
        $this->authorRepository->save($author);

        $this->bookId = new BookId();
        $book         = new Book($this->bookId, "Hamlet", $this->authorId);
        $this->bookRepository->save($book);
    }

    /**
     * @test
     */
    public function editBookTitle() {
        $title = "Amlet";
        $req   = new EditBookRequest($this->bookId, $title, $this->authorId);
        $this->editBookService->execute($req);

        $book = $this->bookRepository->findById($this->bookId);
        $this->assertSame($title, $book->title());
    }

    /**
     * @test
     */
    public function editBookAuthor() {
        $title       = "Amlet";
        $newAuthorId = new AuthorId();
        $newAuthor   = new Author($newAuthorId, "Edgar Alan", "Poe");
        $this->authorRepository->save($newAuthor);

        $req = new EditBookRequest($this->bookId, $title, $newAuthorId);
        $this->editBookService->execute($req);

        $book = $this->bookRepository->findById($this->bookId);
        $this->assertSame($title, $book->title());
        $this->assertSame($newAuthorId, $book->author());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function editBookWithEmptyTitle() {
        $emptyTitle = "";
        $req        = new EditBookRequest($this->bookId, $emptyTitle, $this->authorId);
        $this->editBookService->execute($req);
    }

    /**
     * @test
     * @expectedException \books\domain\model\author\InvalidAuthorException
     */
    public function editBookWithInvalidAuthor() {
        $title         = "Amlet";
        $invalidAuthor = new AuthorId();
        $req           = new EditBookRequest($this->bookId, $title, $invalidAuthor);
        $this->editBookService->execute($req);
    }

    /**
     * @test
     * @expectedException \books\domain\model\book\InvalidBookException
     */
    public function editBookWithInvalidBookId() {
        $invalidBookId = new BookId();
        $title         = "Amlet";
        $req           = new EditBookRequest($invalidBookId, $title, $this->authorId);
        $this->editBookService->execute($req);
    }
}
