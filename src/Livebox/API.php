<?php

/**
 * API.php
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

use App\Livebox\Exceptions\InvalidChannelException;

/**
 * Class API
 *
 * @package App\Livebox
 */
class API
{
    const OPERATION = [
        'TV'      => '01',
        'CHANNEL' => '09',
        'STATUS'  => '10',
    ];

    const TV_KEY_COMMAND = [
        'ON'    => 116,
        'OFF'   => 116,
        'CH+'   => 402,
        'CH-'   => 403,
        'VOL+'  => 115,
        'VOL-'  => 114,
        'MUTE'  => 113,
        'UP'    => 103,
        'DOWN'  => 108,
        'LEFT'  => 105,
        'RIGHT' => 106,
        'OK'    => 352,
        'BACK'  => 158,
        'MENU'  => 139,
        'PLAY'  => 164,
        'PAUSE' => 164,
        'FBWD'  => 168,
        'FFWD'  => 159,
        'REC'   => 167,
        'VOD'   => 393,
    ];

    const CHANNEL = [
        'TF1'            => '*******192',
        'FRANCE_2'       => '*********4',
        'FRANCE_3'       => '********80',
        'CANAL+'         => '********34',
        'FRANCE_5'       => '********47',
        'M6'             => '*******118',
        'ARTE'           => '*******111',
        'C8'             => '*******445',
        'W9'             => '*******119',
        'TMC'            => '*******195',
        'TFX'            => '*******446',
        'NRJ12'          => '*******444',
        'LCP'            => '*******234',
        'FRANCE_4'       => '********78',
        'BFM_TV'         => '*******481',
        'CNEWS'          => '*******226',
        'CSTAR'          => '*******458',
        'GULLI'          => '*******482',
        'FRANCE_0'       => '*******160',
        'TF1_SERIES'     => '******1404',
        'EQUIPE'         => '******1401',
        '6TER'           => '******1403',
        'NUMERO_23'      => '******1402',
        'RMC_DECOUVERTE' => '******1400',
        'CHERIE_25'      => '******1399',
        'LCI'            => '*******112',
        'FRANCE_INFO'    => '******2111',
    ];

    const CHANNEL_MAPPING = [
        1  => 'TF1',
        2  => 'FRANCE_2',
        3  => 'FRANCE_3',
        4  => 'CANAL+',
        5  => 'FRANCE_5',
        6  => 'M6',
        7  => 'ARTE',
        8  => 'C8',
        9  => 'W9',
        10 => 'TMC',
        11 => 'TFX',
        12 => 'NRJ12',
        13 => 'LCP',
        14 => 'FRANCE_4',
        15 => 'BFM_TV',
        16 => 'CNEWS',
        17 => 'CSTAR',
        18 => 'GULLI',
        19 => 'FRANCE_0',
        20 => 'TF1_SERIES',
        21 => 'EQUIPE',
        22 => '6TER',
        23 => 'NUMERO_23',
        24 => 'RMC_DECOUVERTE',
        25 => 'CHERIE_25',
        26 => 'LCI',
        27 => 'FRANCE_INFO',
    ];

    /**
     * @param string $name Channel name
     *
     * @return mixed
     * @throws InvalidChannelException
     */
    public static function getChannelCode(string $name)
    {
        if (!self::hasChannel($name)) {
            throw new InvalidChannelException($name);
        }

        return self::CHANNEL[$name];
    }

    /**
     * @param string $channel
     *
     * @return bool
     */
    public static function hasChannel(string $channel)
    {
        return isset(self::CHANNEL[$channel]);
    }

    /**
     * @param $channel
     *
     * @return mixed
     */
    public static function getChannelName($channel)
    {
        return self::CHANNEL_MAPPING[intval($channel)];
    }
}
