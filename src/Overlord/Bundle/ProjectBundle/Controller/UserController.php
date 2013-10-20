<?php

namespace Overlord\Bundle\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/users")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="project_users")
     * @Template()
     */
    public function indexAction()
    {
        $users = 
            $this->getDoctrine()
                ->getRepository('OverlordCoreBundle:User')
                ->findBy(array('deleted' => false));
        return array(
            'users' => $users,
        );
    }
}
