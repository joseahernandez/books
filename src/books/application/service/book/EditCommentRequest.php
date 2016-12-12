<?php

namespace books\application\service\book;

use books\domain\model\book\BookId;
use books\domain\model\book\CommentId;
use books\domain\model\reader\ReaderId;

class EditCommentRequest {
    /**
     * @var ReaderId
     */
    private $reader;

    /**
     * @var BookId
     */
    private $book;

    /**
     * @var CommentId
     */
    private $commentId;

    /**
     * @var string
     */
    private $comment;

    /**
     * CreateCommentRequest constructor.
     *
     * @param ReaderId  $reader
     * @param BookId    $book
     * @param CommentId $commentId
     * @param string    $comment
     */
    public function __construct(ReaderId $reader, BookId $book, CommentId $commentId, string $comment) {
        $this->reader    = $reader;
        $this->book      = $book;
        $this->commentId = $commentId;
        $this->comment   = $comment;
    }

    /**
     * @return ReaderId
     */
    public function reader() { return $this->reader; }

    /**
     * @return BookId
     */
    public function book() { return $this->book; }

    /**
     * @return CommentId
     */
    public function commentId() { return $this->commentId; }

    /**
     * @return string
     */
    public function comment() { return $this->comment; }
}
