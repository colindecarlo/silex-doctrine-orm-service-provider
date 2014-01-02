<?php

namespace ColinDeCarlo\Silex\Provider;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

use Silex\Application;
use Silex\ServiceProviderInterface;

class DoctrineOrmServiceProvider implements ServiceProviderInterface
{
	public function register(Application $app)
	{
		$app['orm.options'] = [];

		$app['orm.conn'] = [];

		$app['orm.config'] = $app->share(function ($app) {
			$entityDirs = $app['orm.options']['entity_dirs'];
			return Setup::createAnnotationMetadataConfiguration($entityDirs, $app['debug']);
		});

		$app['orm.em'] = $app->share(function ($app) {
			return EntityManager::create($app['orm.conn'], $app['orm.config']);
		});
	}

	public function boot(Application $app)
	{
	}
}
