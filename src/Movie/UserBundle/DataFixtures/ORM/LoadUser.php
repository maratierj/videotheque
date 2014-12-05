<?php
// src/OC/UserBundle/DataFixtures/ORM/LoadUser.php

/*namespace Movie\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Movie\UserBundle\Entity\UserTest;

class LoadUser implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    // Les noms d'utilisateurs à créer
    $listNames = array('Julien2', 'Delphine2', 'Lou2', 'Emmy2');

    foreach ($listNames as $name) {
      // On crée l'utilisateur
      $user = new UserTest;

      // Le nom d'utilisateur et le mot de passe sont identiques
      $user->setUsername($name);
      $user->setPassword($name);

      // On ne se sert pas du sel pour l'instant
      //$user->setSalt('');
      // On définit uniquement le role ROLE_USER qui est le role de base
	  if($name === 'Julien')
	  {
		$user->setRole(array('ROLE_ADMIN'));
	  }
	  else
	  {
		$user->setRole(array('ROLE_USER'));
	}

      // On le persiste
      $manager->persist($user);
    }

    // On déclenche l'enregistrement
    $manager->flush();
  }
}*/