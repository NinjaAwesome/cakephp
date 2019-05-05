<?php
use Cake\Core\Configure;
use Cake\Routing\Router;
?>
<div class="product-sec">
    <div class="container">
        <div class="row">
            <?php foreach ($banners as $banner): ?>
            <div class="col-md-4">
                <div class="product-col">
                    <a href="<?= Router::url(['controller'=>'Collabeds', 'action'=>'add', 'plugin' => 'CollabedManager',$banner->id], true); ?>">
                    <div class="product-textarea-sec" style="background-image: url(<?= $this->request->webroot.$_banner.$banner->image ?>)">
                    
                        <!--<div class="product-textarea-sec">-->
                            <div class="product-logo">
                                <?php //$this->Html->Image('uploads/banners/'.$banner->image,['url' => ['controller' => 'Collabeds', 'action' => 'add','plugin'=>'CollabedManager',$banner->id]]); ?>
                                <?= $this->Html->image(Configure::read('Setting.MAIN_LOGO'), ["alt" => "logo", "style" => ""]); ?>
                            </div>
                        </div>
                    </a>
                    <br><br>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>

