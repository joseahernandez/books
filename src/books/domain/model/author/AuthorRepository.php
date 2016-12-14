<?php

namespace books\domain\model\author;


interface AuthorRepository {
    /**
     * @param AuthorId $authorId
     *
     * @return Author
     */
    public function findById(AuthorId $authorId): Author;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Author $author
     */
    public function save(Author $author);
}
