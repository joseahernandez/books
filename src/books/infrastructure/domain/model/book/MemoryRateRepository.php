<?php

namespace books\infrastructure\domain\model\book;

use books\domain\model\book\BookId;
use books\domain\model\book\InvalidRateException;
use books\domain\model\book\Rate;
use books\domain\model\book\RateRepository;
use books\domain\model\reader\ReaderId;

class MemoryRateRepository implements RateRepository {
    /**
     * @var array
     */
    private $map;

    public function __construct() {
        $this->map = [];
    }

    /**
     * @param BookId $bookId
     *
     * @return array
     */
    public function findByBook(BookId $bookId): array {
        return array_filter(
            $this->map,
            function (Rate $rate) use($bookId) {
                return $rate->book() == $bookId;
            }
        );
    }

    /**
     * @param ReaderId $readerId
     * @param BookId   $bookId
     *
     * @return Rate
     * @throws InvalidRateException
     */
    public function findReaderRateForBook(ReaderId $readerId, BookId $bookId): Rate {
        $key = sprintf("%s-%s", $bookId, $readerId);
        if (!array_key_exists($key, $this->map)) {
            throw new InvalidRateException(sprintf("Rate from reader %s for book doesn't exists", $readerId, $bookId));
        }

        return $this->map[$key];
    }


    /**
     * @param Rate $rate
     */
    public function save(Rate $rate) {
        $key = sprintf("%s-%s", $rate->book(), $rate->reader());
        $this->map[$key] = $rate;
    }

}
