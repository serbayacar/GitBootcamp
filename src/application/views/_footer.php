<?php
if (!class_exists('Login')) {
    ?>
    </div>
    <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->

    <div class="page-footer">
        <div class="page-footer-inner"> 2016 &copy; Pickyfy By
            <a target="_blank" href="http://gladiustechnology.com/">Gladius Technology</a>


        </div>
        <?php
        if (class_exists('Search_Plus') || class_exists('Search')) {
        ?>

        <div style="display: none" class="text-right">
        <a style="padding: 2px 18px;" href="#contactForm_Modal" data-toggle="modal" role="button" class="btn red btn-sm"><?php echo lang("contact"); ?></a>
        </div>
        <?php
        }
        ?>
        <div class="scroll-to-top"><i class="icon-arrow-up"></i></div>
    </div>
    <!-- END FOOTER -->
    </div>
    <?php
}
?>

<!--[if lt IE 9]>
<script src="<?php echo base_url() ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/excanvas.min.js"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js"
        type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<?php
if (class_exists('Search_Plus')) {
    ?>

    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js?vSearch_Plus"
            type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js?vSearch_Plus"
            type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js?vSearch_Plus"
            type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js?vSearch_Plus"
            type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js?vSearch_Plus"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo base_url() ?>assets/global/scripts/app.min.js?vSearch_Plus"
            type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->

    <script src="<?php echo base_url() ?>assets/pages/scripts/search.min.js?vSearch_Plus"
            type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/pages/scripts/components-bootstrap-select.min.js?vSearch_Plus"
            type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/pages/scripts/components-bootstrap-multiselect.min.js?vSearch_Plus"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <?php
} else
    if (class_exists('Login')) {
        ?>

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js?vLogin"
                type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js?vLogin"
                type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js?vLogin"
                type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/backstretch/jquery.backstretch.min.js?vLogin"
                type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js?vLogin" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/v1/login-5.js?vLogin" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->

        <?php
    } else {
        ?>
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/gmaps/gmaps.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/JSPdf/jspdf.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/JSPdf/pdfFromHTML.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/html2canvas/dist/html2canvas.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js?vElse"
                type="text/javascript"></script>

        <!--
        <script src="<?php echo base_url() ?>assets/global/plugins/typeahead/handlebars.min.js?vElse"
                type="text/javascript"></script><script src="<?php echo base_url() ?>assets/global/plugins/typeahead/typeahead.bundle.min.js?vElse"
                type="text/javascript"></script>

                -->
        <script src="<?php echo base_url() ?>assets/global/plugins/select2/js/select2.full.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/jquery.sparkline.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/jstree/dist/jstree.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/select2/js/select2.full.min.js?vElse"
                type="text/javascript"></script>

        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/moment.min.js?vElse" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/clockface/js/clockface.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/datatables/datatables.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/select2/js/select2.full.min.js?vElse"
                type="text/javascript"></script>

        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/ckeditor/ckeditor.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-markdown/lib/markdown.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js?vElse"
                type="text/javascript"></script>

        <script src="<?php echo base_url() ?>assets/global/plugins/jquery.wallform.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/alert.js?vElse" type="text/javascript"></script>

        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url() ?>assets/global/scripts/app.min.js?vElse" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url() ?>assets/pages/scripts/table-datatables-buttons.min.js?vElse"
                type="text/javascript"></script>

        <script src="<?php echo base_url() ?>assets/pages/scripts/contact.min.js" type="text/javascript"></script>

        <!--
        <script src="<?php echo base_url() ?>assets/pages/scripts/components-typeahead.min.js?vElse"
                type="text/javascript"></script>
-->
        <script src="<?php echo base_url() ?>assets/pages/scripts/components-select2.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/pages/scripts/components-bootstrap-select.min.js?vElse"
                type="text/javascript"></script>

        <script src="<?php echo base_url() ?>assets/pages/scripts/profile.min.js?vElse" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/pages/scripts/ui-tree.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/pages/scripts/components-multi-select.min.js?vElse"
                type="text/javascript"></script>

        <script src="<?php echo base_url() ?>assets/pages/scripts/search.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/pages/scripts/components-date-time-pickers.min.js?vElse"
                type="text/javascript"></script>

        <script src="<?php echo base_url() ?>assets/pages/scripts/components-bootstrap-multiselect.min.js?vElse"
                type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/pages/scripts/components-bootstrap-maxlength.min.js?vElse"
                type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php
    }
?>


<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url() ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/layouts/global/scripts/quick-sidebar.min.js"
        type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->


<script src="<?php echo base_url() ?>assets/_/js/jquery.marquee.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/_/js/all.js" type="text/javascript"></script>
</body>
</html>
