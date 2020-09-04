<?php

declare(strict_types=1);
class TreeNode
{
    public $parent;
    private $children = null;
    private $_id;
    public function __construct($parent, $id)
    {
        $this->_id = $id;
        $this->parent = $parent;
    }
    public function setChildren( $children){
        $this->children[]=$children;
    }


    public function getId()
    {
        return $this->_id;
    }
    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }
    public function getSelf(){
        return $this;
    }
}