<?php

namespace App;


class FindCustomers
{
    /**
     * @var string
     */
    private $filePath;
    /**
     * @var int
     */
    private $distance;
    /**
     * @var float
     */
    private $officeLongitude;
    /**
     * @var float
     */
    private $officeLatitude;

    /**
     * @param int $distance
     * @param string $filePath
     * @param float $officeLatitude
     * @param int $officeLongitude
     */
    function __construct($distance, $filePath, $officeLatitude, $officeLongitude)
    {
        $this->distance = $distance;
        $this->filePath = $filePath;
        $this->officeLongitude = $officeLongitude;
        $this->officeLatitude = $officeLatitude;
    }

    /**
     * Get sorted UserList from file
     *
     * @return array
     */
    public function getUserList()
    {
        $fileReader = new FileReader($this->filePath);
        $data = $fileReader->loadDataFromFile();

        $userList = new UserList($data);
        $userList->sortUserList();

        return $userList->getUsers();
    }

    /**
     * Return list of customers than are located within given limit
     *
     * @param $users
     * @return array
     */
    public function findCustomers($users)
    {
        $customers = [];
        if (!empty($users)) {
            foreach ($users as $key => $value) {
                if ($this->isWithinDistance($value)) {
                    $customers[$key] = $value;
                }
            }
        } else {
            trigger_error("UserList is empty", E_USER_ERROR);
        }

        return $customers;
    }

    /**
     * Check if Great circle distance found between user location and the office is less then given limit
     *
     * @param array $user
     * @return bool
     */
    private function isWithinDistance($user)
    {
        $distanceCounter = new DistanceCalculator();
        $userDistance = $distanceCounter->getDistance(
            $user['latitude'], $user['longitude'], $this->officeLatitude, $this->officeLongitude
        );

        return ($userDistance < $this->distance) ? true : false;
    }
}