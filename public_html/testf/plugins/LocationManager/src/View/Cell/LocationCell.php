<?php
namespace LocationManager\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;
/**
 * Location cell
 */
class LocationCell extends Cell
{

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
    public function display()
    {
    }
    
    public function getParentLocations($id = null) {
        $this->Locations = TableRegistry::get('LocationManager.Locations');
        $records = $this->Locations->getParentLocationsList($id);
        $this->set(compact('records','id'));
    }
}
