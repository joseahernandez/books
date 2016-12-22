<?php

namespace books\domain\model\book;

interface RateRepository {
    /**
     * @param BookId $bookId
     *
     * @return array
     */
    public function findByBook(BookId $bookId): array;

    /**
     * @param Rate $rate
     */
    public function save(Rate $rate);
}
