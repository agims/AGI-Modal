<?php
    if(!session_id()) {
        session_start();
    }

	$_SESSION['agi_modal_form_loaded'] = $_SESSION['agi_modal_form_loaded'] + 1;