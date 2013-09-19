<?php

namespace Jcid\Bundle\LocoBundle\DependencyInjection;

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
	 * {@inheritDoc}
	 */
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root("jcid_loco");

		$treeBuilder->root("jcid_loco")
			->children()

				// Config the locales to download
				->arrayNode("locales")
					->isRequired()
					->requiresAtLeastOneElement()
					->useAttributeAsKey("name")
					->prototype("scalar")->end()
				->end()

				// Config the locales to download
				->arrayNode("domains")
					->isRequired()
					->requiresAtLeastOneElement()
					->prototype("scalar")->end()
				->end()

				// Target dir
				->scalarNode("target")
					->defaultValue("%kernel.root_dir%/Resources/translations")
				->end()

				// API Key
				->scalarNode("key")
					->isRequired()
				->end()

			->end()
		->end();

		return $treeBuilder;
	}
}
