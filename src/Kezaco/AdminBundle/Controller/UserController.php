<?php

namespace Kezaco\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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

    public function deleteAction(User $user)
    {
      $form = $this->createFormDelete($user);
      
    }

}
