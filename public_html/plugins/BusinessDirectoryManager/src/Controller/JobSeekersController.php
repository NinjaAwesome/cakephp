<?php
namespace BusinessDirectoryManager\Controller;

use BusinessDirectoryManager\Controller\AppController;

/**
 * JobSeekers Controller
 *
 * @property \BusinessDirectoryManager\Model\Table\JobSeekersTable $JobSeekers
 *
 * @method \BusinessDirectoryManager\Model\Entity\JobSeeker[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JobSeekersController extends AppController
{
    /**
     * initialize method
     *
     * 
     */
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Jobs']
        ];
        $jobSeekers = $this->paginate($this->JobSeekers);
        $this->set(compact('jobSeekers'));
    }

    /**
     * View method
     *
     * @param string|null $id Job Seeker id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $jobSeeker = $this->JobSeekers->get($id, [
            'contain' => ['Jobs']
        ]);
        $this->set('jobSeeker', $jobSeeker);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($job_id = null) {
        $jobSeeker = $this->JobSeekers->newEntity();
        if ($this->request->is('post')) {
            $jobSeeker = $this->JobSeekers->patchEntity($jobSeeker, $this->request->getData());
            if ($this->JobSeekers->save($jobSeeker)) {
                $status = array('status' => '1');
                echo json_encode($status);
                die;
            }
            $err = $jobSeeker->errors();
            $status = array('status' => '0', 'errors' => $err);
            echo json_encode($status);
            die;
        }
        $jobs = $this->JobSeekers->Jobs->find('list', ['limit' => 200]);
        $jobid = array('id' => $job_id);
        $this->set(compact('jobSeeker', 'jobs', 'jobid'));
        $this->set('_serialize', ['jobSeeker']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Job Seeker id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $jobSeeker = $this->JobSeekers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $jobSeeker = $this->JobSeekers->patchEntity($jobSeeker, $this->request->getData());
            if ($this->JobSeekers->save($jobSeeker)) {
                $this->Flash->success(__('The job seeker has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The job seeker could not be saved. Please, try again.'));
        }
        $jobs = $this->JobSeekers->Jobs->find('list', ['limit' => 200]);
        $this->set(compact('jobSeeker', 'jobs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Job Seeker id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $jobSeeker = $this->JobSeekers->get($id);
        if ($this->JobSeekers->delete($jobSeeker)) {
            $this->Flash->success(__('The job seeker has been deleted.'));
        } else {
            $this->Flash->error(__('The job seeker could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
