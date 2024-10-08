<script>
    function openEditFieldModal(field_id, farmer_name, field_name, field_owner, field_address, field_total_area) {
        document.getElementById('editfield_id').value = field_id;
        document.getElementById('editfarmer_name').value = farmer_name;
        document.getElementById('editfield_name').value = field_name;
        document.getElementById('editfield_owner').value = field_owner;
        document.getElementById('editfield_address').value = field_address;
        document.getElementById('editfield_total_area').value = field_total_area;

        $('#editfieldmodal').modal('show');
    }


    function deleteProduct(field_id) {
        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                type: 'POST',
                url: '/viewfields/delete/' + field_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }

    $(document).ready(function() {
        $('#addfieldmodal').on('show.bs.modal', function() {
            $('#farmer_name').val('');
            $('#field_name').val('');
            $('#field_owner').val('');
            $('#field_address').val('');
            $('#field_total_area').val('');
        });
    });

    // crop planting


    function openAddPlantingModal(field_id, field_name) {
        document.getElementById('field_id_planting').value = field_id;
        document.getElementById('field_name_add').value = field_name;
        $('#addplantingmodal').modal('show');
    }

    function openEditPlantingModal(planting_id, farmer_name, field_name, crop_variety, planting_date, season, start_date, notes) {
        document.getElementById('editplanting_id').value = planting_id;
        document.getElementById('editfarmer_name').value = farmer_name;
        document.getElementById('editfield_name').value = field_name;
        document.getElementById('editcrop_variety').value = crop_variety;
        document.getElementById('editplanting_date').value = planting_date;
        document.getElementById('editseason').value = season;
        document.getElementById('editstart_date').value = start_date;
        document.getElementById('editnotes').value = notes;

        $('#editplantingmodal').modal('show');
    }

    function deleteplanting(planting_id) {
        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                type: 'POST',
                url: '/cropplanting/delete/' + planting_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }

    //jobs
    function openAddJobModal(field_id, field_name) {
        document.getElementById('field_id_add').value = field_id;
        document.getElementById('field_nameadd').value = field_name;
        $('#addjobmodal').modal('show');
    }

    function openEditJobModal(job_id, job_name, field_name, finished_date, worker_name, equipment_use, quantity_use, total_money_spent, notes) {
        document.getElementById('editjob_id').value = job_id;
        document.getElementById('editjob_name').value = job_name;
        document.getElementById('editfield_name').value = field_name;
        document.getElementById('editfinished_date').value = finished_date;
        document.getElementById('editworker_name').value = worker_name;
        document.getElementById('editequipment_use').value = equipment_use;
        document.getElementById('editquantity_use').value = quantity_use;
        document.getElementById('edittotal_money_spent').value = total_money_spent;
        document.getElementById('editnotes').value = notes;

        $('#editjobmodal').modal('show');
    }



    function deleteJob(job_id) {
        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                type: 'POST',
                url: '/jobs/delete/' + job_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }
    $(document).ready(function() {
        $('#addjobmodal').on('show.bs.modal', function() {

            $('#job_name').val('');
            $('#field_name').val('');
            $('#finished_date').val('');
            $('#equipment_use').val('');
            $('#quantity_use').val('');
            $('#total_money_spent').val('');
            $('#notes').val('');

        });
    });



    //harvest
    function openAddHarvestModal(field_id, field_name) {
        document.getElementById('field_id_harvest').value = field_id;
        document.getElementById('field_name_harvest').value = field_name;
        $('#addharvestmodal').modal('show');
    }

    function openEditHarvestModal(harvest_id, field_name, variety_name, harvest_quantity, total_revenue, harvest_date, notes) {
        document.getElementById('editharvest_id').value = harvest_id;
        document.getElementById('editfield_name').value = field_name;
        document.getElementById('editvariety_name').value = variety_name;
        document.getElementById('editharvest_quantity').value = harvest_quantity;
        document.getElementById('edittotal_revenue').value = total_revenue;
        document.getElementById('editharvest_date').value = harvest_date;
        document.getElementById('editnotes').value = notes;
        $('#editharvestmodal').modal('show');
    }


    function deleteHarvest(harvest_id) {
        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                type: 'POST',
                url: '/harvest/delete/' + harvest_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }
    $(document).ready(function() {
        $('#addharvestmodal').on('show.bs.modal', function() {

            $('#field_name').val('');
            $('#variety_name').val('');
            $('#harvest_quantity').val('');
            $('#total_revenue').val('');
            $('#harvest_date').val('');
            $('#total_money_spent').val('');
            $('#notes').val('');

        });
    });

    // worker
    function openEditWorkerModal(worker_id, worker_name, salaryperday) {
        document.getElementById('editworker_id').value = worker_id;
        document.getElementById('editworker_name').value = worker_name;
        document.getElementById('editsalaryperday').value = salaryperday;
        $('#editworkermodal').modal('show');
    }


    function deleteworker(worker_id) {
        if (confirm("Are you sure you want to delete this worker?")) {
            $.ajax({
                type: 'POST',
                url: '/workers/delete/' + worker_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }

    function openEditFarmerModal(id, fims_code, fullname, address, user_id) {
        document.getElementById('editid').value = id;
        document.getElementById('editfims_code').value = fims_code;
        document.getElementById('editfullname').value = fullname;
        document.getElementById('editaddress').value = address;

        $('#editfarmermodal').modal('show');
    }

    function deletefarmer(id) {
        if (confirm("Are you sure you want to delete this farmer?")) {
            $.ajax({
                type: 'POST',
                url: '/farmer/delete/' + id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }
    // damage

    function openAddDamageModal(planting_id, field_id, field_name, field_address, farmer_name, fims_code, crop_variety) {
        document.getElementById('planting_id').value = planting_id;
        document.getElementById('field_id').value = field_id;
        document.getElementById('field_name_add').value = field_name;
        document.getElementById('field_address_add').value = field_address;
        document.getElementById('farmer_name_add').value = farmer_name;
        document.getElementById('fims_code_add').value = fims_code;
        document.getElementById('crop_variety_add').value = crop_variety;
        $('#adddamagemodal').modal('show');
    }

    function openEditDamageModal(damage_id, pest_type, severity, symptoms, actions, weather_events, damage_descriptions, damage_severity, mitigation_measures) {
        document.getElementById('editdamage_id').value = damage_id;
        document.getElementById('editpest_type').value = pest_type;
        document.getElementById('editseverity').value = severity;
        document.getElementById('editsymptoms').value = symptoms;
        document.getElementById('editactions').value = actions;
        document.getElementById('editweather_events').value = weather_events;
        document.getElementById('editdamage_descriptions').value = damage_descriptions;
        document.getElementById('editdamage_severity').value = damage_severity;
        document.getElementById('editmitigation_measures').value = mitigation_measures;
        $('#editdamagemodal').modal('show');
    }


    function deleteDamage(damage_id) {
        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                type: 'POST',
                url: '/damage/delete/' + damage_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }
    $(document).ready(function() {
        $('#adddamagemodal').on('show.bs.modal', function() {

            $('#damage_type').val('');
            $('#pest_type').val('');
            $('#severity').val('');
            $('#symptoms').val('');
            $('#actions').val('');
            $('#weather_events').val('');
            $('#damage_descriptions').val('');
            $('#damage_severity').val('');
            $('#mitigation_measures').val('');

        });
    });

    function openEditUserReportsModal(report_id, title, description, images) {
        document.getElementById('edituserreport_id').value = report_id;
        document.getElementById('edituser_title').value = title;
        document.getElementById('edituser_description').value = description;
        const imageElement = document.getElementById('edituser_image_preview');
        imageElement.src = images;
        imageElement.style.display = 'block';

        $('#edituserreportsmodal').modal('show');
    }


    function deleteuserreport(report_id) {
        if (confirm("Are you sure you want to delete this report?")) {
            $.ajax({
                type: 'POST',
                url: '/deleteuserreport/delete/' + report_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }

    function openEditUserTrainingModal(training_id, event_title, date, time, speaker, place, image_training) {
        document.getElementById('edittraining_id').value = training_id;
        document.getElementById('editevent_title').value = event_title;
        document.getElementById('edit_date').value = date;
        document.getElementById('edit_time').value = time;
        document.getElementById('edit_speaker').value = speaker;
        document.getElementById('edit_place').value = place;
        const imageElement = document.getElementById('editimage_training_preview');
        imageElement.src = image_training;
        imageElement.style.display = 'block';
        $('#editusertrainingsmodal').modal('show');
    }

    function deleteusertraining(training_id) {
        if (confirm("Are you sure you want to delete this report?")) {
            $.ajax({
                type: 'POST',
                url: '/usertrainings/delete/' + training_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }
    // disease
    function openEditDiseaseModal(disease_id, dis_image, dis_name, dis_type, dis_desc, dis_solutions) {
        document.getElementById('editdisease_id').value = disease_id;
        document.getElementById('editdis_name').value = dis_name;
        document.getElementById('editdis_type').value = dis_type;
        document.getElementById('editdis_desc').value = dis_desc;
        document.getElementById('editdis_solutions').value = dis_solutions;

        const imageElement = document.getElementById('editdis_image_preview');
        imageElement.src = dis_image;
        imageElement.style.display = 'block';
        var editDiseaseModal = new bootstrap.Modal(document.getElementById('editdiseasemodal'));
        editDiseaseModal.show();
    }

    function deletedisease(disease_id) {
        if (confirm("Are you sure you want to delete this disease?")) {
            $.ajax({
                type: 'POST',
                url: '/dis/delete/' + disease_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }
    //pest
    function openEditPestModal(pest_id, pest_name, pest_type, pest_desc, pest_solutions) {
        document.getElementById('editpest_id').value = pest_id;
        document.getElementById('editpest_name').value = pest_name;
        document.getElementById('editpest_type').value = pest_type;
        document.getElementById('editpest_desc').value = pest_desc;
        document.getElementById('editpest_solutions').value = pest_solutions;

        const imageElement = document.getElementById('editpest_image_preview');
        imageElement.src = pest_image;
        imageElement.style.pestplay = 'block';
        var editPestModal = new bootstrap.Modal(document.getElementById('editpestmodal'));
        editPestModal.show();
    }

    function deletepest(pest_id) {
        if (confirm("Are you sure you want to delete this pest?")) {
            $.ajax({
                type: 'POST',
                url: '/userpest/delete/' + pest_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }

    function openEditDisasterModal(disaster_id, weather_events, damage_description, damage_severity, mititgation_measures) {
        document.getElementById('editdisaster_id').value = disaster_id;
        document.getElementById('editweather_events').value = weather_events;
        document.getElementById('editdamage_description').value = damage_description;
        document.getElementById('editdamage_severity').value = damage_severity;
        document.getElementById('editmititgation_measures').value = mititgation_measures;

        var editDisasterModal = new bootstrap.Modal(document.getElementById('editdisastermodal'));
        editDisasterModal.show();
    }

    function deletedisaster(disaster_id) {
        if (confirm("Are you sure you want to delete this disaster?")) {
            $.ajax({
                type: 'POST',
                url: '/disaster/delete/' + disaster_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }

    function openUserEditTriviaModal(trivia_id, triviatitle, trivia) {
        document.getElementById('useredittrivia_id').value = trivia_id;
        document.getElementById('useredittriviatitle').value = triviatitle;
        document.getElementById('useredit_trivia').value = trivia;
        $('#useredittriviasmodal').modal('show');
    }


    function deletetrivia(trivia_id) {
        if (confirm("Are you sure you want to delete this trivia?")) {
            $.ajax({
                type: 'POST',
                url: '/adtrivias/delete/' + trivia_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#farmer_name').on('input', function() {
            var input = $(this).val().toLowerCase();
            $('#farmer-name-options option').each(function() {
                var optionText = $(this).text().toLowerCase();
                if (optionText.indexOf(input) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js">
</script>

<script>
    $(document).ready(function() {
        $('#fullname').on('input', function() {
            var searchValue = $(this).val();

            console.log('Search value:', searchValue);

            $.ajax({
                url: '/search-profiles',
                method: 'POST',
                data: {
                    search: searchValue
                },
                success: function(response) {
                    console.log('Search results:', response);

                    $('#fullname-options').empty();
                    response.forEach(function(profile) {
                        $('#fullname-options').append(`<option value="${profile.fullname}">`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    (function(w, d, v3) {
        w.chaportConfig = {
            appId: '661be9dc7db7c259746c97d2'
        };

        if (w.chaport) return;
        v3 = w.chaport = {};
        v3._q = [];
        v3._l = {};
        v3.q = function() {
            v3._q.push(arguments)
        };
        v3.on = function(e, fn) {
            if (!v3._l[e]) v3._l[e] = [];
            v3._l[e].push(fn)
        };
        var s = d.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'https://app.chaport.com/javascripts/insert.js';
        var ss = d.getElementsByTagName('script')[0];
        ss.parentNode.insertBefore(s, ss)
    })(window, document);
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>dashboard/js/jquery1-3.4.1.min.js"></script>

<script src="<?= base_url() ?>dashboard/js/popper1.min.js"></script>

<script src="<?= base_url() ?>dashboard/js/bootstrap1.min.js"></script>

<script src="<?= base_url() ?>dashboard/js/metisMenu.js"></script>

<script src="<?= base_url() ?>dashboard/vendors/count_up/jquery.waypoints.min.js"></script>

<script src="<?= base_url() ?>dashboard/vendors/chartlist/Chart.min.js"></script>

<script src="<?= base_url() ?>dashboard/vendors/count_up/jquery.counterup.min.js"></script>

<script src="<?= base_url() ?>dashboard/vendors/swiper_slider/js/swiper.min.js"></script>

<script src="<?= base_url() ?>dashboard/vendors/niceselect/js/jquery.nice-select.min.js"></script>

<script src="<?= base_url() ?>dashboard/vendors/owl_carousel/js/owl.carousel.min.js"></script>

<script src="<?= base_url() ?>dashboard/vendors/gijgo/gijgo.min.js"></script>

<script src="<?= base_url() ?>dashboard/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>dashboard/vendors/datatable/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>dashboard/vendors/datatable/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>dashboard/vendors/datatable/js/buttons.flash.min.js"></script>
<script src="<?= base_url() ?>dashboard/vendors/datatable/js/jszip.min.js"></script>
<script src="<?= base_url() ?>dashboard/vendors/datatable/js/pdfmake.min.js"></script>
<script src="<?= base_url() ?>dashboard/vendors/datatable/js/vfs_fonts.js"></script>
<script src="<?= base_url() ?>dashboard/vendors/datatable/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>dashboard/vendors/datatable/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>dashboard/js/chart.min.js"></script>

<script src="<?= base_url() ?>dashboard/vendors/progressbar/jquery.barfiller.js"></script>

<script src="<?= base_url() ?>dashboard/vendors/tagsinput/tagsinput.js"></script>

<script src="<?= base_url() ?>dashboard/vendors/text_editor/summernote-bs4.js"></script>
<script src="<?= base_url() ?>dashboard/vendors/apex_chart/apexcharts.js"></script>

<script src="<?= base_url() ?>dashboard/js/custom.js"></script>
<script src="<?= base_url() ?>dashboard/vendors/apex_chart/bar_active_1.js"></script>
<script src="<?= base_url() ?>dashboard/vendors/apex_chart/apex_chart_list.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= base_url() ?>dashboard/vendors/chartjs/chartjs_init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dom-to-image-more@2.8.0/dist/dom-to-image-more.min.js"></script>

</body>

</html>