<?php
    if(!session_id()) {
        session_start();
    }
    $_SESSION['agi_modal_form_finished'] = TRUE;
    $redirect = (isset($_SESSION['agi_modal_last_page']) ? $_SESSION['agi_modal_last_page'] : "http://$_SERVER[HTTP_HOST]");
    
    header('Location: ' . $redirect);
    exit;