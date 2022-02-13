<div id="foozawebMenu" class="foozawebMenu">
    <?php $this->load->view('template/calculator'); ?>
</div>

<script>
    $(document).mousedown(function(event) {
        if (event.which == 1) {
            if (!$(event.target).closest(".foozawebMenu").length) {
                $("body").find(".foozawebMenu").fadeOut("fast");
            }
        }
    });

    $("body").keydown(function(event) {
        var x = event.keyCode;
        if (x == 117) {
            $('.foozawebMenu').fadeIn('fast');
        }
    });
</script>