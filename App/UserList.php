<?php

namespace App;


class UserList
{
    /**
     * @string
     */
    private $sortField;
    /**
     * @array
     */
    private $users;

    /**
     * @param array $users
     * @param string $sortField
     */
    function __construct($users, $sortField = 'user_id')
    {
        $this->users = $users;
        $this->sortField = $sortField;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * A comparison function
     *
     * @param $valueLeft
     * @param $valueRight
     * @return int
     */
    private function sortByField($valueLeft, $valueRight)
    {
        if ($valueLeft[$this->sortField] == $valueRight[$this->sortField]) {
            return 0;
        }
        return ($valueLeft[$this->sortField] > $valueRight[$this->sortField]) ? 1 : -1;
    }

    /**
     *  Sort UserList by given field (user_id by default)
     */
    public function sortUserList()
    {
        usort($this->users, [$this, "sortByField"]);
    }

}