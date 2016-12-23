<?php

namespace books\application\service\book;

use books\domain\model\book\BookId;
use books\domain\model\reader\ReaderId;

class EditRateRequest {
    /**
     * @var BookId
     */
    private $bookId;

    /**
     * @var ReaderId
     */
    private $readerId;

    /**
     * @var int
     */
    private $rate;

    /**
     * @param BookId   $bookId
     * @param ReaderId $readerId
     * @param int      $rate
     */
    public function __construct(BookId $bookId, ReaderId $readerId, $rate) {
        $this->bookId   = $bookId;
        $this->readerId = $readerId;
        $this->rate     = $rate;
    }

    /**
     * @return BookId
     */
    public function book(): BookId { return $this->bookId; }

    /**
     * @return ReaderId
     */
    public function reader(): ReaderId { return $this->readerId; }

    /**
     * @return int
     */
    public function rate(): int { return $this->rate; }
}
