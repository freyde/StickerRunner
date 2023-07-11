<?php
    session_start();
    include('dbh.inc.php');

    if(isset($_POST['it_code'])){
        $i_c = $_POST['it_code'];
        global $i_c;
    } else {
        return 'aye';
    }






?>