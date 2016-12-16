<?php

namespace books\application\service\author;

use books\domain\model\author\AuthorId;

class EditAuthorRequest {
    /**
     * @var AuthorId
     */
    private $authorId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $surname;

    /**
     * EditAuthorRequest constructor.
     *
     * @param AuthorId $authorId
     * @param string   $name
     * @param string   $surname
     */
    public function __construct(AuthorId $authorId, string $name, string $surname) {
        $this->authorId = $authorId;
        $this->name     = $name;
        $this->surname  = $surname;
    }

    /**
     * @return AuthorId
     */
    public function author(): AuthorId { return $this->authorId; }

    /**
     * @return string
     */
    public function name(): string { return $this->name; }

    /**
     * @return string
     */
    public function surname(): string { return $this->surname; }
}
