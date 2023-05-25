<?php

/**
 * VAT CALCULATOR APP.
 * (c) ktarila <ktarila@gmail.com>.
 */

namespace App\Test\Controller;

use App\Entity\VatCalculation;
use App\Repository\VatCalculationRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VatCalculationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private VatCalculationRepository $repository;
    private string $path = '/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(VatCalculation::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('VAT Calculator');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    // public function testNew(): void
    // {
    //     $originalNumObjectsInRepository = count($this->repository->findAll());

    //     $this->markTestIncomplete();
    //     $this->client->request('GET', sprintf('%snew', $this->path));

    //     self::assertResponseStatusCodeSame(200);

    //     $this->client->submitForm('Save', [
    //         'vat_calculation[monetaryValue]' => 'Testing',
    //         'vat_calculation[vatPercentage]' => 'Testing',
    //     ]);

    //     self::assertResponseRedirects('/vat/calculation/');

    //     self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    // }

    // public function testShow(): void
    // {
    //     $this->markTestIncomplete();
    //     $fixture = new VatCalculation();
    //     $fixture->setMonetaryValue('My Title');
    //     $fixture->setVatPercentage('My Title');

    //     $this->repository->save($fixture, true);

    //     $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

    //     self::assertResponseStatusCodeSame(200);
    //     self::assertPageTitleContains('VatCalculation');

    //     // Use assertions to check that the properties are properly displayed.
    // }

    // public function testEdit(): void
    // {
    //     $this->markTestIncomplete();
    //     $fixture = new VatCalculation();
    //     $fixture->setMonetaryValue('My Title');
    //     $fixture->setVatPercentage('My Title');

    //     $this->repository->save($fixture, true);

    //     $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

    //     $this->client->submitForm('Update', [
    //         'vat_calculation[monetaryValue]' => 'Something New',
    //         'vat_calculation[vatPercentage]' => 'Something New',
    //     ]);

    //     self::assertResponseRedirects('/vat/calculation/');

    //     $fixture = $this->repository->findAll();

    //     self::assertSame('Something New', $fixture[0]->getMonetaryValue());
    //     self::assertSame('Something New', $fixture[0]->getVatPercentage());
    // }

    // public function testRemove(): void
    // {
    //     $this->markTestIncomplete();

    //     $originalNumObjectsInRepository = count($this->repository->findAll());

    //     $fixture = new VatCalculation();
    //     $fixture->setMonetaryValue('My Title');
    //     $fixture->setVatPercentage('My Title');

    //     $this->repository->save($fixture, true);

    //     self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

    //     $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
    //     $this->client->submitForm('Delete');

    //     self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
    //     self::assertResponseRedirects('/vat/calculation/');
    // }
}
