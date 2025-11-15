<?php
include 'conn.php';
$option = $_GET['option'];
$output = array('error'=>false);
$customerid="";
$storeid="";
if(isset($_GET['customerid'])){
    $customerid=$_GET['customerid'];
}
if(isset($_GET['storeid'])){
    $storeid=$_GET['storeid'];
}

if ($option==1){
    $sql = "SELECT id,description FROM customer";
	$query = $conn->query($sql);
    $result_store = array();
    while($row = $query-> fetch_assoc()){
        $result_store[] = $row;
    }
    $output = $result_store;
}else if($option==2){
    
    $sql = "SELECT id,description FROM store where customerid='$customerid'";
	$query = $conn->query($sql);
    $result_store = array();
    while($row = $query-> fetch_assoc()){
        $result_store[] = $row;
    }
    $output = $result_store;
}else if($option==3){
    $sql = "SELECT b.store,(select store.requerimiento from store where store.description=b.store) as requerimiento,count(a.id) as marcaciones 
    from attendance a left join employees b on a.employee_id=b.id where a.date='2022-04-06' and b.customer='$customerid' and b.store<>''
    group by b.store";
	$query = $conn->query($sql);
    
    $result_store = array();
    while($row = $query-> fetch_assoc()){
        $result_store[] = $row;
    }
    $output = ["data"=>$result_store];
    
}else if ($option==4){
    $sql = "SELECT b.store,(select store.requerimiento from store where store.description=b.store) as requerimiento,count(a.id) as marcaciones 
    from attendance a left join employees b on a.employee_id=b.id where a.date='2022-04-06' and b.store <>''
    and b.store='$storeid' group by b.store";
	$query = $conn->query($sql);
    
    $result_store = array();
    while($row = $query-> fetch_assoc()){
        $result_store[] = $row;
    }
    $output = ["data" => $result_store];
}
echo json_encode($output);
$conn->close();
?>