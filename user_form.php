<?php include_once 'autoload.php';?>


<?php
$form = new userFunctions(); 
$id = new userIndex();
$insert_id = $id->maxID() + 1;

$image = "unknown-person.jpg";
if(!empty($_FILES['image']['name'])) {
    $image = $_FILES['image']['name'];
    
    $form->upload($_FILES);}
    if(isset($_POST) && !empty($_POST)){
        if($form->form_errors($_POST['name'], $_POST['surname'], $_POST['address'], $_POST['company'], $_POST['position'], $_POST['email'], $_POST['phone'])){
         
            $form->insert_user($_POST['name'], $_POST['surname'], $_POST['address'], $image, $_POST['company'], $_POST['position'], $_POST['email'], $_POST['phone']);
       
       
        $pdf = new PDF();
        
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->Image($form->filepath($image),10,6,25);
        $pdf->Cell(0,10," ",0,1);
        $pdf->SetFont('Times','',12);
        if($_POST['color'] == 0) {
            $pdf->SetTextColor(0,0,0);
            
        }
        elseif ($_POST['color'] == 1)
        {
            $pdf->SetTextColor(255,0,0);
        } elseif ($_POST['color'] == 2)
        {
            $pdf->SetTextColor(0,0,255);
        }
        unset($_POST['color']);
        foreach ($_POST as $key => $data)
        {
            
            $pdf->Cell(0,10,"$key: $data",0,1);
            
        }
        $pdf->Output('pdfs/Business card' . $insert_id . '.pdf', F);
        header('Location: index.php');
        }
    }
?>
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
<label>E-mail: </label>
<input type="text" name="email" value="<?php if (isset($_POST['email'])) { echo $form->checkInput($_POST['email']);}?>">
<br />
<label>Company: </label>
<input type="text" name="company" value="<?php if (isset($_POST['company'])) { echo $form->checkInput($_POST['company']);}?>">
<br />
<label>Position: </label>
<input type="text" name="position" value="<?php if (isset($_POST['position'])) { echo $form->checkInput($_POST['position']);}?>">
<br />
<label>Phone: </label>
<input type="text" name="phone" value="<?php if (isset($_POST['phone'])) { echo $form->checkInput($_POST['phone']);}?>">
<br />
 <select name="color">
  <option value="0">Black</option>
  <option value="1">Red</option>
  <option value="2">Blue</option>
</select>
<br />
<p>Upload your file</p>
<input type="file" name="image"><br />
<input type="submit" value="Create PDF">
</form>
<?php foreach ($form->errors as $error) {
    echo $error;
    ;
}?>