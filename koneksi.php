<?php

$db = new mysqli('localhost', 'root', '', 'pweb');

if($db->connect_errno > 0){
    die('Koneksi gagal');
}