<?php
namespace CollabedManager\Controller;

use CollabedManager\Controller\AppController;
 use Cake\Routing\Router;
/**
 * CollabLikes Controller
 *
 * @property \CollabedManager\Model\Table\CollabLikesTable $CollabLikes
 *
 * @method \CollabedManager\Model\Entity\CollabLike[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CollabedLikesController extends AppController
{
    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Collabe');
        $this->Auth->allow(['index','ajaxIndex']);
        
    }
   
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function ajaxIndex($id = null)
    {
        $this->autoRender = false;
        $request = [];
        if ($this->request->is('ajax')) {
            $request['ip_address'] = $this->request->clientIp();
            $request['collabed_id'] = $this->request->data['collbe_id'];
            $request['user_id'] = $this->request->data['user_id'];
            $likeCount = $this->request->data['likeCount'];
            
            $likeCount = $this->CollabedLikes->find()->where(['collabed_id' => $request['collabed_id']])->count();
            $liked = $this->CollabedLikes->find()->where(['collabed_id' => $request['collabed_id'],'ip_address' => $request['ip_address'], 'user_id' => $request['user_id'] ])->first();
            $result = [];
            $result['success'] = false;
            if(empty($liked)) {
                $collabLike = $this->CollabedLikes->newEntity();
                $collabLike = $this->CollabedLikes->patchEntity($collabLike, $request);
                if ($this->CollabedLikes->save($collabLike)) {
                    $result['success'] = true;
                    $result['likeCount'] = $this->numberFormatShort($likeCount+1);
                }
            }else{
                    
                if($this->CollabedLikes->delete($liked)) {
                    $result['likeCount'] = $this->numberFormatShort($likeCount-1);
                    
                }
            }
            echo json_encode($result);
        }
        
    }
    
    
    
    
    /**
     * View method
     *
     * @param string|null $id Collab Like id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*
    public function view($id = null)
    {
        $collabLike = $this->CollabLikes->get($id, [
            'contain' => ['Collabs']
        ]);

        $this->set('collabLike', $collabLike);
    }
    */
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    /*
    public function add()
    {
        $collabLike = $this->CollabLikes->newEntity();
        if ($this->request->is('post')) {
            $collabLike = $this->CollabLikes->patchEntity($collabLike, $this->request->getData());
            if ($this->CollabLikes->save($collabLike)) {
                $this->Flash->success(__('The collab like has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The collab like could not be saved. Please, try again.'));
        }
        $collabs = $this->CollabLikes->Collabs->find('list', ['limit' => 200]);
        $this->set(compact('collabLike', 'collabs'));
    }
    */
    /**
     * Edit method
     *
     * @param string|null $id Collab Like id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    /*
    public function edit($id = null)
    {
        $collabLike = $this->CollabLikes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $collabLike = $this->CollabLikes->patchEntity($collabLike, $this->request->getData());
            if ($this->CollabLikes->save($collabLike)) {
                $this->Flash->success(__('The collab like has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The collab like could not be saved. Please, try again.'));
        }
        $collabs = $this->CollabLikes->Collabs->find('list', ['limit' => 200]);
        $this->set(compact('collabLike', 'collabs'));
    }
    */
    /**
     * Delete method
     *
     * @param string|null $id Collab Like id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $collabLike = $this->CollabLikes->get($id);
        if ($this->CollabLikes->delete($collabLike)) {
            $this->Flash->success(__('The collab like has been deleted.'));
        } else {
            $this->Flash->error(__('The collab like could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
     * */
}
