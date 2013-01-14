<?php 

// JulCityField

namespace Jul\LocationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\Common\Persistence\ObjectManager;
use Jul\LocationBundle\Form\DataTransformer\CityTransformer;

class CityType extends AbstractType
{
	/**
	 * @var ObjectManager;
	 */
	private $om;
	
	/**
	 * Options sent via config
	 * 
	 * @var array
	 */
	private $configOptions;
	
	/**
	 * @param ObjectManager $om
	 */
	public function __construct(ObjectManager $om, $configOptions)
	{
		$this->om = $om;
		$this->configOptions = $configOptions;
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$transformer = new CityTransformer($this->om);
		
		/*
		 * Generate form builder fields from config
		*/
		foreach( $this->configOptions['city']['inputFields'] as $field => $fieldArray )
		{
			if( $fieldArray['enabled'] )
			{
				$builder->add( $field, $fieldArray['type'], $fieldArray['options'] );
			}
		}
		
		if( $this->configOptions['state']['enabled'] ) $builder->add( 'state', 'JulStateField' );
		
		$builder->addModelTransformer($transformer);
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		/*
		 * Generate Validation array from config
		*/
		$validationArray = array();
		
		foreach( $this->configOptions['city']['inputFields'] as $field => $fieldArray )
		{
			if( $fieldArray['enabled'] && $fieldArray['required'] )
			{
				array_push( $validationArray, "city$field" );
			}
		}
		
		$resolver->setDefaults(array(
			'data_class' => $this->configOptions['city']['data_class'],
			'validation_groups' => $validationArray,
			'cascade_validation' => true
		));
	}
	
	public function getParent()
	{
		return 'form';
	}

	public function getName()
	{
		return 'JulCityField';
	}
}