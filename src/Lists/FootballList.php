<?php


namespace buibr\KambiMrGreen\Lists;

use buibr\KambiMrGreen\Odds\FootballOdds;

class FootballList extends \buibr\KambiMrGreen\Base\ListView {

    /**
     * 
     */
    protected $path = 'listView/football';

    /**
     * get all to models.
     */
    public function object() {
        
        self::all();

        $this->data = [];
        foreach ( $this->eventData as $obj) {

            if($obj->event->name !=='Roma - Atalanta'){
                continue;
            }

            $this->data[] = new FootballOdds($obj);
            
        }

        return $this->data;

    }

}