<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
/**
 * Common helper
 */
class CommonHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    
    
    public function errorMessage($errors = array(), &$ar){
        foreach($errors as $error){
            if(is_array($error)){
                $this->errors($error, $ar);
            }else{
                 $ar[] = $error;
            }
        }
        return $ar;
    }
    
    public function errors($errors = array(), &$ar){
        foreach($errors as $error){
            if(is_array($error)){
                $this->errors($error, $ar);
            }else{
                 $ar[] = $error;
            }
        }
    }
    
    public function checkLike($collabed_id, $user_id = 0){
        $this->CollabedLikes = TableRegistry::get('CollabedLikes');
        $thisIp = $this->request->clientIp();
        $check = $this->CollabedLikes->find()
                ->where(['collabed_id' => $collabed_id, 'user_id' => $user_id])->toArray();
        if(!empty($check)) {
            return true;
        }else{
            return false;
        }
    }
    
    /**
    * @param $n
    * @return string
    * Use to convert large positive numbers in to short form like 1K+, 100K+, 199K+, 1M+, 10M+, 1B+ etc
    */
   public function numberFormatShort($n) {
        if ($n >= 0 && $n < 1000) {
            // 1 - 999
            $n_format = floor($n);
            $suffix = '';
        } else if ($n >= 1000 && $n < 1000000) {
            // 1k-999k
            $n_format = floor($n / 1000);
            $suffix = 'K+';
        } else if ($n >= 1000000 && $n < 1000000000) {
            // 1m-999m
            $n_format = floor($n / 1000000);
            $suffix = 'M+';
        } else if ($n >= 1000000000 && $n < 1000000000000) {
            // 1b-999b
            $n_format = floor($n / 1000000000);
            $suffix = 'B+';
        } else if ($n >= 1000000000000) {
            // 1t+
            $n_format = floor($n / 1000000000000);
            $suffix = 'T+';
        }

        return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
   }

}
