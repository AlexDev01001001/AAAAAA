<script>
    function login(){
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data:{
                option:7,
                employee_id:$("#supervisor_user").val()
            },
            cache:false,
            success:function(data){    
                
                localStorage.setItem("login_supervisor",data[0].supervisor);
                localStorage.setItem("sup_position",data[0].position);
                location.href="options.php";
               
            }
        })
    }
     $(document).ready(function(){   
         $("#supervisor_ingresar").click(function(){
            login();
         });
         $("#supervisor_marcaciones").click(function(){
            location.href="../index.php";
         });
        
     });
</script>