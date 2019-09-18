<?php

namespace App\Controller;

use App\Entity\ProductOrder;
use App\Form\ProductOrderType;
use App\Repository\ProductOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product/order")
 */
class ProductOrderController extends AbstractController
{
    /**
     * @Route("/", name="product_order_index", methods={"GET"})
     */
    public function index(ProductOrderRepository $productOrderRepository): Response
    {
        return $this->render('product_order/index.html.twig', [
            'product_orders' => $productOrderRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_order_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $productOrder = new ProductOrder();
        $form = $this->createForm(ProductOrderType::class, $productOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productOrder);
            $entityManager->flush();

            return $this->redirectToRoute('product_order_index');
        }

        return $this->render('product_order/new.html.twig', [
            'product_order' => $productOrder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_order_show", methods={"GET"})
     */
    public function show(ProductOrder $productOrder): Response
    {
        return $this->render('product_order/show.html.twig', [
            'product_order' => $productOrder,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_order_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProductOrder $productOrder): Response
    {
        $form = $this->createForm(ProductOrderType::class, $productOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_order_index');
        }

        return $this->render('product_order/edit.html.twig', [
            'product_order' => $productOrder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_order_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProductOrder $productOrder): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productOrder->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productOrder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_order_index');
    }
}
