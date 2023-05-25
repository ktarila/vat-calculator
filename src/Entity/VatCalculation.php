<?php

/**
 * VAT CALCULATOR APP.
 * (c) ktarila <ktarila@gmail.com>.
 */

namespace App\Entity;

use App\Repository\VatCalculationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VatCalculationRepository::class)]
class VatCalculation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $monetaryValue = null;

    #[ORM\Column]
    private ?float $vatPercentage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonetaryValue(): ?float
    {
        return $this->monetaryValue;
    }

    public function setMonetaryValue(float $monetaryValue): self
    {
        $this->monetaryValue = $monetaryValue;

        return $this;
    }

    public function getVatPercentage(): ?float
    {
        return $this->vatPercentage;
    }

    public function setVatPercentage(float $vatPercentage): self
    {
        $this->vatPercentage = $vatPercentage;

        return $this;
    }

    /**
     * Caluculate VAT when exlusive from amount.
     */
    public function getVATExclusive(): float
    {
        return ($this->monetaryValue * (1 + ($this->vatPercentage / 100))) - $this->monetaryValue;
    }

    /**
     * Add VAT exlusive amount.
     */
    public function getVATExclusiveAdded(): float
    {
        return $this->monetaryValue + $this->getVATExclusive();
    }

    /**
     * Caluculate VAT when inclusive in amount.
     */
    public function getVATInclusive(): float
    {
        return $this->monetaryValue - ($this->monetaryValue / (1 + $this->vatPercentage / 100));
    }

    /**
     * Remove VAT inclusive amount.
     */
    public function getVATInclusiveSubtracted(): float
    {
        return $this->monetaryValue - $this->getVATInclusive();
    }
}
