<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Form\MailForm;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $form = new MailForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $flash = $this->flashMessenger();
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $d = $form->getData();
                /**
                 * @var \Application\Service\MailService $i
                 */
                $i = $this->getServiceLocator()->get('Application\Service\MailService');
                try {
                    $i->send($d);
                    $flash->addSuccessMessage('Send success');
                } catch (\RuntimeException $e) {
                    $flash->addErrorMessage($e->getMessage());
                }
            } else {
                $flash->addErrorMessage($form->getMessages());
            }
        }
        return array('form' => $form);
    }
}
