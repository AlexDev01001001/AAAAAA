<script>
    function customers(){
        $.ajax({
            url:"../visit/api.php",
            data:{
                option:1
            },
            cache:false,
            success:function(data){
                var json =$.parseJSON(data);
                var html="<option value='-1' selected>Seleccionar Cliente</option>";
                $(json).each(function(i, val){
                    html+="<option value='" + val.id + "'>" + val.description +"</option>";                
                $("#cbocustomers").html(html);
            });
            }
        });
    }

    function stores(){
        $.ajax({
            url:"../visit/api.php",
            data:{
                option:2,
                customerid: $("#cbocustomers").val()
            },
            cache:false,
            success:function(data){
                
                var json =$.parseJSON(data);
                var html="<option value='-1' selected>Seleccionar Tienda</option>";
                $(json).each(function(i, val){
                    html+="<option value='" + val.description + "'>" + val.description +"</option>";                
                $("#cbostores").html(html);
            });
            }
        });
    }
    //var table="";
    var customerid="";
    function details_customer(){
        var table = $("#test").DataTable({
            ajax:{
                url: "../visit/api.php?option=3&customerid=" + $("#cbocustomers").val(),
                dataSrc: "data"
            },
            columns:[
                {data: "store"},
                {data: "requerimiento"},
                {data: "marcaciones"}
            ],
            destroy:true
        });
       
    }
    function details_customer_1(){
        $.ajax({
                url:"../visit/api.php",
                data:{
                    option:3,
                    customerid: $("#cbocustomers").val()
                },
                cache:false,  
                beforeSend:function(data){
                  
                },           
                success:function(data){
                console.log(data);
                var json = $.parseJSON(data);             
                var html="<table id='detailcustomer' class='ui celled table'>";
                html+="<thead><tr><th>Tienda</th>";
                html+="<th>Requerimiento</th>";
                html+="<th>Marcaciones</th></tr></thead><tbody>"
                $(json).each(function(i,val){
                    
                        html+="<tr>";
                            html+="<td>" + val.store +"</td>";
                            html+="<td>" + val.requerimiento +"</td>";
                            html+="<td>" + val.marcaciones +"</td>";
                        html+="</tr>";
                });
                html+="</tbody></table>";  
                
                $("#master").html(html);
                table = $("#detailcustomer").DataTable()
                customerid = $("#cbocustomers").val();
                },
                complete:function(data){                   
                   
                }
            });
    
        
    }
    function details(){
        $.ajax({
            url:"../visit/api.php",
            data:{
                option:4,
                storeid: $("#cbostores").val()
            },
            cache:false,
            success:function(data){

            }
        });
    }
    function initialize(){
        $(".ui.dropdown").dropdown({
            fullTextSearch: true
        });
        setInterval(() => {
            $("#test").DataTable().ajax.reload();
        }, 60000);
      
    }
    
    $(document).ready(function(){
        initialize();
        customers();
        $("#cbocustomers").change(function(){
            details_customer();           
        });
        $("#cbostores").change(function(){            
            if($("#cbostores").val()!="-1"){
                details();                
            }
        });
    });
</script>