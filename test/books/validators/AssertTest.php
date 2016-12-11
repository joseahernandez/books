<?php

namespace books\validators;

class AssertTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function emptyStringThrowException() {
        $emptyString = "";
        Assert::notEmpty($emptyString);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function stringWithWhiteSpacesThrowException() {
        $whiteSpaceString = "  ";
        Assert::notEmpty($whiteSpaceString);
    }

    /**
     * @test
     */
    public function notEmptyStringPassAssert() {
        $notEmpty = "This string isn't empty";
        Assert::notEmpty($notEmpty);
        $this->assertTrue(true);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function valueLessThanMinThrowException() {
        $minValue     = 1;
        $maxValue     = 3;
        $currentValue = 0;
        Assert::betweenInclusive($currentValue, $minValue, $maxValue);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function valueGreatThanMaxThrowException() {
        $minValue     = 1;
        $maxValue     = 3;
        $currentValue = 4;
        Assert::betweenInclusive($currentValue, $minValue, $maxValue);
    }

    /**
     * @test
     */
    public function valueBetweenMinAndMaxPassAssert() {
        $minValue     = 1;
        $maxValue     = 3;
        $currentValue = 2;
        Assert::betweenInclusive($currentValue, $minValue, $maxValue);
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function valueEqualsToMinPassAssert() {
        $minValue     = 1;
        $maxValue     = 3;
        $currentValue = 1;
        Assert::betweenInclusive($currentValue, $minValue, $maxValue);
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function valueEqualsToMaxPassAssert() {
        $minValue     = 1;
        $maxValue     = 3;
        $currentValue = 3;
        Assert::betweenInclusive($currentValue, $minValue, $maxValue);
        $this->assertTrue(true);
    }
}
