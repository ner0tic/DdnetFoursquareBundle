<?php

namespace Ddnet\FoursquareBundle\DependencyInjection;

use Symfony\Component\Config\Handler\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class DdnetFoursquareExtension extends Extension {
  protected $resources = array(
      'foursquare'  =>  'foursquare.yml',
      'security' => 'security.yml',
  );
  
  /**
    * {@inheritDoc}
    */
  public function load(array $configs, ContainerBuilder $container) {
    $processor = new Processor();
    $configuration = new Configuration();
    $config = $this->processConfiguration($configuration, $configs);

    $this->loadDefaults($container);
    
    if(isset($config['alias']))
      $container->setAlias($config['alias'], 'ddnet_foursquare.api');
    
    
    foreach(array('api', 'helper', 'twig') as $attr) 
      $container->setParameter('ddnet_foursquare.'.$attr.'.class', $config['class'][$attr]);
    
    foreach(array('app_id', 'cookie', 'domain', 'logging', 'culture', 'permissions') as $attr)
      $container->setParameter('ddnet_foursquare.'.$attr, $config[$attr]);
   
    
    
    $container->setParameter('foursquare.api_key', $config['api_key']);
    $container->setParameter('foursquare.user_id', $config['user_id']);
  }
  
  public function loadDefaults($container) {
    $loader = new YamlLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
    
    foreach($this->resources as $resource)
      $loader->load($resource);
  }
}
