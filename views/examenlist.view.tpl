<section>
  <header>
    <h1>Personas</h1>
  </header>
  <main>
    <table class="full-width">
      <thead>
        <tr>
          <th>Cod</th>
          <th>pluying</th>
          <th>URLhomepague</th>
          <th>Estado</th>
          <th>URLcdn</th>
          <th class="right">
            <form action="index.php?page=examenform" method="post">
            <input type="hidden" name="MMGBcodigo" value="" />
            <input type="hidden" name="xcfrt" value="{{~xcfrt}}" />
            <button type="submit" name="btnIns">Agregar</button>
          </form>
          </th>
        </tr>
      </thead>
      <tbody class="zebra">
        {{foreach personas}}
        <tr>
          <td>{{MMGBcodigo}}</td>
          <td>{{MMGBpluying}}</td>
          <td>{{MMGBurlhomepage}}</td>
          <td>{{MMGBestado}}</td>
          <td>{{MMGBurlcdn}}</td>
          <td class="right">
            <form action="index.php?page=examenform" method="post">
              <input type="hidden" name="MMGBcodigo" value="{{MMGBcodigo}}"/>
              <input type="hidden" name="xcfrt" value="{{~xcfrt}}" />
              <button type="submit" name="btnDsp">Ver</button>
              <button type="submit" name="btnUpd">Editar</button>
              <button type="submit" name="btnDel">Eliminar</button>
            </form>
          </td>
        </tr>
        {{endfor personas}}
      </tbody>
      <tfoot>
        <tr>
          <td colspan="6"> Paginación</td>
        </tr>
      </tfoot>
    </table>
  </main>
</section>
