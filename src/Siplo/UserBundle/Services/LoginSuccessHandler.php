<?php

namespace Siplo\UserBundle\Services;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{

    protected $router;
    protected $security;

    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

        if ($this->security->isGranted('ROLE_ADMIN'))
        {
            $response = new RedirectResponse($this->router->generate('siplo_admin_home'));
        }
        elseif ($this->security->isGranted('ROLE_GUARDIAN'))
        {
            $response = new RedirectResponse($this->router->generate('siplo_guardian_home'));
        }
        elseif ($this->security->isGranted('ROLE_TEACHER'))
        {
            $response = new RedirectResponse($this->router->generate('siplo_teacher_home'));
        }
        elseif ($this->security->isGranted('ROLE_STUDENT'))
        {
            $response = new RedirectResponse($this->router->generate('siplo_student_home'));
        }

//        elseif ($this->security->isGranted('ROLE_USER'))
//        {
//            // redirect the user to where they were before the login process begun.
//            $referer_url = $request->headers->get('referer');
//
//            $response = new RedirectResponse($referer_url);
//        }
//        else
//        {
//            $response = new RedirectResponse($this->router->generate('siplo_student_login'));
//        }

        return $response;
    }

}