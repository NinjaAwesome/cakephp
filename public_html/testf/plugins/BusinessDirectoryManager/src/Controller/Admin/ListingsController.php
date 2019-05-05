<?php namespace BusinessDirectoryManager\Controller\Admin;

use BusinessDirectoryManager\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Listings Controller
 *
 * @property \BusinessDirectoryManager\Model\Table\ListingsTable $Listings
 *
 * @method \BusinessDirectoryManager\Model\Entity\Listing[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListingsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Locations = TableRegistry::get("LocationManager.Locations");
        //$this->Auth->allow(['getcatdetails']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Listings->find();

        $query->contain(['Locations', 'ListingCatalogs']);
        $query->find('filter', $this->request->getQuery());

        $options['order'] = ['Listings.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $listings = $this->paginate($query);


        $this->set(compact('listings'));
        $this->set('_serialize', ['listings']);
    }

    /**
     * View method
     *
     * @param string|null $id Listing id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $listing = $this->Listings->get($id, [
            'contain' => []
        ]);

        $this->set('listing', $listing);
        $this->set('_serialize', ['listing']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null)
    {
        if ($id) {
            $listing = $this->Listings->get($id, [
                'contain' => ['ListingCatalogs']
            ]);
        } else {
            $listing = $this->Listings->newEntity();
        }
        $all_location = [];
        if ($this->request->is(['post', 'patch', 'put'])) {
            $locationId = $this->request->getData('location_id');
            $listing = $this->Listings->patchEntity($listing, $this->request->getData());
            $locationTree = $this->isempty($locationId);
            if ($this->Listings->save($listing)) {
                $this->Flash->success(__('The listing has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The listing could not be saved. Please, try again.'));
        }
        if (!empty($listing->location_id)) {
            $locationTree = $this->isempty($listing->location_id);
            foreach ($locationTree as $key => $row) {
                if ($key == 0) {
                    $this->request->data['parent_id'] = $row->id;
                }
                $arr_loc = $this->Listings->Locations->find('list')->where(['parent_id' => $row->id])->toArray();
                if (!empty($arr_loc)) {
                    $all_location[] = $arr_loc;
                }
                if ($key > 0) {
                    $this->request->data['sublocations'][] = $row->id;
                }
            }
        }
        $dataerror = $listing->getErrors();
        $users = $this->Listings->Users->find('list', ['limit' => 200]);
        $industries = $this->Listings->Industries->find('list', ['keyField' => 'id', 'valueField' => 'title']);
        $locations = $this->Listings->Locations->find('list', ['limit' => 200])->where(['Locations.parent_id' => 0]);
        $this->set(compact('listing', 'users', 'locations', 'industries', 'locationTree', 'all_location', 'dataerror'));
        $this->set('_serialize', ['listing']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Listing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $data = $this->add($id);
        if (empty($data)) {
            $this->render("add");
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Listing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $listing = $this->Listings->get($id);
        if ($this->Listings->delete($listing)) {
            $this->Flash->success(__('The listing has been deleted.'));
        } else {
            $this->Flash->error(__('The listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isempty($locationId = NULL)
    {

        if ($locationId != "") {
            $locations = $this->Locations->find('path', ['for' => $locationId])->select(['Locations.id', 'Locations.title'])->toArray();
            return $locations;
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
            $status = $this->Listings->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Listings->save($status)) {
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
