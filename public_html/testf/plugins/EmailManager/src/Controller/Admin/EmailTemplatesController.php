<?php

namespace EmailManager\Controller\Admin;

use EmailManager\Controller\AppController;

/**
 * EmailTemplates Controller
 *
 * @property \EmailManager\Model\Table\EmailTemplatesTable $EmailTemplates
 *
 * @method \EmailManager\Model\Entity\EmailTemplate[] paginate($object = null, array $settings = [])
 */
class EmailTemplatesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        
        $query = $this->EmailTemplates->find();
        $query->contain(['EmailHooks' , 'EmailPreferences']);
        $query->order(['EmailTemplates.id' => 'DESC']);
        $emailTemplates = $query->all();
        
        $emailHooks = $this->EmailTemplates->EmailHooks->find('list', ['limit' => 200,'conditions'=>['EmailHooks.status'=>1]]);
        $emailPreferences = $this->EmailTemplates->EmailPreferences->find('list', ['limit' => 200]);
        
        $this->set(compact('emailTemplates','emailHooks','emailPreferences'));
        $this->set('_serialize', ['emailTemplates']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => ['EmailHooks', 'EmailPreferences']
        ]);

        $this->set('emailTemplate', $emailTemplate);
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {

        if ($id) {
            $emailTemplate = $this->EmailTemplates->get($id, [
                'contain' => []
            ]);
        } else {
            $emailTemplate = $this->EmailTemplates->newEntity();
        }
        if ($this->request->is(['post', 'patch', 'put'])) {
            $emailTemplate = $this->EmailTemplates->patchEntity($emailTemplate, $this->request->getData());
            if ($this->EmailTemplates->save($emailTemplate)) {
                $status = true;
                $message = __('The email template has been saved.');
                if (!$this->request->is('Ajax')) {
                    $this->Flash->success($message);
                    return $this->redirect(['action' => 'index']);
                } else {
                    $resultJ = json_encode(array('status' => $status, 'errors' => $message));
                    $this->response->type('json');
                    $this->response->body($resultJ);
                    return $this->response;
                }
            }else{
                if ($this->request->is('Ajax')){
                    $resultJ = json_encode(array('status' => false, 'errors' => $emailTemplate->errors()));
                    $this->response->type('json');
                    $this->response->body($resultJ);
                    return $this->response;
                }
            }
            if (!$this->request->is('Ajax')){
                $this->Flash->error(__('The email template could not be saved. Please, try again.'));
            }
        }
        $emailHooks = $this->EmailTemplates->EmailHooks->find('list', ['limit' => 200,'conditions'=>['EmailHooks.status'=>1]]);
        $emailPreferences = $this->EmailTemplates->EmailPreferences->find('list', ['limit' => 200]);
        $templates = $this->EmailTemplates->find()->contain(['EmailHooks'])->order(['EmailTemplates.id' => 'DESC'])->all();
        //dump($templates);die;
        $this->set(compact('emailTemplate', 'emailHooks', 'emailPreferences', 'templates'));
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailTemplate = $this->EmailTemplates->patchEntity($emailTemplate, $this->request->getData());
            if ($this->EmailTemplates->save($emailTemplate)) {
                $this->Flash->success(__('The email template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email template could not be saved. Please, try again.'));
        }
        $emailHooks = $this->EmailTemplates->EmailHooks->find('list', ['limit' => 200]);
        $emailPreferences = $this->EmailTemplates->EmailPreferences->find('list', ['limit' => 200]);
        $this->set(compact('emailTemplate', 'emailHooks', 'emailPreferences'));
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $emailTemplate = $this->EmailTemplates->get($id);
        if ($this->EmailTemplates->delete($emailTemplate)) {
            $this->Flash->success(__('The email template has been deleted.'));
        } else {
            $this->Flash->error(__('The email template could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
