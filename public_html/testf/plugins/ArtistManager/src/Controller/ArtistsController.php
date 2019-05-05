<?php
namespace ArtistManager\Controller;

use ArtistManager\Controller\AppController;

/**
 * Artists Controller
 *
 * @property \ArtistManager\Model\Table\ArtistsTable $Artists
 *
 * @method \ArtistManager\Model\Entity\Artist[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArtistsController extends AppController
{
    
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index','view','getArtists','getArtistsName']);
//        $this->Banner = TableRegistry::get('BannerManager.Banners');
//        $this->Artist = TableRegistry::get('ArtistManager.Artists');
//        $_banner = str_replace("\\", "/", $this->Banner->_dirshow);
//        $this->set(compact('_banner'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $artists = $this->paginate($this->Artists);

        $this->set(compact('artists'));
    }

    /**
     * View method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $artist = $this->Artists->get($id, [
            'contain' => ['Groups']
        ]);

        $this->set('artist', $artist);
    }

    
    
    public function getArtists($artist_id = null) 
    {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            //dump($this->request->data);die;
            if($this->request->data['artist_name']){
                $artist_name = trim($this->request->data['artist_name']);
            }
            $artist_name_not = '';
            $checkArtist = [];
            if($this->request->data['artist_name_not'] != ''){
                $artist_name_not = trim($this->request->data['artist_name_not']);
                $checkArtist = $this->Artists->find('Active')->where(['Artists.name LIKE' => $artist_name_not.'%'])->first();
                $checkGroups = $this->Artists->Groups->find()->where(['Groups.name LIKE' => $artist_name_not.'%'])->first();
            }
            
            //pr($checkGroups);die;
            $finalData = [];
            $query = $this->Artists->find('list',[
                        'keyField' => 'id',
                        'valueField' => 'name'
                    ], ['limit' => 200])->find('Active');
            if(!empty($artist_name)){     
                $query->where(['Artists.name LIKE' => $artist_name.'%']);
                if(!empty($artist_name_not)){
                    
                    $query->andwhere(['Artists.name !=' => $artist_name_not]);
                }
                if(!empty($checkGroups)){
                     $query->andwhere(['Artists.id !=' => $checkGroups->artist_id]);
                }
            }else{
                $query->where(['Artists.name LIKE' => $artist_name.'%']);
            }
            //dump($query);die;
            $artists = $query->toArray();
            foreach ($artists as $key => $artist) {
                $finalData[] = ['id' =>$key, 'name' =>$artist];
                //$finalData['id'] = $key;
                //$finalData[ ] = $artist;
            }
            $groups = [];
            $gquery = $this->Artists->Groups->find('list',[
                               'keyField' => 'artist_id',
                               'valueField' => 'name'
                           ], ['limit' => 200]);
            if(!empty($checkArtist)){
                if(!empty($artist_name)){     
                    $gquery->where(['Groups.name LIKE' => $artist_name.'%','Groups.artist_id !=' => $checkArtist->id]);
                    if(!empty($artist_name_not)){
                        $gquery->andwhere(['Groups.name !=' => $artist_name_not,'Groups.artist_id !=' => $checkArtist->id]);
                    }
                    if(!empty($checkGroups)){
                        $gquery->andwhere(['Groups.artist_id !=' => $checkGroups->artist_id]);
                   }
                }else{
                    $gquery->where(['Groups.name LIKE' => $artist_name.'%','Groups.artist_id !=' => $checkArtist->id]);
                }
            }else{
                if(!empty($artist_name)){     
                    $gquery->where(['Groups.name LIKE' => $artist_name.'%']);
                    if(!empty($artist_name_not)){
                        $gquery->andwhere(['Groups.name !=' => $artist_name_not]);
                    }
                    if(!empty($checkGroups)){
                        $gquery->andwhere(['Groups.artist_id !=' => $checkGroups->artist_id]);
                   }
                }else{
                    $gquery->where(['Groups.name LIKE' => $artist_name.'%']);
                }
            }
            $groups = $gquery->toArray();
            //pr($groups);die;
             foreach ($groups as $key => $group) {
                $finalData[] = ['id' =>$key, 'name' =>$group];
            }
            //pr($finalData);die;
            echo json_encode($finalData);exit;
        }
    }
    
    
//    public function getArtists($artist_id = null) 
//    {
//        $this->layout = 'ajax';
//        if ($this->request->is('ajax')) {
//            
//            if($this->request->data['artist_name']){
//                $artist_name = trim($this->request->data['artist_name']);
//            }
//            if(isset($this->request->data['ida'])){
//                $ida = $this->request->data['ida'];
//            }
//            
//            $finalData = [];
//            $query = $this->Artists->find();
//            if(!empty($artist_name) && $ida){     
//                $query->where(['Artists.name LIKE' => $artist_name.'%']);
//                $query->andwhere(['Artists.id !=' => $ida]);
//            }else{
//                $query->where(['Artists.name LIKE' => $artist_name.'%']);
//            }
//            //dump($query);die;
//            if($artist_id){
//                $query->where(['Artists.id !=' => $artist_id]);
//            }
//            $query->find('Active');
//            $artists = $query->toArray();
//
//            $this->set(compact('artists'));
//        }
//    }
    
    

}
