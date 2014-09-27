<?php
/**
 * Simple Doctrine ORM Provider for Silex.
 *
 */

namespace Raztud\Provider;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

use \Silex\Application;
use \Silex\ServiceProviderInterface;

/**
 * Simple Doctrine ORM Provider
 *
 * @author Razvan Tudorica
 */
class DoctrineORMServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {        
        $app['db.doctrine.em'] = $app->share(function (Application $app) {
            $connectionParams = isset($app['db.connection']) ? $app['db.connection'] : array();
            $isDevMode = isset($app['db.is_dev_mode']) ? $app['db.is_dev_mode'] : true;
            $paths = isset($app['db.orm.entities_paths']) ? $app['db.orm.entities_paths'] : '';

            $config = Setup::createConfiguration($isDevMode);
            $driver = new AnnotationDriver(new AnnotationReader(), $paths);
            AnnotationRegistry::registerLoader('class_exists');
            $config->setMetadataDriverImpl($driver);

            $em = EntityManager::create($connectionParams, $config);

            return $em;
        });
    }

    public function boot(Application $app) { }

    
}
