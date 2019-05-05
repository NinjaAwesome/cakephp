<?php

use Cake\Core\Configure;
use Cake\Routing\Router;

//pr($this->request->query('search'));die;
?>
<nav class="navbar navbar-main fixed-top navbar-expand-lg navbar-light pt-0 pb-0 bg-white">
    <div class="container-fluid d-block pl-3 pl-lg-5 pr-3 pr-lg-5">
        <div class="row pt-3 pb-4 pb-md-2 pb-xl-3  align-items-center justify-content-end justify-content-md-end justify-content-lg-between flex-wrap flex-lg-nowrap">  
            <?= $this->Html->link($this->Html->image(Configure::read('Setting.MAIN_LOGO'), ["alt" => "logo", "style" => "" , "class" => "img-fluid"]), ['controller' => 'Collabeds', 'action' => 'index', 'plugin' => 'CollabedManager'], ['class' => 'navbar-brand col-6 col-sm-5 col-md-3 col-xl-2 text-center order-0 order-md-0 order-lg-0 mr-0 mr-lg-3 pl-0','escape' => false]); ?>
            <div class="mainMenuBar col-12 col-lg-8 text-center order-2 order-md-2 order-lg-1 mt-4 mt-lg-0 pl-0 pr-0">
                <nav class="nav  form-inline" role="navigation">
                    <div class="wrapper-flush form-group  d-flex align-items-center mb-0">
                        <div class="topSearchBar col-4 col-md-8 col-xl-10 pl-0" style="display: block;">
                            <div class="search-form-block bg-white"> 
                                <?php //echo $this->Form->create('', ['type' => 'get','url' => ['controller' => 'Collabeds','action' => 'index','plugin' => 'CollabedManager'],'id'=>'collabSearch']);onkeyup="collabSearch(this.value)"  ?>
                                <input name="search" type="text" class="form-control form-control-lg w-100" id="collabSearch" autocomplete="off" value="<?= $this->request->query('search') ?>" placeholder="Search Artist(s)">
                                <a class="fa fa-close fa-times btn-close-search"></a> 
                                <input type="submit" name="btnsubmit" value="" class="fa fa-search d-none">
                                <label  class="fa fa-search icon-search" for="btnsubmit" ></label>
                                <?php //echo $this->Form->end(); ?>
                            </div>   
                        </div>
                        <?php
                        $aclass = '';
                        if ($this->request->query('like') == 'desc') {
                            $type = 'Most Wanted';
                        } elseif ($this->request->query('like') == 'new') {
                            $type = 'Recent';
                        } elseif ($this->request->query('like') == 'random') {
                            $type = 'Random';
                        } else {
                            $type = 'Recent';
                        }
                        ?>
                        <div class="sort-by-col col-8 col-md-4 col-xl-2 text-right text-lg-left text-xl-right pl-xl-0 pr-0 text-nowrap <?= $createheader ? 'd-none d-md-block' : 'd-block'; ?> <?= ($this->request->params['controller'] == 'Login') || ($this->request->params['controller'] == 'Profile') ? 'invisible' : '' ?>" id="sort-by-col">
                            <span class="sortBtn font-weight-bold text-dark"><?= $type ?><i class="fa fa-angle-down ml-3"></i></span>    
                            <?php // $this->Html->link('Top Likes', ['controller' => 'Collabeds', 'action' => 'index', 'plugin' => 'CollabedManager','?' => ['like' => $type]], ['class' => 'menu-link sortBtn']);  ?>
                            <div class="sort-menu" style="display:none;"> 
                                <ul class="pb-2">
                                    <li class="menu-item <?= $type == 'Most Wanted' ? 'active d-none' : '' ?>">
                                        <?= $this->Html->link('Most Wanted', ['controller' => 'Collabeds', 'action' => 'index', 'plugin' => 'CollabedManager', '?' => ['like' => 'desc']], ['class' => 'menu-link ']); ?>
                                    </li>
                                    <li class="menu-item <?= $type == 'Random' ? 'active d-none' : '' ?>">
                                        <?= $this->Html->link('Random', ['controller' => 'Collabeds', 'action' => 'index', 'plugin' => 'CollabedManager', '?' => ['like' => 'random']], ['class' => 'menu-link']); ?>
                                    </li>
                                    <li class="menu-item <?= $type == 'Recent' ? 'active d-none' : '' ?>">
                                        <?= $this->Html->link('Recent', ['controller' => 'Collabeds', 'action' => 'index', 'plugin' => 'CollabedManager', '?' => ['like' => 'new']], ['class' => 'menu-link']); ?>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="sort-by-col col-8 col-md-4 col-xl-2 text-right text-lg-left text-xl-right pl-xl-0 pr-0 text-nowrap <?= $createheader ? 'd-block d-md-none' : 'd-none' ?>" id="search-reset" onclick="searchReset();">
                            <!-- <span>Sort by:</span>  -->
                            <a class="sortBtn font-weight-bold text-dark">Reset<small class="fa fa-redo-alt ml-2"></small></a>
                        </div>
                        
                    </div>    
                </nav>
            </div>
            <div class="col-3 col-md-4 col-lg-1 text-right order-1 order-md-1 order-lg-1 pr-0">
                <?= $this->Html->link('<span class="navbar-toggler-icon"></span>', ['controller' => 'Profile', 'action' => 'index', 'plugin' => false], ['class' => 'mr-0', 'title' => 'Profile', 'escape' => false]); ?>
            </div>
        </div>  
      </div>
  </nav>



<?php $like = $this->request->query('like'); ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    if (('<?php echo $this->request->params['controller']?>' == 'Login')
        || ('<?php echo $this->request->params['controller']?>' == 'Profile')
        || ('<?php echo $this->request->params['controller']?>' == 'Collab')
        || ('<?php echo $this->request->params['action']?>' == 'ajaxIndex')) {
            $(".navbar-main").addClass("no-show-search");
    } else {
        $(".navbar-main").removeClass("no-show-search");
    }

    var searchRequest = null;
    let keyword = localStorage.getItem("keyword");
    if (keyword) {
        getCollabs(keyword);
        $("#collabSearch").val(keyword);
        localStorage.removeItem("keyword");
    }
    $("#loading").hide();
    $(document).on("keyup", "#collabSearch", function (e) {
        var that = this;
        value = $(this).val();
        if (value.length) {
            $("#collabSearch").addClass("dropdown-shown");
            // $(".btn-close-search").addClass("d-block");
        }
        else {
            $("#collabSearch").removeClass("dropdown-shown");
            // $(".btn-close-search").addClass("d-block");
        }

        
        if (e.keyCode == 13) {
            getCollabs(value);
            $("#collabSearch").trigger("blur");
        }
        
    });
    $("#collabSearch").on("blur", function() {
        $("#collabSearch").removeClass("dropdown-shown");
    })

    var urlgetartist = '<?php echo $this->Url->build(['controller'=>'Artists','action'=>'getArtists','plugin'=>'ArtistManager']); ?>';
    $("#collabSearch").autocomplete({
        open: function(event, ui) {
            $('.ui-autocomplete').off('menufocus hover mouseover mouseenter');
        },
        source: function(request, response){
            // var artist_name_not = $('#artist_two').val();
            $.ajax({
                type: "POST",
                url: urlgetartist,
                data: {'artist_name':request.term},
                dataType: "json",
                beforeSend: function (xhr) { // Add this line
                    xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                    
                },  // Add this line
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            label: item.name,
                            value: item.name
                        }
                    }));
                },
                error: function (msg) {
                    console.log(msg.status + ' ' + msg.statusText);
                }
            })
        },
        select: function( event, ui ) {
            if(ui.item){
                getCollabs(ui.item.label);
            }
        },
    });

    $(".btn-close-search").on("click", function() {
        $("#collabSearch").val("");
        getCollabs("");
        $(this).removeClass("d-block");
    })


function getCollabs(keyword) {
    if (('<?php echo $this->request->params['controller']?>' == 'Login')
        || ('<?php echo $this->request->params['controller']?>' == 'Profile')
        || ('<?php echo $this->request->params['controller']?>' == 'Collab')
        || ('<?php echo $this->request->params['action']?>' == 'ajaxIndex')) {
        
        localStorage.setItem("keyword", keyword);
        window.location = "./";     
    }
    $.ajax({
        url: '<?php echo $this->Url->build(['controller' => 'Collabeds', 'action' => 'ajaxCollabe', 'plugin' => 'CollabedManager']); ?>',
        type: "GET",
        dataType: "text",
        data: {'like': '<?= $like; ?>', 'search_keyword': keyword},
        beforeSend: function (xhr) { // Add this line
            xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
            $("#loading").show();
        }, // Add this line
        complete: function () {
            $("#loading").hide();
        },
        success: function (data, textStatus, jQxhr) {
            $('#results').html(data);
            var newTotal = jQuery('#allCollabeCount').val();
            console.log(newTotal);
            if (window.innerWidth < 768) {
                if (newTotal < 2) {
                    $("#sort-by-col").addClass("d-none");
                    // $("#search-reset").removeClass("d-none");
                }    
                else {
                    $("#sort-by-col").removeClass("d-none");
                    // $("#search-reset").addClass("d-none");
                }
            }
            jQuery('#totalCollabeds').val(newTotal);
            if (data) {
                $('#results').html(data);
                $("#loading").hide();
            }
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
    $("#collabSearch").removeClass("dropdown-shown");
}
<?php $this->Html->scriptEnd(); ?>
</script>
