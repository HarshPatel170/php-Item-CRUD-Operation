<?php
session_start();
$mysqli=new mysqli('localhost','root','','training_sql') or die(mysqli_error($mysqli));
$id= 0;
$name='';
$location='';
$update=false;
if(isset($_POST['save'])){
    $name=$_POST['name'];
    $location= $_POST['location'];
    $mysqli->query("INSERT INTO crud2 (name,location) VALUES('$name','$location')") or die($mysqli->error);
    $_SESSION['message']="Record has been saved!";
    $_SESSION['msg_type'] ='success';
    header("location:index.php");
}

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $mysqli->query("DELETE FROM crud2 WHERE id=$id")or die($mysqli->error);
    $_SESSION['message']="Record has been deleted!";
    $_SESSION['msg_type'] ='danger';
    header("location:index.php");
}
if (isset($_GET['edit'])){
    $id= $_GET['edit'];
    //$id = 99;
    $update=true;
    $result=$mysqli->query("SELECT * FROM crud2 WHERE id=$id") or die($mysqli->error());
    $row=$result->fetch_array(MYSQLI_ASSOC);
    // echo '<pre>';
    // var_dump($row);s
    // echo '</pre>';
    // exit;
    $name=$row['name'];
    $location=$row['location'];
}
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $location=$_POST['location'];
    $mysqli->query("UPDATE crud2 SET name='$name',location='$location' WHERE id=$id") or die($mysqli->error());
    $_SESSION['message']="Record has been updated!";
    $_SESSION['msg_type'] ='warning';
    header("location:index.php");
}

 ?>