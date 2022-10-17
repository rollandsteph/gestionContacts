<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categories", name="categories", methods={"GET"})
     */
    public function listeCategories(CategorieRepository $repo)
    {
        $categories=$repo->findAll();
        return $this->render('categorie/listeCategories.html.twig', [
            'lesCategories' => $categories
        ]);
    }

    /**
     * @Route("/categorie/{id}", name="ficheCategorie", methods={"GET"})
     */
    public function lafficheCategorie(Categorie $categorie)
    {
        return $this->render('categorie/ficheCategorie.html.twig', [
            'laCategorie' => $categorie
        ]);
    }

    /**
     * @Route("/categories/nbContactsParCat", name="nbContactsParCat", methods={"GET"})
     */
    public function nbContactsParCat(CategorieRepository $repo)
    {
        $data="";
        $categories = $repo->nbContactsParCat();
        foreach ($categories as $ligne){
            $data .='{ y: '.$ligne["nbContacts"] . ', label: "'.$ligne["libelle"].'" },';
        }
        $data=substr($data,0,-1);
        return $this->render('categorie/nbContactsParCat.html.twig', [
            'lesCategories' => $categories,
            'data' => $data
        ]);
    }
}
