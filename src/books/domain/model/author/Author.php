<?php

namespace books\domain\model\author;

use books\validators\Assert;

class Author {

    /**
     * @AuthorId
     */
    private $authorId;

    /**
     * @string
     */
    private $name;

    /**
     * @string
     */
    private $surname;

    /**
     * @param AuthorId $authorId
     * @param string   $name
     * @param string   $surname
     */
    public function __construct(AuthorId $authorId, string $name, string $surname) {
        $this->authorId = $authorId;
        $this->setName($name);
        $this->setSurname($surname);
    }

    /**
     * @param string $name
     */
    private function setName(string $name) {
        Assert::notEmpty($name, "Author name can't be empty");
        $this->name = $name;
    }

    /**
     * @param string $surname
     */
    private function setSurname(string $surname) {
        Assert::notEmpty($surname, "Author surname can't be empty");
        $this->surname = $surname;
    }

    /**
     * @return AuthorId
     */
    public function id(): AuthorId { return $this->authorId; }

    /**
     * @return string
     */
    public function name(): string { return $this->name; }

    /**
     * @return string
     */
    public function surname(): string { return $this->surname; }

    /**
     * @return string
     */
    function __toString() {
        return $this->name() . ' ' . $this->surname();
    }
}
