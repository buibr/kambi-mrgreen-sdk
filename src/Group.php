<?php 

namespace buibr\KambiMrGreen;

class Group extends Data {

    /**
     * 
     */
    protected $path = 'group';

    /**
     * 
     */
    public $groupData;

    /**
     * Get all data from groups.
     */
    public function all(){

        $data = self::getData()->group->groups;
        $group = get_called_class()::$groupName;


        foreach ( $data as $obj) {

            if( trim($obj->englishName) === trim($group)) {
                $this->groupData = $obj;
                break; 
            }

        }

        return $this->groupData;

    }
}