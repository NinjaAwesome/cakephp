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
        $artistone = wordwrap($artistone, 15, "\n");
        $artisttwo = $data['article_two'];
        $artisttwo = wordwrap($artisttwo, 15, "\n");
        $midtext = Configure::read('BANNER_MID_TEXT');
        $banner_path = $data['banner_path'];
        $collabe_path = $data['collabe_path'];
        $banner = $banner_path.$data['banner'];
        //$logoPath = 'img/uploads/col-logo.jpg';
        
        
        $image = imagecreatefrompng($banner);
        imagealphablending($image, true);
        
        $color = imagecolorallocate($image, 0, 0, 0);
        $colormid = imagecolorallocate($image, 94, 94, 94);
        $artist_font = 'fonts/AvenirLTStd-Black_0.ttf';
        $feat_font = 'fonts/AvenirLTStd-Medium.ttf';
        
        // Get image Width and Height
        $image_width = imagesx($image);  
        $image_height = imagesy($image);

        // Get Bounding Box Size
        $text_box = imagettfbbox(55,0,$artist_font,$artistone);        
        
        // Get your Text Width and Height
        $text_width = $text_box[2]-$text_box[0];
        $text_height = $text_box[7]-$text_box[1];
//        $text_width = $text_box[2];
//        $text_height = $text_box[1];
        
        
        // Calculate coordinates of the text
        $x = ($image_width/2) - ($text_width/2);
        $y = ($image_height/2) - ($text_height/2);

        
        ///////////////////////////////////////////////////////////////
        // Get Bounding Box Size
        $text_box1 = imagettfbbox(60,0,$feat_font,$midtext);

        // Get your Text Width and Height
        $text_width1 = $text_box1[2]-$text_box1[0];
        $text_height1 = $text_box1[7]-$text_box1[1];

        // Calculate coordinates of the text
        $x1 = ($image_width/2) - ($text_width1/2);
        $y1 = ($image_height/2) - ($text_height1/2);

        //////////////////////////////////////////////////////////////////////
        // Get Bounding Box Size
        $text_box2 = imagettfbbox(55,0,$artist_font,$artisttwo);

        // Get your Text Width and Height
        $text_width2 = $text_box2[2]-$text_box2[0];
        $text_height2 = $text_box2[7]-$text_box2[1];

        // Calculate coordinates of the text
        $x2 = ($image_width/2) - ($text_width2/2);
        $y2 = ($image_height/2) - ($text_height2/2);
        
        
        //imagefttext($image, 70, 0, 290, 400, $color, $artist_font, $artistone);
        //imagefttext($image, 60, 0, 440, 500, $colormid, $feat_font, $midtext);
        //imagefttext($image, 70, 0, 290, 610, $color, $artist_font, $artisttwo , array('float' => 'right')); 
        
        /*Mid Text hight calculation*/
        $mh = $y1+0;
        /*Mid Text hight calculation*/
        
       /*Top Text hight calculation*/
        $fsplittext = explode ( "\n" , $artistone );
        $flines = count($fsplittext);
        $th = 200;
       /*Top Text hight calculation*/
        
        
        
        /*Bottm text hight calculation*/
        $splittext = explode ( "\n" , $artisttwo);
        $lines = count($splittext);
        $bh = 50;
        /*Bottm text hight calculation*/
        /* $flines top text line number*/
        /* $lines bottom text line number*/
        
        if($flines == 1 && $lines == 1) { /*top one line, bottom one line */
            $th = $th;
            $bh = $bh;
        }else if($flines == 2 && $lines == 2) { /*top two line, bottom two line */
            $th = 320;
            $bh = $bh+50;
            $mh = $mh-30;
        }else if($flines == 3 && $lines == 3) { /*top three line, bottom thee line */
            $th = $th+150;
            $bh = $bh+150;
            $mh = $mh;
        }else if($flines == 1 && $lines == 2) { /*top one line, bottom two line */
            $th = $th+80;
            $bh = $bh+30;
            $mh = $mh-60;
        }else if($flines == 2 && $lines == 1) { /*top two line, bottom one line */
            $th = $th+100;
            $bh = $bh+20;
            $mh = $mh+0;
        }else if($flines == 3 && $lines == 1) { /*top three line, bottom one line */
            $th = $th+40;
            $bh = $bh+140;
            $mh = $mh+120;
        }else if($flines == 1 && $lines == 3) { /*top one line, bottom three line */
            $th = $th+180;
            $bh = $bh+10;
            $mh = $mh-160;
        }else if($flines == 2 && $lines == 3) { /*top two line, bottom three line */
            $th = $th+180;
            $bh = $bh+80;
            $mh = $mh-80;
        }else if($flines == 3 && $lines == 2) { /*top three line, bottom two line */
            $th = $th+120;
            $bh = $bh+120;
            $mh = $mh+40;
        }   
        //pr($mh);
        //pr($th);
        //pr($bh);die;
        
        
        /*Top Text Write on image*/
        foreach ($fsplittext as $ftext) {
            $text_box = imagettfbbox(75,0,$artist_font,$ftext);
            $text_width = abs(max($text_box[2], $text_box[4]));
            $text_height = abs(max($text_box[5], $text_box[7]));
            $fx = (imagesx($image) - $text_width)/2;
            $fy = ((imagesy($image) + $text_height)/2)-($flines-2)*$text_height;
            $flines = $flines-2;
            imagettftext($image, 75, 0, $fx, $fy-$th, $color, $artist_font, $ftext);
        }
        /*Top Text Write on image*/
        
        // Add the text
        //imagettftext($image, 50, 0, $x, $y-100, $color, $artist_font, $artistone);
        /*Middel test*/
        imagettftext($image, 60, 0, $x1, $mh, $colormid, $feat_font, $midtext);
        /*Middel text*/
        
        /*Bottm text write on image*/
        foreach ($splittext as $text) {
            $text_box = imagettfbbox(75,0,$artist_font,$text);
            $text_width = abs(max($text_box[2], $text_box[4]));
            $text_height = abs(max($text_box[5], $text_box[7]));
            $sx = (imagesx($image) - $text_width)/2;
            $sy = ((imagesy($image) + $text_height)/2)-($lines-2)*$text_height;
            $lines=$lines-2;
            imagettftext($image, 75, 0, $sx, $sy+$bh, $color, $artist_font, $text);
        }
        /*Bottm text write on image*/
        
        
        //imagettftext($image, 50, 0, $x2, $y2+100, $color, $artist_font, $artisttwo);
        
       /* list($logo_width, $logo_height) = getimagesize($logoPath);
        
        $dst_x =  $image_width-$logo_width;
        
        $dst_y = $image_height-$logo_height;
        
        $src = imagecreatefromjpeg($logoPath);
        
        imagealphablending($image, false);
        imagesavealpha($image, true);

        imagecopymerge($image, $src, $dst_x-40, $dst_y-20, 0, 0, $logo_width, $logo_height, 100); //have to play with these numbers for it to work for you, etc.
*/
        
        /* If you want to display the file in browser */
       /*
        header('Content-type: image/png');
        ImagePng($image);
        imagedestroy($image);
        imagedestroy($src);
        die;
        */
        
        
        /* if you want to save the file in the web server */

        $name = rand().'-'.date('d').'-'.date('m').'-'.date('Y').'.png';
        $filename = $collabe_path.$name;
        ImagePng($image, $filename);
        imagedestroy($image);
        return $name;
        
     }
}