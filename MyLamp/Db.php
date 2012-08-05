<?php

/**
 * MyLamp/Db.php
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
 * @package     MyLamp
 * @copyright   Copyright (c) 2012, MyLamp (http://www.mylamp.org)
 * @license     http://www.mylamp.org/license - New BSD License
 */


class MyLamp_Db extends MyLamp
{

    /**
     * Db Adapter
     *
     * @var MyLamp_Db_Adapter_Abstract
     */
    protected $adapter;

    /**
     * List of Database tables
     *
     * @var array of MyLamp_Db_Table_Abstract
     */
    protected $tables;

    /**
     * Get database adapter
     *
     * @return MyLamp_Db_Adapter_Abstract
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Get list of tables
     *
     * @return array of MyLamp_Db_Table_Abstract
     */
    public function getTables()
    {
        if (!is_array($this->tables)) {
            $this->tables = $this->_populateTables();
        }
        return $this->tables;
    }

    /**
     * Set database adapter
     *
     * @params MyLamp_Db_Adapter_Abstract
     */
    public function setAdapter(MyLamp_Db_Adapter_Abstract $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Set tables for database
     *
     * @params array of MyLamp_Db_Table_Abstract
     */
    public function setTables(Array $tables)
    {
        $this->tables = array();
        // accepts only MyLamp_Db_Table_Abstract
        foreach ($tables as $table) {
            if (!$table instanceof MyLamp_Db_Table_Abstract) continue;
            $this->tables[] = $table;
        }
    }

    /**
     * Get database adapter name
     *
     * @return string
     */
    public function getAdapterName()
    {
        $adapterName = '';
        if ($this->adapter instanceof MyLamp_Db_Adapter_Abstract) {
            $adapterPrefix = 'MyLamp_Db_Adapter_';
            $adapterName = substr(get_class($this->adapter), strlen($adapterPrefix));
        }
        return $adapterName;
    }

    /**
     * Constructor
     *
     * @param string adapter name
     * @param mixed database options - if array, keys are the following: hostname, username, password, dbname, port, socket
     */
    public function __construct($adapterName, $options)
    {
        parent::__construct();
        $adapterClass = 'MyLamp_Db_Adapter_'.$adapterName;

        $opts = array(
            'hostname' => 'localhost',
            'username' => null,
            'password' => null,
            'dbname' => null,
            'port' => null,
            'socket' => null,
        );

        if (is_array($options)) {
            foreach ($options as $key=>$value) {
                if (!array_key_exists($key, $opts)) continue;
                $opts[$key] = $value;
            }
        }
        else if ($options instanceof StdClass) {
            foreach ($opts as $key=>$value) {
                if (!isset($options->$key)) continue;
                $opts[$key] = $options->$key;
            }
        }

        $this->adapter = new $adapterClass($opts['hostname'], $opts['username'], $opts['password'], $opts['dbname'], $opts['port'], $opts['socket']);
        $connection = $this->adapter->getConnection();
        if ($this->adapter->isConnected() && $this->adapter instanceof MyLamp_Db_Adapter_Abstract) {
            $this->tables = $this->adapter->describeTables();
        }
    }

}

