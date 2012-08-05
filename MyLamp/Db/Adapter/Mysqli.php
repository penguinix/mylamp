<?php

/**
 * MyLamp/Db/Adapter/Mysqli.php
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


class MyLamp_Db_Adapter_Mysqli extends MyLamp_Db_Adapter_Abstract
{

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
    public function __construct($hostname = 'localhost', $username = null, $password = null, $dbname = null, $port = null, $socket = null)
    {
        parent::__construct($hostname, $username, $password, $dbname, $port, $socket);

        $mysqli = new mysqli($this->hostname, $this->username, $this->password, $this->dbname, $this->port, $this->socket);

        if (mysqli_connect_error()) {
            $this->addError('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
        else {
            $this->connection = $mysqli;
        }
    }

    /**
     * Destructor, close any opened socket or database connection
     */
    public function __destruct()
    {
        if ($this->connection instanceof mysqli) {
            $this->connection->close();
        }
    }

    /**
     * Describe database tables
     *
     * @return array MyLamp_Db_Table_Abstract
     */
    public function describeTables()
    {
        $tables = array();
        $query = "SHOW TABLES";
        if ($result = $this->connection->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $key = 'Tables_in_' . $this->dbname;
                $tableName = $row[$key];
                $table = new MyLamp_Db_Table($tableName);
                if ($status = $this->describeStatus($tableName)) {
                    $engineClass = 'MyLamp_Db_Table_Engine_' . $status['Engine'];
                    $engine = new $engineClass();
                    $table->setEngine($engine);
                    $table->setComments($status['Comment']);
                }
                if ($columns = $this->describeColumns($tableName)) {
                    $table->setColumns($columns);
                }
                $tables[] = $table;
            }
        }
        return $tables;
    }

    /**
     * Describe table status
     *
     * @param string table name
     * @return array
     */
    public function describeStatus($table)
    {
        $status = array();
        $query = "SHOW TABLE STATUS FROM `{$this->dbname}` WHERE Name = '{$table}'";
        if ($result = $this->connection->query($query)) {
            $status = $result->fetch_assoc();
        }
        return $status;
    }

    /**
     * Describe table columns
     *
     * @param string table name
     * @return array MyLamp_Db_Table_Column_Abstract
     */
    public function describeColumns($table)
    {
        $columns = array();
        $query = "SHOW COLUMNS FROM `{$table}`";
        if ($result = $this->connection->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $column = new MyLamp_Db_Table_Column($row['Field']);
                $length = '';
                $pos = stripos($row['Type'], '(');
                if ($pos !== false) {
                    $datatype = ucwords(substr($row['Type'], 0, $pos));
                    $length = substr($row['Type'], ($pos + 1), -1);
                }
                else {
                    $datatype = ucwords($row['Type']);
                }

                $column->setLength($length);
                $typeClass = 'MyLamp_Db_Table_Column_Type_' . $datatype;
                $type = new $typeClass();
                $column->setType($type);
                $column->setDefault($row['Default']);

                $column->setAttributes($type);
                $isNull = ($row['Null'] == 'YES')? true : false;
                $column->isNull($isNull);
                $isAutoIncrement = ($row['Extra'] == 'auto_increment')? true : false;
                $column->isAutoIncrement($isAutoIncrement);
                switch ($row['Key']) {
                    case 'PRI':
                        $column->isPrimaryKey(true);
                        break;
                    case 'UNI':
                        $column->isUnique(true);
                        break;
                    case 'MUL':
                        $column->isMultiple(true);
                        break;
                }
                $columns[] = $column;
            }
        }
        return $columns;
    }

}
