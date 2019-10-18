<?php

/**
 * BaseController.php
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

namespace App\Http;

use App\Livebox\Client;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * @package App\Http
 */
class BaseController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * BaseController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->client    = $container->get(Client::class);
        $this->logger    = $container->get(LoggerInterface::class);
    }

    /**
     * @param $id
     */
    protected function get($id)
    {
        $this->container->get($id);
    }
}
