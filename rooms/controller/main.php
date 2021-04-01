<?php
/**
 * User Controller
 *
 * @author Serhii Shkrabak
 * @global object $CORE
 * @package Controller\Main
 */
namespace Controller;
class Main
{
  use \Library\Shared;

  private $model;

  public function exec():?array {
    include 'model/config/patterns.php';
     
    $result = null;
    $url = $this->getVar('REQUEST_URI', 'e');
    $path = explode('/', $url);

    if (isset($path[2]) && !strpos($path[1], '.')) { // Disallow directory changing
      $file = ROOT . 'model/config/methods/' . $path[1] . '.php';
      if (file_exists($file)) {
        include $file;
        if (isset($methods[$path[2]])) {
          $details = $methods[$path[2]];
          $request = [];
          foreach ($details['params'] as $param) {
            $var = $this->getVar($param['name'], $param['source']);
            try{
              if ($var){
                try{
                  if(isset($param['pattern'])){//если есть паттерн
                    if(preg_match($patterns[$param['pattern']]['regex'],$var)){//если вар подходит под паттерн
                      if(isset($patterns[$param['pattern']]['callback'])){
                        $var=preg_replace_callback($patterns[$param['pattern']]['regex'],$patterns[$param['pattern']]['callback'],$var);
                      }
                      $request[$param['name']] = $var;  
                    }else throw new \Exception('REQUEST_INCORRECT');
                
                  }else {
                    $request[$param['name']]=$var;//так как нет шаблона,просто присваиваем
                    }
                }catch (\Exception $e){
                  echo $e->getMessage();
                  }

              }
              else if(!$param['required']){//если параметр не вписан но он не обязательный
                try{
                  if(isset($param['default'])){
                    $request[$param['name']]=$param['default'];//если есть дефолтное значение 
                  }
                  else throw new \Exception('REQUEST_INCOMPLETE');
                }catch (\Exception $e){
                  echo $e->getMessage();}
              }
              else throw new \Exception('REQUEST_INCOMPLETE');

            }  catch (\Exception $e){
                echo $e->getMessage();}
        
        }
          if (method_exists($this->model, $path[1] . $path[2])) {
            $method = [$this->model, $path[1] . $path[2]];
            $result = $method($request);
          }

        }

      }
    }

    return $result;
  }
  public function __construct() {
    // CORS configuration
    $origin = $this -> getVar('HTTP_ORIGIN', 'e');
    $front = $this->getVar('FRONT','e');
    foreach ( ['rooms.pnit.od.ua'] as $allowed )
      if ( $origin == "https://$allowed") {
        header( "Access-Control-Allow-Origin: $origin" );
        header( 'Access-Control-Allow-Credentials: true' );
      }
    $this->model = new \Model\Main;
  }
}