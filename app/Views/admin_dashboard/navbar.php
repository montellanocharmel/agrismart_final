<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <a href=""><img src="<?= base_url() ?>assets_landingpage/img/agrismart-logo.png" alt></a>
        <div class="sidebar_close_icon d-lg-none">

        </div>
    </div>
    <ul id="sidebar_menu">

        <li class="side_menu_title">
            <span>Dashboard</span>
        </li>
        <li>
        <li><a href="/admindashboard" style="margin-left: 40px;">Dashboard</a></li>

        </li>
        <li class="side_menu_title">
            <span>Fields</span>
        </li>
        <li>
            <a class="has-arrow" href="#" aria-expanded="false">
                <img src="img/menu-icon/1.svg" alt>
                <span>Fields</span>
            </a>
            <ul>
                <li><a href="/adminfields">View Fields</a></li>
                <li><a href="/map">View Map</a></li>
            </ul>
        </li>
        <li class="side_menu_title">
            <span>About Fields</span>
        </li>
        <li class>
        <li><a href="/admincropplanting" style="margin-left: 40px;">Planting</a></li>
        <li><a href="/adminexpense" style="margin-left: 40px;">Expenses</a></li>
        <li><a href="/admindamage" style="margin-left: 40px;">Damages</a></li>
        <li><a href="/adminharvest" style="margin-left: 40px;">Harvest</a></li>
        </li>
        <li class="side_menu_title">
            <span>Data Analytics</span>
        </li>
        <li class>
        <li><a href="/adminviewcharts" style="margin-left: 40px;">Charts</a></li>

        </li>
        <li class="side_menu_title">
            <span>Account Management</span>
        </li>
        <li class>
        <li><a href="/manageaccounts" style="margin-left: 40px;">Manage</a></li>
        </li>
    </ul>
</nav>