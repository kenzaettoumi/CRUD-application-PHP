<?php
session_start();
$mysqli = new mysqli('localhost:8012', 'root', 'password','crud') or die(mysqli_error($mysqli));
$update= false;
$name='';
$cin='';
$id = 0;
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $cin = $_POST['cin'];
   
    $mysqli->query("INSERT INTO info ( name, cin) VALUES('$name', '$cin')") or die($mysqli->error);
    $_SESSION['message']= "Record has been saved!";
    $_SESSION['msg_type']= "success";
    header("location: index.php");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM info WHERE id=$id") or die($mysqli->error);
    $_SESSION['message']= "Record has been deleted!";
    $_SESSION['msg_type']= "danger";
    header("location: index.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $mysqli->query("SELECT * FROM info WHERE id=$id") or die($mysqli->error);

    if(count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $cin = $row['cin'];

    }
    // $_SESSION['message']= "Record has been deleted!";
    // $_SESSION['msg_type']= "danger";
    // header("location: index.php");
}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $cin = $_POST['cin'];
   
    $mysqli->query(" UPDATE info SET name='$name', cin='$cin' WHERE id=$id") or die($mysqli->error);
    $_SESSION['message']= "Record has been updated!";
    $_SESSION['msg_type']= "warning";
    header("location: index.php");
}