<?php

namespace Jcid\Bundle\LocoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DownloadCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
			->setName("translation:loco:download")
			->setDescription("Download laatste loco translation files");
	}

	/**
	 * {@inheritdoc}
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$this->getContainer()->get("jcid_loco.downloader")->download();
	}
}
