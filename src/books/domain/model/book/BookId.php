<?php

namespace books\domain\model\book;

use Ramsey\Uuid\Uuid;

final class BookId {

    /**
     * @var string
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
