<?php
if(!isset($_COOKIE['visita'])){
    //setcookie("visita", "si", 86400);

}
else{
    echo "Bienvenido de Nuevo!!";
}
include 'config.php';?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Carga Imágenes</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-cookie.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var titulo = "<h1>Manipulación de Imágenes con filtros CSS</h1>";
            var estilo = function(){
                $(titulo).appendTo("#borda");
                $("#borda h1").css({
                    "color" : "white",
                    "font-size": "34px",
                    "width" : "700px",
                    "margin" : "10px auto",
                    "text-shadow" : "1px 1px #000"
                });
            };
            // Cookie por un dia
            var setCookie = function(){
                $.cookie("visita", "si", {expires: 1});
            };

            var visita = $.cookie("visita");

            if(visita === "si"){
                alert("Bienvenido de nuevo!");
                estilo();
            }
            else{
                alert("nooo");
                $(".aviso").show("fast");
            }
            $(".acepta").click(function(){
                $(".aviso").fadeOut(300);
                estilo();
                setCookie();
                alert("Cookie establecida");
            });
            var valor = "0.0";
            $("span.bri").text(valor);
            $("span.dif").text(valor);
            $("span.sat").text(valor);
            $(".mini > img").on('click',function(){
            var nombre = $(this).attr("src");
            /*
            $("img").click(function(){
                $("idfotocentra").attr("src", $(this).attr("src"));
            }); */
            //$(this).fadeOut(5000);
            //alert ("Valor " + nombre);
            if($(".foto:has(img)").length === 0){
                $(this).clone().appendTo(".foto");
            }
            else{
                $(".foto img").remove();
                $(this).clone().appendTo(".foto");
            }
            });
             $("input[type='range'].brillo").change(function(){
                 var valor = $(this).val();
                 //alert("Valor " + valor);
                 $(".foto > img").css({
                    "-webkit-filter" : "brightness("+valor+")",
                    "-op-filter" : "brightness("+valor+")",
                    "-ms-filter" : "brightness("+valor+")",
                    "filter" : "brightness("+valor+")",
                    "-moz-filter" : "brightness("+valor+")"
                    });
                    $("span.bri").text(valor);
             });   
             $("input[type='range'].difu").change(function(){
                 var valor = $(this).val();
                 //alert("Valor " + valor);
                $(".foto > img").css({"-webkit-filter" : "blur("+valor+"px)"});
                $("span.dif").text(valor); 
            }); 
             $("input[type='range'].satur").change(function(){
                 var valor = $(this).val();
                //alert("Valor " + valor);
                $(".foto > img").css({"-webkit-filter" : "saturate("+valor+")"});
                $("span.sat").text(valor);
            }); 
            
        });
    </script>
</head>
<body>
    <div id="borda">
        <div class="aviso">
            <p>Tenemos cookies señoooreees!!! <br />
                Esta web usa cookies,
                debes aceptar o salir de la misma.</p>
            <div class="btn btn_gris acepta">Aceptar</div>
        </div>
    </div>
    <div id="pagina">
        <div class="izq">
            <div class="fotos">
            <?php include 'muestra.php'; ?>
            </div>
        </div>
        <div class="der">
            <div class="foto"></div>
        <form action="procesa.php" method="POST" enctype="multipart/form-data" class="accion">
            <label for="archivo">Archivo</label>
            <input type="file" name="archivo" id="archivo">
            <input type="submit" value="Enviar" id="enviar">
        </form>

            <form class="controles" method="">
                <span class="titulo">Añadir brillo</span>
                <input type="range" name="brillo" class="brillo" min="0" max="10" step="0.1">
                <span class="bri"></span>
                <span class="titulo">Añadir borrosidad</span>
                <input type="range" name="difumina" class="difu" min="0" max="10" step="0.1">
                <span class="dif"></span>
                <span class="titulo">Añadir saturación</span>
                <input type="range" name="difumina" class="satur" min="0" max="10" step="0.1">
                <span class="sat"></span>
            </form>
        </div>
    </div>
</body>
</html>
