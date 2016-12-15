<?php

namespace books\application\service\book;

use books\domain\model\author\AuthorId;
use books\domain\model\book\Book;
use books\domain\model\book\BookId;
use books\domain\model\book\BookRepository;
use books\infrastructure\domain\model\book\MemoryBookRepository;

class DeleteBookServiceTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var DeleteBookService
     */
    private $deleteBookService;

    /**
     * @var BookId
     */
    private $bookId;

    protected function setUp() {
        $this->bookRepository    = new MemoryBookRepository();
        $this->deleteBookService = new DeleteBookService($this->bookRepository);

        $this->addFixturesToRepositories();
    }

    private function addFixturesToRepositories() {
        $authorId     = new AuthorId();
        $this->bookId = new BookId();

        $this->bookRepository->save(new Book($this->bookId, "Hamlet", $authorId));
    }

    /**
     * @test
     */
    public function deleteBook() {
        $req = new DeleteBookRequest($this->bookId);
        $this->deleteBookService->execute($req);

        $this->assertSame(0, count($this->bookRepository->findAll()));
    }
}
