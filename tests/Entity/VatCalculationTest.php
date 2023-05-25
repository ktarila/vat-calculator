<?php

/**
 * VAT CALCULATOR APP.
 * (c) ktarila <ktarila@gmail.com>.
 */

namespace App\Tests\Entity;

use App\Entity\VatCalculation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VatCalculationTest extends KernelTestCase
{
    public function testVATExclusiveCalculation(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());

        $vat = new VatCalculation();
        $vat->setVatPercentage(20)->setMonetaryValue(60);
        $vatCalc = $vat->getVATExclusive();

        $this->assertEquals(12, $vatCalc);
    }

    public function testVATInclusiveCalculation(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());

        $vat = new VatCalculation();
        $vat->setVatPercentage(20)->setMonetaryValue(60);
        $vatCalc = $vat->getVATInclusive();

        $this->assertEquals(10, $vatCalc);
    }
}
