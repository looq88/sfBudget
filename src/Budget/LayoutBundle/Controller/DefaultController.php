<?php

namespace Budget\LayoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BudgetLayoutBundle:Default:index.html.twig', array());
    }
}
