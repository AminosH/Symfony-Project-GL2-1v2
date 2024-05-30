<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(Request $request, Security $security)
    {
        // Handle form submission and authentication
        if ($request->isMethod('POST')) {
            $user = $security->getUser();

            if ($user) {
                // User already logged in, redirect if needed
            } else {
                // Try to authenticate the user
                $security->authenticateUser($request->request->get('_username'), $request->request->get('_password'));

                // Authentication successful, redirect
            }
        }

        // Login form rendering logic
        return $this->render('security/login.html.twig', [
            'error' => null, // Optional: Pass an error object for display
        ]);
    }
}

