<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Licores | El Bunker</title>
    <link rel="stylesheet" href="css/master.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow:400,500,700|Barlow:100,300,400,500|PT+Sans+Narrow" rel="stylesheet">
    <link rel="stylesheet" href="css/productos.css">

  </head>
  <body>

    <style media="screen">
      .barra-pag{
      width: 100%;
      padding: 10px;
      display: block;
      background: black;
      color: white;
      margin-top: -10px;
    }

      .pag-barra{
        width: 100%;
        margin-top: 60px;
        display: block;
      }

      .pag-barra img{

      }
      .barra-pag ul{


        padding: 10px;
        width: 80%;
        display:block;
        height: 100%;
        margin: auto;
        border: solid 1px black;
        text-align: center;
      }
      .barra-pag li{
        padding: 10px;
        text-decoration: none;
        margin: 0px 20px;
        display: inline;
        font-weight: 400;
      }
      .item{
        width:20%;
        margin: 10px;
        box-shadow:inherit;
      }

      body{
        background:rgb(245, 245, 245);
      }
      .ic{
        width: 23%;
      }
    </style>

<script type="text/javascript">
$('.main').load('licores_core.php');
function pageFuncion(tipo) {
    $('.main').load('licores_core.php?categoria='+tipo);
}
</script>
    <main>
      <?php

  include 'nav.php';
  include 'core/conexion.php';
  include 'nav-licores.php';
       ?>
       <script type="text/javascript">
         $('#barra').attr("src","img/whisky.png");
       </script>

<div class="carousel">
  <?php
  include 'core/conexion.php';
  $sql_licores="SELECT * FROM productos WHERE tipo='whisky' LIMIT 0,15";
  $query_licores=$con_pdo->query($sql_licores);
    while ($re=$query_licores->fetch(PDO::FETCH_ASSOC)) {
     ?>
    <a href="item.php?producto=<?php echo $re['idproductos']?>&categoria=<?php echo $re['tipo']?> ">
    <div class="item" id='13' >
    <img src="img/b/<?php echo $re['imagen']?>" alt="" >
    <h4 id='tx-4'><?php echo utf8_encode($re['nombre'])?></h4>
    <h4 class="num-price"><?php echo $re['precio']?> S/</h4>
    </a>
    <button type="button" id='add<?php echo $re['idproductos']?>' name="button">
      AÑADIR AL CARRITO!</button>
</div>
    <script type="text/javascript">

        $('#add<?php echo $re['idproductos']?>').click(function() {

          var params = {
          producto : "<?php echo utf8_encode($re['nombre'])?>",
          cantidad:1,
          accion: "add"
          };
          $.get("core/carrito.php",params, function(respuesta){
                $(".carro").html(respuesta);
          })
        });

    </script>
    <?php

    }
  ?>

<section>
  <div class="content bw" style="height:380px;line-height:80px;">
          <div class="contenido-ico">
            <h3 class="tx-1 pd-10">Realiza tu pedido</h3>
            <div class="i">

              <div class="icono ic">
            <i class="fas fa-motorcycle"></i>
              <h4 style="line-height:30px;">Entregas a domicilio<br>
              <small class="sub-title">Ver más</small>  </h4>
              </div>
              <div class="icono ic">
            <i class="far fa-credit-card"></i>
              <h4 style="line-height:30px;">Pagos con tarjetas de credito<br>
                    <small class="sub-title">Ver más</small>
              </h4>
              </div>
              <div class="icono ic">
            <i class="far fa-tag"></i>
              <h4 style="line-height:30px;">Precios especiales<br>
                    <small class="sub-title">Ver más</small>
              </h4>
              </div>
              <div class="icono ic">
                <i class="far fa-clock"></i>
              <h4 style="line-height:30px;">Entregas en 30 minutos<br>
                      <small class="sub-title">Ver más</small> </h4>
              </div>
            </div class="i">

          </div>
    </div>
  </section>

      </main>

      <footer>

    <table>
    <tr>
      <td><small class='title'>Contáctanos</small></td>
      <td><small class='title'>Servicios</small></td>
      <td><small class='title'>Productos</small></td>
    </tr>
    <tr>

    <td><small class="sub-title">Dirección</small><small class="text">Av. Sucre 1051 Pueblo Libre.</small><small class='text' >Av. Lima S/N Barranco</small></td>
    <td><small class='text'>Licores al mayor</small><small class='text'>Barra movil</small><small class='text'>Delivery de licores</small><small class='text'>Organiza tus eventos con nosotros</small></td>
    <td><small class='text'>Antojos</small><small class='text'>Cervezas</small><small class='text'>Licores <br> Farmacia<br> Más vendidos</small></td>
    </tr>
    <tr>
      <td><small class='sub-title'>Teléfonos</small><small class="text"> (01) 480-0167 <br> 923 985 662 </small> <small class="text"> pedidos@elbunker.pe</small></td>
      <td><small class="sub-title">Zonas de reparto</small>
        <ul class="zn"><li><small class="text">Miraflores</small></li>
            <li><small class="text">Barranco</small></li>
          <li><small class="text">Pueblo libre</small>
              <small class="text"></small>
          </li>
        </ul>
      </td>
      <td>

        <i class="fab fa-facebook-f n pd-5 title"></i>
        <i class="fab fa-instagram n pd-5 title"></i>
        <i class="fab fa-youtube n pd-5 title"></i>
         </td>
    </tr>
    </table>
    <small class="text n pd-10">Todos los derechos reservados 2018. Donjuerguero.</small>
      </footer>
      <script src="js/master.js" charset="utf-8"></script>
  </body>
</html>
