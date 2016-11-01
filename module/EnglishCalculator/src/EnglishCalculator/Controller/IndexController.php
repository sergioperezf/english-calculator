<?php

namespace EnglishCalculator\Controller;

use EnglishCalculator\Service\CalculatorServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package EnglishCalculator\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * @var CalculatorServiceInterface
     */
    protected $calculatorService;

    public function __construct(CalculatorServiceInterface $calculatorService)
    {
        $this->calculatorService = $calculatorService;
    }

    public function indexAction()
    {
        $view = new ViewModel([
            'result' => $this->calculatorService->sum(3, 8)
        ]);
        $view->setTemplate('pages/index');
        return $view;
    }
}