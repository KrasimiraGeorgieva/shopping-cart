<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShoppingCartBundle\Entity\Category;
use ShoppingCartBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Category controller.
 *
 * @Route("category")
 */
class CategoryController extends Controller
{
    /**
     * Lists all category entities.
     *
     * @Route("/", name="category_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('ShoppingCartBundle:Category')->findAll();

        return $this->render('category/index.html.twig', ['categories' => $categories,]);
    }

    /**
     * Creates a new category entity.
     *
     * @Route("/new", name="category_new")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $currentUser = $this->getUser();
        if(!$currentUser->isAdmin() && !$currentUser->isEditor()){
            return $this->redirectToRoute("category_index");
        }

//        $category = new Category();
       //$form = $this->createForm('ShoppingCartBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash("info", "Category " . $category->getName() . " was added successfully");

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a category entity.
     *
     * @Route("/{id}", name="category_show")
     *
     * @Method("GET")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(int $id)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        if (null === $category){
            return $this->redirectToRoute("category_index");
        }
        return $this->render('category/show.html.twig',
            [
                'category' => $category,
//                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Displays a form to edit an existing category entity.
     *
     * @Route("/{id}/edit", name="category_edit")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Category $category)
    {
        $editForm = $this->createForm('ShoppingCartBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("info", "Category " . $category . " was successfully edited.");
            return $this->redirectToRoute('category_index', ['id' => $category->getId()]);
        }

        return $this->render('category/edit.html.twig',
            [
            'category' => $category,
            'edit_form' => $editForm->createView(),
            ]
        );
    }

    /**
     * Deletes a category entity.
     *
     * @Method({"GET", "POST"})
     * @Route("/{id}/delete", name="category_delete")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(Category $category, Request $request)
    {
        //$category = $this->getDoctrine()->getRepository(Category::class, $category);
            dump($category);
        if (null === $category){
            return $this->redirectToRoute("category_index");
        }

        
        $currentUser = $this->getUser();

        if(!$currentUser->isEditor() && !$currentUser->isAdmin()){
            return $this->redirectToRoute("category_index");
        }

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            //dump($category);
           // dump($category->getName());
            $em->remove($category);
            $em->flush();

            $this->addFlash("info", "Category " . $category . " was successfully deleted.");

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/delete.html.twig',
            [
                'category' => $category,
                'delete_form' => $form->createView()
            ]
        );
    }
}