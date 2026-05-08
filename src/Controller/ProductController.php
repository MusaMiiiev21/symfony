<?php
declare(strict_types=1);


namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    #[Route('/products', name: 'product_list')]
    public function list(): Response
    {
        $productsFromDb = $this->productRepository->findBy([], ['id' => 'ASC']);
        $products = !empty($productsFromDb)
            ? array_map([$this, 'normalizeProductEntity'], $productsFromDb)
            : $this->getDemoProducts();

        return $this->render('product/list.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/products/{id}', name: 'product_detail', requirements: ['id' => '\\d+'])]
    public function detail(int $id): Response
    {
        $productEntity = $this->productRepository->find($id);
        if ($productEntity instanceof Product) {
            $product = $this->normalizeProductEntity($productEntity);
        } else {
            $product = null;
            foreach ($this->getDemoProducts() as $item) {
                if ($item['id'] === $id) {
                    $product = $item;
                    break;
                }
            }
        }

        if ($product === null) {
            throw $this->createNotFoundException('Product not found.');
        }

        return $this->render('product/detail.html.twig', [
            'product' => $product,
            'category' => $product['category'],
            'similarProducts' => $this->getSimilarProducts($id),
        ]);
    }

    private function getDemoProducts(): array
    {
        return [
            ['id' => 1, 'name' => 'Product 1', 'description' => 'Description for product 1', 'categoryId' => 1, 'category' => ['id' => 1, 'name' => 'Electronics']],
            ['id' => 2, 'name' => 'Product 2', 'description' => 'Description for product 2', 'categoryId' => 1, 'category' => ['id' => 1, 'name' => 'Electronics']],
            ['id' => 3, 'name' => 'Product 3', 'description' => 'Description for product 3', 'categoryId' => 2, 'category' => ['id' => 2, 'name' => 'Books']],
            ['id' => 4, 'name' => 'Product 4', 'description' => 'Description for product 4', 'categoryId' => 3, 'category' => ['id' => 3, 'name' => 'Home']],
            ['id' => 5, 'name' => 'Product 5', 'description' => 'Description for product 5', 'categoryId' => 2, 'category' => ['id' => 2, 'name' => 'Books']],
        ];
    }

    private function normalizeProductEntity(Product $product): array
    {
        $category = $product->getCategory();

        return [
            'id' => (int) $product->getId(),
            'name' => $product->getName(),
            'description' => (string) ($product->getDescription() ?? ''),
            'categoryId' => $category?->getId(),
            'category' => $category ? ['id' => (int) $category->getId(), 'name' => $category->getName()] : null,
        ];
    }

    private function getSimilarProducts(int $id): array
    {
        return [
            [
                'id' => max(1, $id - 1),
                'name' => 'Similar product ' . max(1, $id - 1),
                'description' => 'Alternative option close to product ' . $id,
            ],
            [
                'id' => $id + 1,
                'name' => 'Similar product ' . ($id + 1),
                'description' => 'Alternative option close to product ' . $id,
            ],
            [
                'id' => $id + 2,
                'name' => 'Similar product ' . ($id + 2),
                'description' => 'Alternative option close to product ' . $id,
            ],
        ];
    }
}
