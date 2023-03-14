<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\EspecesRepository;
use App\Entity\Especes;
USE App\Form\EspeceType;
use Symfony\Component\HttpFoundation\Request; 

class EspecesController extends AbstractController
{
    #[Route('/liste-des-especes', name: 'app_especes_index')]
    public function index(EspecesRepository $especeRepository): Response
    {
        return $this->render('especes/index.html.twig', [
            'especesListe' => $especeRepository->findAll(),
        ]);
    }

    #[Route('/espece/[id]', name: 'app_especes_show')]
    public function showOneEspece(Especes $espece,EspecesRepository $especesRepository, int $id):Response
    {
        $espece=$especesRepository->getEspeces($id);

        return $this->render('especes/show.html.twig', [
            'espece' => $espece,
        ]);
    }

    #[Route('/import', name: 'app_especes_add')]
    public function addEspece(Request $request,EspecesRepository $especesRepository):Response
    {
        $espece=new Especes();
        $form = $this->createForm(EspeceType::class, $espece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $especesRepository->save($espece, true);

            return $this->redirectToRoute('app_espece_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('espece/new.html.twig', [
            'espece' => $espece,
            'form' => $form,
        ]);
    }
}
