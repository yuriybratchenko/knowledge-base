<div class="site-header-wrap">
	<div class="site-header-container">
		<div class="site-main-navigation"><?php
			if ( class_exists( '\\Croco_Site_Menu\\Menu' ) ) {
				\Croco_Site_Menu\Menu::instance()->mobile_menu_render();
			}
		?></div>
		<div class="site-branding"><?php
			the_custom_logo();
		?></div>
	</div>
</div>