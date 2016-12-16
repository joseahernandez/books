<?php

namespace books\application\service\author;

use books\domain\model\author\Author;
use books\domain\model\author\AuthorId;
use books\domain\model\author\AuthorRepository;
use books\infrastructure\domain\model\author\MemoryAuthorRepository;

class EditAuthorServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @var EditAuthorService
     */
    private $editAuthorService;

    /**
     * @var AuthorId
     */
    private $authorId;

    protected function setUp() {
        $this->authorRepository  = new MemoryAuthorRepository();
        $this->editAuthorService = new EditAuthorService($this->authorRepository);

        $this->addFixturesToRepositories();
    }

    private function addFixturesToRepositories() {
        $this->authorId = new AuthorId();
        $this->authorRepository->save(new Author($this->authorId, "William", "Shakespeare"));
    }

    /**
     * @test
     */
    public function editAuthor() {
        $name    = "Edgar Alan";
        $surname = "Poe";
        $req     = new EditAuthorRequest($this->authorId, $name, $surname);
        $this->editAuthorService->execute($req);

        $this->assertSame(1, count($this->authorRepository->findAll()));
        $this->assertSame($name, $this->authorRepository->findAll()[0]->name());
        $this->assertSame($surname, $this->authorRepository->findAll()[0]->surname());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function createAuthorWithEmptyName() {
        $emptyName = "";
        $surname   = "Poe";
        $req       = new EditAuthorRequest($this->authorId, $emptyName, $surname);
        $this->editAuthorService->execute($req);

    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function createAuthorWithEmptySurname() {
        $name         = "Edgar Alan";
        $emptySurname = "";
        $req          = new EditAuthorRequest($this->authorId, $name, $emptySurname);
        $this->editAuthorService->execute($req);
    }
}
