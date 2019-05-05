<?php

namespace ArtistManager\Controller\Admin;

use ArtistManager\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\ORM\TableRegistry;
/**
 * Artists Controller
 *
 * @property \ArtistManager\Model\Table\ArtistsTable $Artists
 *
 * @method \ArtistManager\Model\Entity\Artist[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArtistsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $query = $this->Artists->find();
        $query->find('filter', $this->request->getQuery())->find('withInDate', $this->request->getQuery());
        $options['order'] = ['Artists.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $artists = $this->paginate($query);
        $this->set(compact('artists'));
        $this->set('_serialize', ['artists']);
    }

    /**
     * View method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $artist = $this->Artists->get($id, [
            'contain' => ['Groups']
        ]);

        $this->set('artist', $artist);
        $this->set('_serialize', ['artist']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {
        // In a controller.
        $associated = ['Groups'];
        $edit = [];
        if ($id) {
            $artist = $this->Artists->get($id, [
                'contain' => $associated
            ]);
            $edit = ['associated' => $associated];
        } else {
            $artist = $this->Artists->newEntity();
        }
        
        if ($this->request->is(['post', 'patch', 'put'])) {
            $request = $this->request->getData();
            
            $artist = $this->Artists->patchEntity($artist, $request, $edit);
            
            if ($this->Artists->save($artist)) {
                $this->Flash->success(__('The artist has been saved.'));
                return $this->redirect(['action' => 'index']);
            }elseif(!empty($artist->errors())){
                $this->Flash->error(__('The field cannot be left empty. Please, try again.'));
            }else{
                $this->Flash->error(__('Data not able to save. Please, try again.'));
            }
            
        }

        $groups = $this->Artists->Groups->find('list', ['limit' => 200]);
        $this->set(compact('artist', 'groups'));
        $this->set('_serialize', ['artist']);
    }
    
    /**
     * import method
     *
     * case: import
     * @return \Cake\Http\Response|null Redirects on successful import, renders view otherwise.
     * cse: import
     * @param string|null.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function import() {
        
        if ($this->request->is(['post', 'patch', 'put'])) {
            if (isset($this->request->data['fileUpload']['name']) && 
                    $this->request->data['fileUpload']['name'] != "") {
                $uploadedVideoArr = $this->request->data['fileUpload'];
                $file_name = 'artists.txt';
                $upload_folder = 'img'.DS.'uploads'.DS.'artist';
                if (move_uploaded_file($uploadedVideoArr['tmp_name'], $upload_folder . DS . $file_name)) {
                    $file = new File($upload_folder.DS.$file_name, true, 0644);

                    $file_lines = file($file->path);
                    $j = 1;
                    foreach ($file_lines as $key => $line) {
                        $line = utf8_encode($line);
                        //pr($line);
                        $exsit = $this->Artists->find()->where(['name LIKE' => '%'.$line.'%'])->count();
                        //dump($exsit);
                        if(empty($exsit)){
                            $artist = $this->Artists->newEntity();
                            $request['name'] = trim($line);
                            $request['status'] = 1;
                            $artist = $this->Artists->patchEntity($artist, $request);
                            if ($this->Artists->save($artist)) {
                                $j++;
                            }
                        }    
                    }
                    $this->Flash->success(__('Successfully insert '. $j .' artist has been saved.'));
                    return $this->redirect(['action' => 'index']); 
                }
            }
            /*
             * 
                    $file_name = 'artists.txt';
                    $upload_folder = 'img'.DS.'uploads'.DS.'artist';
                    $file = new File($upload_folder.DS.$file_name, true, 0644);

                    $file_lines = file($file->path);
                    $j = 1;
                    foreach ($file_lines as $key => $line) {
                        $line = utf8_encode($line);
                        //pr($line);
                        $exsit = $this->Artists->find()->where(['name LIKE' => '%'.$line.'%'])->count();
                        //dump($exsit);
                        if(empty($exsit)){
                            $artist = $this->Artists->newEntity();
                            $request['name'] = $line;
                            $request['status'] = 1;
                            $artist = $this->Artists->patchEntity($artist, $request);
                            if ($this->Artists->save($artist)) {
                                $j++;
                            }
                        }    
                    }
                    $this->Flash->success(__('Successfully insert '. $j .' artist has been saved.'));
                    return $this->redirect(['action' => 'index']); 
             */
        }

        //$groups = $this->Artists->Groups->find('list', ['limit' => 200]);
        //$this->set(compact('artist', 'groups'));
        //$this->set('_serialize', ['artist']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Artist id.
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
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $artist = $this->Artists->get($id,[
                        'contain' => ['Collabeds']
                    ]);
        $collabeds = $this->Artists->Collabeds->find()->where(['OR' => ['artist_1'=>$artist->id,'artist_2'=>$artist->id]])->first();
        if(empty($collabeds)){
            if ($this->Artists->delete($artist)) {
                $this->Flash->success(__('The artist has been deleted.'));
            } else {
                $this->Flash->error(__('The artist could not be deleted. Please, try again.'));
            }
        }else{
          $this->Flash->error(__('The artist could not be delete. because collab exist'));  
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
                    $artists = $this->Artists->get($id,[
                        'contain' => ['Collabeds']
                    ]);
                    $collabeds = $this->Artists->Collabeds->find()->where(['OR' => ['artist_1'=>$artists->id,'artist_2'=>$artists->id]])->first();
                    if(empty($collabeds)){
                        $this->Artists->delete($artists);
                        $i++;
                    }
                }
                $this->Flash->success(__($i.' free artists has been deleted.'));
            }else{
                $this->Flash->error(__('The artist could not be deleted. Please, try again.'));
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
            $this->Collabeds = TableRegistry::get('CollabedManager.Collabeds');
            $id = $this->request->getData('id');
            $field = $this->request->getData('field');
            $request = $this->request->getData();
 
            $artists = $this->Artists->get($id,[
                        'contain' => ['Collabeds']
                    ]);
            
            $collabed = $this->Collabeds->find()->where(['Collabeds.status' =>0])
                    ->where(['OR'=>['Collabeds.artist_1'=>$id,'Collabeds.artist_2'=>$id]])->toArray();
            
            if(!empty($collabed)){
                foreach($collabed as $key=> $colb){
                    $artist_1 = $this->getArtists($colb->artist_1);
                    $artist_2 = $this->getArtists($colb->artist_2);
                    if(!empty($artist_1) || !empty($artist_2)){
                        $request['collabeds'][$key]['id'] = $colb->id;
                        $request['collabeds'][$key]['status'] = ACTIVE;
                    }
                }
            }
            $associated = ['Collabeds'];
            $edit = ['associated' => $associated];
            $artists->$field = $this->request->getData('status');
            $artist = $this->Artists->patchEntity($artists, $request,$edit);
            if ($this->Artists->save($artist)) {
                
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
    
    private function getArtists($id = null){
        return $this->Artists->find('active')->where(['Artists.id'=>$id])->toArray();
    }
}
