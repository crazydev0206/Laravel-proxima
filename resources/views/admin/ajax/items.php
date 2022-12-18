<?php
if(isset($_POST['id'])) {
$id=$_POST['id'];
include('../common/connect.php');
    $q="SELECT name,id FROM raw_materials WHERE category_id='$id'";
    $r=@mysqli_query($dbc,$q);
    if(@mysqli_num_rows($r)!=0) {
        $echo='<option value="">Please Select</option>';
        while($row=@mysqli_fetch_assoc($r)) {
            $echo.='<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
        echo $echo;
    }
    else echo '<option value="">No item added to this category.</option>';
}
?>