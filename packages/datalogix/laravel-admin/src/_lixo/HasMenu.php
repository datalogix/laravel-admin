<?php

namespace Datalogix\Admin\Traits;

use Datalogix\Admin\Content\Menu;
use Datalogix\Admin\Content\MenuItem;

trait HasMenu
{
    protected $menu;
    protected $navigation;

    public function setMenu(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function getMenu()
    {
        return $this->menu;
    }

    public function setNavigation(Menu $navigation)
    {
        $this->navigation = $navigation;
    }

    public function getNavigation()
    {
        return $this->navigation;
    }

    protected function createMenu()
    {
        $this->setMenu(Menu::make([
            MenuItem::make('Preferências')->icon('mdi-settings'),
            MenuItem::make('Sair')->icon('mdi-logout')->href(route('admin.logout')),
        ]));
    }

    protected function createNagivation()
    {
        $this->setNavigation(Menu::make([
            MenuItem::make('Dashboard')->icon('mdi-view-dashboard'),
        ]));
    }
}
