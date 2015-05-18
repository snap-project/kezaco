<?php

namespace Kezaco\MediathequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

use Kezaco\CoreBundle\Entity\User;
use Kezaco\MediathequeBundle\Entity\Media;

class DefaultController extends Controller
{
    /**
     * @Route("/medias/", name="kezaco_medias_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $user_id = $this->getUser()->getId();

      $medias = $em->getRepository('KezacoCoreBundle:User')
        ->find($user_id)
        ->getMedias();

      $user = $em->getRepository('KezacoCoreBundle:User')->find($user_id);

      $media = new Media();
      $media->setAuthorId($user_id);

      $form = $this->createFormBuilder($media)
        ->add('name')
        ->add('file')
        ->add('Envoyer', 'submit')
        ->getForm();

      $form->handleRequest($request);

      if ($form->isValid()) {
        $user->addMedia($media);
        $em->persist($user);
        $em->persist($media);
        $em->flush();

        $request->getSession()->getFlashBag()->add('success', "Votre fichier a bien été sauvegardé");
        return $this->redirectToRoute('kezaco_medias_index');
      }

      return $this->render('KezacoMediathequeBundle:Default:index.html.twig', [
        'medias' => $medias,
        'form' => $form->createView()
        ]);
    }
}
