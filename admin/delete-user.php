<?php
$page_name = 'delete-user';


require_once '../system/db-connect.php';
require_once '../template/admin-header.php';
require_once '../template/admin-nav.php';
require_once '../system/functions/auto-load.php';

# Only Admin can enter this page
checkRole(['Admin']);





$id = intval(@$_REQUEST['id']);
$ref = intval(@$_REQUEST['ref']);

$query = $conn -> prepare("SELECT `username` FROM `userinfo` WHERE `id` = ?");
if(!$query -> execute([$id]))  
    die(showAlert("danger" , "خطای 54151516515: \n درخواست شما با مشکل مواجه شد. با پشتیبانی تماس بگیرید. 
                                    <a href='users-list.php?page=".$ref."'>بازگشت</a>"));


if($user = $query -> fetch()){
    $query = $conn -> prepare("DELETE FROM `userinfo` WHERE `id` = ?");
    if(!$query -> execute([$id])) 
        die(showAlert("danger" , "خطای 54151516515: \n درخواست شما با مشکل مواجه شد. با پشتیبانی تماس بگیرید. 
                                    <a href='users-list.php?page=".$ref."'>بازگشت</a>"));
    showAlert('success' , "کاربر {$user['username']} با موفقیت حذف شد. 
    <a href='users-list.php?page=".$ref."'>بازگشت</a>");

}
else{
    showAlert('danger' , "کاربر موردنظر وجود ندارد. مجددا تلاش کنید.  
    <a href='users-list.php?page=".$ref."'>بازگشت</a>");
}






require_once '../template/admin-footer.php';
