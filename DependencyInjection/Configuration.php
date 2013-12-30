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

			// Verwerken opgegeven config
			->beforeNormalization()

				// Mogelijk maken om waardes op hoogste niveau op te geven als dit wenselijk is
				->ifTrue(function ($v) {	return is_array($v) && (array_key_exists("locales", $v) || array_key_exists("key", $v)); })
				->then(function ($v) {		 

					// Converten naar sub niveau waar nodig
					if (array_key_exists("locales", $v)) {
						$v = array("default" => $v);
					}

					// Als key op top nivue zit verplaatsen naar sub niveau
					if (array_key_exists("key", $v)) {
						$key = $v["key"];
						unset($v["key"]);

						// Key op array niveau plaatsen
						foreach ($v as $code => $config) {
							$v[$code]["key"] = $key;
						}
					}

					return $v;
				})
			->end()

			// Minimaal een element nodig
			->requiresAtLeastOneElement()
			->useAttributeAsKey("name")
			->prototype("array")
				->addDefaultsIfNotSet()
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

					// Extra params
					->scalarNode("key")				->isRequired()->end()
					->scalarNode("target")			->defaultValue("%kernel.root_dir%/Resources/translations")->end()
					->scalarNode("extension")		->defaultValue("phps")->end()
					->scalarNode("format")			->defaultValue("symfony")->end()
					->scalarNode("index")			->defaultValue("id")->end()

				->end()
			->end()
		->end();

		return $treeBuilder;
	}
}
