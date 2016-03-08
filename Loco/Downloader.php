<?php

namespace Jcid\Bundle\LocoBundle\Loco;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\Console\Output\OutputInterface;

class Downloader
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config    = $config;
        $this->client    = new Client(['base_uri' => 'https://localise.biz/api/']);
    }

    /**
     * Downloaden loco files.
     *
     * @param OutputInterface $output
     */
    public function download(OutputInterface $output = null)
    {
        // Doorlopen bestanden
        foreach ($this->config as $config) {
            foreach ($config['locales'] as $localeKey => $localeValue) {
                foreach ($config['domains'] as $domain) {
                    // Dir maken als deze niet bestaat
                    if (!is_dir($config['target'])) {
                        mkdir($config['target'], 0777, true);
                    }

                    // Basis query
                    $query = array(
                        'key'          => $config['key'],
                        'format'       => $config['format'],
                        'index'        => $config['index'],
                        'order'        => $config['order'],
                        'status'       => $config['status'],
                        'filter'       => $domain,
                    );

                    // Build url
                    $url         = sprintf('export/locale/%s.%s?%s', $localeValue, $config['extension'], http_build_query($query));
                    $savePath    = sprintf('%s/%s.%s.%s', $config['target'], $domain, $localeKey, $config['extension']);

                    // Downloaden
                    if ($output) {
                        $output->writeln('<info>[file+]</info> ' . $savePath);
                    }

                    $response = (string) $this->client->get($url)->getBody();

                    // Conversie
                    if ($config['extension'] === 'json') {
                        $response = json_encode(json_decode($response), JSON_PRETTY_PRINT) . "\r\n";
                    }

                    // Opslaan in map
                    file_put_contents($savePath, $response);
                }
            }
        }
    }
}
