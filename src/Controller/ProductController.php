<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    #[Route('/products', name: 'product_list')]
    public function list(): Response
    {
        $products = $this->productRepository->findAll();

        return $this->render('product/list.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/products/{id}', name: 'product_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id): Response
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            $this->addFlash('danger', 'Produkt nenalezen.');
            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/detail.html.twig', [
            'product' => $product,
        ]);
    }
}
