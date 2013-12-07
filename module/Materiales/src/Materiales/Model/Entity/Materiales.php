<?php


namespace Materiales\Model\Entity;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;

class Materiales
{

 	private $id;
    private $codigo;
    private $titulo;
    private $autor;
    private $pal_claves;
    private $nro_pag;
    private $estado;
    private $descripcion;
    private $anio;
    private $fecha_recepcion;
	private $idioma;
	private $numero;
	private $copia;
	private $tipo;


	 public function buscarmateriales($parametro,$palabra)
    {
    	$palabra = (string) $palabra;
        $parametro= (string) $parametro;
        $rowset = $this->select(array($parametro => $palabra));
        $row = $rowset->current();
        
        if (!$row) {
        	echo $rut;
            throw new \Exception("No hay registros asociados al valor $palabra");
        }
        
        return $row;
    } 







	}