<?php

namespace App\Controller;

use App\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Message\NewsParser;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\Query;




class NewsController extends AbstractController
{
     public $em;
     public $logger;

    public function __construct(LoggerInterface $logger,ManagerRegistry $doctrine)
    {
        $this->em= $doctrine->getManager();
        $this->logger=$logger;
    }
      /**
     * @Route("/news/{page<\d+>?1}",name="news")
     */
    public function index(int $page): Response
    {
        $news=[];

       $query = $this->em->getRepository(News::class)
           ->createQueryBuilder('u')
           ->getQuery();

       $paginator = new Paginator($query);

       $pageSize = 10;

       $totalItems = count($paginator);

        $pageCount = ceil($totalItems/$pageSize);
       $news = $paginator
           ->getQuery()
           ->setFirstResult($pageSize * ($page-1))
           ->setMaxResults($pageSize)
           ->getResult(Query::HYDRATE_OBJECT);


         return $this->render('news/index.html.twig',[
           'news'=>$news,
           'pageCount'=>$pageCount,
           'nextPage'=>($pageCount > $page)? "/news/" . ($page + 1): "#",
           "lastPage"=>($page == 1)?"#":"/news/" . ($page - 1)
       ]);

    }
  
     /**
     *@Route("/news/delete/{id}", name="delete")
     */
    public function delete(int $id, Request $request)
    {
        $query = $this->em->getRepository(News::class)->find($id);
        $this->em->remove($query);
        $this->em->flush();
        return $this->redirect($request->headers->get('referer'));
    }
}
