var readyGo = {
    init: function () {
        'use strict';

        this.filters.init();
        this.mobileMenu.init();
        this.parallax.init();
        this.tabs.init();
    }
};

readyGo.filters = {
    init: function () {
        if ($('#filter-set').length > 0) {
            this.bindEvents();
            this.initValues();
        }
    },

    bindEvents: function () {
        $('#filter-form select').on('change', function (e) {
            $(this).addClass('dirty');
            var data = $('#filter-form').serializeArray();
            var filters = '';
            $.each(data, function (index, value) {
                filters += '[data-' + value['name'] + '*="' + value['value'] + '"]';
            });
            if (filters !== '[data-locations*=""]') {
                $('#filter-set .filter-item').hide();
                $('#filter-set .filter-item' + filters).show();
            } else {
                $('#filter-set .filter-item').show();
            }
        });
    },

    initValues: function () {
        var queries = {};
        $.each(document.location.search.substr(1).split('&'), function (c, q) {
            var i = q.split('=');
            if (i[1]) {
                queries[i[0].toString()] = i[1].toString();
            }
        });
        if (queries['c'] > 0) {
            $('#filter-form select[name="categories"]').val(queries['c']).trigger('change');
        }
    }
};

readyGo.mobileMenu = {
    init: function () {
        this.bindEvents();
    },

    bindEvents: function () {
        $('#mobile-menu-btn').on('click', function (e) {
            e.preventDefault();
            $('#mobile-menu').slideToggle();
        });
    }
};

readyGo.parallax = {
    init: function () {
        var isMobile = false;

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            isMobile = true;
        }

        var $window = $(window);

        if (!isMobile) {
            $('[data-type="background"]').each(function () {
                var $bgobj = $(this);
                $(window).scroll(function () {
                    var yPos = -($window.scrollTop() / $bgobj.data('speed'));
                    var coords = '50% calc(50% + ' + yPos + 'px)';
                    $bgobj.css({backgroundPosition: coords});
                });
            });
        }
    }
};

readyGo.tabs = {
    init: function () {
        var $tabs = $('.tab');
        if ($tabs.length > 0) {
            $('.tab').on('click', function (e) {
                e.preventDefault();
                var $tab = $(this);
                $tabs.not($tab).removeClass('tab-active');
                $tab.addClass('tab-active');
                $('.tab-content').hide().filter('[data-tab="' + $tab.data('tab-target') + '"]').show();
            });
        }
    }
};

$(document).ready(function () {
    'use strict';
    readyGo.init();
});