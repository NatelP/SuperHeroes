<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
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
    <div class="w3-container w3-teal">
      <div class="alert alert-info mt-2">
        <h5>Publishers</h5>
      </div>
      <div class="mb-3">
        <label for="publisher" class="form-label">Publishers</label>
        <select name="publisher" id="selectPublisher" class="form-select" required>
          <option value="Todos">Seleccione el Publisher</option>
        </select>
      </div>
    </div>

    <div style="width: 70%; margin:auto">
      <canvas id="grafico"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
    let grafico = null; 

    function $(id) { return document.querySelector(id) }

    const selectPublisher = $("#selectPublisher");

    selectPublisher.addEventListener('change', () => {
      const selectedPublisherId = selectPublisher.value;
      fetch(`../controllers/Publisher.controller.php?operacion=getAlignment&publisherId=${selectedPublisherId}`)
        .then(respuesta => respuesta.json())
        .then(data => {
          const contexto = document.getElementById('grafico').getContext('2d');
          if (grafico) {
            grafico.destroy();
          }
          grafico = new Chart(contexto, {
            type: 'bar',
            data: {
              labels: data.map(registro => registro.alignment),
              datasets: [{
                label: 'Total por alignment',
                data: data.map(registro => registro.TotalAliPubli),
                backgroundColor: 'rgba(54,162,235,0.5)',
                borderColor: 'rgba(54,162,235,1)',
                borderWidth: 1
              }]
            },
          });
        })
        .catch(e => {
          console.error(e);
        });
    });

        fetch(`../controllers/Publisher.controller.php?operacion=listar`)
          .then(respuesta => respuesta.json())
          .then(editores => {
            editores.forEach(editor => {
              const option = document.createElement("option");
              option.value = editor.id;
              option.textContent = editor.publisher_name;
              selectPublisher.appendChild(option);
            });
          })
          .catch(e => {
            console.error(e);
          });
      });
    </script>
  </body>
</html>
