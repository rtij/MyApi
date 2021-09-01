<?php

namespace App\Controller;

use App\DBAL\MultiDbConnectionWrapper;
use App\Entity\Contact;
use App\Entity\Contactclient;
use App\Entity\Contactfrs;
use App\Entity\Customer\Contactuser;
use App\Repository\AuthTokenRepository;
use App\Repository\ClientRepository;
use App\Repository\ContactClientRepository;
use App\Repository\ContactFrsRepository;
use App\Repository\ContactRepository;
use App\Repository\ContactUserRepository;
use App\Repository\FrsRepository;
use App\Repository\UsersRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


/**
 *  @Route("/api", name="api")
 */


class ContactController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     *  @Route("/Myuser/addContact", name="MyUseraddContact", methods={"POST"})
     */
    public function addMyUserContact(Request $request, AuthTokenRepository $authTokenRepository, ContactUserRepository $contactUserRepository)
    {
        $token = $authTokenRepository->findOneByToken(hash("sha512", $request->headers->get('X-Auth-Token')));
        $donnes = json_decode($request->getContent());
        $contact = new Contactuser();
        $contact->setTel($donnes->data);
        $contact->setIduser($token->getIduser());
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($contact);
        $sauv->flush();
        return $this->json(['data' => $contactUserRepository->findByIduser($token->getIduser())], 200);
    }


    /**
     *  @Route("/user/addContact", name="addContact", methods={"POST"})
     */
    public function addContactUser(Request $request, UsersRepository $usersRepository, ContactUserRepository $contactUserRepository)
    {
        $donnes = json_decode($request->getContent());
        $contact = new Contactuser();
        $contact->setTel($donnes->data->tel);
        $contact->setIduser($usersRepository->findOneByEmailu($donnes->data->iduser->emailu));
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($contact);
        $sauv->flush();
        return $this->json(['data' => $contactUserRepository->findAll()], 200);
    }

    /**
     *  @Route("/user/EditContact/{idcontact}", name="editContact", methods={"PUT"})
     */
    public function EditContact(Request $request, UsersRepository $usersRepository, ?ContactUser $contact, ContactUserRepository $contactUserRepository)
    {
        $donnes = json_decode($request->getContent());
        $contact->setTel($donnes->data->tel);
        $contact->setIduser($usersRepository->findOneByEmailu($donnes->data->iduser->emailu));
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($contact);
        $sauv->flush();
        return $this->json(['data' => $contactUserRepository->findAll()], 200);
    }

    /**
     *  @Route("/user/DeleteContact/{idcontact}", name="deleteContact", methods={"PUT"})
     */
    public function DelteContact(?ContactUser $contact, ContactUserRepository $contactUserRepository)
    {
        $sauv = $this->getDoctrine()->getManager();
        $sauv->remove($contact);
        $sauv->flush();
        return $this->json(['data' => $contactUserRepository->findAll()], 200);
    }

    /**
     *  @Route("/MyUserContact/liste", name="MyuserContactliste", methods={"GET"})
     */
    public function MyUserContact(Request $request, AuthTokenRepository $authTokenRepository, ContactUserRepository $contactUserRepository)
    {
        $connection = $this->em->getConnection();
        // set database
        if (!$connection instanceof MultiDbConnectionWrapper) {
            throw new \RuntimeException('Wrong connection');
        }
        $connection->selectDatabase('gestuser');
        $token = $authTokenRepository->findOneByToken(hash("sha512", $request->headers->get('X-Auth-Token')));
        return $this->json(['data' => $contactUserRepository->findByIduser($token->getIduser())], 200);
    }

    /**
     *  @Route("/ContactUser/liste", name="contactliste", methods={"GET"})
     */
    public function ContactUser(ContactUserRepository $contactUserRepository)
    {
        $connection = $this->em->getConnection();
        // set database
        if (!$connection instanceof MultiDbConnectionWrapper) {
            throw new \RuntimeException('Wrong connection');
        }
        $connection->selectDatabase('gestuser');
        return $this->json(['data' => $contactUserRepository->findAll()], 200);
    }
    /**
     *  @Route("/contact/client/liste", name="ContactClientListe", methods={"GET"})
     */
    public function contactClientListe(ContactClientRepository $contactClientRepository)
    {
        return $this->json(['data' => $contactClientRepository->findAll()], 200);
    }

    /**
     *  @Route("/contact/frs/liste", name="ContacFrsListe", methods={"GET"})
     */
    public function contactFrsListe(ContactFrsRepository $contactFrsRepository)
    {
        return $this->json(['data' => $contactFrsRepository->findAll()], 200);
    }

    /**
     *  @Route("/contact/client/add", name="contactClientAdd", methods={"POST"})
     */
    public function addContactClient(Request $request, ClientRepository $clientRepository, ContactRepository $contactRepository, ContactClientRepository $contactClientRepository)
    {
        $donnes = json_decode($request->getContent());
        $sauv = $this->getDoctrine()->getManager();
        $contact = new Contact();
        $contact->setTel($donnes->data->idcontact->tel);
        $sauv->persist($contact);
        $sauv->flush();
        $id = $contactRepository->findMax();
        $contact = $contactRepository->findOneByIdcontact($id);
        $contactClient = new Contactclient();
        $client = $clientRepository->findOneByIdcl($donnes->data->idcl->idcl);
        $contactClient->setIdcl($client);
        $contactClient->setIdcontact($contact);
        $sauv->persist($contactClient);
        $sauv->flush();
        return $this->json(['data' => $contactClientRepository->findAll()], 200);
    }

    /**
     *  @Route("/contact/client/edit", name="contactClientEdit", methods={"PUT"})
     */
    public function EditContactClient(Request $request, ?Contact $contact, ClientRepository $clientRepository, ContactRepository $contactRepository, ContactClientRepository $contactClientRepository)
    {
        $donnes = json_decode($request->getContent());
        $sauv = $this->getDoctrine()->getManager();
        $contact = $contactRepository->findOneByIdcontact($donnes->data->idcontact->idcontact);

        $result = $contactClientRepository->findOneByIdcontact($contact);
        $result->setIdcl($clientRepository->findOneByIdcl($donnes->data->idcl->idcl));
        $contact->setTel($donnes->data->idcontact->tel);
        $sauv->persist($contact);
        $sauv->flush();
        return $this->json(['data' => $contactClientRepository->findAll()], 200);
    }

    /**
     *  @Route("/contact/client/delete", name="contactClientRemove", methods={"POST"})
     */
    public function RemoveContactClient(Request $request, ?Contact $contact, ContactClientRepository $contactClientRepository, ContactRepository $contactRepository)
    {
        $donnes = json_decode($request->getContent());
        $sauv = $this->getDoctrine()->getManager();
        $contact = $contactRepository->findOneByIdcontact($donnes->data->idcontact->idcontact);
        $contactClient = $contactClientRepository->findOneByIdcontact($contact);
        $sauv->remove($contactClient);
        $sauv->flush();
        $sauv->remove($contact);
        $sauv->flush();
        return $this->json(['data' => $contactClientRepository->findAll()], 200);
    }


    /**
     *  @Route("/contact/frs/add", name="contactFrsAdd", methods={"POST"})
     */
    public function addContactFrs(Request $request, FrsRepository $frsRepository, ContactRepository $contactRepository, ContactFrsRepository $contactFrsRepository)
    {
        $donnes = json_decode($request->getContent());
        $contact = new Contact();
        $contact->setTel($donnes->data->idcontact->tel);
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($contact);
        $sauv->flush();
        $id = $contactRepository->findMax();
        $contact = $contactRepository->findOneByIdcontact($id);
        $contactfrs = new Contactfrs();
        $contactfrs->setIdf($frsRepository->findOneByIdf($donnes->data->idf->idf));
        $contactfrs->setIdcontact($contact);
        $sauv->persist($contactfrs);
        $sauv->flush();
        return $this->json(['data' => $contactFrsRepository->findAll()], 200);
    }

    /**
     *  @Route("/contact/frs/edit", name="contactFrsEdit", methods={"PUT"})
     */
    public function EditContactFrs(Request $request, FrsRepository $frsRepository, ContactRepository $contactRepository, ContactFrsRepository $contactFrsRepository)
    {
        $donnes = json_decode($request->getContent());
        $contact = $contactRepository->findOneByIdcontact($donnes->data->idcontact->idcontact);
        $contact->setTel($donnes->data->idcontact->tel);
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($contact);
        $sauv->flush();
        $contactfrs = $contactFrsRepository->findOneByIdcontact($contact);
        $contactfrs->setIdf($frsRepository->findOneByIdf($donnes->data->idf->idf));
        $contactfrs->setIdcontact($contact);
        $sauv->persist($contactfrs);
        $sauv->flush();
        return $this->json(['data' => $contactFrsRepository->findAll()], 200);
    }


    /**
     *  @Route("/contact/frs/delete", name="contactFrsRemove", methods={"POST"})
     */
    public function RemoveContactFrs(Request $request, ?Contact $contact, ContactFrsRepository $contactFrsRepository, ContactRepository $contactRepository)
    {
        $donnes = json_decode($request->getContent());
        $sauv = $this->getDoctrine()->getManager();
        $contact = $contactRepository->findOneByIdcontact($donnes->data->idcontact->idcontact);
        $contactfrs = $contactFrsRepository->findOneByIdcontact($contact);
        $sauv->remove($contactfrs);
        $sauv->flush();
        $sauv->remove($contact);
        $sauv->flush();
        return $this->json(['data' => $contactFrsRepository->findAll()], 200);
    }
}
