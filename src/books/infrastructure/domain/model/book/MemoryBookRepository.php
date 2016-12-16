<?php

namespace books\infrastructure\domain\model\book;

use books\domain\model\author\AuthorId;
use books\domain\model\book\Book;
use books\domain\model\book\BookId;
use books\domain\model\book\BookRepository;
use books\domain\model\book\InvalidBookException;

class MemoryBookRepository implements BookRepository {

    /**
     * @var array
     */
    private $map;


    public function __construct() {
        $this->map = [];
    }

    /**
     * @param BookId $bookId
     *
     * @return Book
     * @throws InvalidBookException
     */
    public function findById(BookId $bookId): Book {
        if (!array_key_exists($bookId->__toString(), $this->map)) {
            throw new InvalidBookException(sprintf("Book %s doesn't exists", $bookId));
        }

        return $this->map[$bookId->__toString()];
    }

    /**
     * @param AuthorId $authorId
     *
     * @return array
     */
    public function findByAuthor(AuthorId $authorId): array {
        return array_filter(
            $this->map,
            function (Book $book) use ($authorId) {
                return $book->author() === $authorId;
            }
        );
    }


    /**
     * @return array
     */
    public function findAll(): array {
        return array_values($this->map);
    }

    /**
     * @param Book $book
     */
    public function save(Book $book) {
        $this->map[$book->id()->__toString()] = $book;
    }

    /**
     * @param BookId $bookId
     */
    public function delete(BookId $bookId) {
        unset($this->map[$bookId->__toString()]);
    }
}
