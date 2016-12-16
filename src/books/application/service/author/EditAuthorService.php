<?php

namespace books\application\service\author;

use books\domain\model\author\Author;
use books\domain\model\author\AuthorRepository;

class EditAuthorService {
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
     * @param EditAuthorRequest $req
     */
    public function execute(EditAuthorRequest $req) {
        $author = $this->authorRepository->findById($req->author());
        $this->authorRepository->save(
            new Author(
                $author->id(),
                $req->name(),
                $req->surname()
            )
        );
    }
}
