<?php

namespace books\domain\model\author;

use Ramsey\Uuid\Uuid;

final class AuthorId {

    /**
     * @string
     */
    private $id;

    /**
     * @param $id
     */
    public function __construct(string $id = null) {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }

    /**
     * @return string
     */
    function __toString() {
        return $this->id;
    }
}
