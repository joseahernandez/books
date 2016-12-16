<?php

namespace books\application\service\author;

use books\domain\model\author\AuthorRepository;
use books\infrastructure\domain\model\author\MemoryAuthorRepository;

class CreateAuthorServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @var CreateAuthorService
     */
    private $createAuthorService;

    protected function setUp() {
        $this->authorRepository    = new MemoryAuthorRepository();
        $this->createAuthorService = new CreateAuthorService($this->authorRepository);
    }

    /**
     * @test
     */
    public function createAuthor() {
        $name    = "William";
        $surname = "Shakespeare";
        $req     = new CreateAuthorRequest($name, $surname);
        $this->createAuthorService->execute($req);

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
        $surname   = "Shakespeare";
        $req       = new CreateAuthorRequest($emptyName, $surname);
        $this->createAuthorService->execute($req);

    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function createAuthorWithEmptySurname() {
        $name         = "William";
        $emptySurname = "";
        $req          = new CreateAuthorRequest($name, $emptySurname);
        $this->createAuthorService->execute($req);
    }
}
