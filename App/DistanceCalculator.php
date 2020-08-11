<?php

namespace App;


class DistanceCalculator
{

    /**
     * Get distance between 2 points
     *
     * @param $firstLatitude
     * @param $firstLongitude
     * @param $secondLatitude
     * @param $secondLongitude
     * @return float
     */
    public function getDistance($firstLatitude, $firstLongitude, $secondLatitude, $secondLongitude)
    {
        $centralAngle = $this->getCentralAngle($firstLatitude, $firstLongitude, $secondLatitude, $secondLongitude);

        // convert central angle in degrees to minutes and then convert nautical mile to mile and then to kilometers
        return rad2deg($centralAngle) * 60 * 1.15078 * 1.60934;
    }

    /**
     * Get central angle between 2 points
     *
     * @param $firstLatitude
     * @param $firstLongitude
     * @param $secondLatitude
     * @param $secondLongitude
     * @return float
     */
    private function getCentralAngle($firstLatitude, $firstLongitude, $secondLatitude, $secondLongitude)
    {
        $firstLatitudeRad = deg2rad($firstLatitude);
        $firstLongitudeRad = deg2rad($firstLongitude);
        $secondLatitudeRad = deg2rad($secondLatitude);
        $secondLongitudeRad = deg2rad($secondLongitude);

        $longitudeAbsDiff = abs($firstLongitudeRad - $secondLongitudeRad);

        return acos(
            sin($firstLatitudeRad) * sin($secondLatitudeRad)
            +  cos($firstLatitudeRad) * cos($secondLatitudeRad) * cos($longitudeAbsDiff)
        );
    }
}