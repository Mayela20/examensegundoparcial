<?php
  require_once "models/examendata.model.php";
  function run()
  {
      $estadoJuguetes = obtenerEstados();
      $selectedEst = 'ACT';
      $mode = "";
      $errores=array();
      $hasError = false;
      $modeDesc = array(
        "DSP" => "persona ",
        "INS" => "Creando Nueva Persona",
        "UPD" => "Actualizando Nueva Persona ",
        "DEL" => "Eliminando Persona "
      );
      $viewData = array();
      $viewData["showMMGBcodigo"] = true;
      $viewData["showBtnConfirmar"] = true;
      $viewData["readonly"] = '';
      $viewData["selectDisable"] = '';

      if (isset($_POST["xcfrt"]) && isset($_SESSION["xcfrt"]) &&  $_SESSION["xcfrt"] !== $_POST["xcfrt"]) {
          redirectWithMessage(
              "Petición Solicitada no es Válida",
              "index.php?page=examenlist"
          );
          die();
      }
      $viewData["xcfrt"] = $_SESSION["xcfrt"];
      if (isset($_POST["btnDsp"])) {
          $mode = "DSP";
          $moda = obtenerPersonaPorId($_POST["MMGBcodigo"]);
          $selectedEst=$moda["MMGBestado"];
          $viewData["showBtnConfirmar"] = false;
          $viewData["readonly"] = 'readonly';
          $viewData["selectDisable"] = 'disabled';
          mergeFullArrayTo($moda, $viewData);
          $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscMMGBpersona"];
      }
      if (isset($_POST["btnUpd"])) {
          $mode = "UPD";
          //Vamos A Cargar los datos
          $moda = obtenerPersonaPorId($_POST["MMGBcodigo"]);
          $selectedEst=$moda["MMGBestado"];
          mergeFullArrayTo($moda, $viewData);
          $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscMMGBpersona"];
      }
      if (isset($_POST["btnDel"])) {
          $mode = "DEL";
          //Vamos A Cargar los datos
          $moda = obtenerPersonaPorId($_POST["MMGBcodigo"]);
          $selectedEst=$moda["MMGBestado"];
          $viewData["readonly"] = 'readonly';
          $viewData["selectDisable"] = 'disabled';
          mergeFullArrayTo($moda, $viewData);
          $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscMMGBpersona"];
      }
      if (isset($_POST["btnIns"])) {
          $mode = "INS";
          //Vamos A Cargar los datos
          $viewData["modeDsc"] = $modeDesc[$mode];
           $viewData["showMMGBcodigo"]  = false;
      }
      // if ($mode == "") {
      //     print_r($_POST);
      //     die();
      // }
      if (isset($_POST["btnConfirmar"])) {
          $mode = $_POST["mode"];
          $selectedEst = $_POST["MMGBestado"];
           mergeFullArrayTo($_POST, $viewData);
          switch($mode)
          {
          case 'INS':
              $viewData["showMMGBcodigo"] = false;
              $viewData["modeDsc"] = $modeDesc[$mode];
              //validaciones
              if (floatval($viewData["MMGBpluying"]) <= 0) {
                  $hasError = true;
              }
              if (!$hasError && agregarNuevoPluying(
                  $viewData["dscpluying"],
                  $viewData["nompluying"],
                  $viewData["estpluying"]
              )
              ) {
                  redirectWithMessage(
                      "Pluying Guardado Exitosamente",
                      "index.php?page=examenlist"
                  );
                  die();
              }
              break;
          case 'UPD':
              $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["MMGBcodigo"];
              if (modificarJuguete(
                  $viewData["MMGBurlcdn"],
                  $viewData["MMGBpluying"],
                  $viewData["MMGBestado"],
                  $viewData["MMGBcodigo"],
                  $viewData["MMGBurlhomepage"]
              )
              ) {
                  redirectWithMessage(
                      "Persona Actualizado Exitosamente",
                      "index.php?page=examenlist"
                  );
                  die();
              }
              break;
          case 'DEL':
              $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscMMGBpersona"];
              $viewData["readonly"] = 'readonly';
              $viewData["selectDisable"] = 'disabled';
              if (eliminarPersona(
                  $viewData["MMGBcodigo"]
              )
              ) {
                  redirectWithMessage(
                      "Persona Eliminado Exitosamente",
                      "index.php?page=examenlist"
                  );
                  die();
              }
              break;
          }
      }
      $viewData["mode"] = $mode;
      $viewData["MMGBestado"] = addSelectedCmbArray($estadoPersona, 'MMGBestado', $selectedEst);
      $viewData["hasErrors"] = $hasError;
      $viewData["errores"] = $errores;
      renderizar("examenform", $viewData);
  }
  run();
?>
