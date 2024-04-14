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
                                <h3 class="mb-0">Welcome, <?php echo session()->get('fullname'); ?>!</h3>
                            </div>
                        </div>
                    </div>
                    <div class="header_right d-flex justify-content-between align-items-center">
                        <div class="header_notification_warp d-flex align-items-center">

                        </div>

                        <div class="profile_info">
                            <i class="fa-solid fa-user fa-2xl " style="align-self: center; color: #88c431; margin-right: 20px;"></i>
                            <div class="profile_info_iner">
                                <h5><?php echo session()->get('fullname'); ?></h5>
                                <div class="profile_info_details">
                                    <a href="/">Log Out <i class="fa-solid fa-arrow-right-from-bracket" style="color: white;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>