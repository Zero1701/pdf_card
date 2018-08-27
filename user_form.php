<?php session_start();?>
<?php include_once 'autoload.php';?>
<?php $form = new userFunctions(); ?>

<form enctype="multipart/form-data" action="" method="POST">
<label>Name: </label>
<input type="text" name="name" value="<?php if (isset($_POST['name'])) { echo $form->checkInput($_POST['name']);}?>">
<br />
<label>Surname: </label>
<input type="text" name="surname" value="<?php if (isset($_POST['surname'])) { echo $form->checkInput($_POST['surname']);}?>">
<br />
<label>Address: </label>
<input type="text" name="address" value="<?php if (isset($_POST['address'])) { echo $form->checkInput($_POST['address']);}?>">
<br />
<input type="radio" name="gender" value="0" <?php if (isset($_POST['gender']) && $_POST['gender'] == 0) {?> checked <?php } ?>>Male
<br />
<input type="radio" name="gender" value="1" <?php if (isset($_POST['gender']) && $_POST['gender'] == 1) {?> checked <?php } ?>>Female
<br />
<p>Upload your file</p>
<input type="file" name="image"><br />
<input type="submit" value="Upload">
</form>
<?php //print_r($_POST);
$image = "unknown-person.jpg";
if(!empty($_FILES['image']['name'])) { 
    $image = $_FILES['image']['name'];
    
    $form->upload($_FILES);}
if(isset($_POST)){ 
   // $form->insert_user($_POST['name'], $_POST['surname'], $_POST['gender'], $_POST['address'], $image);
    print_r($form->checkIfUserExists($_POST['name'], $_POST['surname']));

}