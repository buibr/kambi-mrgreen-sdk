<?php

namespace buibr\KambiMrGreen\Models;

/**
 * 
 * [event] => stdClass Object
 * (
 *     [id] => 1003168802
 *     [name] => Sabadell FC - Sporting de Gijón
 *     [englishName] => Sabadell FC - Sporting de Gijón
 *     [homeName] => Sabadell FC
 *     [awayName] => Sporting de Gijón
 *     [start] => 2019-09-22T16:00:00Z
 *     [group] => Segunda División
 *     [groupId] => 1000094708
 *     [path] => Array
 *         (
 *             [0] => stdClass Object
 *                 (
 *                     [id] => 1000093190
 *                     [name] => Football
 *                     [englishName] => Football
 *                     [termKey] => football
 *                 )
 * 
 *             [1] => stdClass Object
 *                 (
 *                     [id] => 1000461813
 *                     [name] => Spain
 *                     [englishName] => Spain
 *                     [termKey] => spain
 *                 )
 * 
 *             [2] => stdClass Object
 *                 (
 *                     [id] => 1000094708
 *                     [name] => Segunda División
 *                     [englishName] => Segunda División
 *                     [termKey] => segunda_division
 *                 )
 * 
 *         )
 * 
 *     [nonLiveBoCount] => 2
 *     [sport] => FOOTBALL
 *     [tags] => Array
 *         (
 *             [0] => MATCH
 *         )
 * 
 *     [state] => NOT_STARTED
 * )
 */
class EventModel {

    /**
     * Event name
     */
    public $name;
    public $englishName;
    public $homeName; # home team name
    public $awayName; # 
    public $start; #start date
    public $group; # country, ligue, competition
    public $groupId;
    public $sport;
    public $tags;
    public $state;

    /**
     * extreacted from path
     *  # 0 -Sport, 1 - Country, 2 - Competitions
     */
    public $sportPath; 
    public $country;
    public $competition;

    function __construct( object $data )
    {
        foreach($this as $key=>$val){
            if(isset($data->$key)){
                $this->$key = $data->$key;
            }
        }

        $this->parsePaths( $data );
    }

    /**
     * 
     */
    private function parsePaths( object $data ) {

        if(isset($data->path)) {
            if(isset($data->path[0]))
                $this->sportPath = $data->path[0]->englishName;
            
            if(isset($data->path[1]))
                $this->country = $data->path[1]->englishName;
            
            if(isset($data->path[2]))
                $this->competition = $data->path[2]->englishName;
            
        }
    }
}