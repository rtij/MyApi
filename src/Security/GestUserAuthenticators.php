<?php

namespace App\Security;


// All pack needed

use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\HttpUtils;
use App\DBAL\MultiDbConnectionWrapper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
// Entity
use App\Repository\AuthTokenRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use UnexpectedValueException;

class GestUserAuthenticators extends AbstractGuardAuthenticator
{
    private AuthTokenRepository $jetons; 
    private EntityManagerInterface $em;
    protected $httpUtils;
	public function __construct(EntityManagerInterface $em,HttpUtils $httpUtils,AuthTokenRepository $token)
	{
		$this->em = $em;
        $this->httpUtils = $httpUtils;
        $this->jetons = $token;
	}   
    /**
     * Does the authenticator support the given Request?
     *
     * If this returns false, the authenticator will be skipped.
     *
     * @return bool
     */
    public function supports(Request $request)
    {
        if(!$request->headers->get("X-Auth-Token"))
        {
            throw new BadCredentialsException("X-auth-token required");
        }
        else
        {
            return true;
        }
    }

    /**
     * Get the authentication credentials from the request and return them
     * as any type (e.g. an associate array).
     *
     * Whatever value you return here will be passed to getUser() and checkCredentials()
     *
     * For example, for a form login, you might:
     *
     *      return [
     *          'username' => $request->request->get('_username'),
     *          'password' => $request->request->get('_password'),
     *      ];
     *
     * Or for an API token that's on a header, you might use:
     *
     *      return ['api_key' => $request->headers->get('X-API-TOKEN')];
     *
     * @return mixed Any non-null value
     *
     * @throws \UnexpectedValueException If null is returned
     */
    public function getCredentials(Request $request )
    {
         // Verify if the token exist on the database
         //Set connection
         $connection = $this->em->getConnection();
         // set database
         if(!$connection instanceof MultiDbConnectionWrapper) {
             throw new \RuntimeException('Wrong connection');
         }
         $connection->selectDatabase('gestuser');
         //
         $result = $this->jetons->findOneByToken(hash("sha512",$request->headers->get("X-Auth-Token"))); 
         if($result==null){
             throw new AuthenticationException("This is not a token",400);
         }
         else{
            return $result;
         }
        
    }

    /**
     * Return a UserInterface object based on the credentials.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * You may throw an AuthenticationException if you wish. If you return
     * null, then a UsernameNotFoundException is thrown for you.
     *
     * @param mixed $credentials
     *
     * @throws AuthenticationException
     *
     * @return UserInterface|null
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $credentials->getIduser();
    }

    /**
     * Returns true if the credentials are valid.
     *
     * If false is returned, authentication will fail. You may also throw
     * an AuthenticationException if you wish to cause authentication to fail.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * @param mixed $credentials
     *
     * @return bool
     *
     * @throws AuthenticationException
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        // Verify the token validation
        //Set connection
        $connection = $this->em->getConnection();
        // set database
        if(!$connection instanceof MultiDbConnectionWrapper) {
             throw new \RuntimeException('Wrong connection');
        }
        $connection->selectDatabase('gestuser');
        $now = new DateTime("now");
        $intervale = $now->diff($credentials->getCreatedat());
        $days = $intervale->days; 
        if($days>0){ 
            throw new AuthenticationException("Credentials expired",400);
        }
        //Set database User
        $connection = $this->em->getConnection();
         // set database
         if(!$connection instanceof MultiDbConnectionWrapper) {
             throw new \RuntimeException('Wrong connection');
         }
         $connection->selectDatabase('gestuser');
        
        return true;
    }
    /**
     * Called when authentication executed, but failed (e.g. wrong username password).
     *
     * This should return the Response sent back to the user, like a
     * RedirectResponse to the login page or a 401 response.
     *
     * If you return null, the request will continue, but the user will
     * not be authenticated. This is probably not what you want to do.
     *
     * @return Response|null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new Response('bad request',400);
    }

    /**
     * Called when authentication executed and was successful!
     *
     * This should return the Response sent back to the user, like a
     * RedirectResponse to the last page they visited.
     *
     * If you return null, the current request will continue, and the user
     * will be authenticated. This makes sense, for example, with an API.
     *
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        return;
    }
    
    /**
     * Returns a response that directs the user to authenticate.
     *
     * This is called when an anonymous request accesses a resource that
     * requires authentication. The job of this method is to return some
     * response that "helps" the user start into the authentication process.
     *
     * Examples:
     *
     * - For a form login, you might redirect to the login page
     *
     *     return new RedirectResponse('/login');
     *
     * - For an API token authentication system, you return a 401 response
     *
     *     return new Response('Auth header required', 401);
     *
     * @return Response
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        throw $authException;
    }
    /**
     * Does this method support remember me cookies?
     *
     * Remember me cookie will be set if *all* of the following are met:
     *  A) This method returns true
     *  B) The remember_me key under your firewall is configured
     *  C) The "remember me" functionality is activated. This is usually
     *      done by having a _remember_me checkbox in your form, but
     *      can be configured by the "always_remember_me" and "remember_me_parameter"
     *      parameters under the "remember_me" firewall key
     *  D) The onAuthenticationSuccess method returns a Response object
     *
     * @return bool
     */
    public function supportsRememberMe()
    {
        return false;
    }

}
