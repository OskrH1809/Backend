<?php

namespace App\Entity;

use App\Repository\MesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MesRepository::class)
 */
class Mes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



     /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    

    public function getId(): ?int
    {
        return $this->id;
    }

  

  

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}
