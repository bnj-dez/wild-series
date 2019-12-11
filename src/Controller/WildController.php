<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\CommentType;
use App\Form\ProgramSearchType;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/wild", name="wild_")
 */

class WildController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();
        if (!$programs) {
            throw $this->createNotFoundException(
                'No program found in program\'s table.'
            );
        }
        $form = $this->createForm(ProgramSearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $data = $form->getData();
            $programs = $this->getDoctrine()
                ->getRepository(Program::class)
                ->findBy(['title' => $data['searchField']]);
        }
        return $this->render('wild/index.html.twig', [
            'programs' => $programs,
            'form' => $form->createView()
        ]);
    }

    /**
     * Getting a program with a formatted slug for title
     *
     * @param string $slug The slugger
     * @Route("/show/{slug<^[a-z0-9-]+$>}", defaults={"slug" = null}, name="show")
     * @return Response
     */
    public function show(?string $slug):Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find a program in program\'s table.');
        }
        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with '.$slug.' title, found in program\'s table.'
            );
        }

        return $this->render('wild/show.html.twig', [
            'program' => $program,
            'slug'  => $slug,
        ]);
    }

    /**
     * @param string $categoryName
     * @Route("/category/{categoryName<^[a-z0-9-]+$>}", defaults={"slug" = null}, name="category")
     * @return Response
     */
    public function showByCategory(?string $categoryName):Response
    {

        $categoryName = ucfirst($categoryName);
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy(['name' => $categoryName]);
        if (!$category) {
            throw $this->createNotFoundException(
                'No program with ' . $categoryName . ' category, found in program\'s table.'
            );
        }

        $categoryId = $category[0]->getId();
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(
                ['category' => $categoryId],
                ['id' => 'DESC'],
                3
            );

        return $this->render('wild/category.html.twig',
            [
                'categories' => $category,
                'programs' => $program,
                'categoryname' => $categoryName
            ]);
    }

    /**
     * @param string $programTitle
     * @Route("/program/{programTitle}", defaults={"slug" = null}, name="program")
     * @return Response
     */

    public function showByProgram(?string $programTitle):Response
    {
        $programTitle = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($programTitle)), "-")
        );

        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['title' => $programTitle]);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with ' . $programTitle . ' category, found in program\'s table.'
            );
        }

        $programId = $program[0]->getId();
        $season = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findBy(
                ['program_id' => $programId],
                ['id' => 'ASC']
            );

        return $this->render('wild/program.html.twig',
            [
                'programs' => $program,
                'seasons' => $season
            ]);
    }

    /**
     * @param string $id
     * @Route("/program/season/{id<^[0-9-]+$>}", defaults={"slug" = null}, name="season")
     * @return Response
     */

    public function showBySeason(int $id):Response
    {
        $id = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($id)), "-")
        );

        $season = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findOneBy(['id' => $id]);
        if (!$season) {
            throw $this->createNotFoundException(
                'No program with ' . $id . ' category, found in program\'s table.'
            );
        }
        $program = $season->getProgramId();
        $episode = $season->getEpisodes();

        return $this->render('wild/season.html.twig',
            [
                'seasons' => $season,
                'episodes' => $episode,
                'programs' => $program
            ]);
    }

    /**
     * @Route("/episode/{id<^[0-9-]+$>}", name="episode")
     * @return Response
     */

    public function showEpisode(Episode $episode, Request $request):Response
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('wild_index');
        }
        return $this->render('wild/episode.html.twig',
            [
                'episode' => $episode,
                'form' => $form->createView(),
            ]);
    }

    /**
     * @param string $name The slugger
     * @Route("/actor/{name}", name = "actor")
     * @return Response
     */
    public function actorName(?string $name):Response
    {
        if (!$name) {
            throw $this
                ->createNotFoundException('No slug has been sent to find a program in program\'s table.');
        }
        $name = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($name)), "-")
        );

        $actor = $this->getDoctrine()
            ->getRepository(Actor::class)
            ->findOneBy(['name' => $name]);

        $program = $actor -> getPrograms();

        if (!$actor) {
            throw $this->createNotFoundException(
                'No actor with '.$name.' name, found in actor\'s table.'
            );
        }

        return $this->render('wild/actor.html.twig', [
            'actors' => $actor,
            'programs' => $program,
            'name'  => $name,
        ]);
    }
}
