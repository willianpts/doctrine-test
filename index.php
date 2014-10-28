<?php
@mkdir('tmp') && chmod('tmp', 0777);

$loader = require __DIR__ . "/vendor/autoload.php";
$loader->add('Entities', __DIR__ . '/src');

require 'em.php';

//first we select an Admin which is not the current Owner
$admin = $em->find('Entities\Organizations\Admin', 2);
$org = $em->find('Entities\Organization', 1);

if ($admin->notOwner()) {
	$org->transferOwnership($admin);	
	$em->flush();
}
