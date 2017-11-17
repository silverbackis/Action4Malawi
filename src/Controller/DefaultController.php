<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("", name="home")
     */
    public function home()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("donate", name="donate")
     */
    public function donate()
    {
        return $this->render('donate.html.twig');
    }

    /**
     * @Route("register", name="register")
     */
    public function register()
    {
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("suggest-project", name="suggest")
     */
    public function suggest()
    {
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("about", name="about")
     */
    public function about()
    {
        return $this->render('about.html.twig');
    }

    /**
     * @Route("partners", name="partners")
     */
    public function partners()
    {
        return $this->render('partners.html.twig');
    }

    /**
     * @Route("volunteering", name="volunteering")
     */
    public function volunteering()
    {
        return $this->render('volunteering.html.twig');
    }

    /**
     * @Route("gallery", name="gallery")
     */
    public function gallery()
    {
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("contact", name="contact")
     */
    public function contact()
    {
        return $this->render('contact.html.twig');
    }
}
