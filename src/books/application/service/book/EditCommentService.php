<?php

namespace books\application\service\book;

use books\domain\model\book\Book;
use books\domain\model\book\BookRepository;
use books\domain\model\book\Comment;
use books\domain\model\book\CommentRepository;
use books\domain\model\book\InvalidBookException;
use books\domain\model\reader\InvalidReaderException;
use books\domain\model\reader\Reader;
use books\domain\model\reader\ReaderRepository;

class EditCommentService {

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
     * @param ReaderRepository  $readerRepository
     * @param CommentRepository $commentRepository
     * @param BookRepository    $bookRepository
     */
    public function __construct(
        ReaderRepository $readerRepository,
        CommentRepository $commentRepository,
        BookRepository $bookRepository
    ) {
        $this->readerRepository  = $readerRepository;
        $this->commentRepository = $commentRepository;
        $this->bookRepository    = $bookRepository;
    }

    /**
     * @param EditCommentRequest $req
     */
    public function execute(EditCommentRequest $req) {
        $reader  = $this->readerRepository->findById($req->reader());
        $book    = $this->bookRepository->findById($req->book());
        $comment = $this->commentRepository->findById($req->commentId());

        $this->assertCommentBelongsToBook($comment, $book);
        $this->assertCommentBelongsToReader($comment, $reader);

        $this->commentRepository->save(
            new Comment(
                $comment->id(),
                $comment->book(),
                $comment->reader(),
                $req->comment()
            )
        );
    }

    /**
     * @param Comment $comment
     * @param Book    $book
     *
     * @throws InvalidBookException
     */
    private function assertCommentBelongsToBook(Comment $comment, Book $book) {
        if ($comment->book() !== $book->id()) {
            throw new InvalidBookException(
                sprintf("Comment %s doesn't belongs to book %s", $comment->id(), $book->id())
            );
        }
    }

    /**
     * @param Comment $comment
     * @param Reader  $reader
     *
     * @throws InvalidReaderException
     */
    private function assertCommentBelongsToReader(Comment $comment, Reader $reader) {
        if ($comment->reader() !== $reader->id()) {
            throw new InvalidReaderException(
                sprintf("Comment %s doesn't belongs to reader %s", $comment->id(), $reader->id())
            );
        }
    }
}
