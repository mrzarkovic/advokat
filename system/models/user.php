<?php

namespace Lamework\Model;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends Repository
{
    protected static $table_name = "users";
    protected static $fields = array(
        "username" => "string",
        "password" => "string",
    );

    public function __construct($row = array())
    {
        parent::__construct($row);
    }

    /**
     * Check the user
     * @return bool
     */
    public function check()
    {
        $this->check_credentials($this->username, $this->password);
        if (!empty($this->list))
            return true;

        return false;
    }

    /**
     * Check user credentials
     * @param string $username
     * @param string $password
     * @return bool
     * @throws \Exception
     */
    private function check_credentials( $username = "", $password = "")
    {
        return self::fetchAllByFieldsValues(array('username','password'), array($username, $password));
    }

}
