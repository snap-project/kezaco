<?php

namespace Kezaco\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Kezaco\CoreBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("admin/users/", name="kezaco_admin_user_index")
     * @Template()
     */
    public function indexAction()
    {
      $users = $this->getDoctrine()
        ->getRepository('KezacoCoreBundle:User')
        ->findAll();

      return $this->render('KezacoAdminBundle:User:index.html.twig', [
        'users' => $users
        ]);
    }

    /**
     * @Route("admin/users/delete/{id}", name="kezaco_admin_user_delete")
     * @Template()
     *
     * @param integer  $id      ID's user
     * @param Request $request  Request object
     */
    public function deleteAction($id, Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $user = $em->getRepository('KezacoCoreBundle:User')->findOneBy(['id' => $id]);

      if (null === $user) {
        throw new NotFoundHttpException("L'utilisateur d'id ".$id." n'existe pas.");
      }

      $form = $this->createFormBuilder()->getForm();

      if ($form->handleRequest($request)->isValid()) {
        $em->remove($user);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info', "L'utilisateur a bien été supprimé.");

        return $this->redirect($this->generateUrl('kezaco_admin_user_index'));
      }

      return $this->render('KezacoAdminBundle:User:delete.html.twig', [
        'user' => $user,
        'form' => $form->createView()
        ]);
    }

}
