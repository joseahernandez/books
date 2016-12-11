<?php

namespace books\domain\model\book;

use Ramsey\Uuid\Uuid;

final class CommentId {

    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
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
