<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\SearchType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(EntityManagerInterface $manager, ProductRepository $repo, Request $request): Response
    {

        // $form = $this->createFormBuilder(NULL)
        //             ->add('Recherche')
        //             ->getForm();
        
    
        // $form->handleRequest($request); 
        // if($form->isSubmitted() && $form->isValid())
        // {
        //    $resultat = $form->get('Recherche')->getData();
        //    $products= $repo->getProductByName($resultat);
        
        // }
        // else{
        // $product = $repo->getProductOrderByPrice();

        // }


        // $products = $this->$manager->getRepository(Product::class)->findAll();
       
        $search = new Search();
    
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $products = $repo->findWithSearch($search);
        }
        else{
            $products = $repo->findAll();
        }


        return $this->render('product/index.html.twig',[
            'products' => $products,
            'searchForm' => $form->createView()
            // 'searchForm'=> $form->createView()
        ]);
    }

       /**
     * @Route("/produit/{id}", name="product")
     */
    public function show($id, ProductRepository $repo): Response
    {
       $repo = $this->getDoctrine()->getRepository(Product::class);
       $product = $repo->find($id);

       if(!$product){
           return $this->redirectToRoute('products');
       }
        return $this->render('product/show.html.twig',[
            'product' => $product
        ]);
    }
}
