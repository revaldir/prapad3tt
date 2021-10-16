<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from shreyu.coderthemes.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Nov 2019 03:34:59 GMT -->
<head>
        <meta charset="utf-8" />
        <title>ISTANA SALON</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/istana_logo.png">

        <!-- plugins -->
        <link href="<?php echo base_url() ?>assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <link href="<?php echo base_url() ?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

         <script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script>
       

    </head>

    <body>
        

        <?= $contents ?>

        <!-- Vendor js -->
        <script src="<?php echo base_url() ?>assets/js/vendor.min.js"></script>

        <!-- optional plugins -->
        <script src="<?php echo base_url() ?>assets/libs/moment/moment.min.js"></script>
        <script src="<?php echo base_url() ?>assets/libs/apexcharts/apexcharts.min.js"></script>
        <script src="<?php echo base_url() ?>assets/libs/flatpickr/flatpickr.min.js"></script>

        <!-- page js -->
        <script src="<?php echo base_url() ?>assets/js/pages/dashboard.init.js"></script>

        <script src="<?php echo base_url() ?>assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo base_url() ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url() ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>

        <!-- App js -->
         <script src="<?php echo base_url() ?>assets/js/app.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/format_rp.js"></script>

        <script type="text/javascript">
            $('.datatables').DataTable();

            $( document ).ready(function(){
                  window.print();
              });
        </script>
    </body>

</html>