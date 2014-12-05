<?php

namespace Movie\ListBundle\Form;

use Movie\ListBundle\Form\MovieType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class MovieEditType extends MovieType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('title',     'text')
			->remove('numMovie',   'integer')
			->remove('nbDisc',    'integer')
			->add('isPret', 'checkbox', array('required' => false))
			->add('image', new ImageType())
			->add('typeMovies','entity',array('class'=>'MovieListBundle:TypeMovie','property'=>'type','multiple'=>true))
			->remove('enregistrer','submit')
			->add('sauvegarder','submit')
        ;
    }
    

    /**
     * @return string
     */
    public function getName()
    {
        return 'movie_listbundle_movie_edit';
    }
	
	public function getParent()
	{
		return new MovieType();
	}
}
