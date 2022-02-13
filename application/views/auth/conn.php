<div class="messengerWrapper row"> </div>
<?php
if (!$this->session->userdata('chbAuth') || $this->session->userdata('chbAuth') == "") {
    redirect(base_url() . 'auth/statics?AuthStatus=failed');
}

if ($this->session->userdata('screen_locked') || $this->session->userdata('screen_locked')) {
    redirect(base_url() . 'auth/lockScreen?screenLocked');
}


if ($staff['position'] != "Sales") {
    redirect(base_url() . 'auth/statics?AuthStatus=failed');
}


?>