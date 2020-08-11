<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;


use App\FindCustomers;

class FindCustomersTest extends TestCase {

    function testFindingNoCustomers()
    {
        $obj = new FindCustomers(100,"resources/customers.txt", 53.339428, -6.257664);
        $result = $obj->findCustomers(
            [
                [ // this one lives further then 100 km
                    'latitude' => 51.92893,
                    'user_id' => 1,
                    'name' => 'Alice Cahill',
                    'longitude' => -10.27699
                ]
            ]
        );
        $this->assertTrue(is_array($result));
        $this->assertEquals(0, count($result));
    }

    function testFindingTwoCustomers()
    {
        $obj = new FindCustomers(100,"resources/customers.txt", 53.339428, -6.257664);
        $result = $obj->findCustomers(
            [
                [ // this one lives further then 100 km
                    'latitude' => 51.92893,
                    'user_id' => 1,
                    'name' => 'Alice Cahill',
                    'longitude' => -10.27699
                ],
                [ // this one lives closer then 100 km
                    'latitude' => 53.2451022,
                    'user_id' => 4,
                    'name' => 'Ian Kehoe',
                    'longitude' => -6.238335
                ],
                [ // this one lives closer then 100 km
                    'latitude' => 53.1302756,
                    'user_id' => 5,
                    'name' => 'Nora Dempsey',
                    'longitude' => -6.2397222
                ]
            ]
        );
        $this->assertTrue(is_array($result));
        $this->assertEquals(2, count($result));
    }
}
