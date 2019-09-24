<?php

namespace buibr\KambiMrGreen\Odds;

use buibr\KambiMrGreen\Models\EventModel;
use buibr\KambiMrGreen\Models\BetOfferModel;

/**
 * 
 * 
 */
class FootballOdds {

    /**
     * Data parsed on objects
     */
    public $event;

    /**
     * Offers
     */
    public $betOffer = [];


    public function __construct(object $data)
    {
        $this->event    = new EventModel($data->event);

        if(isset($data->betOffers) && !empty($data->betOffers)):
            foreach($data->betOffers as $bet) {
                $this->betOffer[] = new BetOfferModel( $bet );
            }
        endif;
    }
    
}