<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * Contact module with Laninas MVC framework
 *
 * @package     Contact\Service\Factory
 * @author      Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version     1.0.0
 * @since       1.0.0
 */

declare(strict_types=1);

namespace Contact\Service\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Mail\Message;
use Laminas\Mail\Transport\Sendmail;
use Application\ValueObject\Provider;
use Contact\Service\MailSender;

/**
 * Mail sender service factory
 *
 * @package    Contact
 * @subpackage Contact\Service
 */
class MailSenderFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * 
     * @return Contact\Service\MailSender
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $message = $container->get(Message::class);
        $message->addTo(Provider::CONTACT_EMAIL)->setEncoding("UTF-8");        
        $transport = $container->get(Sendmail::class);
        
        return new MailSender($message, $transport);
    }
}
