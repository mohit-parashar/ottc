<?php

namespace Drupal\openy_custom_url\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;

class OpenyCustomUrl extends ControllerBase {

    /**
     * Constructs a user migrate page.
     */
    public function custom_url() {
        echo '11';
    }

    public function abouterror() {
      
			$menu_name = 'main';
			$menu_tree = \Drupal::menuTree();
			$parameters = $menu_tree->getCurrentRouteMenuTreeParameters($menu_name);
			$parameters->setMinDepth(1);
			//Delete comments to have only enabled links
			//$parameters->onlyEnabledLinks();

			$tree = $menu_tree->load($menu_name, $parameters);
			$manipulators = array(
			  array('callable' => 'menu.default_tree_manipulators:checkAccess'),
			  array('callable' => 'menu.default_tree_manipulators:generateIndexAndSort'),
			);
			$tree = $menu_tree->transform($tree, $manipulators);
			$list = [];

			foreach ($tree as $item) {
			  $title = $item->link->getTitle();
			  $url = $item->link->getUrlObject();
			  $list[] = Link::fromTextAndUrl($title, $url);
			}

			$output['sections'] = array(
			'#theme' => 'item_list',
			'#items' => $list,
			);
			
			echo "<pre>";
			print_r($output);
			
			//return $output;
	  
	  
    }

}
