<?php

/**
 * VAT CALCULATOR APP.
 * (c) ktarila <ktarila@gmail.com>.
 */

namespace App\Controller;

use App\Entity\VatCalculation;
use App\Form\VatCalculationType;
use App\Repository\VatCalculationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/')]
class VatCalculationController extends AbstractController
{
    public function __construct(
        private VatCalculationRepository $vatCalculationRepository,
        private SerializerInterface $serializer,
    ) {
    }

    #[Route('/', name: 'app_vat_calculation_index', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $vatCalculation = new VatCalculation();
        $form = $this->createForm(VatCalculationType::class, $vatCalculation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->vatCalculationRepository->save($vatCalculation, true);

            return $this->redirectToRoute('app_vat_calculation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vat_calculation/index.html.twig', [
            'form' => $form,
            'vat_calculations' => $this->vatCalculationRepository->findAll(),
        ]);
    }

    #[Route('/clear-history', name: 'app_vat_calculation_delete', methods: ['POST'])]
    public function delete(Request $request): Response
    {
        if ($this->isCsrfTokenValid('clear-history', $request->request->get('_token'))) {
            $this->vatCalculationRepository->removeAll();

            return $this->redirectToRoute('app_vat_calculation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute('app_vat_calculation_index');
    }

    #[Route('/download-as-csv', name: 'app_vat_calculation_get_csv', methods: ['GET'])]
    public function getCSV(): Response
    {
        $vats = $this->vatCalculationRepository->findAll();
        $csvContent = $this->serializer->serialize($vats, 'csv');

        $response = new Response($csvContent);
        $response->headers->set('Content-Encoding', 'UTF-8');
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename=vat-calc.csv');

        return $response;
    }
}
