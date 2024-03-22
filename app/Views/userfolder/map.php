<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="<?= base_url() ?>assets_landingpage/img/small.png" type="image/png">
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/css/bootstrap1.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/themefy_icon/themify-icons.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/swiper_slider/css/swiper.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/select2/css/select2.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/niceselect/css/nice-select.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/owl_carousel/css/owl.carousel.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/gijgo/gijgo.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/font_awesome/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/tagsinput/tagsinput.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/datatable/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/datatable/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/datatable/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/text_editor/summernote-bs4.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/morris/morris.css">
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/material_icon/material-icons.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/css/metisMenu.css">
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/css/style1.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/css/colors/default.css" id="colorSkinCSS">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/5f1f084a1d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="<?= base_url() ?>dashboard/js/naujandata.js"></script>
    <script src="https://unpkg.com/@maptiler/geocoding-control@latest/leaflet.umd.js"></script>
    <link href="https://unpkg.com/@maptiler/geocoding-control@latest/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0px;
            right: 0;
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS</title>
</head>

<body>
    <?= $this->include('/dashboard/navbar') ?>
    <?= $this->include('/dashboard/topbar') ?>
    <?= $this->include('/dashboard/main-map') ?>
    <?= $this->include('/dashboard/end') ?>
</body>

</html>