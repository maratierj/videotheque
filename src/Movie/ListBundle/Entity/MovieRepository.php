<?php

namespace Movie\ListBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * MovieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MovieRepository extends EntityRepository
{
	public function getAllMovies($page, $nbPerPage)
	{
		$query = $this->createQueryBuilder('movie')
			->leftJoin('movie.image','image')
			->addSelect('image')
			->leftJoin('movie.typeMovies','typemovie')
			->addSelect('typemovie')
			->orderBy('movie.id', 'ASC')
			->getQuery();

		$query
		  // On définit l'annonce à partir de laquelle commencer la liste
		  ->setFirstResult(($page-1) * $nbPerPage)
		  // Ainsi que le nombre d'annonce à afficher sur une page
		  ->setMaxResults($nbPerPage)
		;

		// Enfin, on retourne l'objet Paginator correspondant à la requête construite
		// (n'oubliez pas le use correspondant en début de fichier)
		return new Paginator($query, true);
	}
	public function getLastMovieAdd($limit)
	{
		$qb = $this->createQueryBuilder('movie');
		$qb->orderBy('movie.id', 'DESC');
		$qb->setMaxResults($limit);
		
		return $qb->getQuery()->getResult();
	}
}
