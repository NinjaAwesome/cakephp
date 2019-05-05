<?php
if (!empty($records)) {
    foreach ($records AS $key => $val) {
        if($key!=$id){
        $parentLinks[] = $this->Html->link($val, ['controller' => 'locations','action' => 'view', $key]);
        }
    }
}
echo !empty($parentLinks) ? implode(' > ', $parentLinks)  : 'N/A';
