<?php
namespace CollabedManager\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
/**
 * Collabeds cell
 */
class CollabedCell extends Cell{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($collabed_id)
    {
        $thisIp = $this->request->clientIp();
        $this->CollabedLikes = TableRegistry::get('CollabedLikes');
        $total = $this->CollabedLikes->find()
                ->where(['collabed_id' => $collabed_id])->count();
        $check = $this->CollabedLikes->find()
                ->where(['collabed_id' => $collabed_id, 'ip_address' => $thisIp])->toArray();
        
        $this->set(compact('collabed_id','check','total'));
    }
}
