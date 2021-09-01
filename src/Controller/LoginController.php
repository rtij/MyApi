<?php

namespace App\Controller;

// Kernel application

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
// MultiDB
use App\DBAL\MultiDbConnectionWrapper;

// Controller
//Controllers
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

// Entity
use App\Entity\Customer\Users;
use App\Entity\Customer\Authtoken;
use App\Entity\Customer\Groupe;
use App\Repository\AuthTokenRepository;
use App\Repository\GroupeRepository;
use App\Repository\UsersRepository;
use App\Repository\UserTypeRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 *  @Route("/login", name="login")
 */

class LoginController extends AbstractController
{

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    /**
     *  @Route("/addgroup", name="addGroup", methods={"POST"})
     */

    public function CreateMyUser(Request $request, KernelInterface $kernel, AuthTokenRepository $auth,UserTypeRepository $userTypeRepository,UserPasswordEncoderInterface $encoder,UsersRepository $usersRepository,GroupeRepository $groupeRepository){
        
        // For Users Only
        $connection = $this->em->getConnection();
        if (!$connection instanceof MultiDbConnectionWrapper) {
            throw new \RuntimeException('Wrong connection');
        }
        $connection->selectDatabase('gestuser');
        $donnes = json_decode($request->getContent());
        // GroupeRegistration
        $sauv = $this->getDoctrine()->getManager();
        if ($groupeRepository->findOneByNameg($donnes->Groupe->nameg)) {
            return new Response("Le nom de groupe est déja utilisé", 500);
        }
        $groupe = new Groupe();
        $groupe->setNameg($donnes->Groupe->nameg);
        $groupe->setEmailg($donnes->Groupe->emailg);
        //User registration
        $user = new Users();
        $hash = $encoder->encodePassword($user, $donnes->User->password);
        $user->setPassword($hash);
        if ($usersRepository->findOneByEmailu($donnes->User->emailu)) {
            return new Response("L'email de votre utilisateur est déja utilisé", 500);
        }
        $sauv->persist($groupe);
        $sauv->flush();
        $user->setUsername($donnes->User->username);
        $user->setEmailu($donnes->User->emailu);
        $type = $userTypeRepository->findOneByType("admin");
        $user->setIdType($type);
        $user->setIdgroup($groupeRepository->findOneByNameg($donnes->Groupe->nameg));
        $sauv = $this->getDoctrine()->getManager();
        $sauv->persist($user);
        $sauv->flush();
        // Create token
        $authToken = new AuthToken();
        $token = base64_encode(random_bytes(50));
        $hash = hash("sha512", $token);
        $authToken->setToken($hash);
        $authToken->setCreatedAt(new \DateTime('now'));
        $authToken->setIduser($usersRepository->findOneByEmailu($donnes->User->emailu));
        $sauv->persist($authToken);
        $sauv->flush();
        $databaseName = $donnes->Groupe->nameg;
        $databaseName = md5($databaseName);
        $connection->selectDatabase($databaseName);
        // create database command
        $application1 = new Application($kernel);
        $application1->setAutoExit(false);
        $input = new ArrayInput(['command' => 'doctrine:database:create']);
        // Output
        $output = new BufferedOutput();
        $application1->run($input, $output);
        //command migration
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $input = new ArrayInput(['command' => 'doctrine:migrations:migrate', '--no-interaction']);
        // set output
        $output = new BufferedOutput();
        $application->run($input, $output);
        // Find the token
        //initiation de jsonEncoder
        $encoders = [new JsonEncoder()];
        //initiation de normalizer
        $normalizer = [new ObjectNormalizer()];
        //conversion
        $serializer = new Serializer($normalizer, $encoders);
        $json_content = $serializer->serialize(['data' => $token], 'json');
        $rep = new Response($json_content, 200, ["Content-Type" => "application/json"]);
        //Envoie de la reponse
        return $rep;
    }

    /**
     *  @Route("/CreateMyDb", name="CreateMyDb", methods={"Get"})
     */
    public function CreateMyDb(Request $req, KernelInterface $kernel, AuthTokenRepository $auth, UsersRepository $usersRepository)
    {
        // For Users Only
        $connection = $this->em->getConnection();
        $sauv = $this->getDoctrine()->getManager();
        if (!$connection instanceof MultiDbConnectionWrapper) {
            throw new \RuntimeException('Wrong connection');
        }
        $connection->selectDatabase('gestuser');
        $donnes = json_decode($req->getContent());
        $databaseName = $donnes->Groupe->nameg;
        $databaseName = md5($databaseName);
        $connection->selectDatabase($databaseName);
        // create database command
        $application1 = new Application($kernel);
        $application1->setAutoExit(false);
        $input = new ArrayInput(['command' => 'doctrine:database:create']);
        // Output
        $output = new BufferedOutput();
        $application1->run($input, $output);
        //command migration
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $input = new ArrayInput(['command' => 'doctrine:migrations:migrate', '--no-interaction']);
        // set output
        $output = new BufferedOutput();
        $application->run($input, $output);
    }

    /**
     *  @Route("/login", name="app_login", methods={"POST"})
     */
    public function login(Request $request, UsersRepository $user, UserPasswordEncoderInterface $encoder, AuthTokenRepository $auth): Response
    {
        //Set connection
        $connection = $this->em->getConnection();
        // set database
        if (!$connection instanceof MultiDbConnectionWrapper) {
            throw new \RuntimeException('Wrong connection');
        }
        $connection->selectDatabase('gestuser');
        $donnes = json_decode($request->getContent());
        // find Emailuser
        $utilisateur = $user->findOneByEmailu($donnes->username);
        if (!$utilisateur) {
            return new Response('Email incorrecte', 401);
        }
        // Check password
        $isPasswordValid = $encoder->isPasswordValid($utilisateur, $donnes->password);
        if (!$isPasswordValid) {
            return new Response('Mot de passe incorrecte', 401);
        }
        // Create the token
        $em = $this->getDoctrine()->getManager();
        $authToken = new AuthToken();
        $token = base64_encode(random_bytes(50));
        $hash = hash("sha512", $token);
        $authToken->setToken($hash);
        $authToken->setCreatedAt(new \DateTime('now'));
        $authToken->setIduser($utilisateur);
        $em->persist($authToken);
        $em->flush();
        //initiation de jsonEncoder
        $encoders = [new JsonEncoder()];
        //initiation de normalizer
        $normalizer = [new ObjectNormalizer()];
        //conversion
        $serializer = new Serializer($normalizer, $encoders);
        $json_content = $serializer->serialize(['data' => $token], 'json');
        $rep = new Response($json_content, 200, ["Content-Type" => "application/json"]);
        //Envoie de la reponse
        return $rep;
    }

    /**
     *  @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout(Request $request, AuthTokenRepository $token)
    {
        $connection = $this->em->getConnection();
        // set database
        if (!$connection instanceof MultiDbConnectionWrapper) {
            throw new \RuntimeException('Wrong connection');
        }
        $connection->selectDatabase('gestuser');
        $authToken = $token->findOneByToken(hash("sha512", $request->headers->get('X-Auth-Token')));
        if ($authToken) {
            $sauv = $this->getDoctrine()->getManager();
            $sauv->remove($authToken);
            $sauv->flush();
            $date = new DateTime('now');
            $authToken = $token->findExpired($date, $authToken->getIduser());
            foreach ($authToken as $token) {
                $sauv->remove($token);
                $sauv->flush();
            }
            return $this->json([$authToken]);
        }
        return new Response("Token removed",200);
    }
}
