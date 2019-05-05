<?php

namespace BusinessDirectoryManager\Controller\Admin;

//use Cake\I18n\Date;
use BusinessDirectoryManager\Controller\AppController;
use Cake\Mailer\MailerAwareTrait;

//use BusinessDirectoryManager\Controller\admin\JobSeekersController;

/**
 * Interviews Controller
 *
 * @property \BusinessDirectoryManager\Model\Table\InterviewsTable $Interviews
 *
 * @method \BusinessDirectoryManager\Model\Entity\Interview[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InterviewsController extends AppController {

    use MailerAwareTrait;

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $query = $this->Interviews->find();
        $query->contain(['JobSeekers' => function($q) {
                return $q->contain(['Jobs']);
            }]);
        $query->find('filter', $this->request->getQuery());
        $options['order'] = ['Interviews.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $interviews = $this->paginate($query);
        //dump($interviews);die;
        $this->set(compact('interviews'));
        $this->set('_serialize', ['interviews']);
    }

    /**
     * View method
     *
     * @param string|null $id Interview id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $interview = $this->Interviews->get($id, [
            'contain' => ['JobSeekers' => function($q) {
                    return $q->contain(['Jobs']);
                }]]);
        $this->set('interview', $interview);
        $this->set('_serialize', ['interview']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Interview id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($seeker_id = null, $id = null) {  // echo "id > $id ,seeker_id > $seeker_id ";die; 
        if ($id) {
            $interview = $this->Interviews->get($id, [
                'contain' => ['Jobseekers' => function($q) {
                        return $q->contain('Jobs');
                    }]
            ]);
            $seeker_id = $interview->job_seeker_id;
        } else {
            $interview = $this->Interviews->newEntity();
        }

        if ($this->request->is(['post', 'patch', 'put'])) {
            if (($this->request->getData('status')) == ($this->ConfigSettings['RE_SCHEDULE']))
                $interview->reshedule_count += 1;

            $interview->job_seeker_id = $seeker_id;


            $interview = $this->Interviews->patchEntity($interview, $this->request->getData());
            if ($this->Interviews->save($interview)) {


                $user['email'] = "dilipkumar.khandelwal@dotsquares.com";
                $user['name'] = "dilip";
				
                //pr($notificationCustomer);die;
                $this->getMailer('Manu')->send('JobSeekersMail', [$user]);


                $query = $this->Interviews->JobSeekers->get($seeker_id);
                $query->schedule_status = 1;

                $this->Interviews->JobSeekers->save($query);
                $this->Flash->success(__('The interview has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The interview could not be saved. Please, try again.'));
        }
        //$job_endDate = $interview->JobSeekers['job']->job_end->format('Y-m-d');
        //$daysCount= $job_endDate - date('Y-m-d');die;
        $daysCount = 10;
        $jobSeekers = $this->Interviews->JobSeekers->get($seeker_id);
        $this->set(compact('interview', 'jobSeekers', 'daysCount'));
        $this->set('_serialize', ['interview', 'jobSeekers', 'daysCount']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Interview id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $interview = $this->Interviews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {



            $interview = $this->Interviews->patchEntity($interview, $this->request->getData());
            if ($this->Interviews->save($interview)) {
                $this->Flash->success(__('The interview has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The interview could not be saved. Please, try again.'));
        }
        $jobSeekers = $this->Interviews->JobSeekers->find('list', ['limit' => 200]);
        $this->set(compact('interview', 'jobSeekers'));
        $this->set('_serialize', ['interview']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Interview id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $interview = $this->Interviews->get($id);
        if ($this->Interviews->delete($interview)) {
            $this->Flash->success(__('The interview has been deleted.'));
        } else {
            $this->Flash->error(__('The interview could not be deleted. Please, try again.'));
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
    public function changeFlag() {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->Interviews->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Interviews->save($status)) {
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
