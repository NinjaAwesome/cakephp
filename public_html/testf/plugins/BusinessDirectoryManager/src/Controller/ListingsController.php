<?php

namespace BusinessDirectoryManager\Controller;

use BusinessDirectoryManager\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Listings Controller
 *
 * @property \BusinessDirectoryManager\Model\Table\ListingsTable $Listings
 *
 * @method \BusinessDirectoryManager\Model\Entity\Listing[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListingsController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {

        $query = $this->Listings->find();
        $query->where(['Listings.status' => true]);
        $query->contain(['Locations', 'ListingCatalogs']);
       $query->find('filter', $this->request->getQuery());

        $options['order'] = ['Listings.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $listings = $this->paginate($query);

        $this->locations = TableRegistry::get('locations');
        $locations = $this->locations->find('list', ['keyField' => 'id', 'valueField' => 'title']);

        $this->set('locations', $locations);

        $this->set('listings', $listings);
        $this->set('_serialize', ['listings', 'locations']);
    }

    public function view($id = null) {
        $listing = $this->Listings->get($id, [
            'contain' => ['Locations', 'Industries']
        ]);


        $this->set('listing', $listing);
        $this->set('_serialize', ['listing']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $listing = $this->Listings->newEntity();
        if ($this->request->is('post')) {
            $listing = $this->Listings->patchEntity($listing, $this->request->getData());
            if ($this->Listings->save($listing)) {
                $this->Flash->success(__('The listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The listing could not be saved. Please, try again.'));
        }
        $users = $this->Listings->Users->find('list', ['limit' => 200]);
        $industries = $this->Listings->Industries->find('list', ['limit' => 200]);
        $locations = $this->Listings->Locations->find('list', ['limit' => 200]);
        $this->set(compact('listing', 'users', 'industries', 'locations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $listing = $this->Listings->get($id, [
            'contain' => []
        ]);
       
        if ($this->request->is(['patch', 'post', 'put'])) {
            $listing = $this->Listings->patchEntity($listing, $this->request->getData());
            if ($this->Listings->save($listing)) {
                $this->Flash->success(__('The listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The listing could not be saved. Please, try again.'));
        }
        $users = $this->Listings->Users->find('list', ['limit' => 200]);
        $industries = $this->Listings->Industries->find('list', ['limit' => 200]);
        $locations = $this->Listings->Locations->find('list', ['limit' => 200]);
        $this->set(compact('listing', 'users', 'industries', 'locations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $listing = $this->Listings->get($id);
        if ($this->Listings->delete($listing)) {
            $this->Flash->success(__('The listing has been deleted.'));
        } else {
            $this->Flash->error(__('The listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
