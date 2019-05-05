<?php
use Cake\Core\Configure;
use Cake\Routing\Router;

$title = $collabeds->artistsone->name.' '.Configure::read('BANNER_MID_TEXT').' '.$collabeds->artiststwo->name;
$imageLink = $this->request->webroot . $_dir . $collabeds->image;
$imageLinkShare = Router::fullbaseUrl().Router::url('/').$_dir . $collabeds->image;

$shareLink = DS . $_dir . $collabeds->image;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta property="og:title" content="Vote for : <?= $title ?> "/>
        <meta property="og:image" content="<?= $imageLinkShare ?>"/>
        <meta property="og:site_name" content="<?= Configure::read("Setting.SYSTEM_APPLICATION_NAME") ?>"/>
        <meta property="og:description" content="Found On #collabthem"/>
    </head>
    <body>
        <div style="width: 100%;text-align: center;">
            <img src="<?= $imageLinkShare ?>"/>
        </div>
    </body>
</html>
