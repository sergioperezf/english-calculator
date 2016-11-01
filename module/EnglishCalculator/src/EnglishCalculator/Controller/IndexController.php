<?php

namespace EnglishCalculator\Controller;

use EnglishCalculator\Exception\InvalidArgumentException;
use EnglishCalculator\Form\SumForm;
use EnglishCalculator\Service\CalculatorServiceInterface;
use EnglishCalculator\Service\ConverterServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
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

    /**
     * Home page.
     * @return ViewModel
     */
    public function indexAction()
    {
        $form = new SumForm();
        $view = new ViewModel([
            'form' => $form
        ]);
        $view->setTemplate('pages/index');
        return $view;
    }

    /**
     * Form handler
     *
     * @return ViewModel
     * @throws \Exception
     */
    public function sumAction()
    {
        $form = new SumForm();
        $request = $this->getRequest();
        $form->setData($request->getPost());
        if ($form->isValid()) {
            try {
                $data = $form->getData();
                $x = $this->converterService->convertWordToNumber($data['x']);
                $y = $this->converterService->convertWordToNumber($data['y']);
                $result = $this->calculatorService->sum($x, $y);
            } catch (InvalidArgumentException $e) {
                $result = 0;
            }

            $view = new JsonModel([
                'result' => $this->converterService->convertNumberToWord($result)
            ]);
            $view->setTemplate('pages/sum');
            return $view;
        } else {
            throw new \Exception('Invalid form.');
        }
    }
}