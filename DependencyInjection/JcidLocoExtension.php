<?php

namespace Jcid\Bundle\LocoBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class JcidLocoExtension extends Extension
{
	/**
	 * Handles the knp_menu configuration.
	 *
	 * @param array $configs The configurations being loaded
	 * @param ContainerBuilder $container
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$configuration = $this->getConfiguration($configs, $container);
		$config = $this->processConfiguration($configuration, $configs);

		foreach ($config as $key => $value) {
			$container->setParameter("jcid_loco.configuration.".$key, $value);
		}

		$loader = new XmlFileLoader($container, new FileLocator(__DIR__."/../Resources/config"));
		$loader->load("services.xml");
	}
}
