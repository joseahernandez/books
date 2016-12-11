<?php

namespace books\domain\model;

use books\domain\model\book\Rate;
use books\domain\model\reader\ReaderId;

class RateTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function createARate() {
        $readerId = new ReaderId();
        $value    = 3;
        $rate     = new Rate($readerId, $value);

        $this->assertSame($readerId, $rate->reader());
        $this->assertSame($value, $rate->rate());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function rateCanNotBeLessThanMinValue() {
        $minValue     = Rate::RATE_MIN_VALUE;
        $invalidValue = $minValue - 1;

        new Rate(new ReaderId(), $invalidValue);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function rateCanNotBeHigherThanMaxValue() {
        $maxValue     = Rate::RATE_MAX_VALUE;
        $invalidValue = $maxValue + 1;

        new Rate(new ReaderId(), $invalidValue);
    }
}