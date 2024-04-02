<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header" style="margin-top: 4vh;">
                        <h4 style="color:#88c431; ">Farmer Profiles</h4>
                        <div class=" box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form Active="#">
                                        <div class="search_field">
                                            <input type="text" placeholder="Search content here...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addfarmermodal" class="btn_1">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col">FIMS Code</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Aksyon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($profiles as $profile) : ?>
                                        <tr>
                                            <td><?= $profile['fims_code'] ?></td>
                                            <td><?= $profile['fullname'] ?></td>
                                            <td><?= $profile['address'] ?></td>

                                            <td>
                                                <button type="button" class="btn btn-primary" onclick="openEditFarmerModal(
                                            <?= $profile['id']; ?>,
                                            '<?= $profile['fims_code']; ?>',
                                            '<?= $profile['fullname']; ?>',
                                            '<?= $profile['address']; ?>',
                                            )">Edit</button>
                                                <button type="button" class="btn btn-danger" onclick="deletefarmer(<?= $profile['id']; ?>)">Delete</button>
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
</div>

<!-- Add Farmer Modal -->
<div class="modal fade" id="addfarmermodal" role="dialog" aria-labelledby="addprofilemodalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addprofilemodalLabel">Add New Farmer</h5>
            </div>
            <div class="modal-body">
                <form action="/addfarmerprofile" method="post">
                    <div class="mb-3">
                        <label for="fims_code" class="form-label">FIMS Code</label>
                        <input type="text" name="fims_code" id="fims_code" placeholder="FIMS Code" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" name="fullname" id="fullname" placeholder="Last Name, First Name Middle Name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <div class="form-input">
                            <select class="form-select mb-3" name="address" tabindex="10" required>
                                <option value="" selected disabled>Select Barangay</option>
                                <option value="Poblacion I">Poblacion I</option>
                                <option value="Poblacion II">Poblacion II</option>
                                <option value="Poblacion III">Poblacion III</option>
                                <option value="Adrialuna">Adrialuna</option>
                                <option value="Andres Ylagan">Andres Ylagan</option>
                                <option value="Antipolo">Antipolo</option>
                                <option value="Apitong">Apitong</option>
                                <option value="Arangin">Arangin</option>
                                <option value="Aurora">Aurora</option>
                                <option value="Bacungan">Bacungan</option>
                                <option value="Bagong Buhay">Bagong Buhay</option>
                                <option value="Balite">Balite</option>
                                <option value="Bancuro">Bancuro</option>
                                <option value="Banuton">Banuton</option>
                                <option value="Barcenaga">Barcenaga</option>
                                <option value="Bayani">Bayani</option>
                                <option value="Buhangin">Buhangin</option>
                                <option value="Caburo">Caburo</option>
                                <option value="Concepcion">Concepcion</option>
                                <option value="Dao">Dao</option>
                                <option value="Del Pilar">Del Pilar</option>
                                <option value="Estrella">Estrella</option>
                                <option value="Evangelista">Evangelista</option>
                                <option value="Gamao">Gamao</option>
                                <option value="General Esco">General Esco</option>
                                <option value="Herrera">Herrera</option>
                                <option value="Inarawan">Inarawan</option>
                                <option value="Kalinisan">Kalinisan</option>
                                <option value="Laguna">Laguna</option>
                                <option value="Mabini">Mabini</option>
                                <option value="Magtibay">Magtibay</option>
                                <option value="Mahabang Parang">Mahabang Parang</option>
                                <option value="Malaya">Malaya</option>
                                <option value="Malinao">Malinao</option>
                                <option value="Malvar">Malvar</option>
                                <option value="Masagana">Masagana</option>
                                <option value="Masaguing">Masaguing</option>
                                <option value="Melgar A">Melgar A</option>
                                <option value="Melgar B">Melgar B</option>
                                <option value="Metolza">Metolza</option>
                                <option value="Montelago">Montelago</option>
                                <option value="Montemayor">Montemayor</option>
                                <option value="Motoderazo">Motoderazo</option>
                                <option value="Mulawin">Mulawin</option>
                                <option value="Nag-Iba 1">Nag-Iba 1</option>
                                <option value="Nag-Iba 2">Nag-Iba 2</option>
                                <option value="Pagkakaisa">Pagkakaisa</option>
                                <option value="Paitan">Paitan</option>
                                <option value="Paniquian">Paniquian</option>
                                <option value="Pinagsabangan 1">Pinagsabangan 1</option>
                                <option value="Pinagsabangan 2">Pinagsabangan 2</option>
                                <option value="Piñahan">Piñahan</option>
                                <option value="Sampaguita">Sampaguita</option>
                                <option value="San Agustin 1">San Agustin 1</option>
                                <option value="San Agustin 2">San Agustin 2</option>
                                <option value="San Andres">San Andres</option>
                                <option value="San Antonio">San Antonio</option>
                                <option value="San Carlos">San Carlos</option>
                                <option value="San Isidro">San Isidro</option>
                                <option value="San Jose">San Jose</option>
                                <option value="San Luis">San Luis</option>
                                <option value="San Nicolas">San Nicolas</option>
                                <option value="San Pedro">San Pedro</option>
                                <option value="Sta. Cruz">Sta. Cruz</option>
                                <option value="Sta. Cruz">Sta. Cruz</option>
                                <option value="Sta. Isabel">Sta. Isabel</option>
                                <option value="Sta. Maria">Sta. Maria</option>
                                <option value="Satiago">Satiago</option>
                                <option value="Sto. Niño">Sto. Niño</option>
                                <option value="Tagumpay">Tagumpay</option>
                                <option value="Tigkan">Tigkan</option>
                            </select>
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


<!-- Edit Farmer Modal.php -->

<div class="modal fade" id="editfarmermodal" tabindex="-1" aria-labelledby="editfarmerrmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editfarmermodalLabel">Edit Harvest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/farmer/update" method="post">
                    <input type="hidden" name="id" id="editid">
                    <div class="mb-3">
                        <label for="editfims_code" class="form-label">FIMS Code</label>
                        <input type="text" name="fims_code" id="editfims_code" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editfullname" class="form-label">First Name</label>
                        <input type="text" name="fullname" id="editfullname" class="form-control">
                        <div class="mb-3">
                            <label for="editaddress" class="form-label">Address</label>
                            <div class="form-input">
                                <select class="form-select mb-3" name="address" id="editaddress" tabindex="10" required>
                                    <option value="" selected disabled>Select Barangay</option>
                                    <option value="Poblacion I">Poblacion I</option>
                                    <option value="Poblacion II">Poblacion II</option>
                                    <option value="Poblacion III">Poblacion III</option>
                                    <option value="Adrialuna">Adrialuna</option>
                                    <option value="Andres Ylagan">Andres Ylagan</option>
                                    <option value="Antipolo">Antipolo</option>
                                    <option value="Apitong">Apitong</option>
                                    <option value="Arangin">Arangin</option>
                                    <option value="Aurora">Aurora</option>
                                    <option value="Bacungan">Bacungan</option>
                                    <option value="Bagong Buhay">Bagong Buhay</option>
                                    <option value="Balite">Balite</option>
                                    <option value="Bancuro">Bancuro</option>
                                    <option value="Banuton">Banuton</option>
                                    <option value="Barcenaga">Barcenaga</option>
                                    <option value="Bayani">Bayani</option>
                                    <option value="Buhangin">Buhangin</option>
                                    <option value="Caburo">Caburo</option>
                                    <option value="Concepcion">Concepcion</option>
                                    <option value="Dao">Dao</option>
                                    <option value="Del Pilar">Del Pilar</option>
                                    <option value="Estrella">Estrella</option>
                                    <option value="Evangelista">Evangelista</option>
                                    <option value="Gamao">Gamao</option>
                                    <option value="General Esco">General Esco</option>
                                    <option value="Herrera">Herrera</option>
                                    <option value="Inarawan">Inarawan</option>
                                    <option value="Kalinisan">Kalinisan</option>
                                    <option value="Laguna">Laguna</option>
                                    <option value="Mabini">Mabini</option>
                                    <option value="Magtibay">Magtibay</option>
                                    <option value="Mahabang Parang">Mahabang Parang</option>
                                    <option value="Malaya">Malaya</option>
                                    <option value="Malinao">Malinao</option>
                                    <option value="Malvar">Malvar</option>
                                    <option value="Masagana">Masagana</option>
                                    <option value="Masaguing">Masaguing</option>
                                    <option value="Melgar A">Melgar A</option>
                                    <option value="Melgar B">Melgar B</option>
                                    <option value="Metolza">Metolza</option>
                                    <option value="Montelago">Montelago</option>
                                    <option value="Montemayor">Montemayor</option>
                                    <option value="Motoderazo">Motoderazo</option>
                                    <option value="Mulawin">Mulawin</option>
                                    <option value="Nag-Iba 1">Nag-Iba 1</option>
                                    <option value="Nag-Iba 2">Nag-Iba 2</option>
                                    <option value="Pagkakaisa">Pagkakaisa</option>
                                    <option value="Paitan">Paitan</option>
                                    <option value="Paniquian">Paniquian</option>
                                    <option value="Pinagsabangan 1">Pinagsabangan 1</option>
                                    <option value="Pinagsabangan 2">Pinagsabangan 2</option>
                                    <option value="Piñahan">Piñahan</option>
                                    <option value="Sampaguita">Sampaguita</option>
                                    <option value="San Agustin 1">San Agustin 1</option>
                                    <option value="San Agustin 2">San Agustin 2</option>
                                    <option value="San Andres">San Andres</option>
                                    <option value="San Antonio">San Antonio</option>
                                    <option value="San Carlos">San Carlos</option>
                                    <option value="San Isidro">San Isidro</option>
                                    <option value="San Jose">San Jose</option>
                                    <option value="San Luis">San Luis</option>
                                    <option value="San Nicolas">San Nicolas</option>
                                    <option value="San Pedro">San Pedro</option>
                                    <option value="Sta. Cruz">Sta. Cruz</option>
                                    <option value="Sta. Cruz">Sta. Cruz</option>
                                    <option value="Sta. Isabel">Sta. Isabel</option>
                                    <option value="Sta. Maria">Sta. Maria</option>
                                    <option value="Satiago">Satiago</option>
                                    <option value="Sto. Niño">Sto. Niño</option>
                                    <option value="Tagumpay">Tagumpay</option>
                                    <option value="Tigkan">Tigkan</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>