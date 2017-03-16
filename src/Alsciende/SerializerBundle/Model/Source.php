<?php

namespace Alsciende\SerializerBundle\Model;

/**
 * Represents a data source, a table to be serialized/deserialized
 *
 * @author Alsciende <alsciende@icloud.com>
 */
class Source
{
    
    /* @var string */
    private $break;

    /* @var string */
    private $path;

    /* @var string */
    private $className;

    function __construct ($className, $path, $break = null)
    {
        $this->className = $className;
        $this->path = $path;
        $this->break = $break;
    }
    
    /**
     * 
     * @return string
     */
    function getBreak ()
    {
        return $this->break;
    }

    /**
     * 
     * @return string
     */
    function getPath ()
    {
        return $this->path;
    }

    /**
     * 
     * @return string
     */
    function getClassName ()
    {
        return $this->className;
    }

    /**
     * 
     * @param string $break
     * @return Source
     */
    function setBreak ($break)
    {
        $this->break = $break;
        
        return $this;
    }

    /**
     * 
     * @param string $path
     * @return Source
     */
    function setPath ($path)
    {
        $this->path = $path;
        
        return $this;
    }

    /**
     * 
     * @param string $className
     * @return Source
     */
    function setClassName ($className)
    {
        $this->className = $className;
        
        return $this;
    }

}
