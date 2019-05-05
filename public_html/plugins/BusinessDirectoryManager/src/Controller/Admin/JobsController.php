<?php
namespace BusinessDirectoryManager\Controller\Admin;
use BusinessDirectoryManager\Controller\AppController;
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
     * Initialize method
     *
     * @return \Cake\Http\Response|void
     */
    public function initialize()
    {
        parent::initialize();
     $this->Auth->allow(['index','view']);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    
    public function index() {
        $query = $this->Jobs->find();
        $query->contain(['Users', 'Listings']);
        $query->find('filter', $this->request->getQuery());
        $options['order'] = ['Jobs.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $jobs = $this->paginate($query);
        $this->set(compact('jobs'));
        $this->set('_serialize', ['jobs']);
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
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {
        $job =($id)?$job = $this->Jobs->get($id,['contain' => ['Locations', 'Users']]):$job = $this->Jobs->newEntity();
        if ($this->request->is(['post', 'patch', 'put'])) {
            $job = $this->Jobs->patchEntity($job, $this->request->getData());
            if ($this->Jobs->save($job)) {
                $this->Flash->success(__('The job has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The job could not be saved. Please, try again.'));
        }

        $users = $this->Jobs->Users->find('list', ['keyField' => 'id', 'valueField' => 'first_name', 'limit' => $this->ConfigSettings['JOB_PAGE_LIMIT']]);
        $listings = $this->Jobs->Listings->find('list', ['limit' => $this->ConfigSettings['JOB_PAGE_LIMIT']]);
        $locations = $this->Jobs->Locations->find('treeList');
        $dataerror = $job->getErrors();
        $this->set(compact('job', 'users', 'listings', 'locations','dataerror'));
        $this->set('_serialize', ['job']);
        
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
        $this->set('_serialize', ['job']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $job = $this->Jobs->get($id);
        if ($this->Jobs->delete($job)) {
            $this->Flash->success(__('The job has been deleted.'));
        } else {
            $this->Flash->error(__('The job could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
  /**
     * ChangeFlag method
     *
     * @param string|null &id flag id.
     * @param string|null &id field those update table field.
     * @param string|null &status Admin status.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeFlag()
    {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->Jobs->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Jobs->save($status)) {
                $msg = $this->request->getData($field) == 1 ? __("Your {$field} has activated") : __("Your {$field} has deactivated");
                $response = ["success" => true, "err_msg" => $msg];
            } else {
                $response = ["success" => false, "err_msg" => __("Your Process faild. please try again!!")];
            }
            $this->set([
                'success' => $response['success'],
                'responce' => 200,
                'message' => $response['err_msg'],
                '_jsonOptions' => JSON_FORCE_OBJECT,
                '_serialize' => ['success', 'responce', 'message']
            ]);
        }
        
    }
}
