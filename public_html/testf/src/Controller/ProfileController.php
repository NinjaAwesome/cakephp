<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class ProfileController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([]);
    }

    public function initialize()
    {
        parent::initialize();
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('default');

        if (!$this->Auth->user())
            return $this->redirect($this->Auth->loginAction());

        $this->set('username', $this->Auth->user('name'));
    }

}
