<?php

use Cake\Core\Configure;
use Cake\Routing\Router;

define('BASE_URL', Router::url('/', true));

Configure::write('BANNER_MID_TEXT', 'feat');
// Configure::write('ALLREADY_COLLABE', 'Start type. This will auto-suggest who\'s allready collabed.');
// Configure::write('CREATE_COLLABE', 'Who should we collab this artist with?');
Configure::write('BANNER_ID', '1');
Configure::write('services', ['gplus' => 'fab fa-google-plus-g gplus-bg', 'facebook' => 'fab fa-facebook-f facebook-bg', 'twitter' => 'fab fa-twitter twitter-bg']);
Configure::write('ALREADY_SENT_APPROVAL','Artist(s) sent for approval');
define('ACTIVE',1);