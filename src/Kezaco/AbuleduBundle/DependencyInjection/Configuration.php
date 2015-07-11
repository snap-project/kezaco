<?php

namespace Kezaco\AbuleduBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kezaco_abuledu');

        $rootNode
            ->children()
                ->arrayNode('endpoint')
                    ->children()
                        ->scalarNode('source_id')->end()
                        ->scalarNode('search_url_pattern')->end()
                        ->scalarNode('resource_url_pattern')->end()
                        ->integerNode('refresh_rate')->defaultValue(60000)->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
