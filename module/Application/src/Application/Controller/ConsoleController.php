<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;

/**
 * Description of ConsoleController
 *
 * @author ddetyuk
 */
class ConsoleController extends AbstractActionController
{

    public function sendAction()
    {
        $request = $this->getRequest();

        if (!$request instanceof ConsoleRequest) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $recipient = $request->getParam('recipient');
        $subject   = $request->getParam('subject');
        $message   = $request->getParam('message');

        $mailService = $this->getServiceLocator()->get('Application\Service\MailService');
        try {
            $mailService->send(array(
                'to'      => $recipient,
                'subject' => $subject,
                'message' => $message
            ));
            echo "Successfully sent\n";
        } catch (\RuntimeException $e) {
            echo $e->getMessage();
        }
    }

}
