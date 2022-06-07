<?php
    require_once("template/head.php");
    require_once("template/menu.php");

    require_once("include/conexion.php");

    $id_estado = @$_GET['id'];
    $estado= @$_GET['nestado'];
    @$opc = $_GET['opc'];
?>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">RESPONSABLE</h3>
        </div>
        <br>
        <a class="btn btn-sm btn-success" href="responsable_form.php"> Agregar Responsable</a>
        <br>
        <div class="panel-body">
            <div class="col-md-12">
<!--            <a href="horarios_form.php?opc=1" style="float:right;"><img src="assets/images/add.png" alt="Crear Facultad"></a>-->
            <br><br>
<?php
                $consulta = "SELECT codigo_responsable ,dui AS DUI, nombres, apellidos, direccion ,parentesco.nombre as parentesco,telefono FROM responsable
                JOIN parentesco ON parentesco.codigo_parentesco = responsable.codigo_parentesco
                ";
                $query = mysqli_query($conex, $consulta); ?>
                <div class="table-responsive">
                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>DUI</th>
                            <th>Nombre completo</th>
                            <th>Telefono</th>
                            <th>Parentesco</th>
                            <th>Direccion</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        while($rows = mysqli_fetch_array($query)){
                            $codigo = $rows['DUI'];
                            $nombres = $rows['nombres']."  ".$rows['apellidos'];

                            $telefono = $rows['telefono'];
                            $parentesco = $rows['parentesco'];
                            $direccion = $rows['direccion'];
                            ?>
                            <tr> 
                                <td><?= $rows['codigo_responsable']; ?></td>
                                <td><?=$codigo;?></td>
                                <td><?=$nombres;?></td>
                                <td><?=$telefono;?></td>
                                <td><?=$parentesco;?></td>
                                <td><?=$direccion;?></td>
                                
                                <td style="text-align:center;">
                                    <a href="responsable_form.php?codigo_a=<?=$rows['codigo_responsable'];;?>"><img src="assets/images/update.png" alt="Editar  responsable"></a>
                                </td>
                            </tr> 
                        <?php }
                            mysqli_close($conex);
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

<div id="dialog_eliminar" title="Eliminar Estado de Inscripcion" eliminar="" id_horario="" nombre="">
    <p>
        ¿Está seguro de eliminar el Estado: <label id="horario_eliminar"></label>?
    </p>
</div>     

<?php
    require_once("template/footer.php");
?>

<script type="text/javascript">
    
    $(document).ready(function(){

        $(".enviar").on("click",function(){
            var nombre_estado = $("#nombre_estado").val();  
            if (nombre_estado != '') {
                $("#form_estadoi").submit();
            }else{
                alert("Debes colocar el nombre del estado de la inscripcion");
            }
            
                
        });
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
                    var eliminar = $(this).attr("eliminar");
                    var id_estado = $(this).attr("id_estado");
                    var nombre = $(this).attr("nombre");
                    $(this).dialog("close");
                    direccion = "estado_inscripcion_operaciones.php?eliminar="+eliminar+"&id_estado="+id_estado;
                    location.href = direccion;
                },
                Cancelar: function() {
                    $(this).attr("eliminar","");
                    $(this).attr("id_estado","");
                    $(this).attr("nombre","");
                    $("#horario_eliminar").text("");
                    $(this).dialog("close");
                }
            }
        });
    });
        $(".eliminar").on("click",function(){
            var eliminar = $(this).attr("eliminar");
            var id_estado = $(this).attr("id_estado");
            var nombre = $(this).attr("nombre");
            $("#horario_eliminar").text("");
            $("#horario_eliminar").text(nombre);
            $("#dialog_eliminar").attr("eliminar",eliminar);
            $("#dialog_eliminar").attr("id_estado",id_estado);
            $("#dialog_eliminar").attr("nombre",nombre);
            $("#dialog_eliminar").dialog("open");
        });
    
</script>