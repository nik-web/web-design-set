<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    Samples\Controller\Factory
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Samples\Controller\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Samples\Form\FlashTestForm;
use Samples\Controller\FlashController;

/**
 * FlashControllerFactory class
 * 
 * @package Samples\Controller\Factory
 */
class FlashControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        ?array $options = null
    ) {
        $form = $container->get(FlashTestForm::class);        
        return new FlashController($form);
    }
}
