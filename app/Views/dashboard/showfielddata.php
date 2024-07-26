<div class="main_content_iner">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">

                    <div class="container-fluid p-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 style="color:#88c431; margin-top: 10px;">Farmer Profile</h2>
                                    </div>
                                    <div class="card-body">
                                        <style>
                                            @media (max-width: 767px) {
                                                .responsive-font p {
                                                    font-size: 15px;
                                                }
                                            }

                                            @media (min-width: 768px) {
                                                .responsive-font p {
                                                    font-size: 18px;
                                                }
                                            }
                                        </style>
                                        <div class="row">
                                            <div class="col-5 responsive-font" style="padding-right: 15px;">
                                                <p style="line-height: 2; margin: 0; text-align: right;">Farmer Name</p>
                                                <p style="line-height: 2; margin: 0; text-align: right;">FIMS Code</p>
                                                <p style="line-height: 2; margin: 0; text-align: right;">Field Owner</p>
                                                <p style="line-height: 2; margin: 0; text-align: right;">Field Address</p>
                                                <p style="line-height: 2; margin: 0; text-align: right;">Field Total Area</p>
                                            </div>
                                            <div class="col-7 responsive-font">
                                                <p style="line-height: 2; margin: 0;"><strong><?= htmlspecialchars($field['farmer_name'] ?: ' N/A', ENT_QUOTES, 'UTF-8') ?></strong></p>
                                                <p style="line-height: 2; margin: 0;"><strong><?= htmlspecialchars($field['fims_code'] ?: ' N/A', ENT_QUOTES, 'UTF-8') ?></strong></p>
                                                <p style="line-height: 2; margin: 0;"><strong><?= htmlspecialchars($field['field_owner'] ?: ' N/A', ENT_QUOTES, 'UTF-8') ?></strong></p>
                                                <p style="line-height: 2; margin: 0;"><strong><?= htmlspecialchars($field['field_address'] ?: ' N/A', ENT_QUOTES, 'UTF-8') ?></strong></p>
                                                <p style="line-height: 2; margin: 0;"><strong><?= htmlspecialchars($field['field_total_area'] ?: ' N/A', ENT_QUOTES, 'UTF-8') ?></strong></p>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>



                            <!-- Main Content -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">

                                        <h2 style="color:#88c431; margin-top: 10px;"><?= htmlspecialchars($field['field_name'], ENT_QUOTES, 'UTF-8') ?></h2>
                                    </div>
                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="planting-details-tab" data-toggle="tab" style="font-size: large; color:#88c431;" href="#planting-details" role="tab" aria-controls="planting-details" aria-selected="true"><i class="fa-solid fa-circle-info"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="expenses-tab" data-toggle="tab" href="#expenses" style="font-size: large; color:#88c431;" role="tab" aria-controls="expenses" aria-selected="false"><i class="fa-solid fa-money-bill-1-wave"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="damages-tab" data-toggle="tab" href="#damages" style="font-size: large; color:#88c431;" role="tab" aria-controls="damages" aria-selected="false"><i class="fa-solid fa-cloud-showers-water"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="harvest-details-tab" data-toggle="tab" style="font-size: large; color:#88c431;" href="#harvest-details" role="tab" aria-controls="harvest-details" aria-selected="false"><i class="fa-solid fa-seedling"></i></a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="planting-details" role="tabpanel" aria-labelledby="planting-details-tab">
                                                <div class="container">

                                                    <div class="table-responsive">
                                                        <table id="plantingTable" class="table table-striped table-bordered" style="width:100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Crop Variety</th>
                                                                    <th>Planting Date</th>
                                                                    <th>Season</th>
                                                                    <th>Start Date</th>
                                                                    <th>Notes</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (isset($plantingDetails) && !empty($plantingDetails)) : ?>
                                                                    <?php foreach ($plantingDetails as $detail) : ?>
                                                                        <tr>
                                                                            <td><?= htmlspecialchars($detail['crop_variety'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                            <td><?= htmlspecialchars($detail['planting_date'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                            <td><?= htmlspecialchars($detail['season'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                            <td><?= htmlspecialchars($detail['start_date'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                            <td><?= htmlspecialchars($detail['notes'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php else : ?>
                                                    <p style="font-size: 15px;"> </p>
                                                <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="expenses" role="tabpanel" aria-labelledby="expenses-tab">

                                                <div class="container">

                                                    <div class="table-responsive">
                                                        <table id="expenseTable" class="table table-striped table-bordered" style="width:100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Expense Details</th>
                                                                    <th>Date</th>
                                                                    <th>Total Money Spent</th>
                                                                    <th>Remarks</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (isset($expensesDetails) && !empty($expensesDetails)) : ?>
                                                                    <?php foreach ($expensesDetails as $expdetails) : ?>
                                                                        <tr>
                                                                            <td><?= htmlspecialchars($expdetails['expense_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                            <td><?= htmlspecialchars($expdetails['finished_date'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                            <td><?= htmlspecialchars($expdetails['total_money_spent'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                            <td><?= htmlspecialchars($expdetails['notes'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php else : ?>
                                                    <p style="font-size: 15px;"> </p>
                                                <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="damages" role="tabpanel" aria-labelledby="damages-tab">
                                                <h3>Damages</h3>
                                                <!-- Your damages content here -->
                                            </div>
                                            <div class="tab-pane fade" id="harvest-details" role="tabpanel" aria-labelledby="harvest-details-tab">
                                                <div class="container">

                                                    <div class="table-responsive">
                                                        <table id="harvestTable" class="table table-striped table-bordered" style="width:100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Variety Name</th>
                                                                    <th>Harvest Quantity</th>
                                                                    <th>Total Revenue</th>
                                                                    <th>Harvest Date</th>
                                                                    <th>Remarks</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (isset($harvestDetails) && !empty($harvestDetails)) : ?>
                                                                    <?php foreach ($harvestDetails as $harvestDetails) : ?>
                                                                        <tr>
                                                                            <td><?= htmlspecialchars($harvestDetails['variety_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                            <td><?= htmlspecialchars($harvestDetails['harvest_quantity'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                            <td><?= htmlspecialchars($harvestDetails['total_revenue'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                            <td><?= htmlspecialchars($harvestDetails['harvest_date'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                            <td><?= htmlspecialchars($harvestDetails['notes'], ENT_QUOTES, 'UTF-8') ?></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php else : ?>
                                                    <p style="font-size: 15px;"></p>
                                                <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5em;
        display: inline-block;
        width: auto;
    }

    .dataTables_wrapper .dataTables_length select {
        margin-right: 0.5em;
        display: inline-block;
        width: auto;
    }

    #plantingTable tbody tr {
        background-color: white;
    }

    #plantingTable tbody tr:hover {
        background-color: #f1f1f1;
    }

    #plantingTable thead th,
    #plantingTable tbody td {
        font-size: 17px;
    }

    #expenseTable thead th,
    #expenseTable tbody td {
        font-size: 17px;
    }

    #harvestTable thead th,
    #harvestTable tbody td {
        font-size: 17px;
    }
</style>

<script>
    $(document).ready(function() {
        $('#plantingTable').DataTable({
            "pagingType": "simple_numbers",
            "lengthMenu": [5, 10, 25, 50],
            "pageLength": 5,
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            "language": {
                "paginate": {
                    "previous": "<i class='fas fa-chevron-left'></i>",
                    "next": "<i class='fas fa-chevron-right'></i>"
                }
            }
        });
    });

    $(document).ready(function() {
        $('#expenseTable').DataTable({
            "pagingType": "simple_numbers",
            "lengthMenu": [5, 10, 25, 50],
            "pageLength": 5,
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            "language": {
                "paginate": {
                    "previous": "<i class='fas fa-chevron-left'></i>",
                    "next": "<i class='fas fa-chevron-right'></i>"
                }
            }
        });
    });
    $(document).ready(function() {
        $('#harvestTable').DataTable({
            "pagingType": "simple_numbers",
            "lengthMenu": [5, 10, 25, 50],
            "pageLength": 5,
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            "language": {
                "paginate": {
                    "previous": "<i class='fas fa-chevron-left'></i>",
                    "next": "<i class='fas fa-chevron-right'></i>"
                }
            }
        });
    });
</script>