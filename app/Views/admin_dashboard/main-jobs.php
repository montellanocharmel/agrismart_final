<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header" style="margin-top: 4vh;">
                        <h4 style="color:#88c431; ">Mga Gastos sa Bukid</h4>
                        <div class=" box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchadminexpense">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Expenses...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="/adminexpense" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="/exportToExceladminexpense" class="btn btn-primary"><i class="fa-regular fa-file-excel"></i></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col">Gastos</th>
                                        <th scope="col">Pangalan ng Bukid</th>
                                        <th scope="col">Araw</th>
                                        <th scope="col">Total na Nagastos</th>
                                        <th scope="col">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($expense as $exp) : ?>
                                        <tr>
                                            <td><?= $exp['expense_name'] ?></td>
                                            <td><?= $exp['field_name'] ?></td>
                                            <td><?= $exp['finished_date'] ?></td>
                                            <td><?= $exp['total_money_spent'] ?></td>
                                            <td><?= $exp['notes'] ?></td>
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