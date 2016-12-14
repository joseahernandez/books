<?php

namespace books\infrastructure\domain\model\author;

use books\domain\model\author\Author;
use books\domain\model\author\AuthorId;
use books\domain\model\author\AuthorRepository;
use books\domain\model\author\InvalidAuthorException;

class MemoryAuthorRepository implements AuthorRepository {

    /**
     * @var array
     */
    private $map;


    public function __construct() {
        $this->map = [];
    }

    /**
     * @param AuthorId $authorId
     *
     * @return Author
     * @throws InvalidAuthorException
     */
    public function findById(AuthorId $authorId): Author {
        if (!array_key_exists($authorId->__toString(), $this->map)) {
            throw new InvalidAuthorException(sprintf("Author %s doesn't exists", $authorId));
        }

        return $this->map[$authorId->__toString()];
    }

    /**
     * @return array
     */
    public function findAll(): array {
        return array_values($this->map);
    }

    /**
     * @param Author $author
     */
    public function save(Author $author) {
        $this->map[$author->id()->__toString()] = $author;
    }

}
