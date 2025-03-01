
<?php
include '../../config/conn.php';

$column = array('StudNum', 'Lname', 'Age', 'Brgy','CNumber');

$query = "
SELECT * FROM tblsi t1
INNER JOIN tblsiadd t2 ON t1.StudNum = t2.StudNum
";


if(isset($_POST['filter_all']) && $_POST['filter_all'] != '')
{
 $query .= '
 WHERE t1.StudNum LIKE  "%'.$_POST['filter_all'].'%" 
 OR Lname LIKE  "%'.$_POST['filter_all'].'%" 
 OR Fname LIKE  "%'.$_POST['filter_all'].'%"
 OR Mname LIKE  "%'.$_POST['filter_all'].'%"
 OR Age LIKE  "%'.$_POST['filter_all'].'%" 
 OR Brgy LIKE  "%'.$_POST['filter_all'].'%"
 OR Town LIKE  "%'.$_POST['filter_all'].'%"
 OR Province LIKE  "%'.$_POST['filter_all'].'%"  
 OR Active LIKE  "%'.$_POST['filter_all'].'%"
 OR Remarks LIKE  "%'.$_POST['filter_all'].'%" 
  OR Course LIKE  "%'.$_POST['filter_all'].'%" 
 OR CNumber LIKE  "%'.$_POST['filter_all'].'%"

 ';
}

if(isset($_POST['order']))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY t1.StudNum DESC ';
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
 $sub_array[] = $row['Lname'] .", ". $row['Fname'] .", " . $row['Mname'];
 $sub_array[] = $row['Course'];
 $sub_array[] = $row['Brgy'].", ". $row['Town'] .", " . $row['Province'];
 $sub_array[] = $row['CNumber'];
 $sub_array[] = $row['Active'];
 $sub_array[] = $row['Remarks'];
 $sub_array[] = '<a href="./index.php?page=College/view&stid=' . $row['StudNum'] . '"  data-toggle="tooltip" data-original-title="View Inquiry"> <i class="fa fa-eye"></i></a> |<a href="./index.php?page=College/editProfile&stid=' . $row['StudNum'] .'"  data-toggle="tooltip" data-original-title="View Inquiry"> <i class="fa fa-edit"></a>';
 $data[] = $sub_array;

 
}

function count_all_data($conn_PDO)
{
 $query = "SELECT * FROM tblsi t1
 INNER JOIN tblsiadd t2 ON t1.StudNum = t2.StudNum";
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






