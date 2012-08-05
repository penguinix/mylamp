<?php

/**
 * MyLamp/Db/Table/Abstract.php
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
 * @subpackage  MyLamp_Db_Table
 * @copyright   Copyright (c) 2012, MyLamp (http://www.mylamp.org)
 * @license     http://www.mylamp.org/license - New BSD License
 */


abstract class MyLamp_Db_Table_Abstract extends MyLamp
{

    /**
     * List of table columns
     *
     * @var array of MyLamp_Db_Table_Column_Abstract
     */
    protected $columns;

    /**
     * Table comments
     *
     * @var string
     */
    protected $comments;

    /**
     * Table storage engine
     *
     * @var MyLamp_Db_Table_Engine_Abstract
     */
    protected $engine;

    /**
     * Get table columns
     *
     * @return array of MyLamp_Db_Table_Column_Abstract
     */
    public function getColumns()
    {
        if (!is_array($this->columns)) {
            $this->columns = $this->_populateColumns();
        }
        return $this->columns;
    }

    /**
     * Set table columns
     *
     * @param array of MyLamp_Db_Table_Column_Abstract
     */
    public function setColumns(Array $columns)
    {
        $this->columns = array();
        // accepts only MyLamp_Db_Table_Column_Abstract
        foreach ($columns as $column) {
            if (!$column instanceof MyLamp_Db_Table_Column_Abstract) continue;
            $this->columns[] = $column;
        }
    }

    /**
     * Get table comment
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set table comments
     *
     * @param string
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * Get table storage engine
     *
     * @return string
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * Set table storage engine
     *
     * @param MyLamp_Db_Table_Engine_Abstract
     */
    public function setEngine(MyLamp_Db_Table_Engine_Abstract $engine)
    {
        $this->engine = $engine;
    }

    /**
     * Constructor
     *
     * @param string optional table name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);
    }

}

