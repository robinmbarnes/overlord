<?php

namespace Overlord\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Overlord\Bundle\CoreBundle\Entity\Company;
use Overlord\Bundle\FrontendBundle\Form\CompanyForm;
use Overlord\Bundle\CoreBundle\Entity\Admin;
use Overlord\Bundle\FrontendBundle\Form\UserForm;
use Overlord\Bundle\CoreBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="frontend_welcome")
     * @Template()
     */
    public function welcomeAction()
    {
        return array(
            
        );
    }
    
    /**
     * @Route("/signup/company", name="frontend_signup_company")
     * @Template()
     */    
    public function signUpCompanyAction()
    {
        $company = new Company();
        $form = $this->createForm(new CompanyForm(), $company);
        $request = $this->getRequest();
        
        if($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if($form->isValid())
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($company);
                $em->flush();
                $request->getSession()->set('company_id', $company->getId());
                return $this->redirect($this->generateUrl('frontend_signup_user'));
            }
        }
        
        return array(
          'form' => $form->createView(),  
        );
    }
    
    /**
     * @Route("/signup/user", name="frontend_signup_user")
     * @Template()
     */
    public function signUpUserAction()
    {
        $request = $this->getRequest();
        $companyId = $request->getSession()->get('company_id');
        $company = ($companyId ? $this->getDoctrine()->getRepository('OverlordCoreBundle:Company')->find($companyId) : null);
        if(!$company)
        {
            $this->redirect($this->generateUrl('frontend_signup_company'));
        }
        $admin = new Admin();
        $form = $this->createForm(new UserForm(), $admin);
                
        if($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if($form->isValid())
            {
                $admin->setCompany($company);
                $admin->setSalt(time());
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($admin);
                $password = $encoder->encodePassword($admin->getPassword(), $admin->getSalt());
                $admin->setPassword($password);
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($admin);
                $em->flush();
                return $this->redirect($this->generateUrl('frontend_signup_success'));
            }
        }    
        return array(
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route("/signup/success", name="frontend_signup_success")
     * @Template()
    */
    public function signUpSuccessAction()
    {
        $request = $this->getRequest();
        $companyId = $request->getSession()->get('company_id');
        $company = ($companyId ? $this->getDoctrine()->getRepository('OverlordCoreBundle:Company')->find($companyId) : null);
        if(!$company)
        {
            return $this->redirect($this->generateUrl('frontend_welcome'));
        }
        $this->getRequest()->getSession()->set('company_id', null);
        return array();
    }
}
