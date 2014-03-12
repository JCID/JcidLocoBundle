<?php

namespace Jcid\Bundle\LocoBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class JcidLocoExtension extends Extension
{
	/**
	 * {@inheritDoc}
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$configuration = $this->getConfiguration($configs, $container);
		$config = $this->processConfiguration($configuration, $configs);

		$container->setParameter("jcid_loco.configurations", $config);

		$loader = new XmlFileLoader($container, new FileLocator(__DIR__."/../Resources/config"));
		$loader->load("services.xml");
	}
}
