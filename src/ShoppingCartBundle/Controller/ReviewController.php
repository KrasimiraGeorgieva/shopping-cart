<?php

namespace ShoppingCartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ShoppingCartBundle\Entity\Product;
use ShoppingCartBundle\Entity\Review;
use ShoppingCartBundle\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends Controller
{

    /**
     * @Route("/{id}/reviews", name="product_reviews")
     *
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Product $product)
    {
        return $this->render('reviews/product.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/{id}/reviews/add", name="new_review_form")
     * @Method("GET")
     *
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newReviewFormAction(Product $product)
    {
        return $this->render('reviews/new_review.html.twig', [
            'reviewForm' => $this->createForm(ReviewType::class)->createView(),
            'product' => $product
        ]);
    }

    /**
     * @Route("/{id}/reviews/add", name="new_review_process")
     * @Method("POST")
     *
     * @param Product $product
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newReviewProcess(Product $product, Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $review->setProduct($product);
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();
            $this->addFlash("info", "Review added");
            return $this->redirectToRoute('product_reviews', ['id' => $product->getId()]);
        }

        return $this->render('reviews/product.html.twig', [
            'product' => $product
        ]);
    }
}
