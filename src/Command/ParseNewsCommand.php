<?php

namespace App\Command;

use App\Message\NewsParser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Psr\Log\LoggerInterface;



class ParseNewsCommand extends Command
{
    protected static $defaultName = 'ParseNews';
    protected static $defaultDescription = 'Add a short description for your command';
    private $logger;


    private MessageBusInterface $bus;

    public function __construct(/*...,*/ MessageBusInterface $bus,LoggerInterface $logger)
    {
        //...
        $this->bus = $bus;
        parent::__construct();
        $this->logger = $logger;

    }

    protected function configure()
    {
        $this->setDescription("This will parse newsFedd and  store it in the database")
            ->addArgument('url', InputArgument::OPTIONAL, "News RSS Feed URL", "https://newsapi.org/v2/everything?q=tesla&from=2022-10-14&sortBy=publishedAt&apiKey=67bca880638142069885e55ab62f3278");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
        //  $url = $input->getArgument('url');
       
        //     $curl = curl_init();
        //    $config['useragent'] = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';

        //     curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://newsapi.org/v2/everything?q=tesla&from=2022-10-14&sortBy=publishedAt&apiKey=67bca880638142069885e55ab62f3278',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        //     CURLOPT_SSL_VERIFYPEER=>0
        //     ));
        //    curl_setopt($curl, CURLOPT_USERAGENT, $config['useragent']);

        //     $response = curl_exec($curl);

        //     curl_close($curl);
           $response = file_get_contents('/var/www/project/src/Command/sample.json');

            $news_response=json_decode($response, true);

            foreach($news_response["articles"] as $article){
             $this->bus->dispatch(new NewsParser($article));
            } 
            

 



        return Command::SUCCESS;
        } catch (\Throwable $th) {
            
        $output->writeln([
        json_encode($th->getMessage())
        ]);
          return Command::FAILURE;
        }
        
    }
}
