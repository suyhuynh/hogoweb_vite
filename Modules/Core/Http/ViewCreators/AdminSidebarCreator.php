<?php

namespace Modules\Core\Http\ViewCreators;

use Illuminate\View\View;
use Modules\Core\Sidebar\AdminSidebar;
use Maatwebsite\Sidebar\Presentation\SidebarRenderer;

class AdminSidebarCreator
{
    /**
     * @var \Modules\Admin\Sidebar\AdminSidebar
     */
    protected $sidebar;

    /**
     * @var \Maatwebsite\Sidebar\Presentation\SidebarRenderer
     */
    protected $renderer;

    /**
     * @param \Modules\Admin\Sidebar\AdminSidebar $sidebar
     * @param \Maatwebsite\Sidebar\Presentation\SidebarRenderer $renderer
     */
    public function __construct(AdminSidebar $sidebar, SidebarRenderer $renderer)
    {
        $this->sidebar = $sidebar;
        $this->renderer = $renderer;
    }

    public function create(View $view)
    {
        $view->sidebar = $this->renderer->render($this->sidebar);
    }
}
