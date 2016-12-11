<?php

namespace books\domain\model\reader;

interface ReaderRepository {

    /**
     * @param ReaderId $readerId
     *
     * @return Reader
     */
    public function findById(ReaderId $readerId): Reader;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Reader $reader
     */
    public function save(Reader $reader);
}
