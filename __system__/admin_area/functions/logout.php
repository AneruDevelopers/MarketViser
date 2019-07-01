<?php
    if(isset($_SESSION['inf_func']))
        unset($_SESSION['inf_func']);
    
    header("Location: " . base_url_adm_php() . "login");
?>