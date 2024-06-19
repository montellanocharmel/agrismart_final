<script>
    function openEditPasswordModal(leader_id, password) {
        document.getElementById('editleader_id').value = leader_id;
        document.getElementById('editpassword').value = password;
        $('#editpasswordmodal').modal('show');
    }

    function openEditAccountModal(leader_id, leader_name, idnumber, position) {
        document.getElementById('editleader_id1').value = leader_id;
        document.getElementById('editleader_name').value = leader_name;
        document.getElementById('editidnumber').value = idnumber;
        document.getElementById('editposition').value = position;
        $('#editaccountmodal').modal('show');
    }

    function openEditTriviaModal(trivia_id, triviatitle, trivia) {
        document.getElementById('edittrivia_id').value = trivia_id;
        document.getElementById('edittriviatitle').value = triviatitle;
        document.getElementById('edit_trivia').value = trivia;
        $('#edittriviasmodal').modal('show');
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

    function openEditReportsModal(report_id, title, description, validity) {
        document.getElementById('editreport_id').value = report_id;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_validity').value = validity;
        $('#editreportsmodal').modal('show');
    }

    function deletereport(report_id) {
        if (confirm("Are you sure you want to delete this report?")) {
            $.ajax({
                type: 'POST',
                url: '/adreports/delete/' + report_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }

    function openEditTrainingModal(training_id, event_title, date, time, speaker, place, validity_training) {
        document.getElementById('edittraining_id').value = training_id;
        document.getElementById('editevent_title').value = event_title;
        document.getElementById('edit_date').value = date;
        document.getElementById('edit_time').value = time;
        document.getElementById('edit_speaker').value = speaker;
        document.getElementById('edit_place').value = place;
        document.getElementById('editvalidity_training').value = validity_training;
        $('#edittrainingsmodal').modal('show');
    }

    function deletetraining(training_id) {
        if (confirm("Are you sure you want to delete this report?")) {
            $.ajax({
                type: 'POST',
                url: '/adtrainings/delete/' + training_id,
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }

    function openEditReportsModal(report_id, title, description, validity) {
        document.getElementById('editreport_id').value = report_id;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_validity').value = validity;
        $('#editreportsmodal').modal('show');
    }

    function deletereport(report_id) {
        if (confirm("Are you sure you want to delete this report?")) {
            $.ajax({
                type: 'POST',
                url: '/adreports/delete/' + report_id,
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
</body>

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

</html>