<?php

namespace books\application\service\book;

use books\domain\model\book\Rate;
use books\domain\model\book\RateRepository;

class EditRateService {
    /**
     * @var RateRepository
     */
    private $rateRepository;

    /**
     * @param RateRepository   $rateRepository
     */
    public function __construct(RateRepository $rateRepository) {
        $this->rateRepository   = $rateRepository;
    }

    /**
     * @param EditRateRequest $req
     */
    public function execute(EditRateRequest $req) {
        $rate = $this->rateRepository->findReaderRateForBook($req->reader(), $req->book());
        $this->rateRepository->save(
            new Rate(
                $rate->book(),
                $rate->reader(),
                $req->rate()
            )
        );
    }
}
