<!doctype html>
<html lang="es">
  <head>
    <title>Publisher</title>
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
    <div class="container mt-4">
      <table class="table">
          <thead>
              <tr>
                  <th scope="col">id</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Nombre Completo</th>
                  <th scope="col">Genero</th>
                  <th scope="col">Raza</th>
              </tr>
          </thead>
          <tbody id="tablaHeroes">
          </tbody>
        </table>
      </div>
      
      <script>
        document.addEventListener("DOMContentLoaded", () => {

          function $(id) { return document.querySelector(id) }

          // Obtener los editores disponibles
          fetch(`../controllers/Publisher.controller.php?operacion=listar`)
            .then(respuesta => respuesta.json())
            .then(editores => {
              // Obtención del select y creación de las opciones
              const selectPublisher = $("#selectPublisher");
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

          // Función para cargar los superhéroes según el editor seleccionado
          $("#selectPublisher").addEventListener("change", () => {
            const selectedPublisherId = $("#selectPublisher").value;

            fetch(`../controllers/Superheros.controller.php?operacion=listar&publisher=${selectedPublisherId}`)
              .then(respuesta => respuesta.json())
              .then(datos => {
                // Limpiar la tabla antes de agregar nuevas filas
                $("#tablaHeroes").innerHTML = '';

                datos.forEach(element => {
                  const fila = document.createElement("tr");

                  const tdId = document.createElement("td");
                  tdId.textContent = element.id;

                  const tdNombre = document.createElement("td");
                  tdNombre.textContent = element.superhero_name;

                  const tdFullName = document.createElement("td");
                  tdFullName.textContent = element.full_name;

                  const tdGenero = document.createElement("td");
                  tdGenero.textContent = element.gender;

                  const tdRaza = document.createElement("td");
                  tdRaza.textContent = element.race;

                  fila.appendChild(tdId);
                  fila.appendChild(tdNombre);
                  fila.appendChild(tdFullName);
                  fila.appendChild(tdGenero);
                  fila.appendChild(tdRaza);

                  $("#tablaHeroes").appendChild(fila);
                });
              })
              .catch(e => {
                console.error(e);
              });
          });
          });
      </script>
  </body>
</html>
