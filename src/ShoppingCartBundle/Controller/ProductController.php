<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShoppingCartBundle\Entity\Product;
use ShoppingCartBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller.
 *
 * @Route("product")
 */
class ProductController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("/", name="product_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getRepository(Product::class);

        $products = $em->findAll();

        return $this->render('product/index.html.twig', ['products' => $products,]);

    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="product_new")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('ShoppingCartBundle\Form\ProductType', $product);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

//            /** @var UploadedFile $file */
//            $file = $product->getImage();
//            $fileName = md5(uniqid()).'.'.$file->guessExtension();
//            $file->move(
//                $this->getParameter('image_directory'),
//                $fileName
//            );
//
//            $product->setImage($fileName);

            $product->setClient($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $this->addFlash("info", "Product " . $product->getName() . " was added successfully");

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/new", name="product_new_image")
//     */
//    public function showImage()
//    {
//        $image = $this->getDoctrine()->getRepository('ShoppingCartBundle:Product')->find(1);
//
//        return $this->render('product/new.html.twig', ['product' => $image]);
//    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="product_show")
     *
     * @Method("GET")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(int $id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        if (null === $product){
            return $this->redirectToRoute("product_index");
        }

        return $this->render('product/show.html.twig', [
            'product' => $product,

        ]);
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     * @Route("/{id}/edit", name="product_edit")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if ($product === null){
            return $this->redirectToRoute("product_index");
        }

        $currentUser = $this->getUser();
        if(!$currentUser->isClient($product) && !$currentUser->isAdmin() && !$currentUser->isEditor()){
            return $this->redirectToRoute("product_index");
        }

        $editForm = $this->createForm(ProductType::class, $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $this->addFlash("info", "Product " . $product->getName() . " was edited successfully");

            return $this->redirectToRoute('product_index', ['id' => $product->getId()]);
        }

        return $this->render('product/edit.html.twig',
            [
                'product' => $product,
                'edit_form' => $editForm->createView(),
            ]
        );
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}/delete", name="product_delete")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Method("GET")
     *
     * @param Product $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (null === $product){
            return $this->redirectToRoute("product_index");
        }

        $currentUser = $this->getUser();
        if(!$currentUser->isClient($product) && !$currentUser->isEditor() && !$currentUser->isAdmin()){

            return $this->redirectToRoute("product_index");
        }

        return $this->render('product/delete.html.twig',
            [
                'product' => $product
            ]
        );
    }

    /**
     * Confirm deletes a product entity.
     *
     * @Route("/{id}/delete/process", name="product_delete_process")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     *
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteProcessAction($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (null === $product){
            return $this->redirectToRoute("product_index");
        }

        $currentUser = $this->getUser();
        if(!$currentUser->isClient($product) && !$currentUser->isEditor() && !$currentUser->isAdmin()){

            return $this->redirectToRoute("product_index");
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        $this->addFlash("delete", "Product " . $product->getName() . " was successfully deleted.");

        return $this->redirectToRoute('product_index');
    }

//    /**
//     * @Route("/{id}/add", name="product_add")
//     *
//     * @Method("GET", "POST")
//     * @param Request $request
//     * @param Product $id
//     * @return void
//     */
//    public function addProduct(Request $request, Product $id)
//    {
//        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
//        $form = $this->createForm('ShoppingCartBundle\Form\ItemType', $product);
//        $form->handleRequest($request);
//
//
//    }
}
