<?php require_once("../autoload.php");
if($_POST['sid']>0 && $_POST['did']>0 && $_POST['tid']>0)
{
	$sid=$_POST['sid']; $did=$_POST['did']; $tid=$_POST['tid'];
	 $rows=$getCredit->show_institutes($sid,$did,$tid);
	$count=count($rows);
	if($count>0)
	{
		foreach($rows as $row)
		{
	?>


	 <div class="col-sm-6 mb-2">
        <div class="card">
  <h5 class="card-header plate"><?php echo $row['iname'];?></h5>
  <div class="card-body">
  	<div style="overflow-x:auto;">
  <table class="table" border="1">
  	<tr>
  		<td><span class="hcol">Registration No.:</span></td>
  		<td colspan="2"><span class="hval"><?php echo $row['ireg_no'];?></span></td>
  		<td><span class="hcol">Mobile No:</span></td>
  		<td colspan="2"><span class="hval"><?php echo $row['imobile'];?></span></td>

  	</tr>
  	<tr>
  		<td><span class="hcol">State:</span></td>
  		<td><span class="hval"><?php echo $getCredit->get_sname($row['sid']);?></span></td>
  		<td><span class="hcol">District:</span></td>
  		<td><span class="hval"><?php echo $getCredit->get_dname($row['did']);?></span></td>
  				<td><span class="hcol">Taluka:</span></td>
  		<td><span class="hval"><?php echo $getCredit->get_tname($row['tid']);?></span></td>

  	</tr>
  		<tr>
  		<td><span class="hcol">Address:</span></td>
  		<td colspan="5"><span class="hval"><?php echo $row['iaddress'];?></span></td>
  		

  	</tr>
  	</tr>
  		<tr>
  		<td><span class="hcol">Date:</span></td>
  		<td colspan="5"><span class="hval"><?php echo $getDatabase->easy_date2($row['idate']);?></span></td>
  		

  	</tr>


  </table>
</div>
  </div>
</div>


    </div>

	<?php 
	}
	}
	else 
	{
			echo 'No data found';
	}
}
?>