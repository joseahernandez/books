<?php

namespace books\validators;

final class Assert {

    /**
     * @param string $value
     * @param string $errorMessage
     */
    public static function notEmpty(string $value, string $errorMessage = "") {
        if (strlen(trim($value)) === 0) {
            throw new \InvalidArgumentException($errorMessage);
        }
    }

    /**
     * @param int    $value
     * @param int    $minValue
     * @param int    $maxValue
     * @param string $errorMessage
     */
    public static function betweenInclusive(int $value, int $minValue, int $maxValue, string $errorMessage = "") {
        if ($value < $minValue || $value > $maxValue) {
            throw new \InvalidArgumentException($errorMessage);
        }
    }
}
