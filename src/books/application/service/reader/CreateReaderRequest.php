<?php

namespace books\application\service\reader;

final class CreateReaderRequest {

    /**
     * @string
     */
    private $name;

    /**
     * CreateReaderRequest constructor.
     *
     * @param string $name
     */
    public function __construct(string $name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name() { return $this->name; }
}
