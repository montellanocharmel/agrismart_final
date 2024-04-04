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
        <li><a href="/admincropplanting" style="margin-left: 40px;">Expenses</a></li>
        <li><a href="/adminharvest" style="margin-left: 40px;">Harvest</a></li>
        </li>
        <li class="side_menu_title">
            <span>Data Analytics</span>
        </li>
        <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <img src="img/menu-icon/4.svg" alt>
                <span>View Charts</span>
            </a>
            <ul>
                <li><a href="">Vegetation History</a></li>
                <li><a href="">Variety</a></li>
                <li><a href="">Field Yields</a></li>
                <li><a href="">Expenses</a></li>
            </ul>
        </li>
        <li class="side_menu_title">
            <span>Barangay Inventory</span>
        </li>
        <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <img src="img/menu-icon/4.svg" alt>
                <span>Profile</span>
            </a>
            <ul>
                <li><a href="/adminprofile">My Profile</a></li>
                <li><a href="/manageaccounts">Farmer Profiles</a></li>
            </ul>
        </li>
        <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <img src="img/menu-icon/4.svg" alt>
                <span>Inventory</span>
            </a>
            <ul>
                <li><a href="/workers">Workers</a></li>
                <li><a href="/cropvariety">Crop Variety</a></li>
                <li><a href="/fertilizers">Fertilizers</a></li>
                <li><a href="/otherexpenses">Other Expenses</a></li>
            </ul>
        </li>
    </ul>
</nav>