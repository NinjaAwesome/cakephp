<?php
namespace BusinessDirectoryManager\Controller\Admin;

use BusinessDirectoryManager\Controller\AppController;

/**
 * JobSeekers Controller
 *
 * @property \BusinessDirectoryManager\Model\Table\JobSeekersTable $JobSeekers
 *
 * @method \BusinessDirectoryManager\Model\Entity\JobSeeker[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JobSeekersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function setSheduleStatus($id = null){  
        if($id){
            $interview = $this->JobSeekers->get($id, [
                'contain' => []
            ]);
          }
          $JobSeekers->schedule_status=1;           
          
          $this->JobSeekers->save($JobSeekers);
          return; 
       }
    
    
    public function download($jobSeeker_id = null) {
       if(!$jobSeeker_id){
            return $this->redirect($this->referer());
        }
        $jobSeeker = $this->JobSeekers->get($jobSeeker_id);
        if(empty($jobSeeker->attachment)){
            return $this->redirect($this->referer());
        }
        $url = _BASE_."uploads/".$jobSeeker->attachment;
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_HEADER, true); 
        curl_setopt($ch, CURLOPT_NOBODY, true); // make it a HEAD request
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        $head = curl_exec($ch);
        $mimeType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        $path = parse_url($url, PHP_URL_PATH);
        $filename = substr($path, strrpos($path, '/') + 1);
        curl_close($ch);         
        header('Content-Type: '.$mimeType);
        header('Content-Disposition: attachment; filename="'.$filename. '";' );
        header('Content-Length: '.$size);
        readfile($url);
        exit();
    }
    /**
     * index method
     *
     * @param string|null $id Job Seeker id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function index()
     {  $query = $this->JobSeekers->find();
        $query->contain(['Jobs']);
        $query->find('filter', $this->request->getQuery());
        $options['order'] = ['JobSeekers.id' => 'DESC'];
        $options['limit'] = $this->ConfigSettings['ADMIN_PAGE_LIMIT'];
        $this->paginate = $options;
        $jobSeekers = $this->paginate($query);
        $this->set(compact('jobSeekers'));
        $this->set('_serialize', ['jobSeekers']);
    }

    /**
     * View method
     *
     * @param string|null $id Job Seeker id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function view($id = null)
    {
        $jobSeeker = $this->JobSeekers->get($id, [
            'contain' => ['Jobs']
        ]);      
        $this->set('jobSeeker', $jobSeeker);
        $this->set('_serialize', ['jobSeeker']);
    }



    /**
     * Delete method
     *
     * @param string|null $id Job Seeker id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $jobSeeker = $this->JobSeekers->get($id);
        if ($this->JobSeekers->delete($jobSeeker)) {
            $this->Flash->success(__('The job seeker has been deleted.'));
        } else {
            $this->Flash->error(__('The job seeker could not be deleted. Please, try again.'));
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
    public function changeFlag()
    {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->JobSeekers->newEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->JobSeekers->save($status)) {
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
