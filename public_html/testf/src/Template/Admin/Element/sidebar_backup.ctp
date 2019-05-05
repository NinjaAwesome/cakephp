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
      
        <!-- search form -->
       
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo (($act == "index") && $ctrl == "dashboard") ? "active" : ""; ?>">
                <?php
                echo $this->Html->link("<i class=\"fa fa-dashboard\"></i> <span>Dashboard</span>", ["controller" => "dashboard", "action" => "index", "plugin" => null], ["class" => "", "escape" => false]);
                ?>
            </li>
            
            <?= $this->fetch('sidebar') ?>
            
            <li class="treeview <?php echo $custs = (in_array($act, array("index", "add", "edit", "view", 'profile', 'patient', 'doctor')) && (in_array($ctrl, array("adminusers", "admin-users", "users")))) ? "active" : ""; ?>"> <a href="#"> <i class="fa fa-fw fa-user"></i> <span>Users</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $custs == "active" ? "menu-open" : ""; ?>">
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view", "profile")) && $ctrl == "adminusers") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Admin Users", ["controller" => "AdminUsers", "action" => "index", "plugin" => 'AdminUserManager'], ["class" => "", "escape" => false]);
                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view", "profile")) && $ctrl == "users") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Website Users", ["controller" => "Users", "action" => "index", "plugin" => 'UserManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                </ul>
            </li>
            
          
<li class="<?php echo ((in_array($act, array("index", "add", "edit", "view"))) && $ctrl == "banners") ? "active" : ""; ?>">
                <?php
                echo $this->html->link("<i class=\"fa fa-image\"></i> <span>Banner Manager</span>", ["controller" => "Banners", "action" => "index", "plugin" => 'BannerManager'], ["class" => "", "escape" => false]);
                ?>
            </li>
            
            <li class="treeview <?php echo $cms = (in_array($act, array("index", "add", "view")) && (in_array($ctrl, array("pages", "modules", "navigations")))) ? "active" : ""; ?>"> <a href="#"> <i class="fa fa-th"></i> <span>CMS Manager</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $cms == "active" ? "menu-open" : ""; ?>">
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "pages") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> CMS Pages", ["controller" => "Pages", "action" => "index", "plugin" => 'CmsManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                    <!-- <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "modules") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Modules", ["controller" => "Modules", "action" => "index", "plugin" => 'CmsManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li> 
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "navigations") ? "active" : ""; ?>">
<?php
echo $this->Html->link("<i class=\"fa fa-circle-o\"></i>  Navigation Menu", ["controller" => "Navigations", "action" => "index", "plugin" => 'CmsManager'], ["class" => "", "escape" => false]);

?>
                    </li>-->

                </ul>
            </li>
            


<li class="<?php echo ((in_array($act, array("index", "add", "edit", "view"))) && $ctrl == "locations") ? "active" : ""; ?>">
                <?php
                echo $this->html->link("<i class=\"fa fa-globe\"></i> <span>Location Manager</span>", ["controller" => "Locations", "action" => "index", "plugin" => 'LocationManager'], ["class" => "", "escape" => false]);
                ?>
            </li>
<li class="treeview <?php echo $catalog = (in_array($act, array("index", "add", "view")) && (in_array($ctrl, array("categories", "options", 'attributes', 'attributegroups','stockstatuses','products')))) ? "active" : ""; ?>"> <a href="#"> <i class="fa fa-tags fw"></i> <span>Catalog</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $catalog == "active" ? "menu-open" : ""; ?>">
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "categories") ? "active" : ""; ?>">
                        <?php
                        echo $this->html->link("<i class=\"fa fa-circle-o\"></i> Categories", ["controller" => "Categories", "action" => "index", "plugin" => 'CategoryManager'], ["class" => "", "escape" => false]);
                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "options") ? "active" : ""; ?>">
<?php echo $this->html->link("<i class=\"fa fa-circle-o\"></i>  Options", ["controller" => "Options", "action" => "index", "plugin" => 'CatalogManager'], ["class" => "", "escape" => false]); ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "attributegroups") ? "active" : ""; ?>">
                        <?php
                        echo $this->html->link("<i class=\"fa fa-circle-o\"></i>  Attribute Group", ["controller" => "AttributeGroups", "action" => "index", "plugin" => 'CatalogManager'], ["class" => "", "escape" => false]);
                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "stockstatuses") ? "active" : ""; ?>">
                        <?php
                        echo $this->html->link("<i class=\"fa fa-circle-o\"></i>  Stock Status", ["controller" => "StockStatuses", "action" => "index", "plugin" => 'CatalogManager'], ["class" => "", "escape" => false]);
                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "attributes") ? "active" : ""; ?>">
                        <?php
                        echo $this->html->link("<i class=\"fa fa-circle-o\"></i>  Attributes", ["controller" => "Attributes", "action" => "index", "plugin" => 'CatalogManager'], ["class" => "", "escape" => false]);
                        ?>
                    </li>

                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "products") ? "active" : ""; ?>">
<?php
echo $this->html->link("<i class=\"fa fa-circle-o\"></i> Products", ["controller" => "Products", "action" => "index", "plugin" => 'CatalogManager'], ["class" => "", "escape" => false]);

?>
                    </li>


                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "Manufacturers") ? "active" : ""; ?>">
                        <?php
                        echo $this->html->link("<i class=\"fa fa-circle-o\"></i>  Manufacturers", ["controller" => "Manufacturers", "action" => "index", "plugin" => 'CmsManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "Downloads") ? "active" : ""; ?>">
<?php
echo $this->html->link("<i class=\"fa fa-circle-o\"></i>  Downloads", ["controller" => "Downloads", "action" => "index", "plugin" => 'CmsManager'], ["class" => "", "escape" => false]);

?>
                    </li>

                </ul>
            </li>
            
            <li class="treeview <?php echo $evt = (in_array($act, array("index", "add", "view")) && (in_array($ctrl, array("events", "evoptions")))) ? "active" : ""; ?>"> <a href="#"> <i class="fa fa-th"></i> <span>Event Manager</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $evt == "active" ? "menu-open" : ""; ?>">
                    <li class="<?php echo (in_array($act, array("index", "add", "view")) && $ctrl == "evoptions") ? "active" : ""; ?>">
                        <?php
                        echo $this->html->link("<i class=\"fa fa-circle-o\"></i> Event Options", ["controller" => "Evoptions", "action" => "index", "plugin" => 'EventManager'], ["class" => "", "escape" => false]);
                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("index", "add", "view")) && $ctrl == "events") ? "active" : ""; ?>">
                        <?php
                        echo $this->html->link("<i class=\"fa fa-circle-o\"></i> Events", ["controller" => "Events", "action" => "index", "plugin" => 'EventManager'], ["class" => "", "escape" => false]);
                        ?>
                    </li>
                   
                </ul>              
            </li>
            
            <li class="treeview <?php echo $custs = (in_array($act, array("index", "add", "edit", "view", 'profile')) && (in_array($ctrl, array("inquiries", "quotes")))) ? "active" : ""; ?>"> 
                <a href="#"> <i class="fa fa-comment-o"></i> <span>Inquiry Manager</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $custs == "active" ? "menu-open" : ""; ?>">
                    <li class="<?php echo (in_array($act, array("index", "view")) && $ctrl == "inquiries") ? "active" : ""; ?>">
                        <?php echo $this->html->link("<i class=\"fa fa-circle-o\"></i> Contact Inquiries", ["controller" => "Inquiries", "action" => "index", "plugin" => 'ContactManager'], ["class" => "", "escape" => false]); ?>
                    </li>

                </ul>
            </li>
            
            
             <li class="treeview <?php echo $custs = (in_array($act, array("index", "add", "edit", "view", 'profile')) && (in_array($ctrl, array("jobseekers","jobs","interviews","listings")))) ? "active" : ""; ?>"> 
                <a href="#"> <i class="fa fa-globe"></i> <span>Business Manager</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $custs == "active" ? "menu-open" : ""; ?>">
                    
                    <li class="<?php echo (in_array($act, array("index", "view")) && $ctrl == "jobs") ? "active" : ""; ?>">
                        <?php echo $this->html->link("<i class=\"fa fa-list\"></i>Jobs Posted ", ["controller" => "Jobs", "action" => "index", "plugin" => 'BusinessDirectoryManager'], ["class" => "", "escape" => false]); ?>
                    </li>

                    <li class="<?php echo (in_array($act, array("index", "view")) && $ctrl == "jobseekers") ? "active" : ""; ?>">
                        <?php echo $this->html->link("<i class=\"fa fa-info-circle\"></i> Jobs Inquiries", ["controller" => "JobSeekers", "action" => "index", "plugin" => 'BusinessDirectoryManager'], ["class" => "", "escape" => false]); ?>
                    </li>
                    
                    <li class="<?php echo (in_array($act, array("index", "view")) && $ctrl == "interviews") ? "active" : ""; ?>">
                        <?php echo $this->html->link("<i class=\"fa fa-info-circle\"></i> Interviews", ["controller" => "Interviews", "action" => "index", "plugin" => 'BusinessDirectoryManager'], ["class" => "", "escape" => false]); ?>
                    </li>


                    <li class="<?php echo (in_array($act, array("index", "view","add","edit")) && $ctrl == "listings") ? "active" : ""; ?>">
                        <?php echo $this->html->link("<i class=\"fa fa-info-circle\"></i> Listings", ["controller" => "Listings", "action" => "index", "plugin" => 'BusinessDirectoryManager'], ["class" => "", "escape" => false]); ?>
                    </li>

                </ul>
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
