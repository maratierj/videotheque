<?php

namespace Movie\ListBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pret
 *
 * @ORM\Table(name="movie_pret")
 * @ORM\Entity(repositoryClass="Movie\ListBundle\Entity\PretRepository")
 */
class Pret
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;
	
	/**
	* @ORM\OneToMany(targetEntity="Movie\ListBundle\Entity\Movie", mappedBy="pret")
	*/
	private $movies; // Notez le « s », un acquéreur est liée à 0-n films


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Pret
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->movies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function addMovie(\Movie\ListBundle\Entity\Movie $movie)
    {
        $this->movies[] = $movie;
		
		// On lie l'acquereur au film
		$movie->setPret($this);

        return $this;
    }

    public function removeMovie(\Movie\ListBundle\Entity\Movie $movie)
    {
        $this->movies->removeElement($movie);
		//relation facultative
		$movie->setPret($this);
    }

    /**
     * Get movies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMovies()
    {
        return $this->movies;
    }
}
