<?php
use Cake\Core\Configure;
use Cake\Routing\Router;
?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo Router::url('/admin/') ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
<?php echo $this->Html->image(Configure::read('Setting.MAIN_FAVICON'), ["alt" => "logo", "style" => "height:38px;"]); ?></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
<?php echo $this->Html->image(Configure::read('Setting.MAIN_LOGO'), ["alt" => "logo", "style" => "max-height:40px; max-width:200px;"]); ?></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
<?php if (!empty($authData)) { ?>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                            <?php
                            if (!empty($authData['profile_photo']) && file_exists("img/".$authData['profile_photo'])) {
                                echo $this->Html->image($authData['profile_photo'], ["class" => "user-image", "style" => "max-height:100px;"]);
                            } else {
                                echo $this->Html->image("noimage.jpg", ["class" => "user-image"]);
                            }
                            ?>
                            <span class="hidden-xs">
    <?php echo $authData['name']; ?>
                            </span> </a>
                        <ul class="dropdown-menu">
                            <li class="user-footer">
                                <div class="pull-left"> <?php echo $this->Html->link('<i class="fa fa-fw fa-user"></i> Profile', array("controller" => "AdminUsers", "action" => "profile", "plugin" => 'AdminUserManager'), array("class" => 'btn btn-default btn-flat', "escape" => false)); ?> </div>
                                <div class="pull-right"> <?php echo $this->Html->link('<i class="fa fa-key"></i> Sign Out', array("controller" => "AdminUsers", "action" => "logout", "plugin" => 'AdminUserManager'), array("class" => 'btn btn-default btn-flat', "escape" => false)); ?> </div>
                            </li>
                        </ul>
                    </li>
<?php } ?>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>
