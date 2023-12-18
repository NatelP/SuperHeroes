<!doctype html>
<html lang="es">
  <head>
    <title>Alignments</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <div style="width: 70%; margin:auto">
      <canvas id="Alignment"></canvas>
    </div>
    <div style="width: 70%;margin: auto; margin-top: 3em;text-align: center;">
      <form action="">
        <input type="text" id="Good" placeholder="Good">
        <input type="text" id="Bad" placeholder="Bad">
        <input type="text" id="Neutral" placeholder="Neutral">
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      function $(id){return document.querySelector(id)}

      const contexto=document.querySelector("#Alignment")

      const grafico=new Chart(contexto,{
        type: 'bar',
        data:{
          labels:["A","B","C"],
          datasets:[{
            label:"Aliniamientos",
            data:[],
            backgroundColor: ['#a9b2a9','#FF0000','#d1ef9a',],
            borderWidth: 2
          }]
        }
      });

      (function (){
        fetch(`../controllers/Superheros.controller.php?operacion=spu_publisher_aligment_resumen`)
        .then(respuesta=>respuesta.json())
        .then(datos=>{
          grafico.data.labels=datos.map(registro=>registro.alignment)
          grafico.data.datasets[0].data = datos.map(registro=>registro.totalalineamientos)
          grafico.update();
          const good = $("#Good");
          const bad = $("#Bad");
          const neutral = $("#Neutral");

          good.value = datos[0].totalalineamientos;
          bad.value = datos[1].totalalineamientos;
          neutral.value = datos[2].totalalineamientos;
        })
        .catch(e => {
          console.error(e)
        })
      })();
    </script>
  </body>
</html>
