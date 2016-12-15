<?php

namespace books\application\service\book;

use books\domain\model\author\AuthorId;
use books\domain\model\book\BookId;

class EditBookRequest {
    /**
     * @var BookId
     */
    private $bookId;

    /**
     * @var string
     */
    private $title;

    /**
     * @var AuthorId
     */
    private $authorId;

    /**
     * @param BookId   $bookId
     * @param string   $title
     * @param AuthorId $authorId
     */
    public function __construct(BookId $bookId, string $title, AuthorId $authorId) {
        $this->bookId   = $bookId;
        $this->title    = $title;
        $this->authorId = $authorId;
    }

    /**
     * @return BookId
     */
    public function book(): BookId { return $this->bookId; }

    /**
     * @return string
     */
    public function title(): string { return $this->title; }

    /**
     * @return AuthorId
     */
    public function author(): AuthorId { return $this->authorId; }
}
