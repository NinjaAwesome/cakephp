<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\View\Helper;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class CollabsController extends AppController {
    
    
    
    public function initialize() {
        parent::initialize();
        $this->Auth->allow();
    }

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index($id = null) {
        $this->layout = false;
        $this->Collabeds = TableRegistry::get('CollabedManager.Collabeds');
        $_dir = str_replace("\\", "/", $this->Collabeds->_dir);
        //->find('artistactive')
        $query = $this->Collabeds->find()->find('active')->where(['Collabeds.id'=>$id]);
        $query->select(['total'=> $query->func()->count('CollabedLikes.collabed_id')])
        ->contain(['Artistsone','Artiststwo'])
        ->autoFields(true)
        ->leftJoinWith('CollabedLikes');
        $collabeds = $query->first();

//        pr($query);
//        pr($collabeds);
//        die;
        $this->set(compact('collabeds', '_dir'));
    }
    

}
