<?php

namespace App\Message;
use Psr\Log\LoggerInterface;



final class NewsParser
{
   /**
     * @var object
     */
    private $load;
    public $logger;
    

    /**
     * @return object
     */
    public function getLoad(): array
    {
        return $this->load;
    }

    public function __construct(array $load)
    {
        $this->load = $load;

    
        
       
    }
}


