<?php

namespace EnglishCalculator\Controller;

use EnglishCalculator\Service\CalculatorServiceInterface;
use EnglishCalculator\Service\ConverterServiceInterface;
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

    /**
     * @var ConverterServiceInterface
     */
    protected $converterService;

    public function __construct(CalculatorServiceInterface $calculatorService, ConverterServiceInterface $converterService)
    {
        $this->calculatorService = $calculatorService;
        $this->converterService = $converterService;
    }

    public function indexAction()
    {
        $view = new ViewModel([
            'result' => $this->converterService->convertWordToNumber('twenty five')
        ]);
        $view->setTemplate('pages/index');
        return $view;
    }

    public function sumAction()
    {
        $view = new ViewModel([
            'result' => $this->converterService->convertNumberToWord(
                $this->calculatorService->sum(
                    $this->converterService->convertWordToNumber('forty seven'),
                    $this->converterService->convertWordToNumber('fifty three')
                )
            )
        ]);
        $view->setTemplate('pages/sum');
        return $view;
    }
}