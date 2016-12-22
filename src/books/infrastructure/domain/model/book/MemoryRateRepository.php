<?php

namespace books\infrastructure\domain\model\book;

use books\domain\model\book\BookId;
use books\domain\model\book\Rate;
use books\domain\model\book\RateRepository;

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
     * @param Rate $rate
     */
    public function save(Rate $rate) {
        $key = sprintf("%s-%s", $rate->book(), $rate->reader());
        $this->map[$key] = $rate;
    }

}
