<?php require_once("template/base_url.php"); ?>
<?php 
    session_name("ANS");
    //inicio la sesion
    session_start();
    //comprueba que el usuario esta autenticado
    if(@$_SESSION["autenticado"]=="AN_SA"){
        //si no existe, va a la pagina de autenticacion
        header("location:index.php");
        //salimos de este script
        exit();
    }
 ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title></title>

        <meta name="description" content="">

        <link href="<?php echo base_url_;?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url_;?>assets/css/login.css" rel="stylesheet">
        <script type="text/javascript" src="<?php echo base_url_;?>assets/js/jquery-1.12.4.js"></script>
        <style type="text/css">
            body, html {
                height: 100%;
                background-repeat: no-repeat;
                background-image: linear-gradient(rgb(255, 255, 255), rgb());
                        }
        </style>
    </head>
    <body>    
        <div class="container">
            <div class="card card-container">
                <img class="profile-img " src="<?php echo base_url_;?>assets/images/a.jpg">
                <p id="profile-name" class="profile-name-card">
                    <?php

                        if(isset($_GET['msj'])){
                            $msj = $_GET['msj'];
                            if($msj==1){
                                echo "Ingrese Usuario y Contraseña";
                            }elseif($msj==2){
                                echo "Usuario y/o Contraseña Invalidos";
                            }
                        }

                    ?>
                </p>
                <form class="form-signin" id="form" name="form" method="post" action="<?php echo base_url_;?>/operaciones/autenticacion.php">
                    <input type="hidden" name="login" id="login" value="1">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="email" id="usuario" name="usuario" class="form-control" placeholder="Usuario" required autofocus>
                    
                    <span style="color:red;" id="help_correo"></span>
                    
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>
                    
                    <span style="color:red;" id="help_password"></span>
                    
                    <input type="button" class="btn btn-sm btn-success btn-block  enviar" value="Iniciar Sesión">
                </form><!-- /form -->
                
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>

<script type="text/javascript">
    
    $(document).ready(function(){
    
        $("#help_correo").hide();
        $("#help_password").hide();
        
        $(".enviar").on("click",function(){
            
            var correo = $("#usuario").val();
            var password = $("#password").val();
            
            var verifica1 = verificar_campo(correo,1);
            var verifica2 = verificar_campo(password,2);

            if(verifica1==true && verifica2==true){
                $("#form").submit();
            }
            
            //$("#form").submit();

        });

        function verificar_campo(campo,id){
            var verifica = true;
            var help = "<ul>";                
                
            if(id==1){
                if(campo == null || campo.length == 0){
                    verifica = false;
                    $("#correo").focus();
                    help += "<li>Ingrese el usuario</li>";
                }
            }else if(id==2){
                if(campo == null || campo.length == 0){
                    verifica = false;
                    $("#password").focus();
                    help += "<li>Ingrese la contraseña</li>";
                }
            }
                
            
            //if(id==1){
            if(id==1){
                patron = /^[a-z]{1,15}[.][a-z]{1,15}@[a]{1}[n]{1}[a]{1}[l]{1}[i]{1}[t]{1}[i]{1}[c]{1}[a]{1}[s]{1}[a]{1}[l]{1}[.][c]{1}[o]{1}[m]{1}$/;
                if(patron.test(campo)==false && campo.length > 1){
                    verifica = false;
                    $("#correo").focus();
                    help += "<li>Ingrese un usuario valido</li>";
                }
            }
            help += "</ul>";
            if(verifica==false){
                if(id==1){
                    $("#help_correo").html(help);
                    $("#help_correo").show();
                }else if(id==2){
                    $("#help_password").html(help);
                    $("#help_password").show();
                }
            }else{
                if(id==1){
                    $("#help_correo").hide();
                }else if(id==2){
                    $("#help_password").hide();
                } 
            }
            return verifica;
        }
    });
</script>



