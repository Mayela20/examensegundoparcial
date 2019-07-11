<?php
require_once "libs/dao.php";

// Elaborar el algoritmo de los solicitado aquí.
/*
SELECT `juguetes`.`idjuguetes`,
    `juguetes`.`nomjuguete`,
    `juguetes`.`preciojuguete`,
    `juguetes`.`estadojuguete`
FROM `examen`.`juguetes`;
*/
/**
 * Obtiene los registro de la tabla de modas
 *
 * @return Array
 */
function obtenerListas()
{
    $sqlstr = "select `persona`.`MMGBcodigo`,
              `persona`.`MMGBpluying`,
              `persona`.`MMGBurlhomepage`,
              `persona`.`MMGBestado`,
              `persona`.`MMGBurlcdn`
          from `examen`.`persona`";

    $modas = array();
    $modas = obtenerRegistros($sqlstr);
    return $modas;
}

function obtenerJuguetePorId($id)
{
  $sqlstr="select `juguetes`.`idjuguetes`,
            `juguetes`.`nomjuguete`,
            `juguetes`.`preciojuguete`,
            `juguetes`.`estadojuguete`
        from `examen`.`juguetes` where idjuguetes=%d";
  $persona= array();
  $persona=obtenerUnRegistro(sprintf($sqlstr, $id));
  return $persona;
}

function obtenerEstadoPorId($id)
{
  $sqlstr="select `persona`.`MMGBestado`
        from `examen`.`persona` where MMGBcodigo=%d";
  $persona= array();
  $persona=obtenerUnRegistro(sprintf($sqlstr, $id));
  return $persona;
}


function obtenerEstados()
{
    return array(
        array("cod"=>"ACT", "dsc"=>"Activo"),
        array("cod"=>"INA", "dsc"=>"Inactivo"),
        array("cod"=>"PLN", "dsc"=>"En Planificación"),
        array("cod"=>"RET", "dsc"=>"Retirado"),
        array("cod"=>"SUS", "dsc"=>"Suspendido"),
        array("cod"=>"DES", "dsc"=>"Descontinuado")
    );
}

function agregarNuevaPersona($dscMMGBpersona, $MMGBpluying, $MMGBestado) {
    $insSql = "INSERT INTO persona(nompersona, pluyingpersona, estadopersona)
      values ('%s', %f, '%s');";
      if (ejecutarNonQuery(
          sprintf(
              $insSql,
              $dscMMGBpersona,
              $MMGBpluying,
              $MMGBestado
          )))
      {
        return getLastInserId();
      } else {
          return false;
      }
}

function modificarJuguete($dscMMGBpersona, $MMGBpluying, $MMGBestado, $MMGBurlhomepague, $MMGBurlcdn, $MMGBcodigo)
{
    $updSQL = "UPDATE persona set pluying='%s', MMGBestado='%f',
    estadojuguete='%s', URLhomepague='%s', URLcdn='%s' where MMGBcodigo=%d;";

    return ejecutarNonQuery(
        sprintf(
            $updSQL,
            $dscMMGBpersona,
            $MMGBpluying,
            $MMGBestado,
            $MMGBurlhomepague,
            $MMGBurlcdn,
            $MMGBcodigo
        )
    );
}
function eliminarJuguete($MMGBcodigo)
{
    $delSQL = "DELETE FROM persona where MMGBcodigo=%d;";

    return ejecutarNonQuery(
        sprintf(
            $delSQL,
            $MMGBcodigo
        )
    );
}
?>
