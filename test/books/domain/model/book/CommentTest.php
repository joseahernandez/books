<?php

namespace books\domain\model;

use books\domain\model\book\BookId;
use books\domain\model\book\Comment;
use books\domain\model\book\CommentId;
use books\domain\model\reader\ReaderId;

class CommentTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function createAComment() {
        $book    = new BookId();
        $reader  = new ReaderId();
        $text    = "This books is great";
        $comment = new Comment(new CommentId(), $book, $reader, $text);

        $this->assertSame($text, $comment->comment());
        $this->assertSame($reader, $comment->reader());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function commentCanNotBeEmpty() {
        $book   = new BookId();
        $reader = new ReaderId();
        $text   = "";

        new Comment(new CommentId(), $book, $reader, $text);
    }
}
