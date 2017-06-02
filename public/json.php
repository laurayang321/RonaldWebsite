<?php
 $con=mysqli_connect("localhost","4900","4900passWord","VolunteerStories");
 
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
$sql = "SELECT * FROM stories WHERE published = 1 ORDER BY id DESC";

if ($result = mysqli_query($con, $sql))
{
	
	$resultArray = array();
	$tempArray = array();
 
	// Loop through each row in the result set
	while($row = $result->fetch_object())
	{
		// Add each row into our results array
		$tempArray = $row;
	    array_push($resultArray, $tempArray);
	}
 
	echo json_encode($resultArray);
}
 
mysqli_close($con);
?>