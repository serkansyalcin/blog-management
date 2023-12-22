<?php

namespace App\Controller;

use App\Datatables\ArticalDatatable;
use App\Entity\Artical;
use App\Form\ArticalAddType;
use Sg\DatatablesBundle\Datatable\DatatableFactory;
use Sg\DatatablesBundle\Response\DatatableResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class ArticalController extends AbstractController
{   

    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }
    
    #[Route('/', name: 'app_artical')]
    public function index(
        Request $request,
        DatatableFactory $datatableFactory,
        DatatableResponse $datatableResponse,
        ArticalRepository $articalRepository
    ): Response {
        $dataTable = $datatableFactory->create(ArticalDatatable::class);
        $dataTable->buildDatatable();

        if ($request->isXmlHttpRequest()) {
            $datatableResponse->setDatatable($dataTable);
            $datatableResponse->getDatatableQueryBuilder()->getQb();

            return $datatableResponse->getResponse();
        }
        
        $totalBlog = $articalRepository->getActiveBlogCounter();

        return $this->render('artical/index.html.twig', [
            'title'             => 'Blog List',
            'route'             => ['add' => 'blog_add'],
            'datatable'         => $dataTable,
            'totalBlog'         => $totalBlog,
            'isDateRangeFilter' => true,
        ]);
    }

    #[Route('bulk_delete', name: 'bulk_delete', methods: ['POST'])]
    public function bulkDelete(Request $request): Response
    {
        try {

            if ($request->isXmlHttpRequest()) {
                $choices = $request->get('data');
                $token   = $request->get('token');

                if (!$this->isCsrfTokenValid('multiselect', $token)) {
                    throw new AccessDeniedException('The CSRF token is invalid.');
                }
                $ids = array_column($choices, 'id');

                if (isset($ids) && count($ids) > 0) {
                    $this->em->createQueryBuilder()
                        ->delete(Artical::class, 'u')
                        ->where('u.id IN (:ids)')
                        ->setParameter('ids', $ids)
                        ->getQuery()
                        ->execute();
                }

                return new Response('Success', Response::HTTP_OK);
            }
        } catch (Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new Response('Bad Request', Response::HTTP_BAD_REQUEST);
    }

    #[Route('add_blog', name: 'blog_add')]
    public function addBlog(Request $request): Response
    {
        $artical = new Artical();
        $form    = $this->createForm(ArticalAddType::class, $artical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->em->persist($artical);
                $this->em->flush();
                $this->addFlash('success', 'Artical added successfully.');

                return $this->redirectToRoute('app_artical');
            } catch (Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }

        return $this->render('artical/add_blog.html.twig', [
            'form'  => $form->createView(),
            'title' => 'Add new blog',
        ]);

    }

    #[Route('blog/{id}', name: 'blog_edit')]
    public function updateUser(Request $request, Artical $artical): Response
    {
        $editForm       = $this->createForm(ArticalAddType::class, $artical);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            try {
                $this->em->persist($artical);
                $this->em->flush();
                $this->addFlash('success', 'Record updated successfully');
                return $this->redirectToRoute('app_artical');
            } catch (Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }

        return $this->render('artical/edit.html.twig', [
            'form'            => $editForm->createView(),
            'title'           => 'Update Blog',
            'route'           => [
            'list'            => 'app_artical',
            ],
        ]);
        
    }
}
