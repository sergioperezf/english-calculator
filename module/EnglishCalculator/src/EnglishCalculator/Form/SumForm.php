<?php

namespace EnglishCalculator\Form;
use Zend\Form\Form;

/**
 * Class SumForm
 * @package EnglishCalculator\Form
 */
class SumForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('sum');

        $this->add([
            'name' => 'x',
            'type' => 'Text',
            'options' => [
                'label' => 'First Number'
            ]
        ]);

        $this->add([
            'name' => 'y',
            'type' => 'Text',
            'options' => [
                'label' => 'Second Number'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit'
        ]);
    }
}