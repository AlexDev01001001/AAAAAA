<?php 
include 'conn.php';
$option =$_GET['option'];
$employee_id="";
$login_supervisor = "";
$schedule_id="";
$store="";
$zone="";
$position_desc="";
$mode_desc="";
$status_desc="";
$schedule_desc = "";
$store_desc = "";
$zone_desc = "";
$list_employees="";
$supervisor="";
$status ="" ;
$day = "";
if(isset($_GET['day'])){
    $day = $_GET['day'];
}
if(isset($_GET['status'])){
    $status = $_GET['status'];
}
if(isset($_GET['supervisor'])){
    $supervisor = $_GET['supervisor'];
}
if(isset($_GET['list_employees'])){
    $list_employees = $_GET['list_employees'];
}
if(isset($_GET['position_desc'])){
    $position_desc = $_GET['position_desc'];
}
if(isset($_GET['mode_desc'])){
    $mode_desc = $_GET['mode_desc'];
}

if(isset($_GET['status_desc'])){
    $status_desc = $_GET['status_desc'];
}

if(isset($_GET['schedule_desc'])){
    $schedule_desc = $_GET['schedule_desc'];
}
if(isset($_GET['store_desc'])){
    $store_desc = $_GET['store_desc'];
}
if(isset($_GET['zone_desc'])){
    $zone_desc = $_GET['zone_desc'];
}

if(isset( $_GET['schedule_id'])){
    $schedule_id = $_GET['schedule_id'];
}
if(isset($_GET['store'])){
    $store = $_GET['store'];
}
if(isset( $_GET['zone'])){
    $zone = $_GET['zone'];
}

if(isset($_GET['employee_id'])){
    $employee_id=$_GET['employee_id'];
}
if(isset($_GET['login_supervisor'])){
    $login_supervisor = $_GET['login_supervisor'];
}
$output = array();
if($option==0){
    $sql = "select a.employee_id as dni,concat(a.firstname,' ',a.lastname) as firstname from employees a where a.employee_id='$employee_id' ";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        //$output[] = $row;
        array_push($output,array("dni"=>$row["dni"],"firstname"=>$row["firstname"]));
    }
    $conn->close();
}else if($option==1){
    //listado de empleados
    $sql = "select a.employee_id as dni,concat(a.firstname,' ' , a.lastname) as nombre,(select position.description from position where id=a.position_id) as role,(case when a.mode ='' then 'NA' else a.mode end) as mode,ifnull(c.id,'NA') as position,ifnull(b.id,'NA') as turno,(case when a.store='' then 'NA' else a.store end) as store,(case when a.zone='' then 'NA' else a.zone end) as zone,(case when a.status=0 then 'BAJA' when a.status=1 then 'ACTIVO' else 'VACANTE' end) as status from employees a left join schedules b on a.schedule_id=b.id left join position c on a.position_id=c.id where a.supervisor=?";
    $result = $conn->prepare($sql);
    
    $result->bind_param("s",$login_supervisor);
    $result->execute();    
    $response = $result->get_result();
    while($row = $response->fetch_assoc()){
        //$output[] = $row;
        array_push($output,array("dni"=>$row["dni"],"nombre"=>$row["nombre"],"role"=>$row["role"],"mode"=>$row["mode"],"position"=>$row["position"],"turno"=>$row["turno"],"store"=>$row["store"],"zone"=>$row["zone"],"status"=>$row["status"]));
    }
    $conn->close();
}else if($option==2){
     //listado de empleados
     $sql = "select description as store from store";
     $result = $conn->query($sql);
     
     while($row = $result->fetch_assoc()){
        //$output[] = $row;
        array_push($output,array("store"=>$row["store"]));
    }
    $conn->close();
}else if($option==3){
     //listado de puesto
     $sql = "select id,description from position";
     $result = $conn->query($sql);
     
     while($row = $result->fetch_assoc()){
        //$output[] = $row;
        array_push($output,array("id"=>$row["id"],"description"=>$row["description"]));
    }
    $conn->close();
}else if($option==4){
     //listado de zona
     $sql = "select description as zone from zone";
     $result = $conn->query($sql);
        
     while($row = $result->fetch_assoc()){
        
        //$output[] = $row;
        array_push($output,array("zone"=>$row["zone"]));
    }
    $conn->close();
}else if($option==5){
     //listado de turnos
     $sql = "select id,concat(left(time_in,5),' - ',left(time_out,5)) as timer from schedules";
     $result = $conn->query($sql);     
     while($row = $result->fetch_assoc()){
        //$output[] = $row;
        array_push($output,array("id"=>$row["id"],"timer"=>$row["timer"]));
    }
    $conn->close();
}else if($option==6){
   //recuperar información por operador seleccionado   
   $sql = "select a.employee_id as dni,concat(a.firstname,' ' , a.lastname) as nombre,(select position.description from position where id=a.position_id) as role,(case when a.mode ='' then 'NA' else a.mode end) as mode,ifnull(c.id,'NA') as position,ifnull(b.id,'NA') as turno,(case when a.store='' then 'NA' else a.store end) as store,(case when a.zone='' then 'NA' else a.zone end) as zone,ifnull(a.status,'NA') as status from employees a left join schedules b on a.schedule_id=b.id left join position c on a.position_id=c.id where a.employee_id=? ";
   $result = $conn->prepare($sql);
   $result->bind_param("s",$employee_id);
   $result->execute();
   $response = $result->get_result();
   while($row = $response->fetch_assoc()){
      //$output[] = $row;
      array_push($output,array("dni"=>$row["dni"],"nombre"=>$row["nombre"],"role"=>$row["role"],"mode"=>$row["mode"],"position"=>$row["position"],"turno"=>$row["turno"],"store"=>$row["store"],"zone"=>$row["zone"],"status"=>$row["status"]));
   }
   
   $conn->close();
}else if($option==7){
    $sql = "select position_id,supervisor from employees where employee_id=? and position_id in (19,20)";
    $result = $conn -> prepare($sql);
    $result->bind_param("s",$employee_id);
    $result->execute();
    $response = $result-> get_result();
    while($row = $response->fetch_assoc()){
        array_push($output,array("position"=>$row["position_id"],"supervisor"=>$row["supervisor"]));
    }
    $conn->close();
}else if($option==8){
    $sql = "UPDATE employees set store = '$store', zone = '$zone', schedule_id = '$schedule_id' where employee_id = '$employee_id'";     
    if($conn->query($sql)){
        $output['msg']=1;
    }else{
        $output['msg']=0;
    }   
    $conn->close();
}else if ($option==9){   
    /*
     "position_desc": $("#listpuesto option:selected").text(),
                "mode_desc":  $("#listmode option:selected").text(),
                "status_desc": $("#listestado option:selected").text(),
                "employee_id" :  $("#listdni").val(),
                "schedule_desc" : $("#listturno option:selected").text(),
                "store_desc" : $("#listtienda option:selected").text(),
                "zone_desc":$("#listzona option:selected").text()
    */
    $sql = "INSERT INTO `change_rh`(`employee_id`, `position_id`, `mode`, `status`, `schedule_id`, `store`, `zone`, `DateLog`) VALUES  ('$employee_id','$position_desc','$mode_desc','$status_desc','$schedule_desc','$store_desc','$zone_desc',date_add(UTC_TIMESTAMP(),interval -5 hour))";
    try{
        $output['msg']=$conn->query($sql);
    }catch(Exception $e){
        $output['msg']=$e;
    }  
    $conn->close();
}else if($option==10){
    //listado de empleados
    $sql = "select a.employee_id as dni,concat(a.firstname,' ' , a.lastname) as nombre,(select position.description from position where id=a.position_id) as role,(case when a.mode ='' then 'NA' else a.mode end) as mode,ifnull(c.id,'NA') as position,ifnull(b.id,'NA') as turno,(case when a.store='' then 'NA' else a.store end) as store,(case when a.zone='' then 'NA' else a.zone end) as zone,(case when a.status=1 then 'ACTIVO' else 'INACTIVO' end) as status from employees a left join schedules b on a.schedule_id=b.id left join position c on a.position_id=c.id where a.supervisor=? and a.status in (1,3) and a.position_id not in (19,20)";
    $result = $conn->prepare($sql);
    $result->bind_param("s",$login_supervisor);
    $result->execute();
    $response = $result->get_result();
    while($row = $response->fetch_assoc()){
        //$output[] = $row;
        array_push($output,array("dni"=>$row["dni"],"nombre"=>$row["nombre"],"role"=>$row["role"],"mode"=>$row["mode"],"position"=>$row["position"],"turno"=>$row["turno"],"store"=>$row["store"],"zone"=>$row["zone"],"status"=>$row["status"]));
    }
    $conn->close();
}else if($option==11){   
  
    //$list = json_decode($list_employees);
    foreach($list_employees as $array){
        $dni = $array['dni'];
        $status = $array['status'];
        $sql = "UPDATE employees set status='$status' where employee_id ='$dni' and supervisor='$supervisor'";
   
        $post_sql = "UPDATE employees set status='$status' where employee_id ='$dni' and supervisor='$supervisor'";
        if($conn->query($sql) && $conn->query($post_sql)){
            $output['msg']=1;
        }else{
            $output['msg']=0;
        } 
       
    }
    $conn->close(); 
   /*
   
    
    
    */
    //var_dump(($post_sql));

    

}else if($option==12){
    $sql = "INSERT INTO planner_sup(employee_id,turno,day) VALUES ('$employee_id','$schedule_desc','$day')";
    var_dump($conn->query($sql));
    if($conn->query($sql)){
        $output['msg']=1;
    }else{
        $output['msg']=0;
    }
    $conn->close();
}else if($option==13){
    $sql = "select b.id from planner_sup a left join (select id,concat(left(a.time_in,5) ,' - ' , left(a.time_out,5)) as turno from schedules a ) b on a.turno = b.turno where a.employee_id='$employee_id' and a.day='$day' order by a.id desc limit 1";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        //$output[] = $row;
        array_push($output,array("id"=>$row["id"]));
    }
    $conn->close();

}
header('Content-type: application/json');
echo json_encode($output);
?>