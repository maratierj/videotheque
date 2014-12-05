<?php
// src/Movie\ListBundle\DataFixtures\ORM/LoadTypeAvis.php

namespace Movie\ListBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Movie\ListBundle\Entity\TypeAvis;

class LoadTypeAvis implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $types = array(
      'Effets spéciaux',
      'Scénario',
      'Action'
    );

    foreach ($types as $type) {
      // On crée la catégorie
      $typeAvis = new TypeAvis();
      $typeAvis->setName($type);

      // On la persiste
      $manager->persist($typeAvis);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}