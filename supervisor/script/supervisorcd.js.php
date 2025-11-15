<script>
    let dt;
  function load(){
        var response;
        var html="";
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data:{
                option:10,
                login_supervisor: localStorage.getItem("login_supervisor")
            },
            cache:false,
            beforeSend: function(before){
                
                $("#menu_loading").dimmer("show");  
            },
            success:function(data){      
                dt = data;                         
                var html="";
                html+="<table>";
                html+="<thead>";
					html+="<tr>";
					// html+="<th>LaborHedSeq</th>";
					// html+="<th>LaborDtlSeq</th>";
					html+="<th>DNI</th>";
					html+="<th>Nombre</th>";
					html+="<th>Puesto</th>";
					html+="<th>Modalidad</th>";
					html+="<th>Estado</th>";
					
					//html+="<th>Recibo de TAT</th>";									
					html+="</tr>";
				html+="</thead>";
			    html += "<tbody id='myTable'>";
                for(var i in data){
                    html+="<tr>";
                    html+="<td>" + data[i].dni + "</td>";
                    html+="<td>" + data[i].nombre + "</td>";
                    html+="<td>" + data[i].role + "</td>";
                    html+="<td>" + data[i].mode + "</td>";
                    if(String(data[i].status).toUpperCase()=="ACTIVO" || String(data[i].status).toUpperCase()=="VACANTE"){
                        html+="<td><input type='checkbox' name='chkstatus' class='ui checkbox chkstatus' checked/> </td>";
                    }else{
                        html+="<td><input type='checkbox' name='chkstatus' class='ui checkbox chkstatus'/> </td>";
                    }
                    
                    html+="</tr>";
                }
                html+="</tbody>";
                html+="</table>";
                $("#table_content").html(html);
                
            },
            error:function(e){
                
            },
            complete:function(complete){               
                //$('td:nth-child(1)').hide();
                $("#menu_loading").dimmer("hide");
            }
        })
    }
    function update_person_cd(vdni){
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data: {
                option:11,
                list_employees: vdni,
                supervisor : localStorage.getItem("login_supervisor")
            },
            cache:false,
            beforeSend: function(before){
                $("#menu_loading").dimmer("show");
            },
            success: function(data){
                console.log(data);
            },
            complete:function(complete){
                $("#menu_loading").dimmer("hide");                
                //alert("Valores actualizados de manera correcta");
            }

        })
    }
    
    $(document).ready(function(){  
       load();
       $("#menucd_txtsearch").keyup(function(){
        var value = $(this).val().toUpperCase();       
        $("#myTable tr").filter(function(){
            $(this).toggle($(this).text().toUpperCase().indexOf(value) > -1)
        })
       });
       $("#menucd_save").click(function(){
            let content=[];
            var result="";
            $("#table_content").find("input[type='checkbox'][name^='chkstatus']:not(:checked)").each(function(e){
                var siblings = $(this).parent().siblings();                
                var dni = $(siblings[0]).text();
                content.push({"dni": dni, "status": 3});
            });            
            $("#table_content").find("input[type='checkbox'][name^='chkstatus']:is(:checked)").each(function(e){
                var siblings = $(this).parent().siblings();
                var dni = $(siblings[0]).text();                
                content.push({"dni": dni, "status": 1});
            });
            console.log(content);
            for(var i in content){
                result = result + "'" + content[i].dni + "'" + ",";
            }
            result = result.substring(0,result.length-1);            
            update_person_cd(content);            
       });
       $("#menucd_logout").click(function(){
            //localStorage.clear();
            location.href="options.php";

       });
     
    });

</script>