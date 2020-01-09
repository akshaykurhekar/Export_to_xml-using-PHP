<!-- This is a code to download file in xml formate from database using object PHP and HTML 	 -->	
		
				<!-- FRONT END -->
<form action="export.php" method="POST">
	<input type="submit" class="btn-success border-secondary" style="border-radius: 10px;" name="export_subscribe" value="Export Users Email">                
</form>

				<!-- BACK END 
	TO USE THIS CODE ,COPY BACK END PART TO NEW PAGE AND GIVE file name AS export.php-->
<?php 

if(isset($_POST["export_subscribe"]))
{
	$user='root';
	$pass='';
	$dbname='database_name';

	$conn = new PDO('mysql:host=localhost;dbname=database_name', $user, $pass);
	if (!$conn) {
	die("Connection failed: " . $conn->connect_error);
	}
	$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = "SELECT * FROM `subscribed_user` WHERE 1";
$stmt=$conn->prepare($query);
$stmt->execute();
$result=$stmt->fetchAll();
$conn=null;
$id=0;
  $output = '';
   if($result)
 {
  $output .= '
   <table class="table" bordered="1">  
    <tr>  
        <th>id</th>  
        <th>Email</th>  
    </tr>
  ';
  foreach($result as $row)
  { ++$id;
   $output .= '
            <tr>  
            <td>'.$id.'</td>  
            <td>'.$row["email"].'</td>  
            </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Employee_Details.xls');
  echo $output;
 }
 else{
  header('location:index.php?q='.md5(404));

}
}

 ?>
