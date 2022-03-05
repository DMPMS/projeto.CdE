<?php
function logado()
{
    if (isset($_SESSION['id']) == '') {
        $_SESSION['Entrar'] = True;
        return false;
    } else {
        return true;
    }
}
