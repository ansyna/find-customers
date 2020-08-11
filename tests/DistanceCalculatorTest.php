<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;


use App\DistanceCalculator;

class DistanceCalculatorTest extends TestCase {

    function testIfTwoPointsWithin100()
    {
        $distanceCounter = new DistanceCalculator();
        $userDistance = $distanceCounter->getDistance(
            53.264344, -6.385531, 53.322035, -6.281393);
        $isWithin = ($userDistance < 100) ? true : false;
        $this->assertTrue($isWithin);
    }

    function testIfTwoPointsFurtherThan100()
    {
        $distanceCounter = new DistanceCalculator();
        $userDistance = $distanceCounter->getDistance(
            53.264344, -6.385531,  52.502428, -9.584614);
        $isWithin = ($userDistance < 100) ? true : false;
        $this->assertFalse($isWithin);
    }
}
