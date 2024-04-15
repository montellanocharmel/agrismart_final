<section class="main_content dashboard_part">
    <div class="container-fluid g-0">
        <div class="row">
            <div class="col-lg-12 p-0"><!--style="background-color: #f28123;"-->
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="serach_field-area">
                        <div class="search_inner">
                            <div class="main-title">
                                <h3 class="mb-0">Welcome, <?php echo session()->get('leader_name'); ?>!</h3>
                            </div>
                        </div>
                    </div>


                    <div class="profile_info" style="align-self: center; margin-right: 20px; z-index: 1000;">
                        <i class="fa-solid fa-user fa-2xl" style="color: #88c431;"></i>
                        <div class="profile_info_iner">
                            <h5><?php echo session()->get('leader_name'); ?></h5>
                            <div class="profile_info_details">
                                <a href="/">Log Out <i class="fa-solid fa-arrow-right-from-bracket" style="color: #ffffff;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>