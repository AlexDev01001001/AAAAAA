<script>
    $(document).ready(function(){
        var usertype = localStorage.getItem("sup_position");
        console.log(usertype);
        $("#options_personal").click(function(){
            if(parseFloat(usertype)==20){
                localStorage.setItem("iswarehouse",true);
                location.href = "menucd.php";
            }else{
                localStorage.setItem("iswarehouse",false);
                location.href = "menu.php";
            }
        });
        $("#options_plan").click(function(){
            location.href="planeamiento.php";
        });
        $("#options_cerrar").click(function(){
            localStorage.clear();
            location.href = "login.php";
         });
    });
</script>