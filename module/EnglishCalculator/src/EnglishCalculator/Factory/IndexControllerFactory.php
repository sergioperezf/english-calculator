<?php

namespace EnglishCalculator\Factory;

use EnglishCalculator\Controller\IndexController;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class IndexControllerFactory
 * @package EnglishCalculator\Factory
 */
class IndexControllerFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $calculatorService = $container->get('EnglishCalculator.Service.Calculator');
        $converterService = $container->get('EnglishCalculator.Service.Converter');
        return new IndexController($calculatorService, $converterService);
    }
}