<?php
/**
 * User: Ingvar
 * Date: 30.04.2016
 */
namespace Iaasen\Navigation;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\View\Helper\Navigation\Menu;

class SubMenuFactory implements FactoryInterface
{
	/**
	 * @param string $requestedName
	 * @return Menu
	 */
	public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
	{
		$menu = new Menu();
		$menu->setUlClass('nav nav-pills nav-stacked');
		$menu->setOnlyActiveBranch(true);
		$menu->setRenderParents(false);
		$menu->setMinDepth(1);
		$menu->setMaxDepth(2);
		return $menu;
	}
}
