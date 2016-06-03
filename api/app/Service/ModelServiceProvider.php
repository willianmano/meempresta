<?php

namespace Me\Service;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ModelServiceProvider implements ServiceProviderInterface
{
    protected $models = [
        'model.emprestimo' => \ME\Model\Emprestimo::class,
    ];

    public function register(Container $app)
    {
        foreach ($this->models as $label => $class) {
            $app[$label] = function ($app) use ($class) {
                return new $class($app['db']);
            };
        }
    }
}
