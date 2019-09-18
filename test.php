<?php

require 'vendor/autoload.php';

use buibr\KambiMrGreen\Auth;
use buibr\KambiMrGreen\Data;
use buibr\KambiMrGreen\Group;
use buibr\KambiMrGreen\Groups\Football;

$football = new Football( new Auth );

print('<pre>');
print_r( $football->all() );
print('</pre>');
die;