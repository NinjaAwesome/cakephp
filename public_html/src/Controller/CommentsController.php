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
class CommentsController extends AppController {
    
    
    
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
    public function add($collab_id = 0) {
        $this->layout = false;
        $this->autoRender = false;

        if(!$this->Auth->user())
        {
            return $this->error(404, 'User not found');
        }

        $this->loadModel('Collabeds');
        $this->loadModel('Comments');

        $collabed = $this->Collabeds->find()
                    ->where(['Collabeds.id' => $collab_id])
                    ->first();

        if(!$collabed)
        {
            return $this->error(404, 'Collab not found.');
        }

        $comment = $this->request->getData('comment');

        if(!$comment)
        {
            return $this->error(404, 'Please write your comment.');

        }

        $user = $this->Auth->user();
        // $user['id'] = 1;

        $data = [
            'collabed_id' => $collabed->id,
            'user_id' => $user['id'],
            'comment' => $comment
        ];

        $comment = $this->Comments->newEntity();

        $comment = $this->Comments->patchEntity($comment, $data);
        if ($this->Comments->save($comment)) {
            $resultJ = json_encode(['id' => $comment->id]);
            $this->response->type('json');
            $this->response->body($resultJ);
            return $this->response;
        }
        else
        {
            return $this->error(500, 'Database error.');

        }
    }

    public function like($comment_id = 0)
    {
        $this->layout = false;
        $this->autoRender = false;

        if(!$this->Auth->user())
        {
            return $this->error(404, 'User not found');
        }

        $this->loadModel('Comments');
        $this->loadModel('Commentslike');

        $comment = $this->Comments->find()
            ->where(['Comments.id' => $comment_id])
            ->first();

        if(!$comment)
        {
            return $this->error(404, 'Comment not found.');
        }

         $user = $this->Auth->user();
        //  $user['id'] = 1;

        $like = $this->Commentslike
            ->find()
            ->where(['Commentslike.user_id' => $user['id'],
                    'Commentslike.comment_id' => $comment_id]
            )
            ->first();

        if($like)
        {
            $result = $this->Commentslike->delete($like);

            $data_for_comment = [
                'count_like' => $comment->count_like - 1
            ];
            $data_for_comment = $this->Comments->patchEntity($comment, $data_for_comment);
            $this->Comments->save($data_for_comment);


            $resultJ = json_encode(['success' => true, 'like' => false, 'count' => $comment->count_like]);
            $this->response->type('json');
            $this->response->body($resultJ);
            return $this->response;
        }
        else
        {
            $data = [
               'user_id' => $user['id'],
               'comment_id' => $comment_id
            ];

            $like = $this->Commentslike->newEntity();
            $like = $this->Commentslike->patchEntity($like, $data);
            if ($this->Commentslike->save($like)) {

                $data_for_comment = [
                    'count_like' => $comment->count_like + 1
                ];
                $data_for_comment = $this->Comments->patchEntity($comment, $data_for_comment);
                $this->Comments->save($data_for_comment);


                $resultJ = json_encode(['success' => true, 'like' => true, 'count' => $comment->count_like]);
                $this->response->type('json');
                $this->response->body($resultJ);
                return $this->response;

            }
            else
            {
                return $this->error(500, 'Database error.');

            }

        }

    }

    private function error($code, $message)
    {
        $this->response->statusCode($code);
        $errorstr = array(
            'success' => false,
            'error' => array(
                'code' => $code,
                'message' => $message
            ));
        $this->response->type('json');
        $this->response->body(json_encode($errorstr));
        return $this->response;

    }

}
