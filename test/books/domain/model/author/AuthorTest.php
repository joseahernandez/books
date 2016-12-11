<?php

namespace books\domain\model\author;

class AuthorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function createAuthor() {
        $authorId = new AuthorId();
        $name     = "William";
        $surname  = "Shakespeare";

        $author = new Author($authorId, $name, $surname);

        $this->assertSame($authorId, $author->id());
        $this->assertSame($name, $author->name());
        $this->assertSame($surname, $author->surname());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function authorCanNotHaveEmptyName() {
        $authorId = new AuthorId();
        $name     = " ";
        $surname  = "Shakespeare";

        new Author($authorId, $name, $surname);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function authorCanNotHaveEmptySurname() {
        $authorId = new AuthorId();
        $name     = "William";
        $surname  = "";

        new Author($authorId, $name, $surname);
    }
}
