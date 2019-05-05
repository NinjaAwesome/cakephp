<?php

namespace CollabedManager\Controller\Admin;

use CollabedManager\Controller\AppController;

/**
 * Collabeds Controller
 *
 * @property \CollabedManager\Model\Table\CollabedsTable $Collabeds
 *
 * @method \CollabedManager\Model\Entity\Collabed[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CollabedsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $query = $this->Collabeds->find();
        $query->contain(['Banners','Artistsone','Artiststwo']);
        $query->find('filteradmin', $this->request->getQuery())->find('withInDate', $this->request->getQuery());
        $query->select(['total'=> $query->func()->count('CollabedLikes.collabed_id')])
            ->autoFields(true)
            ->contain(['CollabedLikes'])
            ->leftJoinWith('CollabedLikes')
            ->group(['Collabeds.id']);
        if($this->request->query('sort') == 'total'){
            $options['order'] = ['Collabeds.id' => $this->request->query('direction')];
        }else{
            $options['order'] = ['Collabeds.id' => 'DESC'];
        }
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $collabeds = $this->paginate($query);
        $this->Artist = \Cake\ORM\TableRegistry::get('Artists');
        $artists = $this->Artist->find('list', ['keyField' => 'id', 'valueField' => 'name'],['limit' => 200])
                ->where(['status' => 1]);
        $this->set(compact('collabeds','artists'));
        $this->set('_serialize', ['collabeds']);
    }

    /**
     * View method
     *
     * @param string|null $id Collabed id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $collabed = $this->Collabeds->get($id, [
            'contain' => ['Banners']
        ]);
        
        $this->set('collabed', $collabed);
        $this->set('_serialize', ['collabed']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Collabed id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {
        if ($id) {
            $collabed = $this->Collabeds->get($id, [
                'contain' => []
            ]);
        } else {
            $collabed = $this->Collabeds->newEntity();
        }
        if ($this->request->is(['post', 'patch', 'put'])) {
            $collabed = $this->Collabeds->patchEntity($collabed, $this->request->getData());
            if ($this->Collabeds->save($collabed)) {
                $this->Flash->success(__('The collabed has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The collabed could not be saved. Please, try again.'));
        }

        $banners = $this->Collabeds->Banners->find('list', ['limit' => 200]);
        $this->set(compact('collabed', 'banners'));
        $this->set('_serialize', ['collabed']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Collabed id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->add($id);
        $this->render("add");
    }

    /**
     * Delete method
     *
     * @param string|null $id Collabed id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $collabed = $this->Collabeds->get($id,[
            'contain' => ['CollabedLikes']
        ]);
        if ($this->Collabeds->delete($collabed)) {
            $this->Collabeds->deleteImage($collabed);
            $this->Flash->success(__('The collabed has been deleted.'));
        } else {
            $this->Flash->error(__('The collabed could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
     /**
     * DeleteAll method
     *
     * @param string|null $id Collabed id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteAll() {
        if ($this->request->is(['post', 'delete'])) {
            $ids = $this->request->getData('checks');
            if(!empty($ids)){
                foreach ($ids as $id){
                    $collabed = $this->Collabeds->get($id,[
                        'contain' => ['CollabedLikes']
                    ]);
                    if ($this->Collabeds->delete($collabed)) {
                        $this->Collabeds->deleteImage($collabed);
                    }
                }
                $this->Flash->success(__(count($ids).' collabes has been deleted.'));
            }else{
                $this->Flash->error(__('The collabed could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
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
            $id = $this->request->getData('id');
            $collabed = $this->Collabeds->get($id,[
                'contain' => ['Artistsone'=>function($q){ return $q->where(['Artistsone.status'=>1]);},'Artiststwo'=>function($q){ return $q->where(['Artiststwo.status'=>1]);}]
            ]);

            if(!empty($collabed->artistsone) && !empty($collabed->artiststwo)){
                $status = $this->Collabeds->newEntity();
                $field = $this->request->getData('field');
                $status->id = $this->request->getData('id');
                $status->$field = $this->request->getData('status');
                if ($this->Collabeds->save($status)) {
                    $msg = $this->request->getData($field) == 1 ? __("Your {$field} has activated") : __("Your {$field} has deactivated");
                    $response = ["success" => true, "err_msg" => $msg];
                } else {
                    $response = ["success" => false, "err_msg" => __("Your Process faild. please try again!!")];
                }
            }else{
                $response = ["success" => false, "err_msg" => __("Your Process faild. May Artist not enable!!")];
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
