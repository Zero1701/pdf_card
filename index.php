<?php 
 include_once 'autoload.php';



 $user = new userIndex();

$userData = $user->allUsers();

?>

    <!-- HTML 5 -->
        <!DOCTYPE html>
        <html>
            <head>
                <title>Users
                </title>
            </head>
            <body>
            <a href="user_form.php">Create a new Business card</a>
 <table>
  <tr>
    <th>User</th>
  </tr>
  <?php foreach ($userData as $data) { ?>
  <tr>
    <td>
<a href="<?php echo $user->filepath() . $data->getId();?>.pdf"><?php echo $data->getName() . " " . $data->getSurname();?></a>
    </td>
  </tr>
<?php }?>
</table> 
        </body>
    </html>