<?php

namespace tacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use techBundle\Entity\Technicien;

/**
 * Taches
 *
 * @ORM\Table(name="taches", indexes={@ORM\Index(name="id_tech", columns={"id_tech"})})
 * @ORM\Entity
 */
class Taches
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tache", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTache;

    /**
     * @return int
     */
    public function getIdTache()
    {
        return $this->idTache;
    }

    /**
     * @param int $idTache
     */
    public function setIdTache($idTache)
    {
        $this->idTache = $idTache;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * @param string $descriptif
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;
    }

    /**
     * @return int
     */
    public function getDifficulte()
    {
        return $this->difficulte;
    }

    /**
     * @param int $difficulte
     */
    public function setDifficulte($difficulte)
    {
        $this->difficulte = $difficulte;
    }

    /**
     * @return bool
     */
    public function isEtat()
    {
        return $this->etat;
    }

    /**
     * @param bool $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }



    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Descriptif", type="text", length=65535, nullable=false)
     */
    private $descriptif;

    /**
     * @var integer
     *
     * @ORM\Column(name="Difficulté", type="integer", nullable=false)
     */
    private $difficulte;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean", nullable=true)
     */
    private $etat;

    /**
     * @var Technicien
     *
     * @ORM\ManyToOne(targetEntity="techBundle\Entity\Technicien",inversedBy="Taches")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tech", referencedColumnName="id_tech")
     * })
     */
    public $idTech;

    /**
     * @return Technicien
     */
    public function getIdTech()
    {
        return $this->idTech;
    }

    /**
     * @param Technicien $idTech
     */
    public function setIdTech($idTech)
    {
        $this->idTech = $idTech;
    }

    public function __toString() {
        return $this->descriptif;
    }

}

