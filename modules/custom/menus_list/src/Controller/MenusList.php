<?php

namespace Drupal\menus_list\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;

class MenusList extends ControllerBase {

 
    /**
     * Constructs a user migrate page.
     */
    public function menu_url_list($menusname,$depths=0) {
        
        $menusname = $menusname ? $menusname : "main";
        $depths = $depths ? $depths : 0; 
        $urls = "http://localhost/otc/api/menu_items/".$menusname."?_format=json&min_depth=".$depths;  
       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urls);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $my_var = curl_exec($ch);

        if (curl_exec($ch) === false) {
            //echo "ok";
        } else {
            // echo 'error:' . curl_error($ch);
        }
        
        curl_close($ch);
        echo $my_var;
        die();
        
       // echo file_get_contents($urls);
    }

}
