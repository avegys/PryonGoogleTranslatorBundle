<?php

namespace Pryon\GoogleTranslatorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('pryon_google_translator');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('google_api_key')->isRequired()->end()
                ->arrayNode('cache')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('service')->defaultValue('pryon.google.translator.array_cache_provider')->end()
                        ->arrayNode('calls')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->booleanNode('translate')->defaultFalse()->end()
                                ->booleanNode('languages')->defaultTrue()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('client_options')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('headers')
                        ->info("Default headers for REST client")
                        ->prototype("scalar")
                        ->end()
                    ->end()
                ->end()
            ->end()
            ;

        return $treeBuilder;
    }
}
