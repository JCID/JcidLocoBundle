<?php

namespace Jcid\Bundle\LocoBundle\Loco;

use Guzzle\Http\Client;

class Downloader
{
	private $locales;
	private $domains;
	private $target;
	private $client;

	public function __construct($locales, $domains, $target, $key)
	{
		$this->locales	= $locales;
		$this->domains	= $domains;
		$this->target	= $target;

		$this->client	= new Client("https://localise.biz/api/");
		$this->client->setDefaultOption("query/key", $key);
	}

	public function download()
	{
		foreach ($this->locales as $localeKey => $localeValue) {
			foreach ($this->domains as $domain) {
				$response	= $this->client->get(sprintf("export/locale/%s.phps?format=symfony&index=id&filter=%s", $localeValue, $domain), array(), array(
					"save_to"		=> sprintf("%s/%s.%s.phps", $this->target, $domain, $localeKey),
				))->send();
			}
		}
	}
}
