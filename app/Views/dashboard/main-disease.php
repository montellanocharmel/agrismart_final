<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h3 style="color:#88c431">Agricultural Diseases</h3>
                        <div class=" box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchuserdisease">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Disease...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                               
                                <a href="/userdisease" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
                    
                            </div>
                        </div>
                    </div>
                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Recommendations</th>

                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($disease as $dis) : ?>
                                    <tr>
                                    <td><img src="<?= 'http://agrismart_final.test/'.$dis['dis_image'] ?>" alt="" class="avatar-img rounded-circle mx-auto d-block" style="display: block; margin: 0 auto; width: 200px; height: 200px;"></td>
                                        <td><?= $dis['dis_name'] ?></td>
                                        <td><?= $dis['dis_type'] ?></td>
                                        <td><?= $dis['dis_description'] ?></td>
                                        <td><?= $dis['dis_solutions'] ?></td>
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

