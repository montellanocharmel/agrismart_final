<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h3 style="color:#88c431">Agricultural Trivias</h3>
                        <div class=" box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchusertrivia">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Trivia About...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                               
                                <a href="/usertrivias" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
                    
                            </div>
                        </div>
                    </div>
                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Trivias</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($trivia as $tri) : ?>
                                    <tr>
                                    <td><img src="<?= 'http://agrismart_final.test/'.$tri['image'] ?>" alt="" class="avatar-img rounded-circle mx-auto d-block" style="display: block; margin: 0 auto; width: 200px; height: 200px;"></td>
                                        <td><?= $tri['trivia'] ?></td>
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

