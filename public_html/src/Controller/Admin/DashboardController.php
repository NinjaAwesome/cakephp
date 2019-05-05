<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class DashboardController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->Artists = TableRegistry::get('Artists');
        $query = $this->Artists->find();
        $query->select(['count' => $query->func()->count('*')]);
        $query->where(['status'=>1]);
        $artisrs = $query->toArray();
        $artisrs = $artisrs[0]->count;
        
        $this->Collabeds = TableRegistry::get('Collabeds');
        $query = $this->Collabeds->find();
        $query->select(['count' => $query->func()->count('*')]);
        $collabeds = $query->toArray();
        $collabeds = $collabeds[0]->count;
        $this->set(compact("artisrs","collabeds"));
    }

}
