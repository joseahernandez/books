<?php

namespace books\domain\model;

use books\domain\model\author\Author;
use books\domain\model\author\AuthorId;
use books\domain\model\book\Book;
use books\domain\model\book\BookId;
use books\domain\model\book\Rate;
use books\domain\model\reader\Reader;
use books\domain\model\reader\ReaderId;

class BookTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var Book
     */
    private $book;

    /**
     * @var AuthorId
     */
    private $authorId;

    /**
     * @setUp
     */
    public function setUp() {
        $this->reader   = new Reader(new ReaderId(), "Reader 1");
        $this->authorId = new AuthorId();
        $this->book     = new Book(new BookId(), "Macbeth", $this->authorId);
    }

    /**
     * @test
     */
    public function createBook() {
        $bookId = new BookId();
        $title  = "Hamlet";
        $book   = new Book($bookId, $title, $this->authorId);

        $this->assertSame($bookId, $book->id());
        $this->assertSame($title, $book->title());
        $this->assertSame($this->authorId, $book->author());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function bookTitleCanNotBeEmpty() {
        $bookId = new BookId();
        $title  = "";
        new Book($bookId, $title, $this->authorId);
    }

    /**
     * @test
     */
    public function readerCanCommentABook() {
        $commentText = "One of the most important book of Shakespeare";
        $comment     = $this->book->comment($this->reader->id(), $commentText);

        $this->assertSame($commentText, $comment->comment());
        $this->assertSame($this->reader->id(), $comment->reader());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function readerCanNotDoEmptyComment() {
        $emptyComment = "";
        $this->book->comment($this->reader->id(), $emptyComment);
    }

    /**
     * @test
     */
    public function readerCanRateABook() {
        $rateValue = 2;
        $rate      = $this->book->rate($this->reader->id(), $rateValue);

        $this->assertSame($rateValue, $rate->rate());
        $this->assertSame($this->reader->id(), $rate->reader());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function readerCanNotRateWithValueLessThanMin() {
        $minValue         = Rate::RATE_MIN_VALUE;
        $lessThanMinValue = $minValue - 1;

        $this->book->rate($this->reader->id(), $lessThanMinValue);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function readerCanNotRateWithValueHigherThanMax() {
        $maxValue          = Rate::RATE_MAX_VALUE;
        $higherTanMaxValue = $maxValue + 1;

        $this->book->rate($this->reader->id(), $higherTanMaxValue);
    }
}
