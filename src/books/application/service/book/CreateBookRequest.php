<?php

namespace books\application\service\book;

use books\domain\model\author\AuthorId;

class CreateBookRequest {
    /**
     * @var string
     */
    private $title;

    /**
     * @var AuthorId
     */
    private $authorId;

    /**
     * CreateBookRequest constructor.
     *
     * @param string   $title
     * @param AuthorId $authorId
     */
    public function __construct(string $title, AuthorId $authorId) {
        $this->title    = $title;
        $this->authorId = $authorId;
    }

    /**
     * @return string
     */
    public function title(): string { return $this->title; }

    /**
     * @return AuthorId
     */
    public function author(): AuthorId { return $this->authorId; }
}
