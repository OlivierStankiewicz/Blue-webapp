<?php

require "buisness.php";
function index(&$model)
{
    return 'index_view';
}

function about(&$model)
{
    return 'about_view';
}

function gallery(&$model)
{
    $photos = getAllImages();
    $photos = $photos->toArray();
    $quantity = count($photos);
    $pageSize = 5;
    $pages = ceil($quantity/$pageSize);
    $model['pages'] = $pages;
    $model['page'] = 1;

    if(!isset($_GET['page'])) {
        $page = 1;
        $model['page'] = $page;
    } else {
        $page = $_GET['page'];
        $model['page'] = $page;
    }

    $skip = ($page - 1) * $pageSize;
    $limit = $pageSize;

    $certainPhotos = getImages($skip, $limit);
    $model['images'] = $certainPhotos;
    
    return 'gallery_view';
}

function addImg(&$model)
{
    $model['isAdded'] = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $GLOBALS['alerts'] = [];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $watermark = $_POST['watermark'];

        if ($_FILES['image']['size'] != 0)
        {
            if ($_FILES['image']['size'] > 1000000)
            {
                create_alert("Za duży plik!");
            }
            
            $ext = strtolower(pathinfo($_FILES['image']["name"], PATHINFO_EXTENSION));

            if($ext != "png" && $ext != "jpg")
            {
                    create_alert("Zły typ pliku");
            }

            if(empty($GLOBALS['alerts']))
            {
                $upload_dir = '../web/upload/original/';
                $file = $_FILES['image'];
                $imageID = uniqid('',true);
                $file_name = $imageID . basename($file['name']);
                $target = $upload_dir . $file_name;
                $tmp_path = $file['tmp_name'];

                if(move_uploaded_file($tmp_path, $target))
                {
                    create_alert("Upload przebiegł pomyślnie!");
                }

                create_watermark($watermark, $file_name, $target, $ext);
                create_miniature($file_name, $target, $ext);
                addImgToDB($file_name, $title, $author, $watermark);
                $model['isAdded'] = true;
            }         
        }
        else
        {
                create_alert("Brak pliku");
        }
        $model['alerts'] = $GLOBALS['alerts'];
    }

      return 'addImg_view';
}

function account(&$model)
{
    $model['loggedIn'] = false;
    $model['registration_err'] = [];
    $model['login_err'] = [];

    if (isset($_POST['submit'])) {
        if($_POST['submit'] == "log_in")
        {
            $login = $_POST['login'];
            $password = $_POST['password'];
            
            if(!loginAvailable($login))
            {
                $user = getUser($login);
                if(password_verify($password, $user['password'])){
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['user_login'] = $login;
                }
                else{
                    $model['login_err'][] = "Złe hasło";
                }
            }
            else{
                $model['login_err'][] = "Nie ma użytkownika z takim loginem";
            }
        }

        else if($_POST['submit'] == "registration")
        {
            $login = $_POST['login'];
            $email = $_POST['email'];
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];

            if(!loginAvailable($login))
            {
                $model['registration_err'][] = "Wybnrany login jest zajęty";
            }
            else{
                if ($password1 === $password2) {
                    $password = password_hash($password1, PASSWORD_DEFAULT);
                    UserToDB($email, $login, $password);
                }
                else{
                    $model['registration_err'][] = "Podane hasła nie są identyczne";
                }
            }
        }
        else if($_POST['submit'] == "logout")
        {
            session_destroy();
            $model['loggedIn'] = false;
    
            return 'account_view';
        }
    }

    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
        $model['loggedIn'] = true;
    }

    return 'account_view';
}