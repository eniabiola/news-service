<?php

namespace App\MessageHandler;
use Psr\Log\LoggerInterface;
use App\Message\NewsParser;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Entity\News;
use Doctrine\Persistence\ManagerRegistry;


final class NewsParserHandler implements MessageHandlerInterface
{

   public $em;
   public $logger;

    public function __construct(LoggerInterface $logger,ManagerRegistry $doctrine)
    {
        $this->em= $doctrine->getManager();
        $this->logger=$logger;
        $this->logger->info('I just got the logger in NewsParser');
    }

     public function __invoke(NewsParser $newsParse)
    {

            
        try {
            $item=$newsParse->getLoad();
               $time = new \DateTime();
               
             $entItem = $this->em->getRepository(News::class)->findOneBy(['title'=> $item->title]);
              if (is_null($entItem)){
                 $entity = new News();
                 $entity->setTitle($item['title']);
                //  $entity->setDateAdded($time);
                 $entity->setPicture($item['urlToImage']);
                 $entity->setShortDescription($item['description']);
                 $this->em->persist($entity);
                $this->em->flush();
              }
            
        } catch (\Throwable $th) {
            $this->logger->info($th->getMessage());
        }
         
           
        
    }

}
