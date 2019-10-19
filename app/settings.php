<?php
declare(strict_types=1);

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $config = array_merge(
        require_once __DIR__ . '/config/livebox.php',
        require_once __DIR__ . '/config/logger.php',
        [
            'displayErrorDetails' => false,
        ]
    );

    $containerBuilder->addDefinitions([
        'config' => $config,
    ]);
};
