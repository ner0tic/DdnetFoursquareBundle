<?php

/*
 * Based on coding from the friendsofsymfony group
 */

namespace Ddnet\FoursquareBundle\Security\EntryPoint;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class FoursquareAuthenticationEntryPoint implements AuthenticationEntryPointInterface {
  protected $foursquare;
  protected $options;
  protected $permissions;

  /**
    * Constructor
    *
    * @param BaseFoursquare $foursquare
    * @param array    $options
    */
  public function __construct(Foursquare $foursquare, array $options = array(), array $permissions = array()) {
    $this->foursquare = $foursquare;
    $this->permissions = $permissions;
    $this->options = new ParameterBag($options);
  }

  /**
    * {@inheritdoc}
    */
  public function start(Request $request, AuthenticationException $authException = null) {
    $redirect_uri = $request->getUriForPath($this->options->get('check_path', ''));
    if ($this->options->get('server_url') && $this->options->get('app_url'))
      $redirect_uri = str_replace($this->options->get('server_url'), $this->options->get('app_url'), $redirect_uri);

    $loginUrl = $this->foursquare->getLoginUrl(
      array(
        'display' => $this->options->get('display', 'page'),
        'scope' => implode(',', $this->permissions),
        'redirect_uri' => $redirect_uri,
    ));

    if ($this->options->get('server_url') && $this->options->get('app_url')) {
      return new Response('<html><head></head><body><script>top.location.href="'.$loginUrl.'";</script></body></html>');
    }

    return new RedirectResponse($loginUrl);
  }
}