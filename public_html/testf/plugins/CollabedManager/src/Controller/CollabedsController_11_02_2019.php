<?php
namespace CollabedManager\Controller;

use CollabedManager\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\MailerAwareTrait;
/**
 * Collabeds Controller
 *
 * @property \CollabedManager\Model\Table\CollabedsTable $Collabeds
 *
 * @method \CollabedManager\Model\Entity\Collabed[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CollabedsController extends AppController
{
    use MailerAwareTrait;
    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Collabe');
        //$this->Auth->allow(['index','view','add','getCollabeds','create','collabeApprovel' ,'getCollabedsByName']);
        $this->Auth->allow();
        $this->Banner = TableRegistry::get('BannerManager.Banners');
        $this->Artists = TableRegistry::get('ArtistManager.Artists');
        $_banner = str_replace("\\", "/", $this->Banner->_dir);
        $_dir = str_replace("\\", "/", $this->Collabeds->_dir);
        $this->set(compact('_dir','_banner'));
        
        $this->Groups = TableRegistry::get('ArtistManager.Groups');
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if($this->request->getQuery('search')) {
            $artists = $this->Artists->find()->where(['name LIKE' => '%'.$this->request->getQuery('search').'%'])->toList();
        }
        
        $allCollabeCount = $this->Collabeds->find('active')->count();
        $query = $this->Collabeds->find()->find('active')->find('artistactive');
        $query->find('filter', $this->request->getQuery());
        $query->select(['total'=> $query->func()->count('CollabedLikes.collabed_id')])
            ->autoFields(true)
            ->contain(['CollabedLikes','Artistsone','Artiststwo'])
            ->leftJoinWith('CollabedLikes')
            ->group(['Collabeds.id']);
            if($this->request->query('like') == 'desc'){
                $query->order(['total' => 'desc']);
            }elseif($this->request->query('like') == 'new'){
                $query->order(['Collabeds.id' => 'desc']);
            }elseif($this->request->query('like') == 'random'){
                $query->order('rand()');
            }else{
               $query->order(['Collabeds.id' => 'desc']);
            }
            $query->limit($this->ConfigSettings['FRONT_PAGE_LIMIT']);
        $collabeds = $query->toArray();
        //pr($query);die;
        $this->set(compact('collabeds','allCollabeCount'));
    }
    
	/**
     * Ajax Load on index page method
     *
     * @return \Cake\Http\Response|void
     */
    public function ajaxIndex()
    {
        $this->layout = 'browse';	 
        if($this->request->getQuery('search')) {
            $artists = $this->Artists->find()->where(['name LIKE' => '%'.$this->request->getQuery('search').'%'])->toList();
        }
        
        $allCollabeCount = $this->Collabeds->find('active')->count();
        $query = $this->Collabeds->find()->find('active')->find('artistactive');
        $query->find('filter', $this->request->getQuery());
        $query->select(['total'=> $query->func()->count('CollabedLikes.collabed_id')])
            ->autoFields(true)
            ->contain(['CollabedLikes','Artistsone','Artiststwo'])
            ->leftJoinWith('CollabedLikes')
            ->group(['Collabeds.id']);
            if($this->request->query('like') == 'desc'){
                $query->order(['total' => 'desc']);
            }elseif($this->request->query('like') == 'new'){
                $query->order(['Collabeds.id' => 'desc']);
            }elseif($this->request->query('like') == 'random'){
                $query->order('rand()');
            }else{
               $query->order(['Collabeds.id' => 'desc']); 
            }
            $query->limit($this->ConfigSettings['FRONT_PAGE_LIMIT']);
        $collabeds = $query->toArray();
        //pr($collabeds);die;
        $this->set(compact('collabeds','allCollabeCount'));
    }
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function ajaxCollabe(){
        //$this->layout = 'ajax';
        if ($this->request->is('ajax')) {
            $offset = $this->request->getQuery('skipCollabeds');
            $artist_ids = [];
            $group_artist_ids = [];
            //pr($this->request->getQuery());die;
            if($this->request->getQuery('search_keyword')) {
                $search = $this->request->getQuery('search_keyword');
                    $artist_qury = $this->Artists->find('active')
                            ->select(['Artists.id'])
                            ->where(['Artists.name LIKE'=>'%'.trim($search).'%']);
                    $group_qury = $this->Artists->Groups->find()
                            ->select(['Groups.artist_id'])
                            ->where(['Groups.name LIKE'=>'%'.trim($search).'%','Artists.status' => 1])
                            ->group(['Groups.artist_id'])
                            ->contain(['Artists']);
                
                
                $groupData = $group_qury->toArray();
                $artistData = $artist_qury->toArray();
               
                if($artist_qury->count()){
                    foreach ($artistData as $ad){
                        $artist_ids[] = $ad->id;
                    }
                }
                if($group_qury->count()){
                    foreach ($groupData as $gd){
                        $group_artist_ids[] = $gd->artist_id;
                    }
                }
                //pr($group_artist_ids);die;
            }else{
                $artist_qury = $this->Artists->find('active')
                        ->select(['Artists.id']);
                $group_qury = $this->Artists->Groups->find()
                        ->select(['Groups.artist_id'])
                        ->where(['Artists.status' => 1])
                        ->group(['Groups.artist_id'])
                        ->contain(['Artists']);
                $groupData = $group_qury->toArray();
                $artistData = $artist_qury->toArray();
                if($artist_qury->count()){
                    foreach ($artistData as $ad){
                        $artist_ids[] = $ad->id;
                    }
                }
                if($group_qury->count()){
                    foreach ($groupData as $gd){
                        $group_artist_ids[] = $gd->artist_id;
                    }
                }
            }
        
        $final_artis = array_unique(array_merge($group_artist_ids,$artist_ids), SORT_REGULAR);
        
        if($this->request->getQuery('like') == 'desc'){
            $type = 'DESC';
        }else{
            $type = 'ASC';
        }
        $collabeds = [];
        //$allCollabeCount = $this->Collabeds->find()->count();
        if(count($final_artis) > 0){
            
            $query = $this->Collabeds->find('active');//->find('artistactive');
            //$query->find('filter', $this->request->getQuery());
            $query->select(['total'=> $query->func()->count('CollabedLikes.collabed_id')])
                ->autoFields(true);    
                $query->where(['Collabeds.artist_1 IN ' => $final_artis]);
                $query->orWhere(['Collabeds.artist_2 IN ' => $final_artis]);
                $query->contain(['CollabedLikes','Artistsone','Artiststwo'])
                ->leftJoinWith('CollabedLikes')
                ->group(['Collabeds.id']);
                if($this->request->query('like') == 'desc'){
                    $query->order(['total' => 'desc']);
                }elseif($this->request->query('like') == 'new' || $this->request->query('like') == 'random'){
                    $query->order(['Collabeds.id' => 'desc']);
                }else{
                   $query->order(['total' => 'desc']); 
                }
                $query->limit($this->ConfigSettings['FRONT_PAGE_LIMIT'])->offset($offset);
            $collabeds = $query->toArray();
            $allCollabeCount = $query->count();
            
        }
        //pr($query);die;
        $this->set(compact('collabeds','allCollabeCount'));
            
        }
    }

    /**
     * View method
     *
     * @param string|null $id Collabed id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $collabed = $this->Collabeds->get($id, [
            'contain' => ['Artistsone','Artiststwo','Banners']
        ]);
        
        $this->set('collabed', $collabed);
        $this->set('_serialize', ['collabed']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        if(!$id){
            return $this->redirect('/');
        }
        $collabed = $this->Collabeds->newEntity();
        
        if ($this->request->is('post')) {
            $collabed = $this->Collabeds->patchEntity($collabed, $this->request->getData());
            if ($this->Collabeds->save($collabed)) {
                $this->Flash->success(__('The collabed has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The collabed could not be saved. Please, try again.'));
        }
        $finalData = [];
        $banner = $this->Banner->get($id);
        $artists = $this->Artists->find('list',[
                        'keyField' => 'id',
                        'valueField' => 'name'
                    ], ['limit' => 200])->find('Active')->toArray();
        foreach ($artists as $key => $artist) {
                $finalData[] = array('id' => $key, 'name' =>$artist);
                //$finalData['id'] = $key;
                //$finalData[ ] = $artist;
            }
            
        $artists = json_encode($finalData);
        
        $this->set(compact('collabed', 'banner','artists'));
    }
    
    /**
     * Create method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function create()
    {
        
        $this->autoRender = false;
        if(!$this->request->getQuery('aone') && !$this->request->getQuery('atwo') && !$this->request->getQuery('banner')){
            return $this->redirect('/');
        }
        
        $itemInfoArr = [];
        $artistone_id = $this->request->getQuery('aone');
        $article_one = $this->Artists->find()->where(['id' => $artistone_id])->first();
        
        $artisttwo_id = $this->request->getQuery('atwo');
        $article_two = $this->Artists->find()->where(['id' => $artisttwo_id])->first();
        
        $banner_id = $this->request->getQuery('banner');
        $banner = $this->Banner->find()->select(['image'])->where(['id' => $banner_id])->first();
        
        $itemInfoArr['article_one'] = $article_one->name;
        $itemInfoArr['article_two'] = $article_two->name;
        $itemInfoArr['banner'] = $banner->image;
        $itemInfoArr['banner_path'] = str_replace("\\", "/", $this->Banner->_dir);
        $itemInfoArr['collabe_path'] = str_replace("\\", "/", $this->Collabeds->_dir);
        
        $collabe = $this->Collabe->CreateCollabe($itemInfoArr);
        $collabed = $this->Collabeds->newEntity();
        
        $requestData = [];
        
        $requestData['artist_1'] =  $artistone_id;
        $requestData['artist_2'] =  $artisttwo_id;
        $requestData['banner_id'] =  $banner_id;
        $requestData['image'] =  $collabe;
        $requestData['status'] =  true;

        $collabed = $this->Collabeds->patchEntity($collabed, $requestData);
        
        if ($this->Collabeds->save($collabed)) {
            $this->Flash->success(__('The collabed has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
    }
    /**
     * collabeApprovel method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function collabeApprovel()
    {
        
        $this->autoRender = false;
        if(!$this->request->getQuery('aone') && !$this->request->getQuery('atwo') && !$this->request->getQuery('banner')){
            return $this->redirect('/');
        }
        
        $itemInfoArr = [];
        $one_new = false;
        $two_new = false;
        //pr($this->request->getQuery());
        if($this->request->getQuery('aone')) {
            $artisonerequest = [];
            $artistone = $this->request->getQuery('aone');
            $article_one = $this->Artists->find()->where(['name' => trim($artistone)])->first();
            $article_group_one = $this->Artists->Groups->find()->where(['name' => trim($artistone)])->first();
            
            /*Check First Artist*/
            if(!empty($article_one) && $article_one->status) {
                $artistone_id = $article_one->id;
                $artistone = $article_one->name;
                $one_new = true;
            } elseif(!empty($article_one) && !$article_one->status) {
                $artistone_id = $article_one->id;
                $artistone = $article_one->name;
            }elseif(!empty($article_group_one)) {
                $artistone_id = $article_group_one->artist_id;
                $artistone = $article_group_one->name;
                $one_new = true;
            } else {
                $artist1 = $this->Artists->newEntity();
                $artisonerequest['name'] = $artistone;
                $artisonerequest['status'] = false;
                $artist1 = $this->Artists->patchEntity($artist1, $artisonerequest);
                $result1 = $this->Artists->save($artist1);
                $artistone_id = $result1->id;
            }
        }
        
        if($this->request->getQuery('atwo')) {
            $artistworequest = [];
            $artisttwo = $this->request->getQuery('atwo');
            $article_two = $this->Artists->find()->where(['name' => trim($artisttwo)])->first();
            $article_group_two = $this->Artists->Groups->find()->where(['name' => trim($artisttwo)])->first();
            //pr($article_two);die;
            /*Check Second Artist*/
            if(!empty($article_two) && $article_two->status){
                $artisttwo_id = $article_two->id;
                $artisttwo = $article_two->name;
                $two_new = true;
            }elseif(!empty($article_two) && !$article_two->status) {
                $artisttwo_id = $article_two->id;
                $artisttwo = $article_two->name;
            }elseif(!empty($article_group_two)){
                $artisttwo_id = $article_group_two->artist_id;
                $artisttwo = $article_group_two->name;
                $two_new = true;
            } else {
                $artist2 = $this->Artists->newEntity();            
                $artistworequest['name'] = $artisttwo;
                $artistworequest['status'] = false;
                $artist2 = $this->Artists->patchEntity($artist2, $artistworequest);
                $result2 = $this->Artists->save($artist2);
                $artisttwo_id = $result2->id;
            }
        }
        
        $banner_id = $this->request->getQuery('banner');
        $banner = $this->Banner->find()->select(['image'])->where(['id' => $banner_id])->first();
        
        $itemInfoArr['article_one'] = $artistone;
        $itemInfoArr['article_two'] = $artisttwo;
        $itemInfoArr['banner'] = $banner->image;
        $itemInfoArr['banner_path'] = str_replace("\\", "/", $this->Banner->_dir);
        $itemInfoArr['collabe_path'] = str_replace("\\", "/", $this->Collabeds->_dir);
//        dump($two_new);
//        dump($one_new);
//        
//        pr($artistone_id);
//        pr($artisttwo_id);
//        pr($itemInfoArr);die;
        /*Create Collab*/
        $collabe = $this->Collabe->CreateCollabe($itemInfoArr);
        
        /*New Entity Collab*/
        $collabed = $this->Collabeds->newEntity();
        if(!$two_new || !$one_new){
            $this->getMailer('Manu')->send('collabe', [$itemInfoArr]);
        }
        $requestData = [];
        
        $requestData['artist_1'] =  $artistone_id;
        $requestData['artist_2'] =  $artisttwo_id;
        $requestData['banner_id'] =  $banner_id;
        $requestData['image'] =  $collabe;
        
        //dump(!$two_new || !$one_new);die;
        
        if(!$two_new || !$one_new){
            $requestData['status'] =  0;
        }else{
            $requestData['status'] =  1;
        }
        
        /*Patch Entity Collab*/
        $collabed = $this->Collabeds->patchEntity($collabed, $requestData);
        
        //pr($collabed);die;
        if ($this->Collabeds->save($collabed)) {
            if(!$two_new || !$one_new){
                $this->Flash->success(__('Collabe is not in our database. Allow our team 24 hours to review this artist.'));
            }else{
                $this->Flash->success(__('The collabed has been saved.'));
            }
            return $this->redirect(['action' => 'index']);
        }
    }
      
    public function getCollabedsByName()
    {
        $this->layout = 'ajax';
        if ($this->request->is('ajax')) {
            $artistone_name = '';
            $artisttwo_name = '';
            $matchArtistId1 = [];
            $matchArtistId2 = [];
            $artistsTwo = [];
            $artistsOne = [];
            $artistsOne2 = [];
            $artistsTwo2 = [];
            $collabeds = [];
            if(isset($this->request->data['artistone_name'])){
                $artistone_name = trim($this->request->data['artistone_name']);
            }
            if(isset($this->request->data['artisttwo_name'])){
                $artisttwo_name = trim($this->request->data['artisttwo_name']);
            }
            
            if(isset($this->request->data['type'])){
                $type = $this->request->data['type'];
            }
            $banner_id = $this->request->data['banner_id'];
            $banner = $this->Banner->get($banner_id);
            if($artistone_name != $artisttwo_name){
                //dump($artistone_name);dump($artisttwo_name);
                if(!empty($artistone_name)) {
                    $artistsOne = $this->Artists->find('list',[
                                'keyField' => 'id',
                                'valueField' => 'name'
                            ])->where(['Artists.name' => strtolower($artistone_name)])
                            ->toArray();
                }
                if(!empty($artisttwo_name)) {
                    $artistsTwo = $this->Artists->find('list',[
                                'keyField' => 'id',
                                'valueField' => 'name'
                            ])
                            ->where(['Artists.name' => strtolower($artisttwo_name)])
                            ->toArray();
                    
                }
                //dump($artistsOne);dump($artistsTwo);
                $matchArtistId1 = array_keys($artistsOne);
                $matchArtistId2 = array_keys($artistsTwo);
                
                $artistsOne2 = $this->Groups->find()->contain(['Artists'])->autoFields(true)
                    ->where(['Groups.name' => $artistone_name])
                    ->toArray();
                $artisAname = '';
                $matchArtistsOneId1 = [];
                if(!empty($artistsOne2)){
                    foreach ($artistsOne2 as $aO2){
                        if($aO2->artist){
                            $matchArtistsOneId1[] = $aO2->artist->id;
                            $artisAname = $aO2->artist->name;
                        }
                    }
                }
                //pr($artistsOne2ids);die;
                $artistsTwo2 = $this->Groups->find()->contain(['Artists'])->autoFields(true)
                    ->where(['Groups.name' => strtolower($artisttwo_name)])
                    ->toArray();
                $artisBname = '';
                $matchArtistsTwoId2 = [];
                if(!empty($artistsTwo2)){
                    foreach ($artistsTwo2 as $aT2){
                        if($aT2->artist){
                            $matchArtistsTwoId2[] = $aT2->artist->id;
                            $artisBname = $aT2->artist->name;
                        }
                    }
                }
//                pr($artistsOne2ids);die;
//                dump($artistsOne2);dump($artistsTwo2);die;
//                $matchArtistsOneId1 = array_keys($artistsOne2ids);
//                $matchArtistsTwoId2 = array_keys($artistsTwo2ids);
//                dump($matchArtistsOneId1);dump($matchArtistsTwoId2);
//                pr($matchArtistsOneId1);
//                pr($matchArtistsTwoId2);
                $matchArtistId1 = array_merge($matchArtistId1, $matchArtistsOneId1);
                
                $matchArtistId2 = array_merge($matchArtistId2, $matchArtistsTwoId2);
                $artistsOne = array_merge($artistsOne,$artistsOne2);
                $artistsTwo = array_merge($artistsTwo,$artistsTwo2);
//                pr($matchArtistId1);pr($matchArtistId2);die;
//                pr($matchArtistId1);
//                pr($matchArtistId2);die;
//                pr($artistsOne);
//                pr($artistsTwo);
//                die;
//                $matchArtistIdNew1 = array_merge($matchArtistId1, $matchArtistsOneId1);
//                $matchArtistIdNew2 = array_merge($matchArtistId2, $matchArtistsTwoId2);
//                $matchArtistIdNew1 = array_unique($matchArtistIdNew1);
//                $matchArtistIdNew2 = array_unique($matchArtistIdNew2);
//                pr($matchArtistIdNew1);        
//                pr($matchArtistIdNew2);die;

//                die;

                if((!empty($artistsOne) && !empty($artistsTwo))) {
                     //pr($matchArtistId1);pr($matchArtistId2);
                    //die('okk');
                    $query = $this->Collabeds->find();//->find('active');
                    $query->where(['Collabeds.banner_id' => $banner_id]);
                    $query->andWhere(['OR'=>[
                                    ['Collabeds.artist_1 IN ' => $matchArtistId1,'Collabeds.artist_2 IN ' => $matchArtistId2],
                                    ['Collabeds.artist_2 IN ' => $matchArtistId1,'Collabeds.artist_1 IN ' => $matchArtistId2]
                                ]
                            ]);
                    $query->select(['total'=> $query->func()->count('CollabedLikes.collabed_id')])
                        ->autoFields(true)
                        ->contain(['CollabedLikes','Artistsone','Artiststwo'])
                        ->leftJoinWith('CollabedLikes')
                        ->group(['Collabeds.id'])
                        ->order(['total'=>'DESC']);
                    $collabeds = $query->toArray(); 
                    //dump($query);die;
                } else if((!empty($artistsOne) && empty($artistsTwo)) && empty($artisttwo_name)) {
                    //pr($matchArtistId1);pr($matchArtistId2);
                    //die('jai');
                    $query = $this->Collabeds->find();//->find('active');
                    $query->where(['Collabeds.banner_id' => $banner_id]);
                    $query->andwhere(['OR'=>['Collabeds.artist_1 IN ' => $matchArtistId1,'Collabeds.artist_2 IN ' => $matchArtistId1]]);
                    $query->select(['total'=> $query->func()->count('CollabedLikes.collabed_id')])
                        ->autoFields(true)
                        ->contain(['CollabedLikes','Artistsone','Artiststwo'])
                        ->leftJoinWith('CollabedLikes')
                        ->group(['Collabeds.id'])
                        ->order(['total'=>'DESC']);
                    $collabeds = $query->toArray();
                    //pr($collabeds);die;
                }else if((!empty($artistsTwo) && empty($artistsOne)) && empty ($artistone_name)) {
                    //pr($matchArtistId1);pr($matchArtistId2);
                    //die('veru');
                    $query = $this->Collabeds->find();//->find('active');
                    $query->where(['Collabeds.banner_id' => $banner_id]);
                    $query->andwhere(['OR'=>['Collabeds.artist_1 IN ' => $matchArtistId2,'Collabeds.artist_2 IN ' => $matchArtistId2]]);
                    $query->select(['total'=> $query->func()->count('CollabedLikes.collabed_id')])
                        ->autoFields(true)
                        ->contain(['CollabedLikes','Artistsone','Artiststwo'])
                        ->leftJoinWith('CollabedLikes')
                        ->group(['Collabeds.id'])
                        ->order(['total'=>'DESC']);
                    $collabeds = $query->toArray(); 
                    //pr($query);die;
                }
            }
//            pr($artistsOne);
//            pr($artistsTwo);die;
            //pr($banner);die;
           //pr($collabeds);die;
            $this->set(compact('banner','banner_id' ,'collabeds','artistone_name','artisttwo_name','artistsOne','artistsTwo','artisBname','artisAname'));
        }
    }
    
    
    
    public function getCollabeds() 
    {
        //$this->autoRender = false;
         $this->layout = 'ajax';
        if ($this->request->is('ajax')) {
            $artistone_id = '';
            $artisttwo_id = '';
            $artistone_name  = '';
            $artisttwo_name  = '';
            $collabeds = [];
            if(isset($this->request->data['artistone_id'])){
                $artistone_id = $this->request->data['artistone_id'];
            }
            if(isset($this->request->data['artistone_name'])){
                $artistone_name = $this->request->data['artistone_name'];
            }
            if(isset($this->request->data['artisttwo_id'])){
                $artisttwo_id = $this->request->data['artisttwo_id'];
            }
            if(isset($this->request->data['artisttwo_name'])){
                $artisttwo_name = $this->request->data['artisttwo_name'];
            }
            $banner_id = $this->request->data['banner_id'];
            $banner = $this->Banner->get($banner_id);
            
            if((!empty($artistone_id) && !empty($artisttwo_id)) && ($artistone_id != $artisttwo_id)) {
                $query = $this->Collabeds->find()->find('active');
                    $query->where(['Collabeds.banner_id' => $banner_id]);
                    $query->andWhere(['OR'=>[
                            ['Collabeds.artist_1' => $artistone_id,'Collabeds.artist_2' => $artisttwo_id],
                            ['Collabeds.artist_2' => $artistone_id,'Collabeds.artist_1' => $artisttwo_id]
                        ]
                    ]);
                    $query->select(['total'=> $query->func()->count('CollabedLikes.collabed_id')])
                        ->autoFields(true)
                        ->contain(['CollabedLikes'])
                        ->leftJoinWith('CollabedLikes')
                        ->group(['Collabeds.id'])
                        ->order(['total'=>'DESC']);
                    //dump($query);die;
                    $collabeds = $query->toArray();
            }else if(!empty($artistone_id) && empty($artisttwo_id)){
                $query = $this->Collabeds->find()->find('active');
                $query->where(['Collabeds.artist_1' => $artistone_id]);
                $query->orwhere(['Collabeds.artist_2' => $artistone_id]);
                $query->select(['total'=> $query->func()->count('CollabedLikes.collabed_id')])
                    ->autoFields(true)
                    ->contain(['CollabedLikes'])
                    ->leftJoinWith('CollabedLikes')
                    ->group(['Collabeds.id'])
                    ->order(['total'=>'DESC']);
                $collabeds = $query->toArray();
            }else if(!empty($artisttwo_id) && empty($artistone_id)){
                $query = $this->Collabeds->find()->find('active');
                $query->where(['Collabeds.artist_1' => $artisttwo_id]);
                $query->orwhere(['Collabeds.artist_2' => $artisttwo_id]);
                $query->select(['total'=> $query->func()->count('CollabedLikes.collabed_id')])
                    ->autoFields(true)
                    ->contain(['CollabedLikes'])
                    ->leftJoinWith('CollabedLikes')
                    ->group(['Collabeds.id'])
                    ->order(['total'=>'DESC']);
                $collabeds = $query->toArray();
            }
            
            $article_one = [];
            $article_two = [];
            if(count($collabeds) == 0){
                if($artistone_id){
                    $article_one = $this->Artists->find()->where(['id' => $artistone_id])->first();
                }    
                if($artisttwo_id){
                    $article_two = $this->Artists->find()->where(['id' => $artisttwo_id])->first();
                }
            }
            //pr($artisttwo_name);pr($artistone_name);die;
            $this->set(compact('collabeds','article_one','article_two','banner_id','banner','artistone_name','artisttwo_name','artisttwo_id','artistone_id'));
        }
    }
    
}
