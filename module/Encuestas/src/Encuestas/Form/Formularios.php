<?php

/**
 * @author César Cancino
 * @copyright 2013
 */
namespace Encuestas\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Factory;
use Zend\Validator\ValidatorInterface;

class Formularios extends Form
{
    public function __construct($name = null)
     {
        parent::__construct($name);
        
        $this->add(array(
            'name' => 'titulo',
            'options' => array(
                'label' => 'Titulo',
				'validator'=>'Alpha()'
				
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
				'required'=>true,
				'filter'=>'Alpha()'
                //'camion'=>'zapato',
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
            'name' => 'volumen',
            'options' => array(
                'label' => 'Volumen',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
				'required'=>true,
                'maxlength'=>'2',
                //'pattern'=>'[0-9]{10}',
            ),
        ));
		
		$this->add(array(
            'name' => 'anio',
            'options' => array(
                'label' => 'A&ntilde;o',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input',
				'required'=>true,
                //'pattern'  => '^0[1-2]([-. ]?[0-9]{2}){4}$',
                'maxlength'=>'4',
                'pattern'=>'[1-9]{4}',
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
                'maxlength'=>'9',
                'pattern'=>'[0-9]{9}',
                'placeholder'=>'Ej: 999999999',
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

	 $this->add(array(
            'name' => 'editorial',
            'options' => array(
                'label' => 'Editorial',
            ),
            'attributes' => array(
                'type' => 'text',
				'required'=>true,
                //'class' => 'input'
            ),
        )); 
		
    $this->add(array(
            'name' => 'edicion',
            'options' => array(
                'label' => 'Edicion',
            ),
            'attributes' => array(
                'type' => 'text',
                'required'=>true,
                'maxlength'=>'5',
                //'pattern'=>'[0-9]{5}',
                //'class' => 'input'
            ),
        )); 
        

	 $tipo = new Element\Select('tipo');
     $tipo->setLabel('Tipo material');
	 //$idioma->setAttribute('multiple',True);
     $tipo->setValueOptions(array(
             'cd'  => 'CD',
             'libro'        => 'Libro',
             'revista'         => 'Revista',
     ));
     $this->add($tipo);
	 
	 
	 $hidden = new Element\Hidden('oculto');
	 $this->add($hidden);
	 
	

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
                //'onclick'=> '()',
            ),
        ));

     
      $this->add(array(
            'name' => 'eliminar',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Eliminar',
                'title' => 'Eliminar'
                //'method'=> 'post',
                //'action'=> $this->url.'/usuarios/editar/editar',
            ),
        ));

     }
	
}

?>
