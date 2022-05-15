<?php

$response = file_get_contents('https://linktutor.herokuapp.com/tutorials/');  //activated and the REST API data fetch  
$response = json_decode(json_encode($response),true);


$response_data = json_decode($response, true);



//echo $yummy[0]['links_val'];


?>
<html>
<table>
<th style="width:200px;background-color:Bisque;color:black;text-align:center">Tutorial Category</th><th style="width:20px;background-color:Azure"></th><th style="width:200px;background-color:Bisque;color:black;text-align:center"> Watch video</th>
<?php
foreach($response_data as $row) 
{ 
?>

<tr>
<td style="width:200px;background-color:white;text-align:center;color:black" class="text_clolor">
<?php
	echo $row["categ_name"];

?>
</td>
<td style="width:20px;background-color:gray">

</td>
<td style="width:200px;background-color:white;text-align:center;color:black">
<button style="background-color:Gainsboro">
<a target= "blank" style="color:black;text-decoration: none;" href ="<?php echo $row['links_path'];?>">Tutorial Link</a></button>

</td>
</tr>
<?php
}
?>
</table>

<style>
.text_clolor{
color:black:
}
</style>
</html>
