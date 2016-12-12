<?php

namespace books\application\service\book;

use books\domain\model\book\BookRepository;
use books\domain\model\book\CommentRepository;
use books\domain\model\reader\ReaderRepository;

class CreateCommentService {

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
     * @param CreateCommentRequest $req
     */
    public function execute(CreateCommentRequest $req) {
        $reader  = $this->readerRepository->findById($req->reader());
        $book    = $this->bookRepository->findById($req->book());
        $comment = $book->comment($reader->id(), $req->comment());

        $this->commentRepository->save($comment);
    }
}
