<?php

namespace books\application\service\book;

use books\domain\model\book\CommentNotBelongsBookException;
use books\domain\model\book\BookId;
use books\domain\model\book\BookRepository;
use books\domain\model\book\Comment;
use books\domain\model\book\CommentRepository;

class DeleteCommentService {
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @param CommentRepository $commentRepository
     * @param BookRepository    $bookRepository
     */
    public function __construct(CommentRepository $commentRepository, BookRepository $bookRepository) {
        $this->commentRepository = $commentRepository;
        $this->bookRepository    = $bookRepository;
    }

    /**
     * @param DeleteCommentRequest $req
     *
     * @throws CommentNotBelongsBookException
     */
    public function execute(DeleteCommentRequest $req) {
        $comment = $this->commentRepository->findById($req->comment());
        $this->assertCommentBelongsToBook($comment, $req->book());

        $this->commentRepository->delete($req->comment());
    }

    private function assertCommentBelongsToBook(Comment $comment, BookId $bookId) {
        if ($comment->book() !== $bookId) {
            throw new CommentNotBelongsBookException(
                sprintf("Comment %s don't belongs to book %s", $comment->id(), $bookId)
            );
        }
    }
}
