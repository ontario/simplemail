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

        $sender     = $request->getParam('sender');
        $recipients = $request->getParam('recipients');
        $subject    = $request->getParam('subject');
        $message    = $request->getParam('message');

        $mailService = $this->getServiceLocator()->get('Application\Service\MailService');
        $recipients = explode(',',$recipients);
        foreach ($recipients as $r) {
            try {
                $mailService->send(array(
                    'from'    => $sender,
                    'to'      => $r,
                    'subject' => $subject,
                    'message' => $message
                ));
                echo "Successfully sent\n";
            } catch (\RuntimeException $e) {
                echo $e->getMessage();
            }
        }
    }

}
