<?php
use Scrawler\Scrawler;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Helper function to return instance of scrawler
 *
 * @return Object \Scrawler\Scrawler
 */
if (! function_exists('s')) {
    function s()
    {
        return Scrawler::engine();
    }
}

/**
 * Render template  from template engine
 *
 * @return String rendered body
 */
if (! function_exists('view')) {
    function view($file, $vars=[])
    {
        return Scrawler::engine()->template()->render($file, $vars);
    }
}

 /**
  *Generates url with bath
  */
  if (! function_exists('url')) {
      function url($path='')
      {
          return Scrawler::engine()->request()->getSchemeAndHttpHost().Scrawler::engine()->request()->getBasePath().$path;
      }
  }

  /**
   * Returns request object
   */
  if (! function_exists('request')) {
      function request()
      {
          return Scrawler::engine()->request();
      }
  }

  /**
   * Redirect user with flash data if given
   */
  if (! function_exists('redirect')) {
      function redirect($url,$data=[])
      {
          if(!empty($data)){
            Scrawler::engine()->session()->start();

              foreach($data as $key=>$value){
                Scrawler::engine()->session()->flash($key,$value);
              }
          }   
          return new RedirectResponse($url);
      }
  }

    /**
     * session read and write helper
     */
    if (! function_exists('session')) {
        function session($key,$value=NULL)
        {
            Scrawler::engine()->session()->start();
            if($value == NULL){
                return Scrawler::engine()->session()->$key;
            }else{
                Scrawler::engine()->session()->$key = $value;
            }
        }
    }

    /**
     * session read and write helper
     */
    if (! function_exists('flash')) {
        function flash($key,$value=NULL)
        {
            Scrawler::engine()->session()->start();
            if($value == NULL){
                return Scrawler::engine()->session()->flash($key);
            }else{
                Scrawler::engine()->session()->flash($key,$value);
            }
        }
    }

    /**
     * session read and write helper
     */
    if (! function_exists('flash_has')) {
        function session_has($key)
        {
            Scrawler::engine()->session()->start();
            return Scrawler::engine()->session()->isset($key);
        }
    }

    /**
     *  helper method to check csrf token
     */
    if (! function_exists('csrf')) {
        function csrf()
        {
            Scrawler::engine()->session()->start();
            if (hash_equals(Scrawler::engine()->session()->csrf_token, Scrawler::engine()->request()->csrf_token))
            return true;

            return false;
        }
    }


