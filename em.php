<?php

$db = [
	"driver" => "pdo_mysql",
	"host" => 'localhost',
	"user" => 'root',
	"password" => '',
	"dbname" => 'test',
	"driverOptions" => [
		\PDO::ATTR_EMULATE_PREPARES => false,
		\PDO::ATTR_STRINGIFY_FETCHES => false,
	]
];

$config = new Doctrine\ORM\Configuration;

$driveImpl = $config->newDefaultAnnotationDriver([
	__DIR__ . "/src/Entities"
]);

$config->setMetadataDriverImpl($driveImpl);

$cache = new Doctrine\Common\Cache\ArrayCache;
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

$config->setAutoGenerateProxyClasses(true);

$config->setProxyDir(__DIR__ . "/tmp");
$config->setProxyNamespace("Proxies");

return $em = Doctrine\ORM\EntityManager::create($db, $config);
