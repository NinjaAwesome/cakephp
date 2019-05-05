<?php

namespace ArtistManager\Controller\Admin;

use ArtistManager\Controller\AppController;

/**
 * ArtistsGroups Controller
 *
 * @property \ArtistManager\Model\Table\ArtistsGroupsTable $ArtistsGroups
 *
 * @method \ArtistManager\Model\Entity\ArtistsGroup[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArtistsGroupsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $query = $this->ArtistsGroups->find();
        $query->contain(['Artists', 'Groups']);

        $options['order'] = ['ArtistsGroups.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $artistsGroups = $this->paginate($query);
        $this->set(compact('artistsGroups'));
        $this->set('_serialize', ['artistsGroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Artists Group id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $artistsGroup = $this->ArtistsGroups->get($id, [
            'contain' => ['Artists', 'Groups']
        ]);

        $this->set('artistsGroup', $artistsGroup);
        $this->set('_serialize', ['artistsGroup']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Artists Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {
        if ($id) {
            $artistsGroup = $this->ArtistsGroups->get($id, [
                'contain' => []
            ]);
        } else {
            $artistsGroup = $this->ArtistsGroups->newEntity();
        }
        if ($this->request->is(['post', 'patch', 'put'])) {
            $artistsGroup = $this->ArtistsGroups->patchEntity($artistsGroup, $this->request->getData());
            if ($this->ArtistsGroups->save($artistsGroup)) {
                $this->Flash->success(__('The artists group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The artists group could not be saved. Please, try again.'));
        }

        $artists = $this->ArtistsGroups->Artists->find('list', ['limit' => 200]);
        $groups = $this->ArtistsGroups->Groups->find('list', ['limit' => 200]);
        $this->set(compact('artistsGroup', 'artists', 'groups'));
        $this->set('_serialize', ['artistsGroup']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Artists Group id.
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
     * @param string|null $id Artists Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $artistsGroup = $this->ArtistsGroups->get($id);
        if ($this->ArtistsGroups->delete($artistsGroup)) {
            $this->Flash->success(__('The artists group has been deleted.'));
        } else {
            $this->Flash->error(__('The artists group could not be deleted. Please, try again.'));
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
            $status = $this->ArtistsGroups->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->ArtistsGroups->save($status)) {
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
