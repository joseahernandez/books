<?php

namespace books\application\service\book;

use books\domain\model\author\Author;
use books\domain\model\author\AuthorId;
use books\domain\model\book\Book;
use books\domain\model\book\BookId;
use books\domain\model\book\BookRepository;
use books\domain\model\book\CommentRepository;
use books\domain\model\reader\Reader;
use books\domain\model\reader\ReaderId;
use books\domain\model\reader\ReaderRepository;
use books\infrastructure\domain\model\book\MemoryBookRepository;
use books\infrastructure\domain\model\book\MemoryCommentRepository;
use books\infrastructure\domain\model\reader\MemoryReaderRepository;

class CreateCommentServiceTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var ReaderRepository
     */
    private $readerRepository;

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var ReaderId
     */
    private $readerId;

    /**
     * @var BookId
     */
    private $bookId;

    protected function setUp() {
        $this->bookId            = new BookId();
        $this->readerId          = new ReaderId();
        $this->commentRepository = new MemoryCommentRepository();
        $this->readerRepository  = new MemoryReaderRepository();
        $this->bookRepository    = new MemoryBookRepository();

        $this->addFixturesToRepositories();
    }

    private function addFixturesToRepositories() {
        $this->readerId = new ReaderId();
        $reader         = new Reader($this->readerId, "Lewis");
        $this->bookId   = new BookId();
        $book           = new Book($this->bookId, "Hamlet", new AuthorId());

        $this->readerRepository->save($reader);
        $this->bookRepository->save($book);
    }

    /**
     * @test
     */
    public function createComment() {
        $commentText          = "That book is awesome";
        $createCommentService = new CreateCommentService(
            $this->readerRepository,
            $this->commentRepository,
            $this->bookRepository
        );
        $createCommentService->execute(new CreateCommentRequest($this->readerId, $this->bookId, $commentText));
        $this->assertTrue(true);
    }

    /**
     * @test
     * @expectedException \books\domain\model\reader\InvalidReaderException
     */
    public function createCommentWithInvalidReader() {
        $invalidReaderId      = new ReaderId();
        $createCommentService = new CreateCommentService(
            $this->readerRepository,
            $this->commentRepository,
            $this->bookRepository
        );
        $createCommentService->execute(new CreateCommentRequest($invalidReaderId, $this->bookId, "A comment"));
    }

    /**
     * @test
     * @expectedException \books\domain\model\book\InvalidBookException
     */
    public function createCommentWithInvalidBook() {
        $invalidBookId        = new BookId();
        $createCommentService = new CreateCommentService(
            $this->readerRepository,
            $this->commentRepository,
            $this->bookRepository
        );
        $createCommentService->execute(new CreateCommentRequest($this->readerId, $invalidBookId, "A comment"));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function createCommentWithEmptyComment() {
        $emptyComment         = "";
        $createCommentService = new CreateCommentService(
            $this->readerRepository,
            $this->commentRepository,
            $this->bookRepository
        );
        $createCommentService->execute(new CreateCommentRequest($this->readerId, $this->bookId, $emptyComment));
    }
}
