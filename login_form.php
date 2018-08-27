<html></html>
<?php session_start();?>
<?php print_r($_SESSION);?>
<?php if(isset($_SESSION['name'])){
      header('Location: index.php');
      exit();

};?>
<?php include 'autoload.php'; ?>
<form method="post" action="">
<input type="text" name="user">
<br />
<input type="password" name="password">
<br />
<input type="submit" name="send">
<br />
</form>
 <?php $formChk = new functions();

if (isset($_POST['user'])) {
if($formChk->login($_POST['user'], $_POST['password']))
{
    header('Location: index.php');
}
foreach ($formChk->errors as $error)
    echo $error;
} ?>


