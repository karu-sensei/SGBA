<?php

namespace Usuarios\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Factory;
use Zend\Validator\ValidatorInterface;
use Zend\Validator\Db;
use Zend\Db\Adapter\Adapter;
use Application\Modelo\Entity\Usuarios;
use Zend\Db\Sql\Sql;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\Factory as InputFactory;

class Formeditar extends Form implements InputFilterAwareInterface
{
    
    public $inputfilter;
    public $adapter;
    public function __construct($name = null,$adapter)
     {
        parent::__construct($name);
        $this->adapter=$adapter;
        $this->add(array(
            'name' => 'nombre',
            'options' => array(
                'label' => 'Nombre Completo',
				//'validator'=>'Alpha()'
				
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
				//'required'=>true,
				//'filter'=>'Alpha()'
            ),
		));


        $this->add(array(
            'name' => 'direccion',
            'options' => array(
                'label' => 'Direccion',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
				'required'=>true,

            ),
        ));

        $this->add(array(
            'name' => 'respuesta',
            'options' => array(
                'label' => 'Respuesta',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
                'required'=>true,

            ),
        ));
		
        $this->add(array(
            'name' => 'matricula',
            'options' => array(
                'label' => 'Nro. matricula',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
				'required'=>true,
                'maxlength'=>'10',
                'pattern'=>'[0-9]{10}',
            ),	
			'validators' =>array(
			'NoRecordExists',
			array(
			'table'=>'usuarios',
			'field'=>'matricula')
			
			
			
        )
        ));
		
		
		$this->add(array(
            'name' => 'fono',
            'options' => array(
                'label' => 'Telefono',
            ),
            'attributes' => array(
                'type' => 'tel',
                'class' => 'input',
				
                'maxlength'=>'7',
                'pattern'=>'[0-9]{7}',
            ),
        ));
        $this->add(array(
            'name' => 'celular',
            'options' => array(
                'label' => 'Celular',
            ),
            'attributes' => array(
                'type' => 'tel',
                'class' => 'input',
				'required'=>true,
                'maxlength'=>'8',
                'pattern'=>'[0-9]{8}',
            ),
        ));
		$this->add(array(
            'name' => 'rut',
            'options' => array(
                'label' => 'RUT',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
				'required'=>true,
                'maxlength'=>'10',
                'minlength'=>'9',
                //'pattern'=>'[0,9]{9}',
                'pattern'=>'[0-9]{7,8}-[0-9,k]{1}',
                'placeholder'=>'Ej: 99999999-9',
                'data-provide'=>'typeahead',
                'autocomplete'=>'off',
            ),
			
			
        ));
        
         $factory = new Factory();

        $email = $factory->createElement(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'correo',
            'options' => array(
                'label' => 'Correo',
            ),
            'attributes' => array(
                
                'class' => 'input',
				'required'=>true,
                'placeholder'=>'Ej: ejemplo@ejemplo.com'
            ),
                ));

        $this->add($email);

        //campo de tipo password
	 $this->add(array(
            'name' => 'password',
            'options' => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'type' => 'password',
				'required'=>true,
                //'class' => 'input'
            ),
        )); 
		 $this->add(array(
            'name' => 'confirmar',
            'options' => array(
                'label' => 'Confirmar Password',
            ),
            'attributes' => array(
                'type' => 'password',
				'required'=>true,
                //'class' => 'input'
            ),
        ));
		
	    $this->add(array(
            'name'    => 'tipo',
            'type'    => 'Zend\Form\Element\Select',
            'options' => array(
                'label'         => 'Tipo Usuario',
                'empty_option'  => 'Elija'
            )
        ));

            $this->add(array(
            'name'    => 'carrera',
            'type'    => 'Zend\Form\Element\Select',
            'options' => array(
                'label'         => 'Carrera',
                'empty_option'  => 'Elija'
            )
        ));
		 $this->add(array(
            'name' => 'buscar_usuario',
            'options' => array(
                'label' => 'RUT',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input search-query',
                'required'=>true,
                'maxlength'=>'9',
                //'pattern'=>'[0-9]{9}',
                'placeholder'=>'RUT: 12345678-9',
                'data-provide'=>'typeahead',
                'autocomplete'=>'off',
            ),
			'validators'=>array(
                    array( 
                    'name'    => 'Db\RecordExists', 
                    'options' => array( 
                        'table' => 'usuarios', 
                        'field' => 'rut', 
                        'adapter'   => $this->adapter
                    ), 

                        ))
        ));

     $pregunta = new Element\Select('pregunta');
     $pregunta->setLabel('Pregunta Secreta');
     $pregunta->setValueOptions(array(
             'Primera Mascota'              => 'Primera Mascota',
             'Primer Nombre de tu abuela'   => 'Primer Nombre de tu abuela',
             'Personaje Historico Favorito' => 'Personaje Historico Favorito',
             'Comida Favorita'              => 'Comida Favorita',
             'Libro Favorito'               => 'Libro Favorito',
     ));
     $this->add($pregunta);
	 
	 $hidden = new Element\Hidden('oculto');
	 $this->add($hidden);

     //tipo de usuario
	 
	$usuario = new Element\Checkbox('registro_usuario');
	$usuario->setLabel('Usuarios');
	$usuario->setUseHiddenElement(true);
	$usuario->setCheckedValue("1");
	$usuario->setUncheckedValue("0");
	$this->add($usuario);

    $reservas = new Element\Checkbox('reservas_material');
    $reservas->setLabel('Reservas');
    $reservas->setUseHiddenElement(true);
    $reservas->setCheckedValue("1");
    $reservas->setUncheckedValue("0");
    $this->add($reservas);

    $multas = new Element\Checkbox('multas_material');
    $multas->setLabel('Multas');
    $multas->setUseHiddenElement(true);
    $multas->setCheckedValue("1");
    $multas->setUncheckedValue("0");
    $this->add($multas);

    $informes = new Element\Checkbox('emision_informes');
    $informes->setLabel('Informes');
    $informes->setUseHiddenElement(true);
    $informes->setCheckedValue("1");
    $informes->setUncheckedValue("0");
    $this->add($informes);

    $prestamos = new Element\Checkbox('registro_prestamos');
    $prestamos->setLabel('Prestamos');
    $prestamos->setUseHiddenElement(true);
    $prestamos->setCheckedValue("1");
    $prestamos->setUncheckedValue("0");
    $this->add($prestamos);

    $materiales = new Element\Checkbox('admin_material');
    $materiales->setLabel('Materiales');
    $materiales->setUseHiddenElement(true);
    $materiales->setCheckedValue("1");
    $materiales->setUncheckedValue("0");
    $this->add($materiales);



      $this->add(array(
            'name' => 'nombre_tipo',
            'options' => array(
                'label' => 'Nombre Tipo',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
                'required'=>true,
                'data-provide'=>'typeahead',
                'autocomplete'=>'off',

            ),
        ));

      $this->add(array(
            'name' => 'nombre_carrera',
            'options' => array(
                'label' => 'Nombre Carrera',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
                'required'=>true,
                'data-provide'=>'typeahead',
                'autocomplete'=>'off',

            ),
        ));

      $this->add(array(
            'name' => 'descripcion_carrera',
            'options' => array(
                'label' => 'Descripcion',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
                'autocomplete'=>'off',

            ),
        ));
	
	$date = new Element\Date('fecha');
	$date
		->setLabel('Fecha de ingreso')
		
		->setAttributes(array(
			'min'  => '2012-01-01',
			'max'  => '2020-01-01',
			'step' => '1',
            'pattern'=>'[1-31]{2}-[1-12]{2}-[1960-2100]{4}' // days; default step interval is 1 day
    ))
    ->setOptions(array(
        'format' => 'd-m-Y'
    ));
	$this->add($date);

    $this->add(array(
            'name' => 'send',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Guardar',
                'title' => 'Guardar'
            ),
        ));

     
      $this->add(array(
            'name' => 'buscar',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'buscar',
                'title' => 'buscar',
            ),
        ));

     
      $this->add(array(
            'name' => 'eliminar',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Eliminar',
                'title' => 'Eliminar'
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
                'name'=>'nombre',
                'required'=>'true',
                'filter'=>array(array(
                'name'=>'HtmlEntities',
                'name'=>'StripTags',
                'name'=>'StringTrim',

                    )),
                'validators'=>array(array('name'=>'Alpha',
				'options'=>array('allowWhiteSpace' => true)),
                    array('name'=>'StringLength',
                    'options'=>array(
                        'min'=>4,
                        'max'=>50)

                        ),
					)

                )));
				$inputfilter->add($factory->createInput(array(
                'name'=>'direccion',
                'required'=>'true',
                'filter'=>array(array(
                'name'=>'HtmlEntities',
                'name'=>'StripTags',
                'name'=>'StringTrim',

                    )),
                'validators'=>array(array('name'=>'Alnum',
				'options'=>array('allowWhiteSpace' => true)),array(
                    'name'=>'StringLength',
                    'options'=>array(
                        'min'=>4,
                        'max'=>60

                        )))

                )));
				$inputfilter->add($factory->createInput(array(
                'name'=>'correo',
                'required'=>'true',
                'filter'=>array(array(
                'name'=>'HtmlEntities',
                'name'=>'StripTags',
                'name'=>'StringTrim',

                    )),
                'validators'=>array(array(
                    'name'=>'StringLength',
                    'options'=>array(
                        'min'=>4,
                        'max'=>60

                        )),(array('name'=>'EmailAddress',
				'options'=>array()))

                )
				)));
             
            $inputfilter->add($factory->createInput(array(
                'name'=>'celular',
                'required'=>'true',
                'filter'=>array(array(
                'name'=>'HtmlEntities',
                'name'=>'StripTags',


                    )),
                'validator'=>array(
                    'name'=>'StringLength',
                    'options'=>array(
                        'max'=>8,

                        ))

                )));
        $this->inputfilter= $inputfilter;
        return $this->inputfilter;

    }
	}
	
	public function reset()
	{
			$this->get("nombre")->setAttribute("value","");
			$this->get("rut")->setAttribute("value","");
			$this->get("matricula")->setAttribute("value","");
			$this->get("celular")->setAttribute("value","");
			$this->get("fono")->setAttribute("value","");
			$this->get("correo")->setAttribute("value","");
			$this->get("respuesta")->setAttribute("value","");
			$this->get("confirmar")->setAttribute("value","");
			$this->get("password")->setAttribute("value","");
			$this->get("direccion")->setAttribute("value","");
	}
}

?>
