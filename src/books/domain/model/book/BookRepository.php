<?php

namespace books\domain\model\book;

use books\domain\model\author\AuthorId;

interface BookRepository {
    /**
     * @param BookId $bookId
     *
     * @return Book
     */
    public function findById(BookId $bookId): Book;

    /**
     * @param AuthorId $authorId
     *
     * @return array
     */
    public function findByAuthor(AuthorId $authorId): array;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Book $book
     */
    public function save(Book $book);

    /**
     * @param BookId $bookId
     */
    public function delete(BookId $bookId);
}
