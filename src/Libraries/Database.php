<?php

namespace Phplover\Libraries;

class Database
{

    public function load()
    {

        // load the configurations to use them in this library
        $baseConfig = new \Phplover\Config\Base;

        // check if debugging is enabled
        if ($baseConfig->debugging === true)
        {

            // if debugging is true, load Database Configuration from .env file

            $db_host = $_ENV["DB_HOST"];
            $db_name = $_ENV["DB_NAME"];
            $db_username = $_ENV["DB_USERNAME"];
            $db_password = $_ENV["DB_PASSWORD"];
            $db_driver = $_ENV["DB_DRIVER"];

        } else {

            // otherwise, get the data from $dbConfig
            $dbCofig = new \Phplover\Config\Database;

            $db_host = $dbCofig->host;
            $db_name = $dbCofig->name;
            $db_username = $dbCofig->username;
            $db_password = $dbCofig->password;
            $db_driver = $dbCofig->driver;

        }

        // load the database connection (dibiphp)
        $connection = new \Dibi\Connection([
            'driver' => $db_driver,
            'database' => $db_name,
            'username' => $db_username,
            'password' => $db_password,
            'host' => $db_host,
        ]);

        // return the connection
        return $connection;

    }

}