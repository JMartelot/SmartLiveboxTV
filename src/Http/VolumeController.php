<?php

/**
 * VolumeController.php
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
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class VolumeController
 *
 * @package App\Http
 */
class VolumeController extends BaseController
{

    public function up(Request $request, Response $response, $args)
    {
        $response->withHeader('Content-Type', 'application/json');

        try {
            $this->client->tv(API::TV_KEY_COMMAND['VOL+']);
        } catch (GuzzleException $e) {
            return $response->withStatus(500, 'Error, querying livebox');
        }

        return $response->withStatus(204);
    }

    public function down(Request $request, Response $response, $args)
    {
        $response->withHeader('Content-Type', 'application/json');

        try {
            $this->client->tv(API::TV_KEY_COMMAND['VOL-']);
        } catch (GuzzleException $e) {
            return $response->withStatus(500, 'Error, querying livebox');
        }

        return $response->withStatus(204);
    }

    public function mute(Request $request, Response $response, $args)
    {
        $response->withHeader('Content-Type', 'application/json');

        try {
            $this->client->tv(API::TV_KEY_COMMAND['MUTE']);
        } catch (GuzzleException $e) {
            return $response->withStatus(500, 'Error, querying livebox');
        }

        return $response->withStatus(204);
    }
}
