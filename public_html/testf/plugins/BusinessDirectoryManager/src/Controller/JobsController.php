<?php
namespace BusinessDirectoryManager\Controller;

use BusinessDirectoryManager\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Jobs Controller
 *
 * @property \BusinessDirectoryManager\Model\Table\JobsTable $Jobs
 *
 * @method \BusinessDirectoryManager\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JobsController extends AppController
{
   /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
     public function index() {
        $query = $this->Jobs->find();
        $query->contain(['Users', 'Listings','Locations']);
        $query = $query->where(['Jobs.status'=>true]);
        
          //$query = $query->where(['Jobs.job_end >='=>'date'('Y-m-d', strtotime("now"))])); 
        
        $query->find('filter', $this->request->getQuery());
        
        $options['order'] = ['Jobs.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
       
        $jobs = $this->paginate($query);
        $this->locations = TableRegistry::get('locations');
        $locations = $this->locations->find('list',['keyField' => 'id', 'valueField' => 'title']);
         $this->set('jobs', $jobs);
        $this->set('locations', $locations);
        $this->set('_serialize', ['jobs','locations']);
    }
    
    public function index1()
            
    {   
          
        $this->paginate = [
            'contain' => ['Users', 'Listings','Locations'],
        ];
        $this->locations = TableRegistry::get('locations');
        $locations = $this->locations->find('list',['keyField' => 'id', 'valueField' => 'title']);
        $query = $this->Jobs->find()->where(['Jobs.status'=>1]);
        $query->find('filter', $this->request->getQuery());
        $jobs = $this->paginate($query); 
        $this->set('jobs', $jobs);
        $this->set('locations', $locations);
        $this->set('_serialize', ['jobs','locations']);
    }
    
     

    /**
     * View method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   
    public function view($id = null) {
        $job = $this->Jobs->get($id, [
            'contain' => ['Users', 'Listings', 'Locations', 'JobSeekers']
        ]);
        $this->set('job', $job);
        $this->set('_serialize', ['job']);
    }

    
   

    

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $job = $this->Jobs->newEntity();
         if($this->request->is('post')) {
            $job = $this->Jobs->patchEntity($job, $this->request->getData());
            if ($this->Jobs->save($job)) {
                $this->Flash->success(__('The job has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
         $this->Flash->error(__('The job could not be saved. Please, try again.'));
        }
        $users = $this->Jobs->Users->find('list', ['limit' => 200]);
        $listings = $this->Jobs->Listings->find('list', ['limit' => 200]);
        $locations = $this->Jobs->Locations->find('list', ['limit' => 200]);
        $this->set(compact('job', 'users', 'listings', 'locations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $job = $this->Jobs->get($id, [
            'contain' => ['Locations']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $job = $this->Jobs->patchEntity($job, $this->request->getData());
            if ($this->Jobs->save($job)) {
                $this->Flash->success(__('The job has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The job could not be saved. Please, try again.'));
        }
        $users = $this->Jobs->Users->find('list', ['limit' => 200]);
        $listings = $this->Jobs->Listings->find('list', ['limit' => 200]);
        $locations = $this->Jobs->Locations->find('list', ['limit' => 200]);
        $this->set(compact('job', 'users', 'listings', 'locations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $job = $this->Jobs->get($id);
        if ($this->Jobs->delete($job)) {
            $this->Flash->success(__('The job has been deleted.'));
        } else {
            $this->Flash->error(__('The job could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
