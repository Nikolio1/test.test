<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Handlers\BaseHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @package App\Controller
 */
class ProductController extends AbstractController
{
    public $base;

    /**
     * ProductController constructor.
     * @param BaseHandler $base
     */
    public function __construct(BaseHandler $base)
    {
        $this->base = $base;
    }

    /**
     @Route("/products", name="products")
     *
     * @return Response
     */
    public function products()
    {
        $products = $this->base
            ->getRepository(Product::class)
            ->findAll();

        if (!$products) {
            throw $this->createNotFoundException(
                'No event found'
            );
        }

        return $this->render(
            'product/products.html.twig', ['products' => $products]);
    }

    /**
     * @Route("/show/{id}", name="show_product")
     *
     * @param $id
     *
     * @return Response
     */
    public function show(Product $product)
    {
       //dd($product);
        if (!$product) {
            throw $this->createNotFoundException(
                'No event found'
            );
        }

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     *
     * @param Product $post
     *
     * @return RedirectResponse
     */
    public function delete(Product $post)
    {
        if (!$post) {
            return $this->redirectToRoute('products');
        }

        $this->base->removeObject($post);

        return $this->redirectToRoute('products');
    }

    /**
     * @Route("/new", name="new")
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function new(Request $request)
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->base->saveObject($product);
            $this->addFlash('success', 'new item created successfully!!!');

            return $this->redirectToRoute('products');
        }

        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     *
     * @param $id
     * @param Request $request
     *
     * @return Response|void
     */
    public function edit($id,Request $request)
    {
        $product = $this->base
            ->getRepository(Product::class)
            ->find($id);

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->base->saveObject($product);
            $this->addFlash('success', 'Success)))!');

            return $this->redirectToRoute('products');
        }

        return $this->render('product/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
