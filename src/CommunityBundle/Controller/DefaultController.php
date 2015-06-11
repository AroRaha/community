<?php

namespace CommunityBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
// Import new namespaces
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * Default controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{
  /**
   * Lists all Post entities.
   *
   * @Route("/", name="community_homepage")
   * @Method("GET")
   * @Template()
   */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('CommunityBundle:Post');
        $entities = $repository->createQueryBuilder('p')
        ->orderBy('p.updatedAt', 'DESC')
        ->getQuery()
        ->getResult();

        return $this->render('CommunityBundle:Default:index.html.twig', array(
            'entities' => $entities));
    }
    /**
     * About
     *
     * @Route("/about", name="community_about")
     * @Method("GET")
     * @Template()
     */
    public function aboutAction()
    {
        return $this->render('CommunityBundle:Default:about.html.twig');
    }
    /**
     * Contact.
     *
     * @Route("/contact", name="community_contact")
     * @Method("GET")
     * @Template()
     */
	public function contactAction()
	{
    $form = $this->createFormBuilder()
      ->add('Nom', 'text')
      ->add('Email', 'text')
      ->add('Objet', 'text')
      ->add('Votre_message', 'textarea')
      ->getForm();

    return $this->render('CommunityBundle:Default:contact.html.twig', array(
        'form' => $form->createView()
    ));
	}
}
