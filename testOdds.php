<?php

require 'vendor/autoload.php';

use buibr\KambiMrGreen\Base\Group;
use buibr\KambiMrGreen\Base\Events;
use buibr\KambiMrGreen\Base\ListView;
use buibr\KambiMrGreen\Base\Auth;
use buibr\KambiMrGreen\Base\Data;
use buibr\KambiMrGreen\Lists\FootballList;
use buibr\KambiMrGreen\Exceptions\KambiMrGrenException;

try {

    $api = new FootballList( new Auth );

    $data = $api->object();

    print_r( "\n" );
    print_r( $data );
    print_r( "\n" );
    die;

}
catch( KambiMrGrenException $ke) {
    
    print_r( "\n" );
    print_r( $ke->getMessage() );
    print_r( "\n" );
    die;

}