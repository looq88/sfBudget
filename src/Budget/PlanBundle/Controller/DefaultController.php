<?php

namespace Budget\PlanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BudgetPlanBundle:Default:index.html.twig', array('name' => $name));
    }
}
