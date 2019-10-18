<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use App\Livebox\Client;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([

        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('config');

            $loggerSettings = $settings['logger'];
            $logger         = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },

        Client::class => function (ContainerInterface $container) {

            $logger = $container->get(LoggerInterface::class);
            $config = $container->get('config');

            /** @var array $config */
            return new Client($logger, $config['livebox']);
        },

    ]);
};
