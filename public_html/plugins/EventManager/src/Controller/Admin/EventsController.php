<?php

namespace EventManager\Controller\Admin;

use EventManager\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Events Controller
 *
 * @property \EventManager\Model\Table\EventsTable $Events
 *
 * @method \EventManager\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController {
     public function initialize() {
        parent::initialize();
        $this->EvoptionValues = TableRegistry::get("EventManager.EvoptionValues");
        //$this->Auth->allow(['getcatdetails']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $query = $this->Events->find();
        $query->contain(['Users']);

        $options['order'] = ['Events.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $events = $this->paginate($query);
        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $event = $this->Events->get($id, [
            'contain' => ['Users', 'EventBookings', 'EventDocuments', 'EventJoins', 'EventReviews']
        ]);

        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {
        if ($id) {
            $event = $this->Events->get($id, [
                'contain' => ['EventImages', 'EventVideos', 'EventOptions' => ['Evoptions', 'EventOptionValues']]
            ]);
        } else {
            $event = $this->Events->newEntity();
        }
        //dump($event);die;
        if ($this->request->is(['post', 'patch', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData(), [
                'associated' => ['EventImages', 'EventVideos','EventOptions.EventOptionValues', 'EventOptions.Evoptions']
            ]);
            //dump($event);die;
             //pr($this->request->getData());
//             pr($event->getErrors());
//            die; 
            //dump($event);die; 
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        
        if (!empty($event) && isset($event->event_options)) {
            //dump($event->event_options);die;
            foreach ($event->event_options as $event_option) {
                if(!isset($event_option->evoption->option_type)){
                    $event_option->evoption = $this->Events->EventOptions->Evoptions->find()->where(['id' => $event_option->evoption_id])->first();
                }
                if (isset($event_option->evoption->option_type) && $event_option->evoption->option_type == 'select' || $event_option->evoption->option_type == 'radio' || $event_option->evoption->option_type == 'checkbox' || $event_option->evoption->option_type == 'image') {
                    //echo $event_option->option_id;die;
                    if (!isset($option_values[$event_option->evoption_id])) {
                        $option_values[$event_option->evoption_id] = $this->EvoptionValues->find("list", ['keyField' => 'id', 'valueField' => 'title'])->where(['evoption_id' => $event_option->evoption_id])->toArray();
                    }
                }
            }
        }
        
        //dump($event);die;

        
        $users = $this->Events->Users->find('list', ['limit' => 200]);
        $this->set(compact('event', 'users','option_values'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
//    public function edit($id = null) {
//        $event = $this->Events->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $event = $this->Events->patchEntity($event, $this->request->getData());
//            if ($this->Events->save($event)) {
//                $this->Flash->success(__('The event has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The event could not be saved. Please, try again.'));
//        }
//        $users = $this->Events->Users->find('list', ['limit' => 200]);
//        $this->set(compact('event', 'users'));
//        $this->set('_serialize', ['event']);
//    }

    public function edit($id = null) {
        $this->add($id);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $banner = $this->Events->get($id);
        if ($this->Events->delete($banner)) {
            $msg = __('The document has been deleted.');
            $this->Flash->success($msg);
            $response = ["success" => TRUE, "err_msg" => $msg];
        } else {
            $msg = __('The document could not be deleted. Please, try again.');
            $this->Flash->error($msg);
            $response = ["success" => FALSE, "err_msg" => $msg];
        }
        $this->set([
            'success' => $response['success'],
            'responce' => 200,
            'message' => $response['err_msg'],
            'data' => $banner,
            '_jsonOptions' => JSON_FORCE_OBJECT,
            '_serialize' => ['success', 'responce', 'message', 'data']
        ]);

        if (!$this->request->is('ajax')) {
            return $this->redirect(['action' => 'index']);
        }
    }

    public function deleteImages($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $bannerImage = $this->Events->EventDocuments->get($id);
        if ($this->Events->EventDocuments->delete($bannerImage)) {
            $msg = __('The document has been deleted.');
            $response = ["success" => TRUE, "err_msg" => $msg];
        } else {
            $msg = __('The document could not be deleted. Please, try again.');
            $response = ["success" => FALSE, "err_msg" => $msg];
        }
        $this->set([
            'success' => $response['success'],
            'responce' => 200,
            'message' => $response['err_msg'],
            'data' => $bannerImage,
            '_jsonOptions' => JSON_FORCE_OBJECT,
            '_serialize' => ['success', 'responce', 'message', 'data']
        ]);

        if (!$this->request->is('ajax')) {
            $response['success'] === TRUE ? $this->Flash->success($msg) : $this->Flash->error($msg);
            return $this->redirect(['action' => 'index']);
        }
    }

    public function changeFlag() {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->Events->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Events->save($status)) {
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

    public function eventOptionDelete($id = null) {
        $option = $this->Events->EventOptions->get($id);
        if ($this->Events->EventOptions->delete($option)) {
            $this->Flash->success(__('The tour add ons option has been deleted.'));
        } else {
            $this->Flash->error(__('The tour add ons option could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer() . "/#tab_addons");
    }

}
