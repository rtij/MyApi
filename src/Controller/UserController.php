<?php

namespace App\Controller;

use App\DBAL\MultiDbConnectionWrapper;
use App\Entity\Customer\Users;
use App\Repository\AuthTokenRepository;
use App\Repository\UsersRepository;
use App\Repository\UserTypeRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 *  @Route("/api", name="api")
 */

class UserController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     *  @Route("/user/editUser/{iduser}", name="EditUser", methods={"POST"})
     */
    public function editUser(Request $request, ?Users $user, UserTypeRepository $userTypeRepository, AuthTokenRepository $authTokenRepository, UsersRepository $usersRepository, UserPasswordEncoderInterface $encoder)
    {
        // Get data
        $connection = $this->em->getConnection();
        // set database
        if (!$connection instanceof MultiDbConnectionWrapper) {
            throw new \RuntimeException('Wrong connection');
        }
        $connection->selectDatabase('gestuser');
        $User = new Users();
        $donnes = json_decode($request->getContent());
        $sauv = $this->getDoctrine()->getManager();
        $hash = $encoder->encodePassword($User, $donnes->User->password);
        $user->setPassword($hash);
        $user->setUsername($donnes->User->username);
        $token = $authTokenRepository->findOneByToken(hash("sha512", $request->headers->get('X-Auth-Token')));
        $utilisateur = $token->getIduser();
        $user->setIdgroup($utilisateur->getIdgroup());
        $user->setIdtype($userTypeRepository->findOneByIdtype($donnes->User->idtype->idtype));
        $utilisateur = $usersRepository->findOneByEmailu($donnes->User->emailu);
        if ($utilisateur && ($utilisateur->getIduser() != $user->getIduser())) {
            return new Response("Cette email est déja utilisé", 500);
        }
        $user->setEmailu($donnes->User->emailu);
        $sauv->persist($user);
        $sauv->flush();
        return $this->json(['data' => $usersRepository->findOneByEmailu($donnes->User->emailu)], 200);
    }

    /**
     *  @Route("/user/removeUser/{iduser}", name="RemoveUser", methods={"POST"})
     */
    public function RemoveUser(Request $request, ?Users $user, AuthTokenRepository $authTokenRepository, UsersRepository $usersRepository):Response
    {
        $donnes = json_decode($request->getContent());
        $sauv = $this->getDoctrine()->getManager();
        $token = $authTokenRepository->findOneByToken(hash("sha512", $request->headers->get('X-Auth-Token')));
        $utilisateur = $token->getIduser();
        $auth = $authTokenRepository->findByIduser($user);
        foreach ($auth as $it) {
            $sauv->remove($it);
            $sauv->flush();
        }
        $sauv->remove($user);
        $sauv->flush();
        if ($user == $utilisateur) {
            return new Response("bad request", 500);
        }

        return $this->json(['data' => $usersRepository->findByIdgroup($utilisateur->getIdgroup())], 200);
    }

    /**
     *  @Route("/user/getuser", name="Getusers", methods={"GET"})
     */
    public function Getusers(Request $req, AuthTokenRepository $token): Response
    {
        $connection = $this->em->getConnection();
        // set database
        if (!$connection instanceof MultiDbConnectionWrapper) {
            throw new \RuntimeException('Wrong connection');
        }
        $connection->selectDatabase('gestuser');
        $jetons = $token->findOneByToken(hash("sha512", $req->headers->get('X-Auth-Token')));
        if ($jetons) {
            return  $this->json(['data' => $jetons->getIduser()], 200);
        } else {
            return new Response("user not found", 400);
        }
    }

    /**
     *  @Route("/user/addUser", name="addUser", methods={"POST"})
     */
    public function addUser(Request $request, UserTypeRepository $userTypeRepository, AuthTokenRepository $authTokenRepository, UserPasswordEncoderInterface $userPasswordEncoder, UsersRepository $usersRepository)
    {
        $donnes = json_decode($request->getContent());
        $User = new Users();
        $User->setUsername($donnes->data->username);
        $hash = $userPasswordEncoder->encodePassword($User, $donnes->data->password);
        $User->setPassword($hash);
        $token = $authTokenRepository->findOneByToken(hash("sha512", $request->headers->get('X-Auth-Token')));
        $utilisateur = $token->getIduser();
        $User->setIdtype($userTypeRepository->findOneByType($donnes->data->type));
        $User->setIdgroup($utilisateur->getIdgroup());
        $utilisateur = $usersRepository->findOneByEmailu($donnes->data->emailu);
        if ($utilisateur) {
            return new Response("Cette email est déja utilisé", 500);
        }
        $User->setEmailu($donnes->data->emailu);
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($User);
        $sauv->flush();
        return $this->json(['data' => $usersRepository->findOneByEmailu($donnes->data->emailu)], 200);
    }

    /**
     *  @Route("/user/type/usertype", name="MyuserType", methods={"GET"})
     */
    public function GetUsertype(Request $request, AuthTokenRepository $authTokenRepository, UsersRepository $usersRepository){
        $token = $authTokenRepository->findOneByToken(hash("sha512", $request->headers->get('X-Auth-Token')));
        $usertype = $token->getIduser()->getIdtype()->getIdtype();
        $rand = random_bytes(10);
        $rand = hash("sha512", (string) $rand);
        $lenght = strlen($rand);
        $pos = $lenght / 2;
        $rand[$pos] = $usertype;
        return $this->json(['data' => $rand], 200);    
    }
    /**
     *  @Route("/user/liste", name="UserListe", methods={"GET"})
     */
    public function UserListe(Request $request, AuthTokenRepository $authTokenRepository, UsersRepository $usersRepository)
    {
        $token = $authTokenRepository->findOneByToken(hash("sha512", $request->headers->get('X-Auth-Token')));
        return $this->json(['data' => $usersRepository->findByIdgroup($token->getIduser()->getIdgroup())], 200);
    }

    /**
     *  @Route("/user/type/liste", name="listeType", methods={"GET"})
     */
    public function Typelist(UserTypeRepository $UserTypeRepository)
    {
        return $this->json(['data' => $UserTypeRepository->findAll()], 200);
    }
}
