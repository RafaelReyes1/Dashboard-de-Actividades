<?php
    require_once("template/head.php");
    require_once("template/menu.php");

    require_once("include/conexion.php");        
?>
   
<?php
    if(isset($_GET["opc"])){
        
        $opc = $_GET["opc"];
        
        if($opc!=2){
            header('Location: index.php');
        }
        
        $codigo_seccion = $_GET["id"];
        
        $consulta = "SELECT * FROM secciones WHERE codigo_seccion=$codigo_seccion";
        $query = $conex->query($consulta);
        $row = $query->fetch_assoc();
        
        $nombre = $row['nombre'];
        
        
        
    }else{
        $nombre = "";
        
    }
?>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Secciones</h3>
        </div>
        <div class="panel-body">
           
            <div class="col-md-8">
               
                <form name="form" id="form" method="post" action="seccion_operaciones.php" class="form-inline">
                    
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$nombre;?>" required maxlength="1" placeholder="Nombre" style="text-transform: uppercase;">
                        <span style="color:red;" id="help_nombre"></span>
                    </div>
                    
                    <div class="form-group" style="text-align:center;">
                    
                        <?php if(isset($_GET["opc"])){?>
                            <input type="hidden" id="codigo_seccion" name="codigo_seccion" value="<?=$codigo_seccion;?>">
                            <input type="hidden" id="editar" name="editar" value="1">
                            <input type="button" class="btn btn-primary enviar" value="Editar">
                            <a href="nivel_gestion.php" class="btn btn-danger">Cancelar</a>
                        <?php }else{?>
                            <input type="hidden" id="crear" name="crear" value="1">
                            <input type="button" class="btn btn-primary enviar" value="Crear">
                        <?php }?>
                    
                    </div>
                    
                </form>
                
            </div>
            
            <div class="col-md-12">
            
            <br><br>
              
            <?php
                $consulta = "SELECT * FROM secciones";
                $query = $conex->query($consulta);
            ?>
               
                <div class="table-responsive">
                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Secci&oacute;n</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        
                        while($rows = $query->fetch_assoc()){
                        
                            $codigo_seccion = $rows['codigo_seccion'];
                            $nombre = $rows['nombre'];
                        ?>
                            <tr>
                                <td><?=$codigo_seccion;?></td>
                                <td><?=$nombre;?></td>
                                <td style="text-align:center;">
                                    <a href="seccion_gestion.php?opc=2&id=<?=$codigo_seccion;?>"><img src="assets/images/update.png" alt="Editar Nivel"></a>
                                </td>
                                <td style="text-align:center;">
                                    <a class="eliminar" codigo_seccion="<?=$codigo_seccion;?>" nombre="<?=$nombre;?>"><img src="assets/images/delete.png" alt="Eliminar Nivel"></a>
                                </td>
                            </tr> 
                             
                        <?php } ?>
                    </tbody>
                </table>
                </div>
                
            </div>
            
        </div>
    </div>
    
    <div id="dialog_eliminar" title="Eliminar Seccion" codigo_seccion="" nombre="">
        <p>
            ¿Está seguro de eliminar el Secci&oacute;n: <label id="codigo_seccion_eliminar"></label>?
        </p>
    </div> 

<?php
    require_once("template/footer.php");
?>

<script type="text/javascript">
    
    $(document).ready(function(){

        $("#mconfig").addClass("active");
        
        $("#help_nombre").hide();

        $(".enviar").on("click",function(){

            var nombre = $("#nombre").val();

            var verifica1 = verificar_campo(nombre,1);

            if(verifica1==true){
                $("#form").submit();
            }

        });
        
        function verificar_campo(campo,id){
            var verifica = true;
            var help = "<ul>";

            if(campo.trim() ==""){
                verifica = false;
                
                if(id==1){
                    $("#nombre").focus();
                    help += "<li>Debe ingresar un nombre</li>";
                }             
                
            }
            
            if(id==1){
                patron = /^[a-zA-Z]{1}$/;
                if(patron.test(campo)==false && campo.length > 0){
                    verifica = false;
                    $("#nombre").focus();
                    help += "<li>Solo debe ingresar una letra</li>";
                }
            }
                
            help += "</ul>";

            if(verifica==false){
                if(id==1){
                    $("#help_nombre").html(help);
                    $("#help_nombre").show();
                } 
            }else{
                if(id==1){
                    $("#help_nombre").hide();
                }
            }

            return verifica;
        }
        
        $("#dialog_eliminar").dialog({
            open: function(event, ui) { 
                $(this).parent().find(".ui-dialog-titlebar-close").remove();
                $('.ui-widget-overlay').css('background', 'black');
            },
            closeOnEscape: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            autoOpen: false,
            buttons: {
                Aceptar: function() {
                    
                    var codigo_seccion = $(this).attr("codigo_seccion");
                    var nombre = $(this).attr("nombre");
                    $(this).dialog("close");
                    direccion = "seccion_operaciones.php?eliminar=1&codigo_seccion="+codigo_seccion;
                    location.href = direccion;
                    
                },
                Cancelar: function() {
                    
                    $(this).attr("codigo_seccion","");
                    $(this).attr("nombre","");
                    $("#codigo_seccion_eliminar").text("");
                    $(this).dialog("close");
                    
                }
            }
        });

    });
    
    $(".eliminar").on("click",function(){
        var codigo_seccion = $(this).attr("codigo_seccion");
        var nombre = $(this).attr("nombre");

        $("#codigo").text("");
        $("#codigo_seccion_eliminar").text(nombre);
        $("#dialog_eliminar").attr("codigo_seccion",codigo_seccion);
        $("#dialog_eliminar").attr("nombre",nombre);
        $("#dialog_eliminar").dialog("open");

    });
    
</script>


<?php mysqli_close($conex); ?>