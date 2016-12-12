<?php

namespace books\domain\model\book;

use books\domain\model\author\Author;
use books\domain\model\reader\ReaderId;
use books\validators\Assert;

final class Book {

    /**
     * @var BookId
     */
    private $bookId;

    /**
     * @var string
     */
    private $title;

    /**
     * @var Author
     */
    private $author;

    /**
     * @param BookId $bookId
     * @param string $title
     * @param Author $author
     */
    public function __construct(BookId $bookId, string $title, Author $author) {
        $this->bookId = $bookId;
        $this->setTitle($title);
        $this->author = $author;
    }

    /**
     * @param $title
     */
    private function setTitle($title) {
        Assert::notEmpty($title, "Book title can't be empty");
        $this->title = $title;
    }

    /**
     * @return BookId
     */
    public function id(): BookId { return $this->bookId; }

    /**
     * @return string
     */
    public function title(): string { return $this->title; }

    /**
     * @return Author
     */
    public function author(): Author { return $this->author; }

    /**
     * @param ReaderId $readerId
     * @param string   $comment
     *
     * @return Comment
     */
    public function comment(ReaderId $readerId, string $comment): Comment {
        return new Comment(new CommentId(), $this->id(), $readerId, $comment);
    }

    /**
     * @param ReaderId $readerId
     * @param int      $rate
     *
     * @return Rate
     */
    public function rate(ReaderId $readerId, int $rate) {
        return new Rate($readerId, $rate);
    }
}
