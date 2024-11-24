<?php
    require "../vendor/autoload.php";

    use Monolog\Level;
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    function dividi($x,$y){
        if($y==0){
            $up = new Exception("No se puede dividir por cero");
            throw $up;
        }
        return $x/$y;
    }

    $logger = new Logger('exception');
    $stream = new StreamHandler(__DIR__."/log/debug.log");
    
    if(!$logger->getHandlers()){
        $logger->pushHandler($stream);
    }

    echo "Inicio pintando logs en archivo debug.log...<br/>";

    $logger->debug("Debug message");
    $logger->warning("Warning message");
    $logger->error("Error message");

    try{
        dividi(5,0);
    }catch(Exception $e){
        $logger->error("Error: ".$e->getMessage());
    }
    echo "Fin pintando logs en archivo debug.log...<br/>";

?>