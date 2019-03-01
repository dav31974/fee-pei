<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProductController extends AbstractController
{
    /**
     * @Route("/admin/products", name="admin_products_index")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(ProductRepository $repo)
    {
        return $this->render('admin/ad/index.html.twig', [
            'products' => $repo->findAll()
        ]);
    }


    /**
     * Permet de créer un produit ou une prestation
     * 
     * @Route("/admin/products/new", name="admin_products_create")
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager) {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
                
            $file = $product->getCover();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $product->setCover($fileName);
            
            $manager->persist($product);
            $manager->flush();
            
            $this->addFlash(
                'success',
                "La prestation/produit à bien été enregistré"
            );
            return $this->redirectToRoute('admin_products_index');
        }

        return $this->render('admin/ad/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * permet d'afficher le formulaire de modification d'un produit
     * 
     * @Route("/admin/products/{slug}/edit", name="admin_products_edit")
     *
     * @return Response
     */
    public function edit(Product $product, Request $request, ObjectManager $manager) {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        
        if($form->isSubmitted() && $form->isValid()) {
            
                
            $file = $product->getCover();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $product->setCover($fileName);
            
            $manager->persist($product);
            $manager->flush();
            
            $this->addFlash(
                'success',
                "Les modifications ont bien été enregistrées"
            );

            return $this->redirectToRoute('admin_products_index');
        }

        return $this->render('admin/ad/edit.html.twig', [
            'form' => $form->createView(),
            'product' => $product
        ]);
    }

    /**
     * Permet de supprimer un produit/création
     * 
     * @Route("/admin/products/{slug}/delete", name="admin_products_delete")
     *
     * @param Product $product
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Product $product, ObjectManager $manager) {
        $manager->remove($product);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le produit/prestation <strong>{$product->getTitle()}</strong> a bien été supprimée !"
        );
        return $this->redirectToRoute('admin_products_index');
    }

    
}
