<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('UTC');

?>
<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>

    <?php if (isset($title)) {
        echo "<title>" . $title . "</title>";
        echo "<meta name=\"description\" content=\" . $description . \"/>";
    } else {
        echo "<title>Social Edu | The Platform For Just Studies</title>";
    }
    ?>
    </script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Social Edu | The Platform For Just Studies" name="description"/>

    <link rel="shortcut icon" href="<?php echo base_url() ?>favicon.ico"/>

    <meta name="msvalidate.01" content="8C279266A0A7E9276250B90EE2FE3941"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
          rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    
        <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css?velse"
          rel="stylesheet" type="text/css"/>
    <link
            href="<?php echo base_url() ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css?velse"
            rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/clockface/css/clockface.css?velse" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/jquery-multi-select/css/multi-select.css?velse"
          rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/select2/css/select2.min.css?velse" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/select2/css/select2-bootstrap.min.css?velse"
          rel="stylesheet"
          type="text/css"/>

    <link href="<?php echo base_url() ?>assets/global/plugins/jstree/dist/themes/default/style.min.css?velse"
          rel="stylesheet"
          type="text/css"/>

    <link href="<?php echo base_url() ?>assets/global/plugins/typeahead/typeahead.css?velse" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/select2/css/select2.min.css?velse" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/select2/css/select2-bootstrap.min.css?velse"
          rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/fancybox/source/jquery.fancybox.css?velse"
          rel="stylesheet"
          type="text/css"/>
        <!-- END PAGE LEVEL PLUGINS --><!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo base_url() ?>assets/global/css/components-md.min.css?velse" rel="stylesheet"
          id="style_components"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/css/plugins-md.min.css?velse" rel="stylesheet" type="text/css"/>
        <!-- END THEME GLOBAL STYLES --><!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo base_url() ?>assets/pages/css/blog.min.css?velse" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/pages/css/profile-2.min.css?velse" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/pages/css/invoice-2.min.css?velse" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/pages/css/contact.min.css?velse" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/pages/css/profile.min.css?velse" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/pages/css/search.min.css?velse" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL STYLES -->


    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?php echo base_url() ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/layouts/layout/css/themes/light2.min.css" rel="stylesheet"
          type="text/css"
          id="style_color"/>
    <link href="<?php echo base_url() ?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->

    <link href="<?php echo base_url() ?>assets/_/css/all.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/v1/jquery.wallform.js?velse"
            type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/v1/alert.js?velse" type="text/javascript"></script>

</head>
<!-- END HEAD -->

