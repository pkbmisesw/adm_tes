<?php

function getallsurat(){
    global $conn;
    $query = "SELECT * FROM `m_surat`";

    $sql = $conn->prepare($query);
    $sql->execute();

    $data = $sql->fetchAll();
    return $data;
}

function getsuratbyid($id)
{
    global $conn;
    $query = "SELECT * FROM `m_surat` WHERE id=$id";

    $sql = $conn->prepare($query);
    $sql->execute();

    $data = $sql->fetch();
    return $data;
}

?>