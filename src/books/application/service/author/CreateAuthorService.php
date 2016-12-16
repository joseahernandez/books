<?php

namespace books\application\service\author;

use books\domain\model\author\Author;
use books\domain\model\author\AuthorId;
use books\domain\model\author\AuthorRepository;

class CreateAuthorService {
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @param AuthorRepository $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository) {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param CreateAuthorRequest $req
     */
    public function execute(CreateAuthorRequest $req) {
        $author = new Author(new AuthorId(), $req->name(), $req->surname());
        $this->authorRepository->save($author);
    }
}
