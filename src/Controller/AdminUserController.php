<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\FidelityType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminUserController extends AbstractController
{

    /**
     * permet de gérer les reduction
     * 
     * @Route("/admin/fidelity/{id}/edit", name="admin_users_edit")
     *
     * @return Response
     */
    public function edit($id, User $user, Request $request, ObjectManager $manager) {
        
        $form = $this->createForm(FidelityType::class, $user);

        $form->handleRequest($request);

        
        if($form->isSubmitted() && $form->isValid()) {
            
            $currentReduction = $user->getReduction();
            $amount = $user->getAmount();
            $newReduction = $amount * 0.10 + $currentReduction;
            $user->setReduction($newReduction);

            $manager->persist($user);
            $manager->flush();
            
            $this->addFlash(
                'success',
                "La reduction à bien été mise à jour !"
            );

            return $this->redirectToRoute('admin_users_index');
        }

        return $this->render('admin/user/reduction.html.twig', [
            'form' => $form->createView(),
            'user' =>$user
        ]);
    }

    /**
     * @Route("/admin/users", name="admin_users_index")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(UserRepository $repo)
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $repo->findAll()
        ]);
    }

    
}
