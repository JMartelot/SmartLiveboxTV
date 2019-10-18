<?php

/**
 * LiveboxApiException.php
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

namespace App\Livebox\Exceptions;

use Throwable;

/**
 * Class LiveboxApiException
 *
 * @package App\Livebox\Exceptions
 */
class LiveboxApiException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
