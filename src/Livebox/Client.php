<?php

/**
 * Client.php
 *
 * LICENCE
 *
 * L'ensemble de ce code relève de la législation française et internationale
 * sur le droit d'auteur et la propriété intellectuelle. Tous les droits de
 * reproduction sont réservés, y compris pour les documents téléchargeables et
 * les représentations iconographiques et photographiques. La reproduction de
 * tout ou partie de ce code sur quelque support que ce soit est formellement
 * interdite sauf autorisation écrite émanant de la société DIGITALEO.
 *
 * @author    Digitaleo 2019 <dev@digitaleo.com>
 * @copyright Copyright (c) 2009-2019 Digitaleo SAS
 * @license   https://www.digitaleo.net/licence.txt Digitaleo Licence
 * @link      https://www.digitaleo.net
 */

namespace App\Livebox;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Log\LoggerInterface;

/**
 * Class Client
 *
 * @package App\Livebox
 */
class Client
{
    const BASE_URL = 'http://%s:%s/remoteControl/cmd';

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var array
     */
    private $settings;

    /**
     * @var boolean
     */
    private $debug;

    /**
     * Client constructor.
     *
     * @param LoggerInterface $logger
     * @param array           $settings
     * @param                 $debug
     */
    public function __construct(LoggerInterface $logger, array $settings, $debug)
    {
        $this->logger   = $logger;
        $this->settings = $settings;
        $this->debug    = $debug;
        $this->client   = $this->initClient();
    }

    /**
     * @param $channel
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws Exceptions\InvalidChannelException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function channel(string $channel)
    {
        $params = [
            'operation' => API::OPERATION['CHANNEL'],
            'epg_id'    => API::getChannelCode($channel),
            'uui'       => 1,
        ];

        return $this->exec($params);
    }

    /**
     * @param $command
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function tv(string $command)
    {
        $params = [
            'operation' => API::OPERATION['TV'],
            'key'       => $command,
            'mode'      => 0,
        ];

        return $this->exec($params);
    }

    /**
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function status()
    {
        $params = [
            'operation' => API::OPERATION['STATUS'],
        ];

        return $this->exec($params);
    }

    /**
     * Init Guzzle HTTP Client to query livebox
     *
     * @return \GuzzleHttp\Client
     */
    private function initClient()
    {
        $stack = HandlerStack::create();

        if ($this->debug) {
            $stack->push(
                Middleware::log(
                    $this->logger,
                    new MessageFormatter('{req_body} - {res_body}')
                )
            );
        }

        return new \GuzzleHttp\Client([
            'handler' => $stack,
        ]);
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function exec(array $params)
    {
        $url = sprintf(self::BASE_URL, $this->settings['ip'], $this->settings['port']);

        $response =  $this->client->request('GET', $url, [
            'query' => $params,
        ]);

        return json_decode($response->getBody()->getContents())->result;
    }
}
