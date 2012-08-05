<?php

/**
 * MyLamp.php
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


class MyLamp
{

    /**
     * Generic name
     *
     * @var string
     */
    protected $name;

    /**
     * Constructor
     */
    public function __construct($name = null)
    {
        if ($name === null) $name = get_class($this);
        $this->name = $name;
    }

    /**
     * Convert object to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get generic name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set generic name
     *
     * @param string
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}

if (!function_exists('__autoload')) {
    set_include_path(realpath(dirname(__FILE__).'/../') . DIRECTORY_SEPARATOR . get_include_path());
    function __autoload($class)
    {
        $file = str_replace('_', '/', $class) . '.php';
        require_once $file;
    }
}
