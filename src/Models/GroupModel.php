<?php

namespace buibr\KambiMrGreen\Models;

class GroupModel {

    public $id;
    public $name;
    public $englishName;
    public $boCount;
    public $sport;
    public $termKey;
    public $sortOrder;
    
    //  
    public $parent;

    function __construct( object $data )
    {
        foreach($this as $key=>$val){
            if(isset($data->$key)){
                $this->$key = $data->$key;
            }
        }
    }

    
}