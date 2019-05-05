<?php
$session = $this->request->getSession();
$authData = $session->read('Auth.Admin');
$userdir = isset($userdir) ? $userdir : "";
$act = $this->request->getParam('action');
$ctrl = strtolower($this->request->getParam('controller'));
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo (($act == "index") && $ctrl == "dashboard") ? "active" : ""; ?>">
                <?php
                echo $this->Html->link("<i class=\"fa fa-dashboard\"></i> <span>Dashboard</span>", ["controller" => "dashboard", "action" => "index", "plugin" => null], ["class" => "", "escape" => false]);
                ?>
            </li>
            
            <?= $this->fetch('sidebar') ?>            
            <li class="treeview <?php echo $custs = (in_array($act, array("index", "add", "edit", "view")) && (in_array($ctrl, array("artists", "groups")))) ? "active" : ""; ?>"> <a href="#"> <i class="fa fa-fw fa-user"></i> <span>Artists</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $custs == "active" ? "menu-open" : ""; ?>">
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "artists") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Artist Manager", ["controller" => "Artists", "action" => "index", "plugin" => 'ArtistManager'], ["class" => "", "escape" => false]);
                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "groups") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Artist Nicknames", ["controller" => "Groups", "action" => "index", "plugin" => 'ArtistManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                </ul>
            </li>
            
            <li class="<?php echo ((in_array($act, array("index", "add", "edit", "view"))) && $ctrl == "banners") ? "active" : ""; ?>">
                <?php
                echo $this->html->link("<i class=\"fa fa-image\"></i> <span>Banner Manager</span>", ["controller" => "Banners", "action" => "index", "plugin" => 'BannerManager'], ["class" => "", "escape" => false]);
                ?>
            </li>
            
            <li class="<?php echo ((in_array($act, array("index", "add", "edit", "view"))) && $ctrl == "locations") ? "active" : ""; ?>">
                <?php
                echo $this->html->link("<i class=\"fa fa-image\"></i> <span>Collabed Manager</span>", ["controller" => "Collabeds", "action" => "index", "plugin" => 'CollabedManager'], ["class" => "", "escape" => false]);
                ?>
            </li>
            <li class="treeview <?php echo $active = (in_array($act, array("index", "add", "edit", "view")) && (in_array($ctrl, array("emailhooks", "emailpreferences", "emailtemplates")))) ? "active" : ""; ?>"> <a href="#"> <i class="fa fa-fw fa-envelope-o"></i> <span>Email Templates</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $active == "active" ? "menu-open" : ""; ?>">
                    <?php /* ?>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "emailhooks") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Hooks (slugs)", ["controller" => "EmailHooks", "action" => "index", 'plugin' => 'EmailManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>

                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "emailpreferences") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Email Preferences (Layouts)", ["controller" => "EmailPreferences", "action" => "index", 'plugin' => 'EmailManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                    <?php */ ?>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "emailtemplates") ? "active" : ""; ?>">
<?php
echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Email Templates", ["controller" => "EmailTemplates", "action" => "index", 'plugin' => 'EmailManager'], ["class" => "", "escape" => false]);

?>
                    </li>

                </ul>
            </li>
            <li class="treeview <?php echo $menu = (in_array($act, array("index", "add", "logos", "options", "social", "themeOptions", "smtp")) && (in_array($ctrl, array("settings")))) ? "active" : ""; ?>"> <a href="#"> <i class="fa fa-fw fa-cog"></i> <span>Settings</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $menu == "active" ? "menu-open" : ""; ?>">
                    <li class="<?php echo (in_array($act, array("logos")) && $ctrl == "settings") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Logo/Fav icon", ["controller" => "Settings", "action" => "logos", "plugin" => 'SettingManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit")) && $ctrl == "settings") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> General Setting", ["controller" => "Settings", "action" => "index", "plugin" => 'SettingManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("smtp")) && $ctrl == "settings") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> SMTP Detail", ["controller" => "settings", "action" => "smtp", "plugin" => 'SettingManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("social")) && $ctrl == "settings") ? "active" : ""; ?>">
<?php
echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Social Links", ["controller" => "settings", "action" => "social", "plugin" => 'SettingManager'], ["class" => "", "escape" => false]);

?>
                    </li>
                    
                </ul>
            </li>
         
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
