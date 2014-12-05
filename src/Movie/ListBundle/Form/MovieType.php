<?php

namespace Movie\ListBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MovieType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',     'text')
			->add('numMovie',   'integer')
			->add('nbDisc',    'integer')
			->add('isPret', 'checkbox', array('required' => false))
			->add('image', new ImageType())
			->add('typeMovies','entity',array('class'=>'MovieListBundle:TypeMovie','property'=>'type','multiple'=>true))
			->add('enregistrer','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Movie\ListBundle\Entity\Movie'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'movie_listbundle_movie';
    }
}
