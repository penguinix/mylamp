<?php

/**
 * MyLamp/Db/Adapter/Abstract.php
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@mylamp.org so we can send you a copy immediately.
 *
 * @category    MyLamp
 * @package     MyLamp_Db
 * @subpackage  MyLamp_Db_Adapter
 * @copyright   Copyright (c) 2012, MyLamp (http://www.mylamp.org)
 * @license     http://www.mylamp.org/license - New BSD License
 */


abstract class MyLamp_Db_Adapter_Abstract
{

    /**
     * Database Host name
     *
     * @var string
     */
    protected $hostname = 'localhost';

    /**
     * Database username
     *
     * @var string
     */
    protected $username;

    /**
     * Database password
     *
     * @var string
     */
    protected $password;

    /**
     * Database name
     *
     * @var string
     */
    protected $dbname;

    /**
     * Database port
     *
     * @var string
     */
    protected $port;

    /**
     * Database socket
     *
     * @var string
     */
    protected $socket;

    /**
     * Database connection
     *
     * @var object
     */
    protected $connection;

    /**
     * Error messages
     *
     * @var array
     */
    protected $errors = array();

    /**
     * Get database hostname
     *
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Get database username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get database password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get database name
     *
     * @return string
     */
    public function getDbname()
    {
        return $this->dbname;
    }

    /**
     * Get database port
     *
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Get database socket
     *
     * @return string
     */
    public function getSocket()
    {
        return $this->socket;
    }

    /**
     * Get database connection
     *
     * @return object
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Get error messages
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set database hostname
     *
     * @param string
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
    }

    /**
     * Set database username
     *
     * @param string
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Set database password
     *
     * @param string
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Set database name
     *
     * @param string
     */
    public function setDbname($dbname)
    {
        $this->dbname = $dbname;
    }

    /**
     * Set database port
     *
     * @param string
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * Set database socket
     *
     * @param string
     */
    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    /**
     * Set database connection
     *
     * @param object
     */
    public function setConnection($connection)
    {
        if (is_object($connection)) { // only set if passed connection is object type
            $this->connection = $connection;
        }
    }

    /**
     * Set error messages
     *
     * @param array
     */
    public function setErrors(Array $errors)
    {
        if (is_array($errors)) {
            $this->errors = $errors;
        }
    }

    /**
     * Add error to error message list
     *
     * @param mixed
     */
    public function addError($error)
    {
        $this->errors[] = $error;
    }

    /**
     * Constructor
     *
     * @param string database hostname
     * @param string database username
     * @param string database password
     * @param string database name
     * @param string database port
     * @param string database socket
     */
    public function __construct($hostname = null, $username = null, $password = null, $dbname = null, $port = null, $socket = null)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->port = $port;
        $this->socket = $socket;
    }

    /**
     * Check if connected to db server
     *
     * @return boolean
     */
    public function isConnected()
    {
        return is_object($this->connection);
    }

    /**
     * Describe database tables
     *
     * @return array MyLamp_Db_Table_Abstract
     */
    abstract public function describeTables();

    /**
     * Describe table columns
     *
     * @param string table name
     * @return array MyLamp_Db_Table_Column_Abstract
     */
    abstract public function describeColumns($table);

}
