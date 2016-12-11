<?php

namespace books\domain\model\book;

use books\domain\model\reader\ReaderId;
use books\validators\Assert;

final class Rate {

    public const RATE_MIN_VALUE = 1;
    public const RATE_MAX_VALUE = 5;

    /**
     * @var ReaderId
     */
    private $readerId;

    /**
     * @var int
     */
    private $rate;

    /**
     * @param ReaderId $readerId
     * @param int      $rate
     */
    public function __construct(ReaderId $readerId, int $rate) {
        $this->readerId = $readerId;
        Assert::betweenInclusive(
            $rate,
            self::RATE_MIN_VALUE,
            self::RATE_MAX_VALUE,
            sprintf("Rate must be between %d and %d", self::RATE_MIN_VALUE, self::RATE_MAX_VALUE)
        );
        $this->rate = $rate;
    }

    /**
     * @return int
     */
    public function rate(): int { return $this->rate; }

    /**
     * @return ReaderId
     */
    public function reader(): ReaderId { return $this->readerId; }
}
