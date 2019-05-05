<?php 
$class = '';
if(!empty($check)) {
    $class = 'red';
}
?>
<?php //echo  $this->Html->Link('<i class="fa fa-heart '.$class.'"></i>',['controller' => 'CollabedLikes', 'action' => 'index','plugin'=>'CollabedManager',$collabed_id],['escape' => false]); ?>
<?php /*
<a href="javascript:void(0)" class="like-<?= $collabed_id ?>" onclick="return likeOnly(<?= $collabed_id ?>,<?= $total ?>);">
    <i class="fa fa-heart <?= $class ?>"></i>
</a>
 * 
 */?>