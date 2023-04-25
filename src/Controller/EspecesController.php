<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\EspeceRepository;
use App\Entity\Espece;
use App\Form\EspeceType;
use App\Model\OpieApi;
use Symfony\Component\HttpFoundation\Request; 

class EspecesController extends AbstractController
{
    #[Route('/liste-des-especes', name: 'especes_index')]
    public function index(EspeceRepository $especeRepository): Response
    {

        return $this->render('espece/index.html.twig', [
            'especesListe' => $especeRepository->findAll(),
        ]);
    }

    #[Route('/espece/{id}', name: 'especes_show')]
    public function showOneEspece(int $id, EspeceRepository $especeRepository):Response
    {
        $resultat= $especeRepository->find($id);
        //dd($resultat);
        $detail = OpieApi::detail($id);
        //dd($detail);
        if(isset($detail['habitat']) && $detail['habitat']!==null){
            $habitat = OpieApi::habitat((int)$detail['habitat']);
        }
        
        $media = OpieApi::media($id);

        return $this->render('espece/show.html.twig', [
            'detail' => $detail,
            'media' => $media,
            'habitat' => $habitat['name']??""
        ]);
    }

    #[Route('/import', name: 'especes_add')]
    public function addEspece(Request $request, EspeceRepository $especeRepository):Response
    {
        $espece=new Espece();
        $form = $this->createForm(EspeceType::class, $espece);
        $form->handleRequest($request);

        //dd($form->getData());

        if ($form->isSubmitted() && $form->isValid()) {
            $especeRepository->save($espece, true);

            return $this->redirectToRoute('app_espece_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('espece/new.html.twig', [
            'espece' => $espece,
            'form' => $form,
        ]);
    }
}
