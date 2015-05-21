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

      $user = $this->getUser();

      $medias = $user->getMedias();

      // recupération des filtres
      $filters = empty($this->getRequest()->query->all()) ? [] : $this->getRequest()->query->all();
      if (!empty($filters))
      {
        $medias = $em->getRepository('KezacoMediathequeBundle:Media')
          ->findAllByFilter($filters);
      }

      // formulaire d'upload
      $media = new Media();
      $form = $this->createFormBuilder($media)
        ->add('name', 'text', ['label' => 'Nom du fichier'])
        ->add('file', 'file', ['label' => 'Choisir un fichier'])
        ->add('Envoyer', 'submit', ['attr' => ['class' => 'btn btn-block btn-primary']])
        ->getForm();

      $form->handleRequest($request);

      if ($form->isValid()) {
        $media->setAuthor( $this->getUser()->getId());
        $media->addUser($user);
        $user->addMedia($media);

        $em->persist($media);
        $em->persist($user);

        $em->flush();

        $request->getSession()->getFlashBag()->add('success', "Votre fichier a bien été sauvegardé");
        return $this->redirectToRoute('kezaco_medias_index');
      }

      return $this->render('KezacoMediathequeBundle:Default:index.html.twig', [
        'medias' => $medias,
        'form' => $form->createView(),
        'filters' => $filters
        ]);
    }
}
