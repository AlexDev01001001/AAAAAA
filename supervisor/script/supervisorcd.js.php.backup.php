<script>
  function load(){
        var response;
        var html="";
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data:{
                option:1,
                login_supervisor: localStorage.getItem("login_supervisor")
            },
            cache:false,
            beforeSend: function(before){
                
                $("#menu_loading").dimmer("show");  
            },
            success:function(data){                
                var html="";
                html+="<table id='table_listcd' style='position:absolute;' class='ui celled table'>";
                html+="<thead>";
					html+="<tr>";
					// html+="<th>LaborHedSeq</th>";
					// html+="<th>LaborDtlSeq</th>";
					html+="<th>DNI</th>";
					html+="<th>Nombre</th>";
					html+="<th>Rol</th>";
					html+="<th>Modalidad</th>";
					html+="<th>Estado</th>";
					
					//html+="<th>Recibo de TAT</th>";									
					html+="</tr>";
				html+="</thead>";
			    html += "<tbody>";
                for(var i in data){
                    html+="<tr>";
                    html+="<td>" + data[i].dni + "</td>";
                    html+="<td>" + data[i].nombre + "</td>";
                    html+="<td>" + data[i].role + "</td>";
                    html+="<td>" + data[i].mode + "</td>";
                    html+="<td><input type='checkbox' class='ui checkbox chkstatus'/> </td>";
                    html+="</tr>";
                }
                html+="</tbody>";
                html+="</table>";
                $("#table_content").html(html);
                
            },
            error:function(e){
                
            },
            complete:function(complete){               
                
                $("#menu_loading").dimmer("hide");
            }
        })
    }
  
    $(document).ready(function(){  
             
        $("#listcd").DataTable({
            "scrollX":true,
            "dom": '<"pull-left"f><"pull-right"l>tip',
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            
            "columnDefs":[
                {
                    "targets":0,
                    "checkboxes":{
                        "selectRow":true
                    }
                }
            ],
            "select":{
                "style":"multi"
            },
            "ajax": {
                url:"../supervisor/api/supervisor.php",
                data:{
                    option:1,
                    login_supervisor: localStorage.getItem("login_supervisor")
                },
                cache:false,
                beforeSend: function(before){                    
                    $("#menu_loading").dimmer("show");  
                },
                "dataSrc":function(data){ 
                  
                   return data;
                },
                error:function(e){
                    
                },
                complete:function(complete){              
                    
                    $("#menu_loading").dimmer("hide");
                }
            },
            destroy:true,
            columns:[                
                {"data": "dni", title:"DNI"},
                {"data": "nombre", title:"Nombres"},               
                {"data": "status", title:"Estado"},
            ],
            buttons:['excel']
            
        });
        //load();
        
    });

</script>