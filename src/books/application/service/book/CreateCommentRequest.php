<?php

namespace books\application\service\book;

use books\domain\model\book\BookId;
use books\domain\model\reader\ReaderId;

class CreateCommentRequest {
    /**
     * @var ReaderId
     */
    private $reader;

    /**
     * @var BookId
     */
    private $book;

    /**
     * @var string
     */
    private $comment;

    /**
     * CreateCommentRequest constructor.
     *
     * @param ReaderId $reader
     * @param BookId   $book
     * @param string   $comment
     */
    public function __construct(ReaderId $reader, BookId $book, string $comment) {
        $this->reader  = $reader;
        $this->book    = $book;
        $this->comment = $comment;
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
     * @return string
     */
    public function comment() { return $this->comment; }
}
