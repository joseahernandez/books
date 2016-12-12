<?php

namespace books\application\service\book;

use books\domain\model\author\Author;
use books\domain\model\author\AuthorId;
use books\domain\model\book\Book;
use books\domain\model\book\BookId;
use books\domain\model\book\BookRepository;
use books\domain\model\book\Comment;
use books\domain\model\book\CommentId;
use books\domain\model\book\CommentRepository;
use books\domain\model\reader\Reader;
use books\domain\model\reader\ReaderId;
use books\domain\model\reader\ReaderRepository;
use books\infrastructure\domain\model\book\MemoryBookRepository;
use books\infrastructure\domain\model\book\MemoryCommentRepository;
use books\infrastructure\domain\model\reader\MemoryReaderRepository;

class EditCommentServiceTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var BookId
     */
    private $bookId;

    /**
     * @var CommentId
     */
    private $commentId;

    /**
     * @var ReaderId
     */
    private $readerId;

    /**
     * @var ReaderRepository
     */
    private $readerRepository;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var EditCommentService
     */
    private $editCommentService;


    /**
     * @setUp
     */
    public function setUp() {
        $this->bookRepository     = new MemoryBookRepository();
        $this->readerRepository   = new MemoryReaderRepository();
        $this->commentRepository  = new MemoryCommentRepository();
        $this->editCommentService = new EditCommentService(
            $this->readerRepository,
            $this->commentRepository,
            $this->bookRepository
        );

        $this->addFixturesToRepositories();
    }

    private function addFixturesToRepositories() {
        $this->readerId  = new ReaderId();
        $reader          = new Reader($this->readerId, "Lewis");
        $this->bookId    = new BookId();
        $book            = new Book($this->bookId, "Hamlet", new Author(new AuthorId(), "William", "Shakespeare"));
        $this->commentId = new CommentId();
        $comment         = new Comment($this->commentId, $this->bookId, $this->readerId, "I like the book");

        $this->readerRepository->save($reader);
        $this->bookRepository->save($book);
        $this->commentRepository->save($comment);
    }

    /**
     * @test
     */
    public function editComment() {
        $commentEdited = "I really love the book";
        $request       = new EditCommentRequest($this->readerId, $this->bookId, $this->commentId, $commentEdited);

        $this->editCommentService->execute($request);
        $comment = $this->commentRepository->findById($this->commentId);
        $this->assertSame($commentEdited, $comment->comment());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function editCommentWithEmptyText() {
        $emptyText = "";
        $request   = new EditCommentRequest($this->readerId, $this->bookId, $this->commentId, $emptyText);

        $this->editCommentService->execute($request);
    }

    /**
     * @test
     * @expectedException \books\domain\model\reader\InvalidReaderException
     */
    public function editCommentWithInvalidReaderId() {
        $commentEdited = "I really love the book";
        $invalidReader = new ReaderId();
        $request       = new EditCommentRequest($invalidReader, $this->bookId, $this->commentId, $commentEdited);

        $this->editCommentService->execute($request);
    }

    /**
     * @test
     * @expectedException \books\domain\model\book\InvalidBookException
     */
    public function editCommentWithInvalidBookId() {
        $commentEdited = "I really love the book";
        $invalidBook   = new BookId();
        $request       = new EditCommentRequest($this->readerId, $invalidBook, $this->commentId, $commentEdited);

        $this->editCommentService->execute($request);
    }

    /**
     * @test
     * @expectedException \books\domain\model\book\InvalidCommentException
     */
    public function editCommentWithInvalidCommentId() {
        $commentEdited    = "I really love the book";
        $invalidCommentId = new CommentId();
        $request          = new EditCommentRequest($this->readerId, $this->bookId, $invalidCommentId, $commentEdited);

        $this->editCommentService->execute($request);
    }

    /**
     * @test
     * @expectedException \books\domain\model\reader\InvalidReaderException
     */
    public function editCommentThatDoNotBelongsToReader() {
        $commentEdited = "I really love the book";
        $otherReaderId = new ReaderId();
        $otherReader   = new Reader($otherReaderId, "Jason");
        $this->readerRepository->save($otherReader);
        $request = new EditCommentRequest($otherReaderId, $this->bookId, $this->commentId, $commentEdited);

        $this->editCommentService->execute($request);
    }

    /**
     * @test
     * @expectedException \books\domain\model\book\InvalidBookException
     */
    public function editCommentThatDoNotBelongsToBook() {
        $commentEdited = "I really love the book";
        $otherBookId = new BookId();
        $otherBook   = new Book($otherBookId, "Macbeth", new Author(new AuthorId(), "William", "Shakespeare"));
        $this->bookRepository->save($otherBook);
        $request = new EditCommentRequest($this->readerId, $otherBookId, $this->commentId, $commentEdited);

        $this->editCommentService->execute($request);
    }
}
