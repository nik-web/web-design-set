<?php

/**
 * Samples module with Laninas MVC framework
 *
 * @package    Semples\Controller\Factory  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Samples\Controller\Factory;

use Interop\Container\ContainerInterface;
use Samples\Form\FlashTestForm;
use Samples\Controller\FlashController;


/**
 * FlachControllerFactory
 * 
 * @package Samples\Controller\Factory
 */
class FlachControllerFactory
{
    /**
     * Create the FlachController
     *
     * @param  ContainerInterface $container
     * @return FlachController
     */
    public function __invoke(ContainerInterface $container)
    {
        $form = $container->get(FlashTestForm::class);        
        return new FlashController($form);
    }
}
