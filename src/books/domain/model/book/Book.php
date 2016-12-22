<?php

namespace books\domain\model\book;

use books\domain\model\author\Author;
use books\domain\model\author\AuthorId;
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
     * @var AuthorId
     */
    private $authorId;

    /**
     * @param BookId   $bookId
     * @param string   $title
     * @param AuthorId $authorId
     */
    public function __construct(BookId $bookId, string $title, AuthorId $authorId) {
        $this->bookId = $bookId;
        $this->setTitle($title);
        $this->authorId = $authorId;
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
     * @return AuthorId
     */
    public function author(): AuthorId { return $this->authorId; }

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
        return new Rate($this->id(), $readerId, $rate);
    }
}
