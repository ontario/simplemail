<?php
/**
 * Created by PhpStorm.
 * User: yukhimenko
 * Date: 01.09.14
 * Time: 13:39
 */

namespace Application\Service;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mime\Part as MimePart;
use Zend\Mime\Message as MimeMessage;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class MailService implements  FactoryInterface {
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->sm = $serviceLocator;
        return $this;
    }

    public function send($options = null) {
        $config = $this->sm->get('Config');
        if ($options && isset($config['mail_setting'])) {

            foreach ($options as $key => $value) {
                $this->$key = $value;
            }

            $message = new Message();
            $message->addTo($this->to)
                    ->addFrom($this->from)
                    ->setSubject($this->subject);

            $transport = new SmtpTransport();
            $op = new SmtpOptions($config['mail_setting']);

            $header = new MimePart('<b>Test message.</b>');
            $header->type = 'text/html';

            $mess = new MimePart($this->message);
            $mess->type = 'text/html';

            $body = new MimeMessage();
            $body->addPart($header);
            $body->addPart($mess);

            $message->setBody($body);
            $transport->setOptions($op);
            $transport->send($message);
        }else{
            throw new \RuntimeException('Config for MailService is absent, need try to create local.php file and fill corresponding fields');
        }
    }
} 