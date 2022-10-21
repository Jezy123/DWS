<?php

namespace App\Entity;

use App\Repository\DineroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DineroRepository::class)]
class Dinero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $total = null;

    #[ORM\Column]
    private ?float $euros = null;

    #[ORM\Column]
    private ?float $dolares = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getEuros(): ?float
    {
        return $this->euros;
    }

    public function setEuros(float $euros): self
    {
        $this->euros = $euros;

        return $this;
    }

    public function getDolares(): ?float
    {
        return $this->dolares;
    }

    public function setDolares(float $dolares): self
    {
        $this->dolares = $dolares;

        return $this;
    }
}
