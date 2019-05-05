<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Collabe component
 */
class CollabeComponent extends Component
{
    /*
     * Collabe configuration method
     */
    
     public function CreateCollabe($data = []) {
        $artistone = $data['article_one'];
        $artisttwo = $data['article_two'];
        $midtext = Configure::read('BANNER_MID_TEXT');
        $banner_path = $data['banner_path'];
        $collabe_path = $data['collabe_path'];
        $banner = $banner_path.$data['banner'];
        $image = imagecreatefrompng($banner);
        imagealphablending($image, true);

        $color = imagecolorallocate($image, 0, 0, 0);
        $colormid = imagecolorallocate($image, 94, 94, 94);
        $artist_font = 'fonts/AvenirLTStd-Black_0.ttf';
        $feat_font = 'fonts/AvenirLTStd-Medium.ttf';
                
        imagefttext($image, 70, 0, 290, 400, $color, $artist_font, $artistone);
        imagefttext($image, 60, 0, 440, 500, $colormid, $feat_font, $midtext);
        imagefttext($image, 70, 0, 290, 610, $color, $artist_font, $artisttwo , array('float' => 'right')); 
        
        /* If you want to display the file in browser */

        
        header('Content-type: image/png');
        ImagePng($image);
        imagedestroy($image);
        die;
        
        /* if you want to save the file in the web server */

        $name = rand().'-'.date('d').'-'.date('m').'-'.date('Y').'.png';
        $filename = $collabe_path.$name;
        ImagePng($image, $filename);
        imagedestroy($image);
        return $name;
        
     }
}