<?php

/**
 * Db/Table/Column/Abstract.php
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


abstract class MyLamp_Db_Table_Column_Abstract extends MyLamp
{

    /**
     * Column length
     *
     * @var string
     */
    protected $length;

    /**
     * Column data type
     *
     * @var MyLamp_Db_Table_Column_Type_Abstract
     */
    protected $type;

    /**
     * Column default
     *
     * @var string
     */
    protected $default;

    /**
     * Column is null
     *
     * @var boolean
     */
    protected $isNull;

    /**
     * Is column autoincrement
     *
     * @var boolean
     */
    protected $isAutoIncrement;

    /**
     * Column is primary
     *
     * @var boolean
     */
    protected $isPrimaryKey;

    /**
     * Is column unique
     *
     * @var boolean
     */
    protected $isUnique;

    /**
     * Is column multiple
     *
     * @var boolean
     */
    protected $isMultiple;

    /**
     * Get column length
     *
     * @return string
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Get column type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get column default
     *
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Set column length
     *
     * @param string
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * Set column type
     *
     * @param MyLamp_Db_Table_Column_Index_Abstract
     */
    public function setType(MyLamp_Db_Table_Column_Type_Abstract $type)
    {
        $this->type = $type;
    }

    /**
     * Set column default
     *
     * @param string
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }

    /**
     * Set column attributes
     *
     * @param string
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Constructor
     *
     * @return string column name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);
    }

    /**
     * Get/Set is null
     *
     * @param boolean use to set
     * @return boolean
     */
    public function isNull($isNull = null)
    {
        if ($isNull !== null) {
            $this->isNull = (bool)$isNull;
        }
        return $this->isNull;
    }

    /**
     * Get/Set autoincrement
     *
     * @param boolean use to set
     * @return boolean
     */
    public function isAutoIncrement($autoIncrement = null)
    {
        if ($autoIncrement !== null) {
            $this->isAutoIncrement = (bool)$autoIncrement;
        }
        return $this->isAutoIncrement;
    }

    /**
     * Get/Set is primary key
     *
     * @param boolean use to set
     * @return boolean
     */
    public function isPrimaryKey($isPrimaryKey = null)
    {
        if ($isPrimaryKey !== null) {
            $this->isPrimaryKey = (bool)$isPrimaryKey;
        }
        return $this->isPrimaryKey;
    }

    /**
     * Get/Set is unique
     *
     * @param boolean use to set
     * @return boolean
     */
    public function isUnique($isUnique = null)
    {
        if ($isUnique !== null) {
            $this->isUnique = (bool)$isUnique;
        }
        return $this->isUnique;
    }

    /**
     * Get/Set is multiple
     *
     * @param boolean use to set
     * @return boolean
     */
    public function isMultiple($isMultiple = null)
    {
        if ($isMultiple !== null) {
            $this->isMultiple = (bool)$isMultiple;
        }
        return $this->isMultiple;
    }

}
