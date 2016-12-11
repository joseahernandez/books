<?php

namespace books\domain\model\reader;

use books\domain\model\book\BookId;

class ReaderTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function createReader() {
        $readerId   = new ReaderId();
        $readerName = 'Jonathan';
        $reader     = new Reader($readerId, $readerName);

        $this->assertSame($readerId, $reader->id());
        $this->assertSame($readerName, $reader->name());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function readerNameCanNotBeEmpty() {
        $readerId  = new ReaderId();
        $emptyName = "";

        new Reader($readerId, $emptyName);
    }

    /**
     * @test
     */
    public function readerCanBeReadingABook() {
        $reader = new Reader(new ReaderId(), "Jonathan");
        $bookId = new BookId();

        $reader->reading($bookId);

        $this->assertSame($bookId, $reader->bookReading());
    }
}
