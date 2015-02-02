<?php
    if(!session_id()) {
        session_start();
    }
    
    if(!isset($_SESSION['agi_modal_last_activity']) || $_SESSION['agi_modal_last_activity'] >= time() - (60*10)) {
	    header("Location : http://$_SERVER[HTTP_HOST]")
    }
    
    $_SESSION['agi_modal_form_finished'] = TRUE;
    $passthrough_url = $_REQUEST['passthrough_url'];
    $redirect = (isset($_SESSION['agi_modal_last_page']) ? $_SESSION['agi_modal_last_page'] : "http://$_SERVER[HTTP_HOST]");
    
    header('Location: ' . $redirect);
    exit;