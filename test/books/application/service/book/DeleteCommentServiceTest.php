<?php

namespace books\application\service\book;

use books\domain\model\author\AuthorId;
use books\domain\model\book\Book;
use books\domain\model\book\BookId;
use books\domain\model\book\BookRepository;
use books\domain\model\book\Comment;
use books\domain\model\book\CommentId;
use books\domain\model\book\CommentRepository;
use books\domain\model\reader\ReaderId;
use books\infrastructure\domain\model\book\MemoryBookRepository;
use books\infrastructure\domain\model\book\MemoryCommentRepository;

class DeleteCommentServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var CommentId
     */
    private $commentId;

    /**
     * @var BookId
     */
    private $bookId;

    /**
     * @var DeleteCommentService
     */
    private $deleteCommentService;

    protected function setUp() {
        $this->commentRepository    = new MemoryCommentRepository();
        $this->bookRepository       = new MemoryBookRepository();
        $this->deleteCommentService = new DeleteCommentService($this->commentRepository, $this->bookRepository);

        $this->addFixturesToRepositories();
    }

    private function addFixturesToRepositories() {
        $this->bookId = new BookId();
        $this->bookRepository->save(
            new Book(
                $this->bookId,
                "Hamlet",
                new AuthorId()
            )
        );

        $this->commentId = new CommentId();
        $this->commentRepository->save(
            new Comment(
                $this->commentId,
                $this->bookId,
                new ReaderId(),
                "This book is amazing"
            )
        );
    }

    /**
     * @test
     */
    public function deleteComment() {
        $req = new DeleteCommentRequest($this->commentId, $this->bookId);
        $this->deleteCommentService->execute($req);
        $this->assertSame(0, count($this->commentRepository->findAll()));
    }

    /**
     * @test
     * @expectedException \books\domain\model\book\InvalidCommentException
     */
    public function deleteCommentWithInvalidCommentId() {
        $invalidCommentId = new CommentId();
        $req              = new DeleteCommentRequest($invalidCommentId, $this->bookId);
        $this->deleteCommentService->execute($req);
    }

    /**
     * @test
     * @expectedException \books\domain\model\book\CommentNotBelongsBookException
     */
    public function deleteCommentWithInvalidBookId() {
        $invalidBookId = new BookId();
        $req           = new DeleteCommentRequest($this->commentId, $invalidBookId);
        $this->deleteCommentService->execute($req);
    }
}
