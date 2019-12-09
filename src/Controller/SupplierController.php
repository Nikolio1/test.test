<?php


namespace App\Controller;

use App\Entity\Supplier;
use App\Form\SupplierType;
use App\Handlers\BaseHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class SupplierController
 * @package App\Controller
 */
class SupplierController extends AbstractController
{
    public $base;

    /**
     * SupplierController constructor.
     * @param BaseHandler $base
     */
    public function __construct(BaseHandler $base)
    {
        $this->base = $base;
    }

    /**
     * @Route("/suppliers", name="suppliers")
     *
     * @return Response
     */
    public function suppliers()
    {
        $suppliers = $this->base
            ->getRepository(Supplier::class)
            ->findAll();

        if (!$suppliers) {
            throw $this->createNotFoundException(
                'No event found'
            );
        }

        return $this->render('supplier/suppliers.html.twig', [
                'suppliers' => $suppliers
            ]);
    }

    /**
     * @Route("/supplier/{id}", name="supplier")
     *
     * @param Supplier $supplier
     *
     * @return Response
     */
    public function show(Supplier $supplier)
    {
        if (!$supplier) {
            throw $this->createNotFoundException(
                'No event found'
            );
        }

        return $this->render('supplier/supplier.html.twig', [
            'supplier' => $supplier
        ]);
    }

    /**
     * @Route("/deleteSupplier/{id}", name="deleteSupplier")
     *
     * @param Supplier $product
     *
     * @return RedirectResponse
     */
    public function delete(Supplier $product)
    {
        if (!$product) {
            return $this->redirectToRoute('suppliers');
        }

        $this->base->removeObject($product);

        return $this->redirectToRoute('suppliers');
    }

    /**
     * @Route("/editSupplier/{id}", name="editSupplier")
     *
     * @param Supplier $product
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function edit(Supplier $product, Request $request)
    {
        $supplier= $this->base
            ->getRepository(Supplier::class)
            ->find($product);

        $form = $this->createForm(SupplierType::class, $supplier);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->base->saveObject($supplier);
            $this->addFlash('success', 'Success)))!');

            return $this->redirectToRoute('suppliers');
        }

        return $this->render('supplier/editSupplier.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/newSupplier", name="newSupplier")
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function new(Request $request)
    {
        $supplier = new Supplier();

        $form = $this->createForm(SupplierType::class, $supplier);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->base->saveObject($supplier);
            $this->addFlash('success', 'new item created successfully!!!');

            return $this->redirectToRoute('suppliers');
        }

        return $this->render('supplier/newSupplier.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}