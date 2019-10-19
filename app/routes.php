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
};

