<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Utility\Text;
use Cake\Utility\Inflector;
$act = strtolower(trim($this->request->getParam('action')));
$ctrl = Text::slug(Inflector::underscore($this->request->getParam('controller')));
$slugedAct = Text::slug(Inflector::underscore($this->request->getParam('action')));
$header_class = '';
if($slugedAct == 'add' && $ctrl == 'collabeds'){
    $header_class = ' header-index';
}
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        #collabthem | <?php echo isset($title_new) ? $title_new : $this->fetch('title'); ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->css([
        // 'bootstrap.min.css', //Bootstrap 3.3.7
        //'/assets/bower_components/select2/dist/select2.min', 
        //'/assets/bower_components/select2/dist/select2-bootstrap.min', 
        //'base.css',
        'jquery-ui.css',
        'animate.css',
        'main.css',
        'style.css',
        'developer.css',
        
    ]) ?>
    <?= $this->fetch('css') ?>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
    <script type="text/javascript">
        var baseurl = '<?php echo $this->request->getAttribute("webroot"); ?>';
        var CLIENT_TOKEN   =   '<?php  echo $this->request->getParam('_csrfToken'); ?>';
    </script>
    <style>
        #cover {
            background: url("http://www.aveva.com/Images/ajax-loader.gif") no-repeat scroll center center #FFF;
            position: absolute;
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="header <?= $header_class ?>">
        <?php echo $this->element("header_without_search");  ?>
    </div>
    <div class="mainWpapContainer container-fluid">
        
        <?= $this->fetch('content') ?>
        <a class="fas fa-long-arrow-alt-up btn-up d-none"></a>

        <!-- The Modal -->
        <div class="modal fade modal-comment" id="modalComment">
            <div class="modal-dialog modal-lg m-0 mx-md-auto my-md-5">
                <div class="modal-content border-0">

                <!-- Modal Header -->
                <div class="modal-header align-items-center py-2 px-1 d-flex d-md-none">
                    <a href="" class="close mx-0 col-2" data-dismiss="modal">
                        <i class="fas fa-angle-left lead"></i>
                    </a>
                    <p class="modal-title lead col-8 text-center">Comments</p> 
                    <p class="col-2"></p>  
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    
                    
                </div>

                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div> -->

                </div>
            </div>
        </div>
        

    </div>
    <footer>
        <?php echo $this->element("footer");  ?>
    </footer>
     <?= $this->Html->script([
        '/js/jquery.min',
        '/js/bootstrap',
        '/js/custom.js',
        //'/js/light-autocomplete.js',
        'jquery-ui.js',
        ]); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.6.6/jquery.timeago.js"></script>
    <?= $this->fetch('script') ?>
<script>

</script>
</body>
</html>
