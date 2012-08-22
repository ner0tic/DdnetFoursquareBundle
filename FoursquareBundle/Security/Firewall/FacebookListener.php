<?php

/*
 * Based on coding from the friendsofsymfony group
 */

namespace Ddnet\FoursquareBundle\Security\Firewall;

use Ddnet\FoursquareBundle\Security\Authentication\Token\FoursquareUserToken;
use Symfony\Component\Security\Http\Firewall\AbstractAuthenticationListener;
use Symfony\Component\HttpFoundation\Request;

/**
 * Foursquare authentication listener.
 */
class FoursquareListener extends AbstractAuthenticationListener {
  protected function attemptAuthentication(Request $request) {
    return $this->authenticationManager->authenticate(new FoursquareUserToken($this->providerKey));
  }
}