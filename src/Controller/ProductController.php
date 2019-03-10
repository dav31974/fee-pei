<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/products/corps", name="products_corps")
     */
    public function showsCorps(ProductRepository $repo)
    {
        $photoa = "/image/corpscarrousfirst.jpg";
        $photob = "/image/corpscarroussecond.jpg";
        $titrea = "Votre corps est précieux. Il est votre véhicule pour l’éveil.";
        $phrasea = "Prenez-en soin";
        $titreb = "Découvrez une multitude de soins spécialement adaptés à votre peau";
        $phraseb = "";

        $products = $repo->findBy(
            ['category' => 'corps']
        );
        return $this->render('product/corps.html.twig', [
            'products' => $products,
            'titrea' => $titrea,
            'phrasea' => $phrasea,
            'titreb' => $titreb,
            'phraseb' => $phraseb,
            'photoa' => $photoa,
            'photob' => $photob
        ]);
    }

    /**
     * @Route("/products/visage", name="products_visage")
     */
    public function showsVisage(ProductRepository $repo)
    {
        $photoa = "/image/visagecarrousfirst.jpg";
        $photob = "/image/visagecarroussecond.jpg";
        $titrea = "Le visage est le miroir du coeur";
        $phrasea = "Découvrez une multitude de soins spécialement adaptés à votre peau";
        $titreb = "Parce-que chaque peaux est différente ..";
        $phraseb = "La fée péi vous propose un diagnostique de peau afin de vous proposer une solution personnalisée";
        $products = $repo->findBy(
            ['category' => 'visage']
        );
        return $this->render('product/visage.html.twig', [
            'products' => $products,
            'titrea' => $titrea,
            'phrasea' => $phrasea,
            'titreb' => $titreb,
            'phraseb' => $phraseb,
            'photoa' => $photoa,
            'photob' => $photob
        ]);
    }

    /**
     * @Route("/products/epilation", name="products_epilation")
     */
    public function showsEpilation(ProductRepository $repo)
    {
        $photoa = "/image/epilationcarrousfirst.jpg";
        $photob = "/image/epilationcarroussecond.jpg";
        $titrea = "";
        $phrasea = "";
        $titreb = "Découvrez Epiloderm ! Une cire, une méthode.";
        $phraseb = "L'essayer c'est l'adopter !";
        $products = $repo->findBy(
            ['category' => 'epilation']
        );
        return $this->render('product/epilation.html.twig', [
            'products' => $products,
            'titrea' => $titrea,
            'phrasea' => $phrasea,
            'titreb' => $titreb,
            'phraseb' => $phraseb,
            'photoa' => $photoa,
            'photob' => $photob
        ]);
    }

    /**
     * @Route("/products/boutique", name="products_boutique")
     */
    public function showsBoutique(ProductRepository $repo)
    {
        $photoa = "/image/boutiquecarrousfirst.jpg";
        $photob = "/image/boutiquecarroussecond.jpg";
        $titrea = "";
        $phrasea = "";
        $titreb = "";
        $phraseb = "";
        $products = $repo->findBy(
            ['category' => 'boutique']
        );
        return $this->render('product/boutique.html.twig', [
            'products' => $products,
            'titrea' => $titrea,
            'phrasea' => $phrasea,
            'titreb' => $titreb,
            'phraseb' => $phraseb,
            'photoa' => $photoa,
            'photob' => $photob
        ]);
    }

    /**
     * @Route("/contact", name="contact_page")
     */
    public function contact()
    {
        $photoa = "/image/visite-attente.jpg";
        $photob = "/image/visite-attente-b.jpg";
        $titrea = "Bienvenue Chez La Fée Péi";
        $phrasea = "115, Rue François-Isautier SAINT-PIERRE";
        $titreb = "";
        $phraseb = "";
        return $this->render('product/contact.html.twig', [
            'titrea' => $titrea,
            'phrasea' => $phrasea,
            'titreb' => $titreb,
            'phraseb' => $phraseb,
            'photoa' => $photoa,
            'photob' => $photob
        ]);
    }

    /**
     * @Route("/regard", name="products_regard")
     */
    public function regard(ProductRepository $repo)
    {
        $photoa = "/image/regardcarrousfirst.jpg";
        $photob = "/image/regardcarroussecond.jpg";
        $titrea = "La beauté est dans les yeux de celui qui la regarde..";
        $phrasea = "115, Rue François-Isautier SAINT-PIERRE";
        $titreb = "Teinture / Réhaussement cils";
        $phraseb = "Trouvez le soin qui vous correspond";
        $products = $repo->findBy(
            ['category' => 'regard']
        );
        return $this->render('product/regard.html.twig', [
            'products' => $products,
            'titrea' => $titrea,
            'phrasea' => $phrasea,
            'titreb' => $titreb,
            'phraseb' => $phraseb,
            'photoa' => $photoa,
            'photob' => $photob
        ]);
    }


    /**
     * permet d'afficher un produit
     * 
     * @Route("/products/{slug}", name="products_show")
     *
     * @return Response
     */
    public function show($slug, ProductRepository $repo) {
        $product = $repo->findOneBySlug($slug);

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}