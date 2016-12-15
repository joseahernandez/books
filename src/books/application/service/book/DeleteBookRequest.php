<?php

namespace books\application\service\book;

use books\domain\model\book\BookId;

class DeleteBookRequest {

    /**
     * @var BookId
     */
    private $bookId;

    /**
     * @param BookId $bookId
     */
    public function __construct(BookId $bookId) {
        $this->bookId = $bookId;
    }

    /**
     * @return BookId
     */
    public function book() { return $this->bookId; }
}
