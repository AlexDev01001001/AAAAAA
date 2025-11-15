<script>
    function getday(){
        var response ="";
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data:{
                option:13,
                employee_id : $("#listdni").val(),
                day : $("#listdia").val()
            },
            cache:false,
            beforeSend: function(b){
              $("#menu_loading").dimmer("show");
            },
            success:function(a){
                if(a.length>0){
                    $("#listturno").val(a[0].id).change();
                }else{
                    $("#listturno").val("NA").change();
                }               
            },
            error:function(e){
                $("#menu_loading").dimmer("hide");
                
                
            },
            complete:function(c){
                $("#menu_loading").dimmer("hide");
            }
        })
    }
    function save(var_day){
        var response="";
        $.ajax({
            url:"../supervisor/api/supervisor.php",
            data:{
                option:12,
                employee_id : $("#listdni").val(),
                day :var_day,
                schedule_desc : $("#listturno option:selected").text()
            },
            cache:false,
            beforeSend: function(b){
              $("#menu_loading").dimmer("show");
            },
            success:function(a){
                //alert("Grabado correctamente");
            },
            error:function(error){
                //console.log(error);
            },
            complete:function(c){
                $("#menu_loading").dimmer("hide");
                $("#message").addClass("ui green label");
                $("#message").text("Registrado correctamente");
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
    function form_loader(){
       $(".ui.form").hide();
       $("#loader").addClass("ui placeholder");       
    }
    function form_complete(){
       $(".ui.form").show();
       $("#loader").removeClass();
    }
    let content=[];
    $(document).ready(function(){
       
        form_loader();
        load_turno();
        load();
        $("#listdni").change(function(){
            $("#message").removeClass();
            $("#message").text("");
            $("div#grpdias input[type=checkbox]").each(function(e){
                $(this).prop("checked",true);
            });
            $("#listturno").prop("selected",false);
        });
        $("#plan_menu").click(function(){
            location.href="../supervisor/options.php";
        });
        $("#plan_save").click(function(){
            $("div#grpdias input[type=checkbox]").each(function(e){
                if($(this).is(":checked")){                    
                    if(jQuery.inArray($(this).val(),content)==-1){
                        content.push($(this).val());
                    }
                }
            });
            content.forEach(function(item,index){
                console.log(item);
                save(item);               
            });
        });
        $("#listdia").change(function(){
            getday();
        });
    })
</script>