<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h3 style="color:#88c431">Agricultural Trainings and Seminars</h3>
                        <div class=" box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchtrainings">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Trainings and Seminars About...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addtrainingsmodal" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
                                <a href="/adtrainings" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>

                            </div>
                        </div>
                    </div>
                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Event</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Resource speaker</th>
                                    <th scope="col">Venue</th>
                                    <th scope="col">Validation</th>
                                    <th scope="col">Aksyon</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($trainings as $tra) : ?>
                                    <tr>

                                        <td><img src="<?= base_url() . $tra['image_training'] ?>" alt="" class="avatar-img rounded-circle mx-auto d-block" style="display: block; margin: 0 auto; width: 200px; height: 200px;"></td>
                                        <td><?= $tra['event_title'] ?></td>
                                        <td><?= $tra['date'] ?></td>
                                        <td><?= $tra['time'] ?></td>
                                        <td><?= $tra['speaker'] ?></td>
                                        <td><?= $tra['place'] ?></td>
                                        <td><?= $tra['validity_training'] ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #88c431; border: none;">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item" onclick="openEditUserTrainingModal(
                                                        <?= $tra['training_id']; ?>,
                                                        '<?= $tra['event_title']; ?>',
                                                        '<?= $tra['date']; ?>',
                                                        '<?= $tra['time']; ?>',
                                                        '<?= $tra['speaker']; ?>',
                                                        '<?= $tra['place']; ?>',
                                                        '<?= $tra['image_training']; ?>',

                                                        )">Edit</button>
                                                    <button class="dropdown-item" onclick="deleteusertraining(<?= $tra['training_id']; ?>)">Delete</button>

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
<div class="modal fade" id="addtrainingsmodal" role="dialog" aria-labelledby="addtrainingsmodalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addtrainingsmodalLabel">Add New Trainings and Seminars</h5>
            </div>
            <div class="modal-body">
                <form action="/addusertrainings" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="image_training" class="form-label">Image</label>
                        <input type="file" name="image_training" id="image_training" placeholder="Poster of Trainings and Seminars" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="event_title" class="form-label">Event</label>
                        <input type="text" name="event_title" id="event_title" placeholder="Event" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" id="date" placeholder="Date of Event" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" name="time" id="time" placeholder="Time of Event" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="place" class="form-label">Venue</label>
                        <input type="text" name="place" id="place" placeholder="Venue of Event" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="speaker" class="form-label">Resource Speaker</label>
                        <input type="text" name="speaker" id="speaker" placeholder="Speakers of the Event" class="form-control">
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
</div>
<!-- edit  -->

<div class="modal fade" id="editusertrainingsmodal" tabindex="-1" aria-labelledby="edittrainingsmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edittrainingsmodalLabel">Edit Trivias</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/trainings/update" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="training_id" id="edittraining_id">
                    <div class="mb-3">
                        <label for="editevent_title" class="form-label">Event</label>
                        <input type="text" name="event_title" id="editevent_title" placeholder="Event" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit_date" class="form-label">Date</label>
                        <input type="text" name="date" id="edit_date" placeholder="Date of Event" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit_time" class="form-label">Time</label>
                        <input type="text" name="time" id="edit_time" placeholder="Time of Event" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit_place" class="form-label">Venue</label>
                        <input type="text" name="place" id="edit_place" placeholder="Venue of Event" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit_speaker" class="form-label">Resource Speaker</label>
                        <input type="text" name="speaker" id="edit_speaker" placeholder="Speakers of the Event" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editimage_training" class="form-label">Images</label>
                        <input type="file" name="image_training" id="editimage_training" class="form-control">

                        <img id="editimage_training_preview" src="" alt="Current Image" style="display: none; width: 100%; height: auto; margin-top: 10px;">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var pestDiseaseRadio = document.getElementById("pest_disease");
        var weatherRelatedRadio = document.getElementById("weather_related");
        var pestDiseaseFields = document.getElementById("pest_disease_fields");
        var weatherRelatedFields = document.getElementById("weather_related_fields");

        pestDiseaseRadio.addEventListener("change", function() {
            if (this.checked) {
                pestDiseaseFields.style.display = "block";
                weatherRelatedFields.style.display = "none";
            }
        });

        weatherRelatedRadio.addEventListener("change", function() {
            if (this.checked) {
                pestDiseaseFields.style.display = "none";
                weatherRelatedFields.style.display = "block";
            }
        });
    });
</script>