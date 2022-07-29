<?php
require "../Models/User.php";
include_once "../config/url.php";

if(!isset($_POST['userController'])) {
    header('location:/?error=injection');
    return false;

}
$reqe = $_SERVER['REQUEST_URI'];


$model = new User();

switch($_POST['userController']) {
    case 'register':
        $validate = validateUserRegister($model, $_POST);
        if(count($validate)) 

        {
            header("location: $BASE_URL/register.php?error=validation&content=" .  json_encode($validate)); 
            die();
            
        }
        $result = $model -> postUser($_POST);
        
        break;

    default:
        echo 'Deu ruim no Usercontroler';
    }

function validateUserRegister(User $user, array $data){

    $errors = [];
    $userExist = $user -> getUser($data['email'], 'email');
    if($userExist){
        $errors[] = 2;
    }

    return $errors;

}