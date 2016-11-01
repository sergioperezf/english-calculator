<?php

namespace EnglishCalculator\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package EnglishCalculator\Controller
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $view = new ViewModel([]);
        $view->setTemplate('pages/index');
        return $view;
    }
}