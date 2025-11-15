<script>
    function list_store(){
        var html;
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data:{
                option:2
            },
            cache:false,
            success:function(data){
                html = "<select id='listdni' class='ui loading search dropdown'><option value=''>Tienda</option>";
                for(var i in data){                  
                        html += "<option value='" + data[i].store + "'>" + data[i].store
                        + "</option>";
                }
                html +="<option value='NA'>No asignado</option></select>";
            },
            error:function(error){

            },
            complete:function(complete){
                $("#listtienda").html(html);
                $("#listtienda").dropdown();
                
            }
        })
    }
   
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
            success:function(data){                
               response=data;
               html = "<select id='listdni' class='ui search dropdown'><option value=''>Nombre</option>";
               for(var i in data){                                   
                    html += "<option value='" + data[i].dni + "'>" + data[i].nombre
                    + "</option>";
               }
               html +="<option value='NA'>No asignado</option></select>";
               //console.log(html);
               
            },
            error:function(e){
                
            },
            complete:function(complete){               
                $("#listdni").html(html);
                $("#listdni").dropdown();
            }
        })
    }

    function load_puesto(){
        var html="";
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data:{
                option:3
            },
            cache:false,
            success:function(data){ 
                html = "<select id='listpuesto' class='ui search dropdown'><option value=''>Puesto</option>";
               for(var i in data){                                   
                    html += "<option value='" + data[i].id + "'>" + data[i].description
                    + "</option>";
               }
               html +="<option value='NA'>No asignado</option></select>";
            },
            complete:function(complete){
                $("#listpuesto").html(html);
                $("#listpuesto").dropdown();
                
            }
        });

    }
    function load_zona(){
        var html="";
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data:{
                option:4
            },
            cache:false,
            success:function(data){ 
                html = "<select id='listpuesto' class='ui search dropdown'><option value=''>Zona</option>";
               for(var i in data){                                   
                    html += "<option value='" + data[i].zone + "'>" + data[i].zone
                    + "</option>";
               }
               html +="<option value='NA'>No asignado</option></select>";
            },
            complete:function(complete){
                $("#listzona").html(html);
                $("#listzona").dropdown();
                //form_complete();
            }
        });

    }
    function load_turno(){
        var html="";
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data:{
                option:5
            },
            cache:false,
            success:function(data){ 
                html = "<select id='listturno' class='ui search dropdown'><option value=''>Turno</option>";
               for(var i in data){                                   
                    html += "<option value='" + data[i].id + "'>" + data[i].timer
                    + "</option>";
               }
               html +="<option value='NA'>No asignado</option></select>";
            },
            complete:function(complete){
                $("#listturno").html(html);
                $("#listturno").dropdown();
                form_complete();
            }
        });
    }
    var base_tienda="";
    var base_zona="";
    var base_change="";
    var base_change_tienda="";
    var base_change_zona="";

    var base_position="";
    var base_mode="";
    var base_status="";

    var base_change_position="";
    var base_change_mode="";
    var base_change_status="";

    function load_info(empid){
        response="";
        var html="";
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data:{
                option:6,
                employee_id:empid
            },
            cache:false,
            beforeSend: function(before){
                $("#menu_loading").dimmer("show");
            },
            success:function(data){ 
               response=data;
               console.log(data);
            },
            complete:function(complete){
               $("#menu_loading").dimmer("hide");
               $("#message").removeClass();
               var mode = response[0].mode;  
               var puesto =response[0].position;  
               var turno= response[0].turno; 
               var store=response[0].store;  
               var zone = response[0].zone;
               var status = response[0].status;   
               base_turno = turno;     
               base_tienda = store;
               base_zona = zone;
               base_position = puesto;
               base_mode = mode;
               base_status= status;
               $("#listmode").val(mode).change();               
               $("#listpuesto").val(puesto).change();
               $("#listturno").val(turno).change();
               $("#listtienda").val(store).change();
               $("#listzona").val(zone).change();
               $("#listestado").val(status).change();
               if(status > 0 ){
                    if(turno==8){                 
                    $("#message").addClass("ui red label");
                    $("#message").text("Descanso");
                    }else{
                    $("#message").addClass("ui green label");
                    $("#message").text("Laborando");
                    }   
               }else{
                    $("#message").addClass("ui gray label");
                    $("#message").text("Sin activación");
               }
              
            }
        });
    }
    function form_loader(){
       $(".ui.form").hide();
       $("#loader").addClass("ui placeholder");
       
    }
    function form_complete(){
       $(".ui.form").show();
       $("#loader").removeClass();
    }
    function supervisor_tiendas_update(puesto, modalidad, turno, tienda, zona, estado){
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data:{
                "option": 8,
                "position_id": puesto,
                "mode": modalidad,
                "schedule_id": turno,
                "store": tienda,
                "zone": zona,
                "status" : estado,
                "employee_id" :  $("#listdni").val()
            },
            cache:false,
            success:function(data){               
                $("#menu_loading").dimmer("show");
            },
            error:function(error){

            },
            complete:function(complete){
                $("#menu_loading").dimmer("hide");                
                alert("Valores actualizados de manera correcta");
            }
        });
    }

    function supervisor_rh(){
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data:{
                "option": 9,
                "position_desc": $("#listpuesto option:selected").text(),
                "mode_desc":  $("#listmode option:selected").text(),
                "status_desc": $("#listestado option:selected").text(),
                "employee_id" :  $("#listdni").val(),
                "schedule_desc" : $("#listturno option:selected").text(),
                "store_desc" : $("#listtienda option:selected").text(),
                "zone_desc":$("#listzona option:selected").text()
                },
            cache:false,
            success:function(data){               
                $("#menu_loading").dimmer("show");
            },
            error:function(error){
                console.log(error);
            },
            complete:function(complete){
                $("#menu_loading").dimmer("hide");                
                alert("Algunos valores fueron notificados para su actualización en Recursos Humanos");
            }
        });
    }

    var xn = 0 ; 
    $(document).ready(function(){   
       form_loader();      
       load();
       list_store();
       load_puesto();
       load_zona();
       load_turno();
       $("#listdni").change(function(){
            //$("#listmode").val("").change();
            empid = $("#listdni").prop("selected",true).val();
            load_info(empid);
       });
       $("#listestado").dropdown();
       $("#listmode").dropdown();
       $("#menu_logout").click(function(){
           //localStorage.clear();
           location.href = "options.php";
       })
       $("#menu_save").click(function(){
           supervisor_rh();
           /*
           var param_sup = 0;
           var param_rh =0;
           if(base_turno!=base_change){
              param_sup +=1;
           }
           if(base_tienda !=base_change_tienda){
               param_sup +=1;               
           }
           if(base_zona !=base_change_zona){
               param_sup +=1;
           }

           if(base_position!=base_change_position){
               param_rh +=1;
           }
           if(base_mode!=base_change_mode){
               param_rh +=1;
           }
           if(base_status !=base_change_status){
               param_rh +=1;
           }

           if(param_sup>0){               
               supervisor_tiendas_update();
            }
           if(param_rh>0){
              
               //
           }
           */
          
       });
       $("#listpuesto").change(function(){
            base_change_position=$(this).val();
       });
       $("#listmode").change(function(){
            base_change_mode = $(this).val();
       });
    
       $("#listturno").change(function(){
           base_change=$(this).val();
       });
       $("#listtienda").change(function(){
            base_change_tienda=$(this).val();
       });
       $("#listzona").change(function(){
            base_change_zona=$(this).val();
       });
       $("#listestado").change(function(){
            base_change_status=$(this).val();
       });
    })
</script>