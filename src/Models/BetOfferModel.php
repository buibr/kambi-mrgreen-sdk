<?php

namespace buibr\KambiMrGreen\Models;

/**
 * 
 * 
 *  {
    *  "id": 2026249016,
    *  "closed": "2019-09-20T02:00:00Z",
    *  "criterion": {
    *  "id": 1001159858,
    *  "label": "Full Time",
    *  "englishLabel": "Full Time",
    *  "order": [
    *      0
    *  ]
 *  },
 *  "betOfferType": {
    *  "id": 2,
    *  "name": "Match",
    *  "englishName": "Match"
 *  },
 *  "eventId": 1003168728,
 *  "outcomes": [
 *      {
 *          "id": 2097289536,
 *          "label": "1",
 *          "englishLabel": "1",
 *          "odds": 2500,
 *          "type": "OT_ONE",
 *          "betOfferId": 2026249016,
 *          "changedDate": "2019-09-15T06:37:03Z",
 *          "oddsFractional": "6/4",
 *          "oddsAmerican": "150",
 *          "status": "OPEN",
 *          "cashOutStatus": "ENABLED"
 *      },
 *      {
 *          "id": 2097289537,
 *          "label": "X",
 *          "englishLabel": "X",
 *          "odds": 2550,
 *          "type": "OT_CROSS",
 *          "betOfferId": 2026249016,
 *          "changedDate": "2019-09-15T06:37:03Z",
 *          "oddsFractional": "31/20",
 *          "oddsAmerican": "155",
 *          "status": "OPEN",
 *          "cashOutStatus": "ENABLED"
 *      },
 *      {
 *          "id": 2097289538,
 *          "label": "2",
 *          "englishLabel": "2",
 *          "odds": 3500,
 *          "type": "OT_TWO",
 *          "betOfferId": 2026249016,
 *          "changedDate": "2019-09-15T06:37:03Z",
 *          "oddsFractional": "5/2",
 *          "oddsAmerican": "250",
 *          "status": "OPEN",
 *          "cashOutStatus": "ENABLED"
 *      }
 *  ],
 *  "tags": [
 *      "OFFERED_PREMATCH",
 *      "MAIN"
 *  ],
 *  "cashOutStatus": "ENABLED"
 *}
 */
class BetOfferModel {


    public $label; 
    public $type; # -> betOfferType -> name
    public $eventId;
    public $tags = [];
    public $one;
    public $cross;
    public $two;

    public function __construct(object $data)
    {

        if(isset($data->betOfferType)){
            $this->type = \trim($data->betOfferType->name);
        }

        if(isset($data->criterion)){
            $this->label = \trim($data->criterion->label);
        }

        @$this->eventId = $data->eventId;
        @$this->tags = $data->tags;
        
        if(isset($data->outcomes)){
            foreach($data->outcomes as $bet) {
                if(\trim($bet->label) === '1' && isset($bet->odds) ){
                    $this->one = \number_format($bet->odds  / 1000, 2);
                }
                if(\trim(\strtolower($bet->label)) === 'x' && isset($bet->odds)){
                    $this->cross = \number_format($bet->odds  / 1000, 2);
                }
                if(\trim($bet->label) === '2' && isset($bet->odds) ){
                    $this->two = \number_format($bet->odds  / 1000, 2);
                }
            }
        }

    }
}