<?php

namespace Movie\ListBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieRate
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Movie\ListBundle\Entity\MovieRateRepository")
 */
class MovieRate
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
     * @var integer
     *
     * @ORM\Column(name="rate", type="integer")
     */
    private $rate;
	
	/**
	* @ORM\ManyToOne(targetEntity="Movie\ListBundle\Entity\Movie", cascade={"persist"})
	* @ORM\JoinColumn(nullable=false)
	*/
	private $movie;
	
	/**
	* @ORM\ManyToOne(targetEntity="Movie\ListBundle\Entity\TypeAvis", cascade={"persist"})
	* @ORM\JoinColumn(nullable=false)
	*/
	private $typeAvis;


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
     * Set rate
     *
     * @param integer $rate
     * @return MovieRate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return integer 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set movie
     *
     * @param \Movie\ListBundle\Entity\Movie $movie
     * @return MovieRate
     */
    public function setMovie(\Movie\ListBundle\Entity\Movie $movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get movie
     *
     * @return \Movie\ListBundle\Entity\Movie 
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set typeAvis
     *
     * @param \Movie\ListBundle\Entity\TypeAvis $typeAvis
     * @return MovieRate
     */
    public function setTypeAvis(\Movie\ListBundle\Entity\TypeAvis $typeAvis)
    {
        $this->typeAvis = $typeAvis;

        return $this;
    }

    /**
     * Get typeAvis
     *
     * @return \Movie\ListBundle\Entity\TypeAvis 
     */
    public function getTypeAvis()
    {
        return $this->typeAvis;
    }
}
