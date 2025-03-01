
<?php
include("../../config/conn.php");

$column = array('StudNum', 'LName', 'Age', 'Brgy','ContactNum','StudNum');

$query = "
SELECT * FROM tblgradeschool 
";

if(isset($_POST['filter_all']) && $_POST['filter_all'] != '')
{
 $query .= '
 WHERE StudNum LIKE  "%'.$_POST['filter_all'].'%" 
 OR LName LIKE  "%'.$_POST['filter_all'].'%" 
 OR FName LIKE  "%'.$_POST['filter_all'].'%"
 OR MName LIKE  "%'.$_POST['filter_all'].'%"
 OR Brgy LIKE  "%'.$_POST['filter_all'].'%"
 OR Town LIKE  "%'.$_POST['filter_all'].'%"
 OR Province LIKE  "%'.$_POST['filter_all'].'%"  
 OR ContactNum LIKE  "%'.$_POST['filter_all'].'%"
 OR EmailAdd LIKE  "%'.$_POST['filter_all'].'%"
 OR GradeLevel LIKE  "%'.$_POST['filter_all'].'%"

 ';
}

if(isset($_POST['order']))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY StudNum DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $conn_PDO->prepare($query);
$statement->execute();
$number_filter_row = $statement->rowCount();
$statement = $conn_PDO->prepare($query . $query1);
$statement->execute();
$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['StudNum'];
 $sub_array[] = $row['LName'] .", ". $row['FName'] .", " . $row['MName'];
 $sub_array[] = $row['GradeLevel'];
 $sub_array[] = $row['Brgy'].", ". $row['Town'] .", " . $row['Province'];
 $sub_array[] = $row['ContactNum'];
 $sub_array[] = $row['EmailAdd'];
 $sub_array[] = $row['Active'];
 $sub_array[] = '<a href="./index.php?page=students/view&stud_Id=' . $row['StudNum'] . '"  data-toggle="tooltip" data-original-title="View Inquiry"> <i class="fa fa-eye"></i></a> |<a href="./index.php?page=students/editProfile&stud_Id=' . $row['StudNum'] .'"  data-toggle="tooltip" data-original-title="View Inquiry"> <i class="fa fa-edit"></a>';
 $data[] = $sub_array;
}

function count_all_data($conn_PDO)
{
 $query = "SELECT * FROM tblgradeschool";
 $statement = $conn_PDO->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}
$output = array(
 "draw"       =>  intval($_POST["draw"]),
 "recordsTotal"   =>  count_all_data($conn_PDO),
 "recordsFiltered"  =>  $number_filter_row,
 "data"       =>  $data
);

echo json_encode($output);

?>



























