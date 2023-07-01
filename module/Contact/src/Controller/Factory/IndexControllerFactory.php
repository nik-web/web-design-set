<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * Contact module with Laninas MVC framework
 *
 * @package    Contact\Controller\Factory
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Contact\Controller\Factory;

use Contact\Controller\IndexController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Contact\Form\ContactForm;
use Contact\Service\MailSenderInterface;

/**
 * Index controller factory
 * 
 * @package Contact\Controller\Factory
 */
class IndexControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        ?array $options = null
    ) {
        $contactForm = $container->get(ContactForm::class);
        $mailSender = $container->get(MailSenderInterface::class);
        
        return new IndexController($contactForm, $mailSender);
    }
}
