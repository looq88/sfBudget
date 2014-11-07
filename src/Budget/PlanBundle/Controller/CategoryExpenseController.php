<?php

namespace Budget\PlanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use Budget\PlanBundle\Entity\CategoryExpense;
use Budget\PlanBundle\Form\CategoryExpenseType;
use Budget\PlanBundle\Form\CategoryExpenseFilterType;

/**
 * CategoryExpense controller.
 *
 */
class CategoryExpenseController extends Controller
{
    /**
     * Lists all CategoryExpense entities.
     *
     */
    public function indexAction()
    {
        list($filterForm, $queryBuilder) = $this->filter();

        list($entities, $pagerHtml) = $this->paginator($queryBuilder);

        return $this->render('BudgetPlanBundle:CategoryExpense:index.html.twig', array(
            'entities' => $entities,
            'pagerHtml' => $pagerHtml,
            'filterForm' => $filterForm->createView(),
        ));
    }

    /**
    * Create filter form and process filter request.
    *
    */
    protected function filter()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $filterForm = $this->createForm(new CategoryExpenseFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('BudgetPlanBundle:CategoryExpense')->createQueryBuilder('e');

        // Reset filter
        if ($request->get('filter_action') == 'reset') {
            $session->remove('CategoryExpenseControllerFilter');
        }

        // Filter action
        if ($request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('CategoryExpenseControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('CategoryExpenseControllerFilter')) {
                $filterData = $session->get('CategoryExpenseControllerFilter');
                $filterForm = $this->createForm(new CategoryExpenseFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }

        return array($filterForm, $queryBuilder);
    }

    /**
    * Get results from paginator and get paginator view.
    *
    */
    protected function paginator($queryBuilder)
    {
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $currentPage = $this->getRequest()->get('page', 1);
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();

        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('category_expense', array('page' => $page));
        };

        // Paginator - view
        $translator = $this->get('translator');
        $view = new TwitterBootstrapView();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => $translator->trans('views.index.pagprev', array(), 'JordiLlonchCrudGeneratorBundle'),
            'next_message' => $translator->trans('views.index.pagnext', array(), 'JordiLlonchCrudGeneratorBundle'),
        ));

        return array($entities, $pagerHtml);
    }

    /**
     * Creates a new CategoryExpense entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new CategoryExpense();
        $form = $this->createForm(new CategoryExpenseType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('category_expense_show', array('id' => $entity->getId())));
        }

        return $this->render('BudgetPlanBundle:CategoryExpense:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new CategoryExpense entity.
     *
     */
    public function newAction()
    {
        $entity = new CategoryExpense();
        $form   = $this->createForm(new CategoryExpenseType(), $entity);

        return $this->render('BudgetPlanBundle:CategoryExpense:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CategoryExpense entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BudgetPlanBundle:CategoryExpense')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CategoryExpense entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BudgetPlanBundle:CategoryExpense:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing CategoryExpense entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BudgetPlanBundle:CategoryExpense')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CategoryExpense entity.');
        }

        $editForm = $this->createForm(new CategoryExpenseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BudgetPlanBundle:CategoryExpense:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing CategoryExpense entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BudgetPlanBundle:CategoryExpense')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CategoryExpense entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CategoryExpenseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('category_expense_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('BudgetPlanBundle:CategoryExpense:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CategoryExpense entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BudgetPlanBundle:CategoryExpense')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CategoryExpense entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('category_expense'));
    }

    /**
     * Creates a form to delete a CategoryExpense entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
