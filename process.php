<?php

$conn = new mysqli("localhost","root","","crud_vue");
if($conn->connect_error){
    die("connection failed ".$conn->connect_error);
}
$result = array('error'=>false);
$action = '';
if(isset($_GET['action'])){
    $action = $_GET['action'];
}
if($action == 'read'){
    $sql = $conn->query("SELECT * FROM utilisateur");
    $users = array();
    while($row = $sql->fetch_assoc()){
        array_push($users,$row);
    }
    $result['users'] = $users;
}

if($action == 'create'){
    $name = $_POST['nom'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = $conn->query("INSERT INTO  utilisateur (nom,email,phone) VALUES ('$name','$email','$phone')");
    if($sql){
        $result['message'] = "user added successefully";
    }
    else{
        $result['erro'] = true;
        $result['message'] = "failed to add user";

    }
   
}


if($action == 'update'){
    $id = $_POST['id'];
    $name = $_POST['nom'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = $conn->query("UPDATE utilisateur SET nom='$name', email='$email', phone='$phone' WHERE id='$id'");
    if($sql){
        $result['message'] = "user upadted successefully";
    }
    else{
        $result['erro'] = true;
        $result['message'] = "failed to update user";

    }
   
}


if($action == 'delete'){
    $id = $_POST['id'];

    $sql = $conn->query("DELETE FROM utilisateur WHERE id='$id'");
    if($sql){
        $result['message'] = "user deleted successefully";
    }
    else{
        $result['erro'] = true;
        $result['message'] = "failed to deleted user";

    }
   
}
echo json_encode($result);
?>