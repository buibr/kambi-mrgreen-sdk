<?php 

namespace buibr\KambiMrGreen\Base;

/**
 * @property array $eventData
 */
class ListView extends \buibr\KambiMrGreen\Base\Data {

    /**
     * 
     */
    protected $path = 'listView/';

    /**
     * string
     * (query)
     * Defines what language should be used for localized texts. Example en_GB, fr_FR
     * Example: en_GB
     */
    public $lang = 'en_GB';

    /**
     * string
     * (query)	
     * Defines the geographical market that the player is registered in. Example GB, FR
     * Example: GB
     */
    public $market = 'GB';

    /**
     * boolean(query)
     * If participants should be included in the response
     * Example: false
     */
    public $includeParticipants;

    /**
     * 
     */
    public $eventData;

    /**
     * Fetch by subclasses of category
     */
    public function fetch() {
        $this->query = ['lang'=>$this->lang,'market'=>$this->market];
        $this->eventData = self::getData()->events;
        return $this->eventData;
    }

    /**
     *  Group
     * @param $group - 
     */
    public function all( ) {

        self::fetch();

        return $this->eventData;
    }
}