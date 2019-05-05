<?php
namespace BannerManager\Controller\Api;

use BannerManager\Controller\AppController;

/**
 * Banners Controller
 *
 * @property \BannerManager\Model\Table\BannersTable $Banners
 *
 * @method \BannerManager\Model\Entity\Banner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BannersController extends AppController
{

    public function initialize()
    {
		
	    parent::initialize();
		$this->Auth->allow();
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$query = $this->Banners->find();
		$options['order'] = ['Banners.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $banners = $this->paginate($query);
		$this->set(compact('banners'));
        $this->set('_serialize', ['banners']);
    }

    /**
     * View method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $banner = $this->Banners->get($id, [
            'contain' => ['BannerImages']
        ]);

        $this->set('banner', $banner);
        $this->set('_serialize', ['banner']);
    }
    
    /**
     * defaultBanner method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function defaultBanner()
    {
        $banner = $this->Banners->get(1, [
            'contain' => ['BannerImages']
        ]);
        $this->set([
            'message' => '',
            'data' => $banner,
            '_serialize' => ['message','data']
        ]);
    }


   
}
