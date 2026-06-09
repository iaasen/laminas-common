<?php
/**
 * User: Ingvar
 * Date: 30.04.2016
 */
namespace Iaasen\Navigation;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\View\Helper\Navigation\Menu;

class MainMenuFactory implements FactoryInterface
{
	/**
	 * @param  string $requestedName
	 * @return Menu
	 */
	public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
	{
		$menu = new Menu();
		$menu->setUlClass('nav navbar-nav');
		$menu->setMaxDepth(0);
		return $menu;
	}
}
