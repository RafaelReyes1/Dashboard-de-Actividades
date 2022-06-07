<?php
    require_once("../template/head.php");
    require_once("../template/menu.php");
    require_once("../include/conexion.php");
?>
   <?php if(true){ ?>
<!-- Contenido -->
                                <div class="card">
                                    <div class="card-header">
                                        #Titulo
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">#Texto en negrita</h5>
                                        <p class="card-text">#Texto general</p>
                                        <!---->
                                        <button type="button" class="btn btn-primary">Primary</button>
                                        <button type="button" class="btn btn-secondary">Secondary</button>
                                        <button type="button" class="btn btn-success">Success</button>
                                        <button type="button" class="btn btn-danger">Danger</button>
                                        <button type="button" class="btn btn-warning">Warning</button>
                                        <button type="button" class="btn btn-info">Info</button>
                                        <button type="button" class="btn btn-light">Light</button>
                                        <button type="button" class="btn btn-dark">Dark</button>

                                        <button type="button" class="btn btn-link">Link</button>
                                        <!---->
                                    </div>
                                    <div class="card-footer">
                                        #Pie de pagina
                                    </div>
                                </div>
<!--Contenido-->
    <?php
    } ?>
<?php  require_once("../template/footer.php"); ?>
<script type="text/javascript">
    
    $(document).ready(function(){
        $("#minicio").addClass("active");

    });
</script>