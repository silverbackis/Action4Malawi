<?php

namespace App\Controller;

use App\Entity\ProjectSuggestion;
use App\Entity\RegisteredUser;
use App\Form\RegisterType;
use App\Form\SuggestionType;
use App\Utils\MailerUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function register(Request $request)
    {
        $form = $this->createForm(RegisterType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mailer = $this->get(\Swift_Mailer::class);
            /**
             * @var RegisteredUser
             */
            $registeredUser = $form->getData();
            $message = MailerUtils::createSwiftMessage(
                'New Volunteer Registration',
                $registeredUser->getEmail(),
                $this->renderView(
                    'emails/registered.html.twig',
                    [
                        'user' => $registeredUser
                    ]
                )
            );
            $mailer->send($message);
            return $this->redirectToRoute('register_success');
        }
        return $this->render('register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("register/success", name="register_success")
     */
    public function registerSuccess(Request $request)
    {
        return $this->render('registerSuccess.html.twig');
    }

    /**
     * @Route("suggest-project", name="suggest")
     */
    public function suggest(Request $request)
    {
        $form = $this->createForm(SuggestionType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mailer = $this->get(\Swift_Mailer::class);
            /**
             * @var ProjectSuggestion
             */
            $suggestion = $form->getData();
            $message = MailerUtils::createSwiftMessage(
                'New Project Suggestion',
                $suggestion->getEmail(),
                $this->renderView(
                    'emails/suggestion.html.twig',
                    [
                        'suggestion' => $suggestion
                    ]
                )
            );
            $mailer->send($message);
            return $this->redirectToRoute('suggest_success');
        }
        return $this->render('suggest.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("suggest-project/success", name="suggest_success")
     */
    public function suggestSuccess()
    {
        return $this->render('suggestSuccess.html.twig');
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

    public static function getSubscribedServices()
    {
        return array_merge(parent::getSubscribedServices(), [
           \Swift_Mailer::class, '?' . \Swift_Mailer::class
        ]);
    }
}
