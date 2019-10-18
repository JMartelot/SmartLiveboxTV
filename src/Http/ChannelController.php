<?php

/**
 * ChannelController.php
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

use App\Livebox\API;
use App\Livebox\Exceptions\InvalidChannelException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class ChannelController
 *
 * @package App\Http
 */
class ChannelController extends BaseController
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return Response
     */
    public function switchByChannel(Request $request, Response $response, $args)
    {
        $response->withHeader('Content-Type', 'application/json');

        try {
            $this->client->channel(API::getChannelName($args['channel']));
        } catch (GuzzleException $e) {
            return $response->withStatus(500, 'Error, querying livebox');
        } catch (InvalidChannelException $e) {
            return $response->withStatus(404, 'Channel not found');
        }

        return $response->withStatus(204);
    }
    /**
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return Response
     */
    public function switchByName(Request $request, Response $response, $args)
    {
        $response->withHeader('Content-Type', 'application/json');

        try {
            $this->client->channel($args['name']);
        } catch (GuzzleException $e) {
            return $response->withStatus(500, 'Error, querying livebox');
        } catch (InvalidChannelException $e) {
            return $response->withStatus(404, 'Channel not found');
        }

        return $response->withStatus(204);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return Response
     */
    public function previous(Request $request, Response $response, $args)
    {
        $response->withHeader('Content-Type', 'application/json');

        try {
            $this->client->tv(API::TV_KEY_COMMAND['CH-']);
        } catch (GuzzleException $e) {
            return $response->withStatus(500, 'Error, querying livebox');
        }

        return $response->withStatus(204);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return Response
     */
    public function next(Request $request, Response $response, $args)
    {
        $response->withHeader('Content-Type', 'application/json');

        try {
            $this->client->tv(API::TV_KEY_COMMAND['CH+']);
        } catch (GuzzleException $e) {
            return $response->withStatus(500, 'Error, querying livebox');
        }

        return $response->withStatus(204);
    }
}
