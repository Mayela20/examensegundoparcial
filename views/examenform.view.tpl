<h1>{{modeDsc}}</h1>
<section class="row">
<form action="index.php?page=examenform" method="post" class="col-8 col-offset-2">
  {{if hasErrors}}
    <section class="row">
      <ul class="error">
        {{foreach errores}}
          <li>{{this}}</li>
        {{endfor errores}}
      </ul>
    </section>
  {{endif hasErrors}}
  <input type="hidden" name="mode" value="{{mode}}"/>
  <input type="hidden" name="xcfrt" value="{{xcfrt}}" />
  <input type="hidden" name="btnConfirmar" value="Confirmar" />
  {{if showMMGBcodigo}}
  <fieldset class="row">
    <label class="col-5" for="MMGBcodigo">Código de Persona</label>
    <input type="text" name="MMGBcodigo" id="MMGBcodigo" readonly value="{{MMGBcodigo}}" class="col-7" />
  </fieldset>
  {{endif showMMGBcodigo}}
  <fieldset class="row">
    <label class="col-5" for="MMGBpluying">pluying: </label>
    <input type="text" name="dscMMGBpersona" id="dscMMGBpersona" {{readonly}} value="{{MMGBpluying}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="MMGBurlhomepage">URL home pague</label>
    <input type="text" name="MMGBurlhomepage" id="MMGBurlhomepage" {{readonly}} value="{{MMGBurlhomepage}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="MMGBurlcdn">URL cdn</label>
    <input type="text" name="MMGBurlcdn" id="MMGBurlcdn" {{readonly}} value="{{MMGBurlcdn}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="MMGBestado">Estado</label>
    <select name="MMGBestado" id="MMGBestado" class="col-7" {{selectDisable}} {{readonly}} >
      {{foreach MMGBestado}}
        <option value="{{cod}}" {{selected}}>{{dsc}}</option>
      {{endfor MMGBestado}}
    </select>
  </fieldset>
  <fieldset class="row">
    <div class="right">
      {{if showBtnConfirmar}}
      <button type="button" id="btnConfirmar" >Confirmar</button>
      &nbsp;
      {{endif showBtnConfirmar}}
      <button type="button" id="btnCancelar">Cancelar</button>
    </div>
  </fieldset>
  <!--
   <td>{{idmoda}}</td>
    <td>{{dscmoda}}</td>
    <td>{{prcmoda}}</td>
    <td>{{ivamoda}}</td>
    <td>{{estmoda}}</td>
   -->
</form>
</section>
<script>
  $().ready(function(){
    $("#btnCancelar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      location.assign("index.php?page=examenlist");
    });
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      /*Aqui deberia hacer validación de datos*/
      document.forms[0].submit();
    });
  });
</script>
