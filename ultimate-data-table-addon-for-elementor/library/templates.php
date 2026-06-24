<?php
/**
 * Template library templates
 */

defined( 'ABSPATH' ) || exit;

?>
<script type="text/template" id="tmpl-udtaTemplateLibrary__header-logo">
    <span class="udtaTemplateLibrary__logo-wrap">
		<img src="<?php echo esc_url( ULTIMATE_DATA_TABLE_DIR_URL . 'assets/img/udta-icon.png' ) ?>" alt="udta">
	</span>
    <span class="udtaTemplateLibrary__logo-title">{{{ title }}}</span>
</script>

<script type="text/template" id="tmpl-udtaTemplateLibrary__header-back">
    <i class="eicon-" aria-hidden="true"></i>
    <span><?php echo __( 'Back to Library', 'ultimate-data-table-addon-for-elementor' ); ?></span>
</script>

<script type="text/template" id="tmpl-udtaTemplateLibrary__header-menu">
    <# _.each( tabs, function( args, tab ) { var activeClass = args.active ? 'elementor-active' : ''; #>
    <div class="elementor-component-tab elementor-template-library-menu-item {{activeClass}}" data-tab="{{{ tab }}}">{{{ args.title }}}</div>
    <# } ); #>
</script>

<script type="text/template" id="tmpl-udtaTemplateLibrary__header-actions">
    <div id="udtaTemplateLibrary__header-sync" class="elementor-templates-modal__header__item">
        <i class="eicon-sync" aria-hidden="true" title="<?php esc_attr_e( 'Sync Library', 'ultimate-data-table-addon-for-elementor' ); ?>"></i>
        <span class="elementor-screen-only"><?php esc_html_e( 'Sync Library', 'ultimate-data-table-addon-for-elementor' ); ?></span>
    </div>
</script>

<script type="text/template" id="tmpl-udtaTemplateLibrary__preview">
    <img class="udtaTemplateLibrary__preview-img" src="{{{ previewUrl }}}">
</script>

<script type="text/template" id="tmpl-udtaTemplateLibrary__header-insert">
    <div id="elementor-template-library-header-preview-insert-wrapper" class="elementor-templates-modal__header__item">
        {{{ udta.library.getModal().getTemplateActionButton( obj ) }}}
    </div>
</script>

<script type="text/template" id="tmpl-udtaTemplateLibrary__insert-button">
    <a class="elementor-template-library-template-action elementor-button udtaTemplateLibrary__insert-button">
        <i class="eicon-file-download" aria-hidden="true"></i>
        <span class="elementor-button-title"><?php esc_html_e( 'Insert', 'ultimate-data-table-addon-for-elementor' ); ?></span>
    </a>
</script>

<script type="text/template" id="tmpl-udtaTemplateLibrary__pro-button">
    <a class="elementor-template-library-template-action elementor-button udtaTemplateLibrary__pro-button" href="https://plugins.rstheme.com/ultimate-data-table#pricing" target="_blank">
        <i class="eicon-external-link-square" aria-hidden="true"></i>
        <span class="elementor-button-title"><?php esc_html_e( 'Get Pro', 'ultimate-data-table-addon-for-elementor' ); ?></span>
    </a>
</script>

<script type="text/template" id="tmpl-udtaTemplateLibrary__loading">
    <div class="elementor-loader-wrapper">
        <div class="elementor-loader">
            <div class="elementor-loader-boxes">
                <div class="elementor-loader-box"></div>
                <div class="elementor-loader-box"></div>
                <div class="elementor-loader-box"></div>
                <div class="elementor-loader-box"></div>
            </div>
        </div>
        <div class="elementor-loading-title"><?php esc_html_e( 'Loading', 'ultimate-data-table-addon-for-elementor' ); ?></div>
    </div>
</script>

<script type="text/template" id="tmpl-udtaTemplateLibrary__templates">
    <div id="udtaTemplateLibrary__toolbar">
        <div id="udtaTemplateLibrary__toolbar-filter" class="udtaTemplateLibrary__toolbar-filter">
            <# if (udta.library.getTypeTags()) { var selectedTag = udta.library.getFilter( 'tags' ); #>
            <# if ( selectedTag ) { #>
            <span class="udtaTemplateLibrary__filter-btn">{{{ udta.library.getTags()[selectedTag] }}} <i class="eicon-caret-right"></i></span>
            <# } else { #>
            <span class="udtaTemplateLibrary__filter-btn"><?php esc_html_e( 'Filter', 'ultimate-data-table-addon-for-elementor' ); ?> <i class="eicon-caret-right"></i></span>
            <# } #>
            <ul id="udtaTemplateLibrary__filter-tags" class="udtaTemplateLibrary__filter-tags">
                <li data-tag="">All</li>
                <# _.each(udta.library.getTypeTags(), function(slug) {
                var selected = selectedTag === slug ? 'active' : '';
                #>
                <li data-tag="{{ slug }}" class="{{ selected }}">{{{ udta.library.getTags()[slug] }}}</li>
                <# } ); #>
            </ul>
            <# } #>
        </div>
        <div id="udtaTemplateLibrary__toolbar-counter"></div>
        <div id="udtaTemplateLibrary__toolbar-search">
            <label for="udtaTemplateLibrary__search" class="elementor-screen-only"><?php esc_html_e( 'Search Templates:', 'ultimate-data-table-addon-for-elementor' ); ?></label>
            <input id="udtaTemplateLibrary__search" placeholder="<?php esc_attr_e( 'Search', 'ultimate-data-table-addon-for-elementor' ); ?>">
            <i class="eicon-search"></i>
        </div>
    </div>

    <div class="udtaTemplateLibrary__templates-window">
        <div id="udtaTemplateLibrary__templates-list"></div>
    </div>
</script>

<script type="text/template" id="tmpl-udtaTemplateLibrary__template">
    <div class="udtaTemplateLibrary__template-body" id="udtaTemplate-{{ id }}">
        <div class="udtaTemplateLibrary__template-preview">
            <i class="eicon-zoom-in-bold" aria-hidden="true"></i>
        </div>
        <img class="udtaTemplateLibrary__template-thumbnail" src="{{ thumbnail }}">
        <# if ( obj.isPro ) { #>
        <span class="udtaTemplateLibrary__template-badge"><?php esc_html_e( 'Pro', 'ultimate-data-table-addon-for-elementor' ); ?></span>
        <# } #>
    </div>
    <div class="udtaTemplateLibrary__template-footer">
        {{{ udta.library.getModal().getTemplateActionButton( obj ) }}}
        <a href="#" class="elementor-button udtaTemplateLibrary__preview-button">
            <i class="eicon-device-desktop" aria-hidden="true"></i>
			<?php esc_html_e( 'Preview', 'ultimate-data-table-addon-for-elementor' ); ?>
        </a>
    </div>
</script>

<script type="text/template" id="tmpl-udtaTemplateLibrary__empty">
    <div class="elementor-template-library-blank-icon">
        <img src="<?php echo ELEMENTOR_ASSETS_URL . 'images/no-search-results.svg'; ?>" class="elementor-template-library-no-results"/>
    </div>
    <div class="elementor-template-library-blank-title"></div>
    <div class="elementor-template-library-blank-message"></div>
    <div class="elementor-template-library-blank-footer">
		<?php esc_html_e( 'Want to learn more about the Ultimate Data Table Library?', 'ultimate-data-table-addon-for-elementor' ); ?>
        <a class="elementor-template-library-blank-footer-link" href="https://plugins.rstheme.com/ultimate-data-table/" target="_blank"><?php echo __( 'Click here', 'ultimate-data-table-addon-for-elementor' ); ?></a>
    </div>
</script>
