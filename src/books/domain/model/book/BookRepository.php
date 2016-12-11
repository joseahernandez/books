<?php

namespace books\domain\model\book;

interface BookRepository {
    /**
     * @param BookId $bookId
     *
     * @return Book
     */
    public function findById(BookId $bookId): Book;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Book $book
     */
    public function save(Book $book);
}
