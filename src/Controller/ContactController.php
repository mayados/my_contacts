<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\User;
use App\Repository\ContactRepository;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Attribute\IsGranted;


class ContactController extends AbstractController
{
    #[Route('/contacts', name: 'app_contacts')]
    public function index(ContactRepository $cr, Request $request): Response
    {
        
        return $this->render('contacts/contacts.html.twig', [
            'contacts' => $cr->findPaginatedContacts($request->query->getInt('page',1),$this->getUser()->getId()),
            'elementPagine' => $cr->findPaginatedContacts($request->query->getInt('page',1),$this->getUser()->getId())
        ]);
    }


    #[Route('/contact/remove/{id}', name: 'remove_contact')]
    public function removeContact(ContactRepository $cr, Contact $contact = null)
    {

        if($contact && $this->getUser()=== $contact->getUser()){

                $cr->remove($contact, $flush = true);

                $this->addFlash('notice', 'Le contact a été supprimé');

                return $this->redirectToRoute("app_contacts");              
        }

        return $this->redirectToRoute("app_contacts");   

    }

 
    #[Route('/contacts/add', name: 'add_contact')]
    #[Route('/contacts/edit/{id}', name: 'edit_contact')]
    public function add(ManagerRegistry $doctrine, Contact $contact = null, Request $request): Response
    {

        $edit = false;
        // EDIT : seul le créateur du contact peut le modifier
        if($contact && ($this->getUser() == $contact->getUser())){
            $edit = true;
        // CREATION 
        }elseif(!$contact){
            $contact = new Contact();
            // Si le user n'est pas l'auteur du contact on redirige vers l'accueil          
        }else{
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();           ;

            $contact->setUser($this->getUser());
            // Dans tous les cas, on persist le contact
            $entityManager = $doctrine->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            ($edit)?$this->addFlash('success', 'Le contact a été modifié avec succès'):$this->addFlash('success', 'Le contact a été créé avec succès');

            return $this->redirectToRoute('app_contacts');
        }

        return $this->render('contacts/add.html.twig', [
            'formAddContact' => $form->createView(),
            'edit' => $edit,
            'contact' => $contact
        ]);            
    }

}
