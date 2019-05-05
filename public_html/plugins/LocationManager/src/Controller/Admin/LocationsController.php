<?php namespace LocationManager\Controller\Admin;

use LocationManager\Controller\AppController;

/**
 * Locations Controller
 *
 * @property \LocationManager\Model\Table\LocationsTable $Locations
 *
 * @method \LocationManager\Model\Entity\Location[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LocationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Locations->find()->find('filter', $this->request->getQuery());
        $query->contain(['ParentLocations']);
        $options['order'] = ['lft' => 'ASC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $locations = $this->paginate($query);
        $parentLocations = $this->Locations->ParentLocations->find('treeList');
        $this->set(compact('locations', 'parentLocations'));
        $this->set('_serialize', ['locations']);
    }

    /**
     * View method
     *
     * @param string|null $id Location id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $location = $this->Locations->get($id, [
            'contain' => ['ParentLocations', 'ChildLocations']
        ]);

        $this->set('location', $location);
        $this->set('_serialize', ['location']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Location id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null)
    {
        if ($id) {
            $location = $this->Locations->get($id, [
                'contain' => []
            ]);
        } else {
            $location = $this->Locations->newEntity();
        }
        if ($this->request->is(['post', 'patch', 'put'])) {
            $location = $this->Locations->patchEntity($location, $this->request->getData());
            if ($this->Locations->save($location)) {
                $this->Flash->success(__('The location has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The location could not be saved. Please, try again.'));
        }

        $parentLocations = $this->Locations->ParentLocations->find('treeList');
        $this->set(compact('location', 'parentLocations'));
        $this->set('_serialize', ['location']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Location id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $location = $this->Locations->get($id);
        if ($this->Locations->delete($location)) {
            $this->Flash->success(__('The location has been deleted.'));
        } else {
            $this->Flash->error(__('The location could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * ChangeFlag method
     *
     * @param string|null &id Admin User id.
     * @param string|null &id field those update table field.
     * @param string|null &status Admin status.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeFlag()
    {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->Locations->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->Locations->save($status)) {
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
    
    
    public function getList() {
        $parent_id  = $this->request->getQuery(['parent_id']);
        $query = $this->Locations->find()->select()->where(['parent_id'=>$parent_id])->toArray();
        $records = $query;
        $locations = [];
        foreach ($records as $loc) {
            $prt = '';
            if (!empty($loc->parent_id)) {
                $parents = $this->Locations->getParentLocationsList($loc->id);
                foreach ($parents as $k => $p) {
                    if ($k == $loc->id) {
                        unset($parents[$k]);
                    }
                }
                krsort($parents);
                $prt = implode(", ", $parents);
            }
            $code = !empty($loc->iso_alpha2_code) ? " (" . $loc->iso_alpha2_code . ")" : (!empty($loc->iso_alpha3_code) ? " (" . $loc->iso_alpha3_code . ")" : "");
            $locations[] = array("id" => $loc->id, "slug" => $loc->slug, "title" => $loc->title . $code, "latitude" => $loc->latitude, "longitude" => $loc->longitude, "parent" => $prt);
        }
       
        $this->set(compact('locations'));
        $this->set('_serialize', ['locations']);
    }
}
