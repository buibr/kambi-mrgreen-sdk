<?php 

namespace buibr\KambiMrGreen\Base;

class Group extends \buibr\KambiMrGreen\Base\Data {

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
    public function fetch(){

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


    /**
     * Organize one group per item in array
     */
    public function all() {

        $data = self::getData()->group->groups;
        $group = get_called_class()::$groupName;

        foreach ( $data as $obj) {

            if( trim($obj->englishName) === trim($group)  ) {

                $this->groupData[] = new \buibr\KambiMrGreen\Models\GroupModel( $obj );

                // loop to find all subgroups.
                $this->subGrouping( $obj );

                break;
            }
        }

        return $this->groupData;

    }


    /**
     * @param object $object
     * @param object $parent
     */
    private function subGrouping( object $object, object $parent = null) {

        if(!isset($object->groups) || empty($object->groups)) {
            return;
        }

        foreach($object->groups as $group){

            $group->parent = $object->id;

            $this->groupData[] = new \buibr\KambiMrGreen\Models\GroupModel( $group);

            $this->subGrouping($group, $object);
        }   
    }
}