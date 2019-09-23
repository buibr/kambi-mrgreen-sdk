<?php

require 'vendor/autoload.php';

use buibr\KambiMrGreen\Group;
use buibr\KambiMrGreen\Events;
use buibr\KambiMrGreen\Base\Auth;
use buibr\KambiMrGreen\Base\Data;
use buibr\KambiMrGreen\Groups\FootballGroup;
use buibr\KambiMrGreen\Exceptions\KambiMrGrenException;

try {
    
    $event  = new FootballGroup( new Auth );
    $data   = $event->all();

    print_r( $data );

}
catch( KambiMrGrenException $ke) {
    
    print_r( "\n" );
    print_r( $ke->getMessage() );
    print_r( "\n" );
    die;

}