<?php
declare(strict_types=1);

use App\Http\ChannelController;
use App\Http\TVController;
use App\Http\VolumeController;

use Slim\App;

return function (App $app) {

    /**
     * Routing for ChannelController
     */
    $app->get('/channel/next', sprintf('%s:next', ChannelController::class));
    $app->get('/channel/previous', sprintf('%s:previous', ChannelController::class));
    $app->get('/channel/name/{name}', sprintf('%s:switchByName', ChannelController::class));
    $app->get('/channel/{channel}', sprintf('%s:switchByChannel', ChannelController::class));

    /**
     * Routing for TVController
     */
    $app->get('/on', sprintf('%s:on', TVController::class));
    $app->get('/off', sprintf('%s:off', TVController::class));

    /**
     * Routing for volume controller
     */
    $app->get('/volume/up', sprintf('%s:up', VolumeController::class));
    $app->get('/volume/down', sprintf('%s:down', VolumeController::class));
    $app->get('/volume/mute', sprintf('%s:mute', VolumeController::class));
    $app->get('/test/{input}', function ($request, $response, $args) {
        $channels = [
            'TF1',
            'FRANCE_23_1_108',
            'FRANCE_3',
            'CANAL_+',
            'FRANCE_5',
        ];

        $closest = -1;
        $closestWord = "";
//        $fmt = new \NumberFormatter( 'fr_FR', \NumberFormatter::SPELLOUT );

        foreach ($channels as $channel){

//            $result = preg_replace_callback("/(\d+)/", $channel, function($matches){
//
//                var_dump($matches[0]);
//            });


            $distance = levenshtein($args['input'], $channel);

            if($closest === -1 || $distance < $closest){
                $closest = $distance;
                $closestWord = $channel;
            }
        }
        var_dump($closestWord);;

        die;
    });
};

