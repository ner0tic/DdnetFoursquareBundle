<?php

/*
 * Based on coding from the friendsofsymfony group
 */

namespace Ddnet\FoursquareBundle\Security\Logout;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;

class FoursquareHandler implements LogoutHandlerInterface {
  private $foursquare;

  public function __construct(Foursquare $foursquare) {
    $this->foursquare = $foursquare;
  }

  public function logout(Request $request, Response $response, TokenInterface $token) {
    $this->foursquare->destroySession();
  }
}