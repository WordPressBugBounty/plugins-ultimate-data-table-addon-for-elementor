;(function ($) {

    $(window).on('elementor/frontend/init', function () {
        const moduleHandler = elementorModules.frontend.handlers.Base;
        const isEditMode = elementorFrontend.isEditMode();

        const ultimateDataTable = moduleHandler.extend({
            bindEvents() {
                const $el = this.$element;
                const id = 'uni-' + $el.attr('data-id');
                const settings = this.getElementSettings();
                
                $.fn.dataTable.ext.errMode = 'none';

                var order = settings.enable_ordering === 'yes';
                var search = settings.show_search === 'yes';
                var searchLabel = (search && settings.search_label) ? settings.search_label : 'Search:';
                var noData = (search && settings.no_data_label) ? settings.no_data_label : 'No records found';
                var pagination = settings.show_pagination === 'yes';
                var paginationLabel = (pagination && settings.pagination_entries_label) ? settings.pagination_entries_label : 'Entries per page:';
                var paginationType = (pagination && settings.pagination_type) ? settings.pagination_type : '';
                var tableInfo = settings.show_tableinfo === 'yes';
                var infoText = (tableInfo && settings.info_text) ? settings.info_text : 'Showing _START_ to _END_ of _TOTAL_ entries';
                var infoTextAfterFilter = (tableInfo && settings.info_after_filter) ? settings.info_after_filter : '(filtered from _MAX_ total entries)';

                var table = $('#ultimate-datatable-' + id).DataTable({
                    info: tableInfo,
                    ordering: order,
                    paging: pagination,
                    searching: search,
                    pagingType: paginationType,
                    language: {
                        search: searchLabel,
                        lengthMenu: paginationLabel + ' _MENU_',
                        zeroRecords: noData,
                        info: infoText,
                        infoFiltered: infoTextAfterFilter
                    }
                });
            },
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/ultimate_data_table_el_widget.default', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(ultimateDataTable, {
                $element: $scope
            });
        });
    });

}) (jQuery);
