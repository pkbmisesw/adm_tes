<?php

function getUserById($id){
    global $conn;
    $query = "SELECT * FROM `m_user` WHERE id=$id";

    $sql = $conn->prepare($query);
    $sql->execute();

    $data = $sql->fetch();
    return $data;
}

?>