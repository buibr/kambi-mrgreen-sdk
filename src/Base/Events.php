<?php 

namespace buibr\KambiMrGreen\Base;

/**
 * 
 * @property string $path
 * @property string $query
 * @property array $eventData
 */
class Events extends \buibr\KambiMrGreen\Base\Data {

    /**
     * 
     */
    protected $path = 'listView/football';

    /**
     * 
     */
    protected $query = ['lang'=>'en_GB'];

    /**
     * 
     */
    public $eventData;

     /**
     * Get all data from groups.
     */
    public function all(){
        $this->eventData = self::getData()->events;
        return $this->eventData;
    }

    /**
     *  Group
     * @param $group - 
     */
    public static function group( $groupName ) {

        self::all();

        $data = [];
        foreach ( $this->eventData as $obj) {

            if( trim($obj->event->group) === trim($groupName)) {
                $data[] = $obj;
            }
        }

        return $data;
    }
}