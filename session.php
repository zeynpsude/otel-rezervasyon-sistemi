<?php
function isLoggedIn() {
    return isset($_SESSION['kullanici_adi']); 
}

function logout() {
    session_unset(); 
    session_destroy(); 
}
?>
