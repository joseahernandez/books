<?php

namespace books\domain\model\reader;

use Ramsey\Uuid\Uuid;

final class ReaderId {
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
