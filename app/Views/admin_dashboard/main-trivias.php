<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h3 style="color:#88c431">Agricultural Trivias</h3>
                        <div class="box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchtrivia">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Trivia About...">
                                        </div>
                                        <button type="submit"><i class="ti-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addtriviasmodal" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
                                <a href="/adtrivias" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Trivias</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Aksyon</th>
                                </tr>
                            </thead>
                            <?php
                            function truncateText($text, $maxLength)
                            {
                                if (strlen($text) > $maxLength) {
                                    $text = substr($text, 0, $maxLength) . '...';
                                }
                                return $text;
                            }
                            ?>
                            <tbody>
                                <?php foreach ($trivia as $tri) : ?>
                                    <tr>
                                        <td><img src="<?= base_url() . $tri['image'] ?>" alt="" class="avatar-img rounded-circle mx-auto d-block" style="display: block; margin: 0 auto; width: 200px; height: 200px;"></td>
                                        <td><?= truncateText($tri['triviatitle'], 30) ?></td>
                                        <td><?= truncateText($tri['trivia'], 100) ?></td>
                                        <td><?= $tri['author'] ?></td>
                                        <td><?= $tri['date'] ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #88c431; border: none;">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item" onclick="openEditTriviaModal(
                                                        <?= $tri['trivia_id']; ?>,
                                                        '<?= htmlspecialchars($tri['triviatitle'], ENT_QUOTES, 'UTF-8'); ?>',
                                                        '<?= htmlspecialchars($tri['trivia'], ENT_QUOTES, 'UTF-8'); ?>'
                                                    )">Edit</button>

                                                    <button class="dropdown-item" onclick="deletetrivia(<?= $tri['trivia_id']; ?>)">Delete</button>
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

<!-- Add Modal -->
<div class="modal fade" id="addtriviasmodal" role="dialog" aria-labelledby="addtriviasmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addtriviasmodalLabel">Add New Trivias</h5>
            </div>
            <div class="modal-body">
                <form action="/addtrivia" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="image" class="form-label">Images</label>
                        <input type="file" name="image" id="image" placeholder="Trivia Image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="triviatitle" class="form-label">Title</label>
                        <input type="text" name="triviatitle" id="triviatitle" placeholder="Title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="trivia" class="form-label">Trivias</label>
                        <textarea name="trivia" id="trivia" placeholder="Trivias" class="form-control" rows="4"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edittriviasmodal" tabindex="-1" aria-labelledby="edittriviasmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edittriviasmodalLabel">Edit Trivias</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/adtrivias/update" method="post">
                    <input type="hidden" name="trivia_id" id="edittrivia_id">
                    <div class="mb-3">
                        <label for="edittriviatitle" class="form-label">Title</label>
                        <input type="text" name="triviatitle" id="edittriviatitle" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit_trivia" class="form-label">Trivias</label>
                        <textarea name="trivia" id="edit_trivia" class="form-control" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>