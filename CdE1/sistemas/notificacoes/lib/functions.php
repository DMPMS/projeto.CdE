<?php

function select_notificaoes($con) {
    if (isset($_GET['usuario'])) {
        $sql = $con->prepare("SELECT * FROM notifications WHERE id_para = ? ORDER BY id DESC");
        $sql->bind_param("s", $_GET['usuario']);
        $sql->execute();
        $get = $sql->get_result();
        $total = $get->num_rows;

        if ($total > 0) {
            while ($dados = $get->fetch_array()) {
                switch ($dados['status']) {
                    case 0:
                        $dados['status'] = "Não lido";
                        break;

                    case 1:
                        $dados['status'] = "Lido";
                        break;
                }
                echo "<li>{$dados['notificacao']} | {$dados['status']}</li>";
            }
        }
    }
}

function mark_read($con) {
    if (isset($_GET['usuario'])) {

        $sql = $con->prepare("UPDATE notifications SET status = 1 WHERE id_para = ?");
        $sql->bind_param("s", $_GET['usuario']);
        $sql->execute();

        $success = null;

        switch ($sql->affected_rows) {
            case -1:
                $success = false;
                break;

            case 0:
                $success = true;
                break;

            case 1:
                $success = true;
                break;
        }


        echo json_encode(array("success" => $success));
    }
}

?>