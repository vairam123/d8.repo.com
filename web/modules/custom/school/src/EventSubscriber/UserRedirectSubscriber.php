<?php

namespace Drupal\school\EventSubscriber;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Drupal\school\Event\UserLoginEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Path\PathMatcherInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Class UserRedirectSubscriber.
 *
 * @package Drupal\school\EventSubscriber
 */
class UserRedirectSubscriber implements EventSubscriberInterface {

  /**
   * The path matcher.
   *
   * @var \Drupal\Core\Path\PathMatcherInterface
   */
  protected $pathMatcher;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $currentUser;

  /**
   * Constructs a new Redirect404Subscriber.
   *
   * @param \Drupal\Core\Path\PathMatcherInterface $path_matcher
   *   The path matcher service.
   * @param \Drupal\Core\Session\AccountInterface $current_user
   *   Current user.
   */
  public function __construct(PathMatcherInterface $path_matcher, AccountInterface $current_user)
  {
    $this->pathMatcher = $path_matcher;
    $this->currentUser = $current_user;
    //echo 'yes baby...';die();

  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['initData'];
    return $events;
  }

  /**
   * {@inheritdoc}
   */
  // public static function getSubscribedEvents() {
  //   return [
  //     // Static class constant => method on this class.
  //     UserLoginEvent::EVENT_NAME => 'onUserLogin',
  //   ];
  // }


  /**
   * Subscribe to the user login event dispatched.
   *
   * @param \Drupal\school\Event\UserLoginEvent $loginEvent
   *   Dat event object yo.
   */
  // public function onUserLogin(UserLoginEvent $loginEvent) {
  //  //kint();die();
  //   if($loginEvent->account->hasRole('student')) {
  //     //return new RedirectResponse('/add-student-info');
  //     //$event->setResponse(new RedirectResponse('/add-student-info'));
  //   }
  // }

 
  /**
   * Manage the redirect logic.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   *   Managed event.
   */
  public function initData(GetResponseEvent $event) {

    if($this->currentUser->getRoles() && in_array('student', $this->currentUser->getRoles())) {
      echo $current_uri = \Drupal::request()->getRequestUri().'<br>';
      //echo $current_path = \Drupal::service('path.current')->getPath();die();
      if (strpos($current_uri, '/web/user/') !== false) {
        //echo 'exit....';die(); 
        //$event->setResponse(new RedirectResponse('/web/add-student-info'));exit();
      } else {
        //echo 'super...';die();
      }
    }
  }

}