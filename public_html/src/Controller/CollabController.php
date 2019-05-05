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
class CollabController extends AppController {
    
    
    
    public function initialize() {
        parent::initialize();
        $this->loadComponent('Collabe');
        //$this->Auth->allow(['index','view','add','getCollabeds','create','collabeApprovel' ,'getCollabedsByName']);
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
    public function get($url = null) {
        $this->layout = false;

        $this->loadModel('Collabeds');
        $this->loadModel('CollabedLikes');
        $this->loadModel('Artists');
        $this->loadModel('Comments');

        $collabed = $this->Collabeds->find()
                    ->where(['Collabeds.banner_id' => 1])
                    ->andwhere(['Collabeds.status' => 1])
                    ->andWhere(['Collabeds.url' => $url])
                    ->first();

        if(!$collabed)
            return $this->redirect('/');

        $likes = $this->CollabedLikes->find()
                ->where(['CollabedLikes.collabed_id' => $collabed->id])
                ->count();

        $artist_two = $this->Artists->find()
            ->where(['Artists.id' => $collabed->artist_2])
            ->first();

        $artist_one = $this->Artists->find()
            ->where(['Artists.id' => $collabed->artist_1])
            ->first();

        $this->loadModel('Userssoc');
        $user_collab = $this->Userssoc
            ->find()
            ->where([
                'Userssoc.id' => $collabed->user_id
            ])
            ->first();

        $comments = $this->Comments->find()
                        ->contain(['Userssoc'])
                        ->where(['Comments.collabed_id' => $collabed->id])
                        ->toArray();

        $user_likes = [];
        if($this->Auth->user())
        {

            $user = $this->Auth->user();
            $this->loadModel('Commentslike');

            $user_likes = $this->Commentslike->find()
                ->where(['Commentslike.user_id' => $user['id']])
                ->toArray();
        }

        


        $this->set('user', $this->Auth->user() ? $this->Auth->user() : []);
        // $this->set('user', $this->Auth->user() ? $this->Auth->user() : ['id' => 1, 'name' => 'Test']);

        //pr($query);die;
        $this->set(compact('collabed', 'likes', 'user_collab', 'artist_two', 'artist_one', 'comments', 'user_likes'));

    }

    public function popup($url = null) {
        $this->layout = false;

        $this->loadModel('Collabeds');
        $this->loadModel('CollabedLikes');
        $this->loadModel('Artists');
        $this->loadModel('Comments');

        $collabed = $this->Collabeds->find()
                    ->where(['Collabeds.banner_id' => 1])
                    ->andwhere(['Collabeds.status' => 1])
                    ->andWhere(['Collabeds.url' => $url])
                    ->first();

        if(!$collabed)
            return $this->redirect('/');

        $likes = $this->CollabedLikes->find()
                ->where(['CollabedLikes.collabed_id' => $collabed->id])
                ->count();

        $artist_two = $this->Artists->find()
            ->where(['Artists.id' => $collabed->artist_2])
            ->first();

        $artist_one = $this->Artists->find()
            ->where(['Artists.id' => $collabed->artist_1])
            ->first();

        $this->loadModel('Userssoc');
        $user_collab = $this->Userssoc
            ->find()
            ->where([
                'Userssoc.id' => $collabed->user_id
            ])
            ->first();

        $comments = $this->Comments->find()
                        ->contain(['Userssoc'])
                        ->where(['Comments.collabed_id' => $collabed->id])
                        ->toArray();

        $this->set('user', $this->Auth->user() ? $this->Auth->user() : []);

        $user_likes = [];
        if($this->Auth->user())
        {

            $user = $this->Auth->user();
            $this->loadModel('Commentslike');

            $user_likes = $this->Commentslike->find()
                ->where(['Commentslike.user_id' => $user['id']])
                ->toArray();
        }

        // $this->set('user', $this->Auth->user() ? $this->Auth->user() : ['id' => 1, 'name' => 'Test']);

        //pr($query);die;
        $this->set(compact('collabed', 'likes', 'user_collab', 'artist_two', 'artist_one', 'comments', 'user_likes'));

    }



}
