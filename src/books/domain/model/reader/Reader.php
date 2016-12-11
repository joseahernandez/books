<?php

namespace books\domain\model\reader;

use books\domain\model\book\BookId;
use books\validators\Assert;

class Reader {
    /**
     * @var ReaderId
     */
    private $readerId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var BookId
     */
    private $bookReadingId;

    /**
     * Reader constructor.
     *
     * @param ReaderId $readerId
     * @param string $name
     */
    public function __construct(ReaderId $readerId, string $name) {
        $this->readerId = $readerId;
        $this->setName($name);
        $this->bookReadingId = null;
    }

    /**
     * @param string $name
     */
    private function setName(string $name) {
        Assert::notEmpty($name, "Reader name can't be empty");
        $this->name = $name;
    }

    /**
     * @return ReaderId
     */
    public function id(): ReaderId { return $this->readerId; }

    /**
     * @return string
     */
    public function name(): string { return $this->name; }

    /**
     * @return BookId
     */
    public function bookReading(): BookId { return $this->bookReadingId; }

    /**
     * @param BookId $bookId
     */
    public function reading(BookId $bookId) {
        $this->bookReadingId = $bookId;
    }
}
