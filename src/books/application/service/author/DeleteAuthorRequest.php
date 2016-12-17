<?php

namespace books\application\service\author;

use books\domain\model\author\AuthorId;

class DeleteAuthorRequest {
    /**
     * @var AuthorId
     */
    private $authorId;

    /**
     * @param AuthorId $authorId
     */
    public function __construct(AuthorId $authorId) {
        $this->authorId = $authorId;
    }

    /**
     * @return AuthorId
     */
    public function author(): AuthorId { return $this->authorId; }
}
