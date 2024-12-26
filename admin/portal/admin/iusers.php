<?php  require_once("../autoload.php");
if(!$getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:login");}

?>
<?php include("header.php"); ?>

                <?php include("sidebar.php"); ?>
<div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Institute Users</h3>
              </div>
            </div>

            <div class="clearfix"></div>

             <div class="row">
          

              <div class="col-md-12 col-sm-12"> 
               
                <div class="x_panel">
                
                  <div class="x_content">

<?php if(isset($_GET['detect'])) 
{
  $detect=$_GET['detect'];
}
else 
{
  $detect='default'; 
}
switch ($detect) {
  case 'add':
?> 
<?php

    if(isset($_POST['add_submit'])){
        extract($_POST);
$error=$getUser->iac_validate($fname,$lname,$username,$email,$password,$passwordConfirm,'','','add'); 
         if($error==NULL){
           $check=$getUser->iinsert_user($fname,$lname,$username,$email,$password); 
                if($check)
                {
                  header('Location:iusers.php?action=added');
                }
                else 
                {
                    echo '<p class="errormsg">Something went wrong..</p>';
                }
                

        
        }

    }
 ?>
    
   
   
<div class="row"> 
             <div class="col-md-6 col-sm-6 ">
              <?php 
               if(isset($error)){
        foreach($error as $error){
            echo '<p class="errormsg">'.$error.'</p>';
        }
    }?>

  
    <form action='' method='post'>
      <div class="col-md-12 col-sm-12 ">
      <label>First Name </label>

        <input type='text' name='fname' class="form-control" value='<?php if(isset($error)){ echo $_POST['fname'];}?>'>
      </div>
      <div class="col-md-12 col-sm-12 ">
      <label>Last Name </label>

        <input type='text' name='lname' class="form-control" value='<?php if(isset($error)){ echo $_POST['lname'];}?>'>
      </div>

<div class="col-md-12 col-sm-12 ">
      <label>Username</label>

        <input type='text' name='username' class="form-control" value='<?php if(isset($error)){ echo $_POST['username'];}?>'>
      </div>
<div class="col-md-12 col-sm-12 ">
        <label>Password</label>
        <input type='password' name='password' class="form-control" value='<?php if(isset($error)){ echo $_POST['password'];}?>'>
</div>
<div class="col-md-12 col-sm-12 ">
        <label>Confirm Password</label>
        <input type='password' name='passwordConfirm' class="form-control" value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'>
</div>
<div class="col-md-12 col-sm-12 ">
        <label>Email</label>
        <input type='email' name='email' class="form-control" value='<?php if(isset($error)){ echo $_POST['email'];}?>'>
        <br>
        </div>


        <div class="col-md-12 col-sm-12 ">
        <input type='submit' class="btn plan-button" name='add_submit' value='Add User'>
      </div>

    </form>
               </div>
</div>
<?php 
    break;
     case 'edit':
?> 
<?php
$id=$_GET['id']; 
 $rows=$getCredit->get_by_id('its_gtw_users','id',$id); 
  foreach($rows as $row)
  {
    $dbfname=$row['fname'];
    $dblname=$row['lname'];
    $dbusername=$row['username'];
    $dbemail=$row['email'];
  }

    if(isset($_POST['submit'])){
        extract($_POST);
 
      $error=$getUser->iac_validate($fname,$lname,$username,$email,$password,$passwordConfirm,$dbusername,$dbemail,'edit'); 

        if($error==NULL){
          $res=$getUser->iupdate_user($fname,$lname,$username,$email,$password,$id); 
               if($res)
               {
                 header('Location:iusers.php?action=updated');
                 exit;
               }
               else 
               {
                echo '<div class="errormsg">Something went wrong</div><br />';
               }
               
              
        }

    }

    ?>


    <?php
    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo '<div class="errormsg">'.$error.'</div><br />';
        }
    }

        try {

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

    ?>

  
    <form action='' method='post'>
      <div class="col-md-12 col-sm-12 ">
      <label>First Name </label>
        <input type='text' name='fname' class="form-control" value='<?php echo $dbfname; ?>'>
      </div>
      <div class="col-md-12 col-sm-12 ">
      <label>Last Name </label>
        <input type='text' name='lname' class="form-control" value='<?php echo $dblname; ?>'>
      </div>

<div class="col-md-12 col-sm-12 ">
      <label>Username</label>
        <input type='text' name='username' class="form-control" value='<?php echo $dbusername; ?>'>
      </div>
<div class="col-md-12 col-sm-12 ">
        <label>Password</label>
        <input type='password' name='password' class="form-control">
</div>
<div class="col-md-12 col-sm-12 ">
        <label>Confirm Password</label>
        <input type='password' name='passwordConfirm' class="form-control">
</div>
<div class="col-md-12 col-sm-12 ">
        <label>Email</label>
        <input type='text' name='email' class="form-control" value='<?php echo $dbemail;?>'>
        <br>
        </div>


        <div class="col-md-12 col-sm-12 ">
        <input type='submit' class="btn plan-button" name='submit' value='Update'>
      </div>

    </form>
<?php 
    break;
     case 'del':
       $id=$_GET['id']; 
     $res=$getCredit->delete_by_id('its_gtw_users','id',$id); 
      if($res)
      {
        header("location:iusers.php?action=deleted"); 
      }
      else 
      {
        echo 'Something went wrong'; 
      }
    break;
  default:
  ?> 
   <a href="iusers.php?detect=add"><button class="btn plan-button"> Add New User</button></a>
                    <div class="table-responsive">
                       <?php 
  if(isset($_GET['action'])){ 
    echo '<div class="success">User '.$_GET['action'].'.</div>'; 
  } 
  ?>

                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">First Name</th>
                            <th class="column-title">Last Name </th>
                            <th class="column-title">Username  </th>
                            <th class="column-title">Email</th>
                            <th class="column-title">Password </th>
                            <th class="column-title">Date </th>
                            <th class="column-title">Edit </th>
                            <th class="column-title">Delete </th>
                            
                            </th>
                           
                          </tr>
                        </thead>

                        <tbody>
                         
                            <?php
    try {

$rows=$getCredit->fetch_all('its_gtw_users','id','ASC'); 
      foreach($rows as $row){
        
        echo '<tr class="even pointer">';
                echo '<td>'.$row['fname'].'</td>';
                        echo '<td>'.$row['lname'].'</td>';
        echo '<td>'.$row['username'].'</td>';
        echo '<td>'.$row['email'].'</td>';
            echo '<td>*********</td>';
             echo '<td>'.$getDatabase->easy_date($row['date']).'</td>';
        ?>
        <td>
        <a href="iusers.php?detect=edit&id=<?php echo $row['id'];?>">  <i class="icon-pencil"></i></a>
       
          </td>
            <td><?php echo'<a href="iusers.php?detect=del&id='.$row['id'].'onClick=\'return confirm("Are you sure you want to delete?")\'">';?><i class="icon-bin" style="color: red;"></i></a>
         
        </td>
        
        <?php 
        echo '</tr>';
      }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
  ?>  
                        </tbody>
                      </table>
                    </div>
  <?php 
    break;
}
?>

              </div> 
                      </div>
                    </div>
                  </div>

    
                <?php include("footer.php"); ?>