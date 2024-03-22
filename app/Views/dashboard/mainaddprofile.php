<div class="main_content_iner ">
    <div class="container-fluid p-1">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="white_box mb_30">
                        <div class="col-lg-12 mt-2 text-center mb-2">
                            <div class="avatar avatar-xxl">
                                <?php foreach ($prof as $pro) : ?>
                                    <img src="<?= base_url($pro['profile_picture']) ?>" alt="Profile Picture" class="avatar-img rounded-circle mx-auto d-block" style="display: block; margin: 0 auto; width: 200px; height: 200px;">
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-lg-12">
                                <?php foreach ($prof as $pro) : ?>
                                    <div class="text-center"> <!-- Add text-center class to center the content -->
                                        <h2 class="mb-1 mt-2" style="color: #88c431;"><?= $pro['fullname'] ?></h2>
                                        <button type="button" class="btn mt-2 mb-2 btn-primary" style="border-radius: 25px;" data-toggle="modal" data-target="#varyModal" data-whatever="@mdo">Add Profile</button>
                                        <button type="button" class="btn mt-2 mb-2 ml-2 btn-primary" style="border-radius: 25px;" data-toggle="modal" data-target="#varyModal" data-whatever="@mdo">Edit Profile</button>
                                    </div>
                                    <h7 class="mb-1">RSBA ID Number</h7>
                                    <h3 class="mb-3"><span style="font-size: large; font-weight:bold; color: #88c431;"><?= $pro['idnumber'] ?></span></h3>
                                    <h7 class="mb-1" style="font-size: large;">Address</h7>
                                    <h3 class="mb-3"><span style="font-size: large; font-weight:bold; color: #88c431;"><?= $pro['address'] ?></span></h3>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="single_element">
                        <div class="quick_activity">
                            <div class="quick_activity_wrap quick_activity_wrap">
                                <div class="single_quick_activity  d-flex">
                                    <div class="count_content count_content2">
                                        <h3><span class="counter blue_color"><?= $totalHarvestQuantity ?></span> </h3>
                                        <p>Total na Naani</p>
                                    </div>
                                </div>
                                <div class="single_quick_activity d-flex">
                                    <div class="count_content count_content2">
                                        <h3><span class="counter red_color"><?= $totalRevenueThisYear ?></span> </h3>
                                        <p>Kita Ngayong Taon</p>
                                    </div>
                                </div>
                                <div class="single_quick_activity  d-flex">
                                    <div class="count_content count_content2">
                                        <h3><span class="counter yellow_color"><?= $totalBinhiCount ?></span> </h3>
                                        <p>Binhi</p>
                                    </div>
                                </div>
                                <div class="single_quick_activity  d-flex">
                                    <div class="count_content count_content2">
                                        <h3><span class="counter green_color"><?= $totalMoneySpent ?></span> </h3>
                                        <p>Nagastos</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="QA_section">
                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col">Pangalan ng Bukid</th>
                                        <th scope="col">May-ari ng Lupa</th>
                                        <th scope="col">Address ng Bukid</th>
                                        <th scope="col">Kabuuang Sukat</th>
                                        <th scope="col">Aksyon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($field as $fie) : ?>
                                        <tr>
                                            <td><?= $fie['field_name'] ?></td>
                                            <td><?= $fie['field_owner'] ?></td>
                                            <td><?= $fie['field_address'] ?></td>
                                            <td><?= $fie['field_total_area'] ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #88c431; border: none;">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" onclick="openEditFieldModal(
                                                        <?= $fie['field_id']; ?>,
                                                        '<?= $fie['field_name']; ?>',
                                                        '<?= $fie['field_owner']; ?>',
                                                        '<?= $fie['field_address']; ?>',
                                                        '<?= $fie['field_total_area']; ?>',
                                                        )">Edit</button>
                                                        <button type="button" class="dropdown-item" onclick="deleteProduct(<?= $fie['field_id']; ?>)">Delete</button>
                                                        <button type="button" class="dropdown-item" onclick="openAddPlantingModal('<?= $fie['field_id']; ?>', '<?= $fie['field_name']; ?>')">Add New Planting Details</button>
                                                        <button type="button" class="dropdown-item" onclick="openAddJobModal('<?= $fie['field_id']; ?>', '<?= $fie['field_name']; ?>')">Add New Job</button>
                                                        <button type="button" class="dropdown-item" onclick="openAddHarvestModal('<?= $fie['field_id']; ?>', '<?= $fie['field_name']; ?>')">Add New Harvest</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">Add Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/addfarmerprofile" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fullname" class="col-form-label">Full Name: </label>
                            <input type="text" class="form-control" id="fullname" name="fullname">
                        </div>
                        <div class="form-group">
                            <label for="idnumber" class="col-form-label">ID Number:</label>
                            <input type="text" class="form-control" id="idnumber" name="idnumber">
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="contactnumber" class="col-form-label">Contact Number:</label>
                            <input type="text" class="form-control" id="contactnumber" name="contactnumber">
                        </div>
                        <div class="form-group">
                            <label for="birthday" class="col-form-label">Birthday:</label>
                            <input type="date" class="form-control" id="birthday" name="birthday">
                        </div>
                        <div class="form-group">
                            <label for="profile_picture" class="col-form-label">Profile Picture:</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn mb-2 btn-primary">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

<style>
    .avatar-xxl {
        margin: 0 auto;
        display: block;
    }

    .profile-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>