<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class PrivacyPolicyController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }

    public function initialize()
    {
        parent::initialize();
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('default_without_search');
    }

}
