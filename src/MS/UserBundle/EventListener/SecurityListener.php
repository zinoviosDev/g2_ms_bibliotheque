<?php
namespace MS\UserBundle\EventListener;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SecurityListener {
    
    protected $router;
    protected $security;
    protected $dispatcher;
    
//     public function __construct(Router $router, SecurityContextInterface $security, EventDispatcher $dispatcher) {
//         $this->router = $router;
//         $this->security = $security;
//         $this->dispatcher = $dispatcher;
//     }
    
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event) {
        $this->dispatcher->addListener(KernelEvents::RESPONSE, array($this, 'onKernelResponse'));
    }
    
    public function onKernelResponse(FilterResponseEvent $event) {
        if ($this->security->isGranted('ROLE_TEAM')) {
            $response = new RedirectResponse($this->router->generate('team_homepage'));
        } elseif ($this->security->isGranted('ROLE_VENDOR')) {
            $response = new RedirectResponse($this->router->generate('vendor_homepage'));
        } else {
            $response = new RedirectResponse($this->router->generate('homepage'));
        }
        
        $event->setResponse($response);
    }
}

