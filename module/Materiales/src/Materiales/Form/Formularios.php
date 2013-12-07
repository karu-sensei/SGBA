<?php

namespace Materiales\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Factory;
use Zend\Validator\ValidatorInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\Factory as InputFactory;

class Formularios extends Form implements InputFilterAwareInterface
{
    public $dbAdapter;
	public $inputfilter;
    public function __construct($name = null,$adapter)
     {
        parent::__construct($name);
        $this->dbAdapter=$adapter;
        $this->add(array(
            'name' => 'titulo',
            'options' => array(
                'label' => 'Titulo',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
				'required'=>true,
            ),
        ));

        $this->add(array(
            'name' => 'autor',
            'options' => array(
                'label' => 'Autor',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
				'required'=>true,

            ),
        ));

        $this->add(array(
            'name' => 'codigo',
            'options' => array(
                'label' => 'Codigo',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
                'required'=>true,

            ),
        ));
		
        $this->add(array(
            'name' => 'anio',
            'options' => array(
                'label' => 'A&ntilde;o',
            ),
            'attributes' => array(
                'type' => 'text',
				'required'=>true,
                'maxlength'=>'4',
                'pattern'=>'[1-9]{4}',
            ),
        ));
		
		$this->add(array(
            'name' => 'pal_clav',
            'options' => array(
                'label' => 'Palabras Clave',
            ),
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'input',
            ),
        ));
        $this->add(array(
            'name' => 'numero_paginas',
            'options' => array(
                'label' => 'Nro. Paginas',
            ),
            'attributes' => array(
                'type' => 'number',
				'required'=>true,
            ),
        ));

		$this->add(array(
            'name' => 'descripcion',
            'options' => array(
                'label' => 'Descripcion',
            ),
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'input',
				//'required'=>true,

            ),
        ));
        

	 $this->add(array(
            'name' => 'volumen',
            'options' => array(
                'label' => 'volumen',
            ),
            'attributes' => array(
                'type' => 'number',
				'required'=>true,
                //'class' => 'input'
            ),
        )); 
		 $this->add(array(
            'name' => 'numero',
            'options' => array(
                'label' => 'Numero copia',
            ),
            'attributes' => array(
                'type' => 'number',
				'required'=>true,
            ),
        ));
          $this->add(array(
            'name' => 'edicion',
            'options' => array(
                'label' => 'Edicion',
            ),
            'attributes' => array(
                'type' => 'number',
                'required'=>true,
            ),
        ));
		
         $this->add(array(
            'name' => 'editorial',
            'options' => array(
                'label' => 'Editorial',
            ),
            'attributes' => array(
                'type' => 'text',
                'required'=>true,

            ),
        ));

         $this->add(array(
            'name' => 'palabra',
            'options' => array(
                'label' => 'Palabra',
            ),
            'attributes' => array(
                'type' => 'text',
                'required'=>true,

            ),
        ));

            $this->add(array(
            'name' => 'tomo',
            'options' => array(
                'label' => 'Tomo',
            ),
            'attributes' => array(
                'type' => 'number',
                'required'=>true,
            ),
        ));

            $this->add(array(
            'name' => 'isbn',
            'options' => array(
                'label' => 'ISBN',
            ),
            'attributes' => array(
                'type' => 'text',
                'required'=>true,
                'maxlength'=>13,
                //'pattern'=>'\d{1}-\d{5}-\d{3}-\d{1}|\d{1}-\d{3}-\d{5}-\d{1}|\d{1}-\d{2}-\d{6}-\d{1}',
                'placeholder'=>'Ej: 0006784534',
               


            ),
        ));

     $this->add(array(
             'type' => 'Zend\Form\Element\Radio',
			 'required'=>true,
             'name' => 'copia',
             'options' => array(
                     'label' => 'Fotocopia',
                     'value_options' => array(
                            '1' => 'Si',
                            '0' => 'No',
                             
                     ),
             )
     ));       

     $idioma = new Element\Select('idioma');
     $idioma->setLabel('Idioma');
     $idioma->setValueOptions(array(
             'Espaniol'  => 'Español',
             'Ingles'   => 'Inglés',
             'Ruso'     => 'Ruso',
             'Aleman'   => 'Alemán',
             'Italiano' => 'Italiano',
     ));
     $this->add($idioma);
	 
	 $parametro = new Element\Select('parametro');
     $parametro->setLabel('Criterio de busqueda');
     $parametro->setValueOptions(array(
             'palabras_claves'  => 'Palabras Clave',
             'autor'   => 'Autor',
             'titulo'     => 'Titulo',
             'codigo'   => 'Codigo',
     ));
     $this->add($parametro);
	 
     $tipo_tesis = new Element\Select('tipo_tesis');
     $tipo_tesis->setLabel('Tipo tesis');
     $tipo_tesis->setValueOptions(array(
             'Pregrado'  => 'Pregrado',
             'Postgrado'   => 'Postgrado',
     ));
     $this->add($tipo_tesis);
	 
	 $tipo = new Element\Select('tipo');
     $tipo->setLabel('Tipo Material');
     
     $this->add($tipo);

	 $hidden = new Element\Hidden('oculto');
	 $this->add($hidden);
	 
	$condiciones = new Element\Checkbox('condiciones');
	$condiciones->setLabel('acepto los terminos');
	$condiciones->setUseHiddenElement(true);
	$condiciones->setCheckedValue("good");
	$condiciones->setUncheckedValue("bad");
	$this->add($condiciones);
	
	$date = new Element\Date('date');
	$date
		->setLabel('Fecha de Recepcion')
		
		->setAttributes(array(
			'min'  => '2012-01-01',
			'max'  => '2020-01-01',
			'step' => '1', // days; default step interval is 1 day
    ))
    ->setOptions(array(
        'format' => 'Y-m-d'
    ));
	$this->add($date);

    $this->add(array(
            'name' => 'send',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Guardar',
                'title' => 'Guardar',
                'class' => 'btn btn-primary pull-right'
            ),
        ));

     
      $this->add(array(
            'name' => 'buscar',
            'attributes' => array(
                'class' => 'btn btn-primary',
                'type' => 'submit',
                'value' => 'buscar',
                'title' => 'buscar',
            ),
        ));

     
      $this->add(array(
            'name' => 'eliminar',
            'attributes' => array(
                'class' => 'btn btn-primary',
                'type' => 'submit',
                'value' => 'Eliminar',
                'title' => 'Eliminar',
            ),
        ));

     }
	 public function setInputFilter(InputFilterInterface $inputFilter){

        return null;
    }
    public function getInputFilter()
    {
       

        if(!$this->inputfilter){
            $inputfilter= new InputFilter();
            $factory = new InputFactory();
            //$dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter');
			$inputfilter->add($factory->createInput(array(
                'name'=>'codigo',
                'filter'=>array(array(
                'name'=>'HtmlEntities',
                'name'=>'StringTrim',
				'name'=>'Alnum',

                    )),
                'validators'=>array(
				
                 /*array('name'=>'Regex',
				'options'=>array('pattern'=>'\W|^)[\w.+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$'))),*/
					

                ))));
        $this->inputfilter= $inputfilter;
        return $this->inputfilter;

    }
	}
	
}

?>
