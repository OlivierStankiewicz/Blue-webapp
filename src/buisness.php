<?php

use MongoDB\BSON\ObjectID;

function get_db()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;

    return $db;
}

function addImgToDB($name, $title, $author, $watermark)
{
    $db = get_db();

    $image = [
        'title' => $title,
        'author' => $author,
        'watermark' => $watermark,
        'photo' => '../upload/original/' . $name,
        'photoWatermark' => '../upload/watermark/watermark'. $name,
        'photoMiniature' => '../upload/miniature/mini'. $name,
    ];

    $db->gallery->insertOne($image);
}
function create_alert($message)
{
    $GLOBALS['alerts'][] = $message;
}

function create_watermark($watermark, $file_name, $original_dir, $ext)
{
    if($ext == 'jpg')
    {
        $newImage = imagecreatefromjpeg($original_dir);
    }
    else
    {
        $newImage = imagecreatefrompng($original_dir);
    }

    $textcolor = imagecolorallocate($newImage, 255, 255, 255);

    $font = '../web/static/Helvetica.ttf';

    imagefttext($newImage, 15, 0, 20, 20, $textcolor, $font, $watermark);
    
    $target_dir = '../web/upload/watermark/watermark'. $file_name;

    imagepng($newImage, $target_dir);

    imagedestroy($newImage);
}

function create_miniature($file_name, $original_dir, $ext)
{
    if ($ext == 'jpg') {
        $image = imagecreatefromjpeg($original_dir);
    }
    else {
        $image = imagecreatefrompng($original_dir);
    }

    $miniature = imagescale($image, 200, 125);

    $target_dir = '../web/upload/miniature/mini'. $file_name;
    
    imagepng($miniature, $target_dir);

    imagedestroy($image);
}

function getAllImages()
{
    $db = get_db();

    $images = $db->gallery->find();

    return $images;
}

function getImages($skip, $limit)
{
    $db = get_db();
    $query = [];
    $opts = [
        'skip' => $skip,
        'limit' => $limit,
    ];

    $images = $db->gallery->find($query, $opts);

    return $images;
}

function loginAvailable($login)
{
    $db = get_db();

    $query = [
        'login' => $login,
    ];

    $logins = $db->users->findOne($query);

    if($logins){
        return false;
    }

    else{
        return true;
    }
}

function UserToDB($email, $login, $password)
{
    $db = get_db();

    $user = [
        'email' => $email,
        'login' => $login,
        'password' => $password,
    ];

    $db->users->insertOne($user);
}

function getUser($login)
{
    $db = get_db();
    $user = $db->users->findOne(['login' => $login]);

    return $user;
}