<div class="main_content_iner ">
    <div class="container-fluid p-1">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
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
                                    <div class="text-center">
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