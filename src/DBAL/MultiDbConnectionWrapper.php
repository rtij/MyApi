<?php
    
    namespace App\DBAL;

    use Doctrine\Common\EventManager;
    use Doctrine\DBAL\Driver;
    use Doctrine\DBAL\Connection;
    use doctrine\DBAL\Configuration;

    final class MultiDbConnectionWrapper extends Connection{
       public function __construct(
           array $params, Driver $driver, ?Configuration $config = null, ?EventManager $eventManager = null
        )
        {
            parent::__construct($params, $driver, $config, $eventManager);    
        }
        
        public function selectDatabase(string $DbName): void{
            if($this->isConnected()){
                $this->close();
            }

            $params = $this->getParams();
            $params['dbname'] = $DbName;
            parent::__construct($params, $this->_driver, $this->_config ,$this->_eventManager);
        }
    }