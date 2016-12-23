<?php

namespace books\domain\model\book;

use books\domain\model\reader\ReaderId;

interface RateRepository {
    /**
     * @param BookId $bookId
     *
     * @return array
     */
    public function findByBook(BookId $bookId): array;

    /**
     * @param ReaderId $readerId
     * @param BookId   $bookId
     *
     * @return Rate
     */
    public function findReaderRateForBook(ReaderId $readerId, BookId $bookId): Rate;

    /**
     * @param Rate $rate
     */
    public function save(Rate $rate);
}
