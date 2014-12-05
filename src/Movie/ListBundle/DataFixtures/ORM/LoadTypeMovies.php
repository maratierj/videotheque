<?php
// src/Movie\ListBundle\DataFixtures\ORM/LoadTypeMovies.php

namespace Movie\ListBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Movie\ListBundle\Entity\TypeMovie;

class LoadTypeMovies implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $types = array(
      'Science fiction',
      'Heroic fantasy',
      'Thriller',
      'Fantastique',
      'Comédie',
	  'Drame',
	  'Animation'
    );

    foreach ($types as $type) {
      // On crée la catégorie
      $typeMovie = new TypeMovie();
      $typeMovie->setType($type);

      // On la persiste
      $manager->persist($typeMovie);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}