<!doctype html>
<html lang="es">
    <head>
        <title>Heroes</title>
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
      const editorHeroesData = {};

      function $(id) { return document.querySelector(id) }

      const selectPublisher = $("#selectPublisher");

      selectPublisher.addEventListener('change', () => {
        const selectedPublisherId = selectPublisher.value;
        fetch(`../controllers/Publisher.controller.php?operacion=getTotalHeroes&publisherId=${selectedPublisherId}`)
          .then(respuesta => respuesta.json())
          .then(data => {
            const selectedPublisher = document.querySelector(`#selectPublisher option[value='${selectedPublisherId}']`);
            editorHeroesData[selectedPublisher.textContent] = data[0].totalHeroes;
            actualizarGrafico();
          })
          .catch(e => {
            console.error(e);
          });
      });
      function actualizarGrafico() {
        const labels = Object.keys(editorHeroesData);
        const totalHeroes = Object.values(editorHeroesData);
        const contexto = document.getElementById('grafico').getContext('2d');
        if (grafico) {
          grafico.destroy();
        }
        grafico = new Chart(contexto, {
          type: 'pie',
          data: {
            labels: labels,
            datasets: [{
              label: 'Total de Héroes por Editor',
              data: totalHeroes,
              backgroundColor: 'rgba(54,162,235,0.5)',
              borderColor: 'rgba(54,162,235,1)',
              borderWidth: 1
            }]
          },
        });
      }

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
