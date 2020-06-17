<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Form\QuestionsType;
use App\Repository\QuestionsRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/questions")
 */
class QuestionsController extends AbstractController
{
    /**
     * @Route("/", name="questions_index", methods={"GET", "POST"})
     * @param QuestionsRepository $questionsRepository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(QuestionsRepository $questionsRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $question = new Questions();
        $form = $this->createForm(QuestionsType::class, $question);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();
            return $this->redirectToRoute('questions_index');
        }

        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(Questions::class)->findAll();
        $donnees = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            13 // Nombre de résultats par page
        );

        return $this->render('questions/index.html.twig', [
            'questions' => $donnees,
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/update", name="update", methods={"GET","POST"})
     */
    public function update()
    {
        return $this->render('update.html.twig');
    }

    /**
     * @Route("/{id}", name="questions_show", methods={"GET"})
     * @param Questions $question
     * @return Response
     */
    public function show(Questions $question): Response
    {
        return $this->render('accueil.html.twig', [
            'question' => $question,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="questions_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Questions $question): Response
    {
        $form = $this->createForm(QuestionsType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('questions_index');
        }

        return $this->render('questions/edit.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="questions_delete", methods={"DELETE"})
     * @param Request $request
     * @param Questions $question
     * @return Response
     */
    public function delete(Request $request, Questions $question): Response
    {

        if ($this->isCsrfTokenValid('delete'.$question->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($question);
            $entityManager->flush();
        }
        return $this->redirectToRoute('questions_index');
    }
}
