<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WildController extends AbstractController
{
    /**
     * @Route("/wild", name="wild_index")
     */
    public function index() :Response
    {
        return $this->render('wild/index.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }

    /**
     * @Route("/wild/show/{slug}", requirements={"slug"="[a-z0-9-]+"}, name="wild_show")
     */
    public function show($slug): Response
    {
        $slugs = str_split($slug);

        $slugs = explode(' ', implode(str_replace('-', ' ', $slugs)));

        foreach ($slugs as $key => $character) {
            $slugs[$key] = ucfirst($character);
        }

        $slug = implode($slugs, ' ');
        return $this->render('wild/show.html.twig', ['slug' => $slug]);
    }
}
