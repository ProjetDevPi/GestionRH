<?php

namespace RHBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matiere
 *
 * @ORM\Table(name="matiere")
 * @ORM\Entity(repositoryClass="RHBundle\Repository\MatiereRepository")
 */
class Matiere
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nommatiere", type="string")
     */
    private $nommatiere;

    /**
     * @var coef
     * @ORM\Column(name="coef", type="integer")
     */
    private $coef;

    /**
     * @return coef
     */
    public function getCoef()
    {
        return $this->coef;
    }

    /**
     * @param integer $coef
     */
    public function setCoef($coef)
    {
        $this->coef = $coef;
    }



    /**
     * @return string
     */
    public function getNommatiere()
    {
        return $this->nommatiere;
    }

    /**
     * @param string $nommatiere
     */
    public function setNommatiere($nommatiere)
    {
        $this->nommatiere = $nommatiere;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

