<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {    $user=null;
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('indexadmin');
        }

            return $this->render('@User/Default/index.html.twig');

    }




    public function indexAdminAction()
    {
        return $this->render('@User/Default/index_admin.html.twig');
    }
}
