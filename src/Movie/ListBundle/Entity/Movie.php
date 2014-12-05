<?php

namespace Movie\ListBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Movie
 *
 * @ORM\Table(name="movie_movie")
 * @ORM\Entity(repositoryClass="Movie\ListBundle\Entity\MovieRepository")
 * @ORM\HasLifecycleCallbacks()
 */

class Movie
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
     * @ORM\Column(name="title", type="string", length=100)
	 * @Assert\NotBlank
     */
    private $title;


    /**
     * @var integer
     *
     * @ORM\Column(name="numMovie", type="integer")
	 * @Assert\Range(min="0")
     */
    private $numMovie;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbDisc", type="integer")
	 * @Assert\Range(min="0")
     */
    private $nbDisc;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isPret", type="boolean")
     */
    private $isPret;
	
	/**
	 * @ORM\Column(name="dateMAJ", type="datetime", nullable=true)
	 */
	private $dateMAJ;
	
	
	/**
	* @ORM\OneToOne(targetEntity="Movie\ListBundle\Entity\Image", cascade={"persist","remove"})
	* @Assert\Valid()
	*/
	private $image;
	
	/**
	* @ORM\ManyToOne(targetEntity="Movie\ListBundle\Entity\Pret", inversedBy="movies", cascade={"persist"})
	* @ORM\JoinColumn(nullable=true)
	*/
	private $pret;
	
	/**
	* @ORM\ManyToMany(targetEntity="Movie\ListBundle\Entity\TypeMovie", cascade={"persist"})
	* @Assert\NotNull()
	*/
	private $typeMovies;
	
	public function __construct()
	{
		$this->isPret = false;
		$this->typeMovies = new ArrayCollection();
	}
	
	/**
	 * @ORM\PreUpdate
	 */
	public function updateDateMAJ()
	{
		$this->setDateMAJ(new \Datetime());
	}

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
     * Set title
     *
     * @param string $title
     * @return Movie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Set numMovie
     *
     * @param integer $numMovie
     * @return Movie
     */
    public function setNumMovie($numMovie)
    {
        $this->numMovie = $numMovie;

        return $this;
    }

    /**
     * Get numMovie
     *
     * @return integer 
     */
    public function getNumMovie()
    {
        return $this->numMovie;
    }

    /**
     * Set nbDisc
     *
     * @param integer $nbDisc
     * @return Movie
     */
    public function setNbDisc($nbDisc)
    {
        $this->nbDisc = $nbDisc;

        return $this;
    }

    /**
     * Get nbDisc
     *
     * @return integer 
     */
    public function getNbDisc()
    {
        return $this->nbDisc;
    }

    /**
     * Set isPret
     *
     * @param boolean $isPret
     * @return Movie
     */
    public function setIsPret($isPret)
    {
        $this->isPret = $isPret;

        return $this;
    }

    /**
     * Get isPret
     *
     * @return boolean 
     */
    public function getIsPret()
    {
        return $this->isPret;
    }


    /**
     * Set image
     *
     * @param \Movie\ListBundle\Entity\Image $image
     * @return Movie
     */
    public function setImage(\Movie\ListBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Movie\ListBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Add typeMovies
     *
     * @param \Movie\ListBundle\Entity\TypeMovie $typeMovies
     * @return Movie
     */
    public function addTypeMovie(\Movie\ListBundle\Entity\TypeMovie $typeMovie)
    {
        $this->typeMovies[] = $typeMovie;

        return $this;
    }

    /**
     * Remove typeMovies
     *
     * @param \Movie\ListBundle\Entity\TypeMovie $typeMovies
     */
    public function removeTypeMovie(\Movie\ListBundle\Entity\TypeMovie $typeMovie)
    {
        $this->typeMovies->removeElement($typeMovie);
    }

    /**
     * Get typeMovies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypeMovies()
    {
        return $this->typeMovies;
    }


    /**
     * Set pret
     *
     * @param \Movie\ListBundle\Entity\Pret $pret
     * @return Movie
     */
    public function setPret(\Movie\ListBundle\Entity\Pret $pret = null)
    {
        $this->pret = $pret;

        return $this;
    }

    /**
     * Get pret
     *
     * @return \Movie\ListBundle\Entity\Pret 
     */
    public function getPret()
    {
        return $this->pret;
    }

    /**
     * Set dateMAJ
     *
     * @param \DateTime $dateMAJ
     * @return Movie
     */
    public function setDateMAJ($dateMAJ)
    {
        $this->dateMAJ = $dateMAJ;

        return $this;
    }

    /**
     * Get dateMAJ
     *
     * @return \DateTime 
     */
    public function getDateMAJ()
    {
        return $this->dateMAJ;
    }
	
	
	//FONCTION VALIDATOR
	// /**
	// *
	// * @Assert\True()
	// */
	// public function isTitle()
	// {
		// return false;
	// }
	
	// FONCTIONS CALLBACK
	// /**
	// * @Assert\Callback
	// */
	// public function isTitleValid(ExecutionContextInterface $context)
	// {
		// $forbiddenWords = array('test', 'test1');

		// On vérifie que le contenu ne contient pas l'un des mots
		// if (preg_match('#'.implode('|', $forbiddenWords).'#', $this->getTitle())) {
		  // La règle est violée, on définit l'erreur
		  // $context
			// ->buildViolation('Contenu invalide car il contient un mot interdit.') // message
			// ->atPath('title')                                                   // attribut de l'objet qui est violé
			// ->addViolation() // ceci déclenche l'erreur, ne l'oubliez pas
		  // ;
		// }
	// }
}
