<?php
namespace ArtistManager\Controller\Admin;

use ArtistManager\Controller\AppController;

/**
 * Groups Controller
 *
 * @property \ArtistManager\Model\Table\GroupsTable $Groups
 *
 * @method \ArtistManager\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GroupsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Groups->find();
        $query->find('filter', $this->request->getQuery());
        $query->contain(['Artists']);
        $options['order'] = ['Groups.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $groups = $this->paginate($query);
        //pr($query);die;
        $artists = $this->Groups->Artists->find('list');
        $this->set(compact('groups','artists'));
        $this->set('_serialize', ['groups','artists']);
    }

    /**
     * View method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $group = $this->Groups->get($id, [
            'contain' => ['Artists']
        ]);

        $this->set('group', $group);
        $this->set('_serialize', ['group']);
    }


    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $group = $this->Groups->get($id, [
                //'contain' => ['Artists']
            ]);
        }else{
            
        }
        
        if ($this->request->is(['post','patch', 'put'])) {
            $artistNames = $this->request->getData('name');
            pr($this->request->getData());die;
            $group = $this->Groups->newEntity();
            
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }
        
        $artists = $this->Groups->Artists->find('list');
        $this->set(compact('group', 'artists'));
        $this->set('_serialize', ['group']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->add($id);
        $this->render("add");
    }

    /**
     * Delete method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->Groups->get($id);
        if ($this->Groups->delete($group)) {
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please, try again.'));
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
                $i = 0;
                foreach ($ids as $id){
                    $group = $this->Groups->get($id);
                    if ($this->Groups->delete($group)) {
                        $i++;
                    }
                }
                $this->Flash->success(__($i.' groups has been deleted.'));
            }else{
                $this->Flash->error(__('The groups could not be deleted. Please, try again.'));
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
    public function changeFlag()
    {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->Groups->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Groups->save($status)) {
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
