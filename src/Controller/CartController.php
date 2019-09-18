<?php
namespace App\Controller;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class CartController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("/cart", name="cart")
     */
    public function index(ProductRepository $productRepository)
    {
        $totaal = 0;
        $cart = $this->session->get('cart');
        $cartArray = array();
        foreach ($cart as $id => $product) {
            array_push($cartArray, ['aantal' => $product['aantal'], "Product" => $productRepository->find($id)]);
            $totaal = $totaal + ($product['aantal'] * $productRepository->find($id)->getPrice());
        }
        return $this->render('cart/index.html.twig', [
            'Products' => $cartArray,
            'totaal' => $totaal,
        ]);
    }

    /**
     * @Route("/cart_checkout", name="cart_checkout")
     */
    public function checkout ()
    {
        $user = $this->getUser()->getId();

        echo($user);
    }
}