<?php

namespace books\infrastructure\domain\model\reader;

use books\domain\model\reader\InvalidReaderException;
use books\domain\model\reader\Reader;
use books\domain\model\reader\ReaderId;
use books\domain\model\reader\ReaderRepository;

class MemoryReaderRepository implements ReaderRepository {

    /**
     * @var array
     */
    private $map;

    public function __construct() {
        $this->map = [];
    }

    /**
     * @param ReaderId $readerId
     *
     * @return Reader
     * @throws InvalidReaderException
     */
    public function findById(ReaderId $readerId): Reader {
        if (!array_key_exists($readerId->__toString(), $this->map)) {
            throw new InvalidReaderException(sprintf("Reader %s doesn't exists", $readerId));
        }

        return $this->map[$readerId->__toString()];
    }

    /**
     * @return array
     */
    public function findAll(): array {
        return array_values($this->map);
    }

    /**
     * @param Reader $reader
     */
    public function save(Reader $reader) {
        $this->map[$reader->id()->__toString()] = $reader;
    }
}
