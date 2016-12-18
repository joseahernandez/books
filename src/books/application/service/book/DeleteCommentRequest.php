<?php

namespace books\application\service\book;

use books\domain\model\book\BookId;
use books\domain\model\book\CommentId;

class DeleteCommentRequest {
    /**
     * @var CommentId
     */
    private $commentId;

    /**
     * @var BookId
     */
    private $bookId;

    /**
     * @param CommentId $commentId
     * @param BookId    $bookId
     */
    public function __construct(CommentId $commentId, BookId $bookId) {
        $this->commentId = $commentId;
        $this->bookId    = $bookId;
    }

    /**
     * @return CommentId
     */
    public function comment() { return $this->commentId; }

    /**
     * @return BookId
     */
    public function book() { return $this->bookId; }
}
