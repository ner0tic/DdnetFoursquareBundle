<?php

namespace Ddnet\FoursquareBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {
  /**
    * {@inheritDoc}
    */
  public function getConfigTreeBuilder() {
    $treeBuilder = new TreeBuilder();
    $rootNode = $treeBuilder->root('ddnet_foursquare')
                ->children()
                  ->variableNode('api_key')->defaultValue("XXX")->isRequired()->end()
                  ->variableNode('file')->defaultNull()->end()
                  ->variableNode('cookie')->defaultFalse()->end()
                  ->variableNode('domain')->defaultNull()->end()
                  ->variableNode('alias')->defaultNull()->end()
                  ->variableNode('logging')->defaultValue('%kernel.debug%')->end()
                  ->variableNode('culture')->defaultValue('en_US')->end()
                  ->arrayNode('class')
                    ->addDefaultsIfNotSet()
                    ->children()
                      ->variableNode('api')->defaultValue('FOS\FacebookBundle\Facebook\FacebookSessionPersistence')->end()
                      ->variableNode('helper')->defaultValue('FOS\FacebookBundle\Templating\Helper\FacebookHelper')->end()
                      ->variableNode('twig')->defaultValue('FOS\FacebookBundle\Twig\Extension\FacebookExtension')->end()
                    ->end()
                  ->end()
                  ->arrayNode('permissions')->prototype('scalar')->end()
                ->end();

    return $treeBuilder;
  }
}
