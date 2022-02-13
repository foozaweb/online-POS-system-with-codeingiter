<!-- START: Footer-->
<footer class="site-footer">
    CopyRight &copy; <?php echo date('Y') ?> <?php echo $this->db->get('chb_settings')->row_array()['sitename'] ?>
</footer>
<!-- END: Footer-->


<!-- START: Back to top-->
<a href="#" class="scrollup text-center">
    <i class="icon-arrow-up"></i>
</a>
<!-- END: Back to top-->


<script>
    var base_url = "<?php echo base_url() ?>";
</script>
<!-- START: Template JS-->
<script src="<?php echo base_url() ?>dist/vendors/jquery/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/moment/moment.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
<!-- END: Template JS-->


<!-- START: Page JS-->
<!-- START: Page JS-->
<script src="<?php echo base_url() ?>dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/jquery-flot/jquery.flot.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
<script src="<?php echo base_url() ?>dist/vendors/jquery-flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url() ?>dist/js/home.script.js"></script>
<script src="<?php echo base_url() ?>dist/color_picker/jquery.minicolors.js"></script>
<!-- END: Page JS-->
<!-- END: Page JS-->


<script src="<?php echo base_url() ?>dist/vendors/toastr/toastr.min.js"></script>
<script src="<?php echo base_url() ?>dist/js/toastr.script.js"></script>


<script>
    var CurrentWebPage = "<?php echo $webpage ?>";
</script>
<!-- START: APP JS-->
<script src="<?php echo base_url() ?>dist/js/app.js"></script>
<!-- END: APP JS-->

<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$session = array('currentUrl' => $actual_link);
$this->session->set_userdata($session);
?>

</body>

</html>