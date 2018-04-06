var app;

$(function () {
    if ($('html').hasClass('no-app')) return;

    app = {
        pageWidth: $(window).width(),
        pageHeight: $(window).height(),
        isMobile: false,
        bodyHeight: '',

        init: function () {
            var isMobile = (/Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)); //iPad|
            if ((/iPad/i.test(navigator.userAgent))) {
                isMobile = false;
            }

            if (isMobile) {
                $('body').addClass('isMobile');
                app.isMobile = true;
            }

            app.setEvents();
            app.setMask();
        },
        setEvents: function () {
            $(window)
                .on('scroll', app.onScroll)
                .on('load', app.onLoad)
                .on('ready', app.onReady)
                .on('resize', app.onResize);
            $(document)
                .on('scroll', app.onScroll)
                .on('load', app.onLoad)
                .on('ready', app.onReady)
                .on('resize', app.onResize);

            $('a[href="#"]').click(function (e) {
                e.preventDefault();
            });

            $(document).on('click', '.nav-menu li a', function (e) {
                if (!$(this).hasClass('no-default')) {
                    e.preventDefault();

                    var menuClick = $(this);

                    if ($(document).width() < 991) {
                        $('html, body').animate({scrollTop: ($('#' + $(this).attr('menu')).offset().top)}, 'show');
                        app.disableMenu();
                    } else {
                        $('html, body').animate({scrollTop: ($('#' + $(this).attr('menu')).offset().top - $('header').height())}, 'show');
                    }

                    $('.nav-menu li a').each(function () {
                        if ($(this).attr('menu') != menuClick.attr('menu')) {
                            $(this).parent().removeClass('active');
                        } else {
                            $(this).parent().addClass('active');
                        }

                        console.log('menu', $(this).attr('menu'));
                        console.log('menuClick', menuClick.attr('menu'));
                    });
                }
            });

            $(document).on('mouseover', '.nav-menu li', function () {
                $('.detail-menu').css('left', ($(this).find('a').first().offset().left + 10));
            });

            $('#go-top').on('click', function () {
                $('html,body').animate({scrollTop: ($('body').offset().top)}, 1000);
            });

            $(document).ready(function () {
                $('.accordion-link').click(function () {
                    var parent = $(this).parent().parent().parent();
                    var parent_2 = $(this).parent().parent();

                    parent.find('.accordion').each(function () {
                        $(this).removeClass('active');
                        $(this).find('.accordion-content').slideUp();
                    });

                    parent_2.addClass('active');
                    parent_2.find('.accordion-content').slideToggle();
                });
            });

            $('#responsive-menu').on('click', function () {
                if ($('header').hasClass('active')) {
                    app.disableMenu();
                } else {
                    app.activeMenu();
                }
            });

            //- --------------------------------------------------------------------------------------------------------
            //- Buscador de Endereço por CEP na base dos correios

            $('.find_cep').on('keyup', function (e) {
                switch (e.keyCode) {
                    case 13:
                        return false;
                        break;
                    case 17:
                        return false;
                        break;
                    case 35:
                        return false;
                        break;
                    case 36:
                        return false;
                        break;
                    case 37:
                        return false;
                        break;
                    case 38:
                        return false;
                        break;
                    case 39:
                        return false;
                        break;
                    case 40:
                        return false;
                        break;
                    case 46:
                        return false;
                        break;
                    case 67:
                        return false;
                        break;
                    case 86:
                        return false;
                        break;
                    default:
                }

                var cep = $(this).val().replace('_', '');

                if (cep.length == 9) {
                    app.pageLoading(true);

                    if ($(this).attr('number_parents') != 'undefined' && $(this).attr('number_parents') != undefined) {
                        if (parseInt($(this).attr('number_parents')) == 1) {
                            var find_cep_parent = $(this).parent();

                        }
                        if (parseInt($(this).attr('number_parents')) == 2) {
                            var find_cep_parent = $(this).parent().parent();

                        }
                        if (parseInt($(this).attr('number_parents')) == 3) {
                            var find_cep_parent = $(this).parent().parent().parent();

                        }
                        if (parseInt($(this).attr('number_parents')) == 4) {
                            var find_cep_parent = $(this).parent().parent().parent().parent();

                        }
                        if (parseInt($(this).attr('number_parents')) == 5) {
                            var find_cep_parent = $(this).parent().parent().parent().parent().parent();

                        }
                    }

                    var icon_spinner = $(this).parent().find('.icon-spinner');

                    icon_spinner.css('display', 'inline-block');
                    toastr.info('Consultando informações do cep.');

                    var formData = {
                        cep: cep
                    };

                    $.post(app.webroot + "php/ServiceFindCep.php", formData, function (data) {
                        if (parseInt(data.success) == 1) {
                            if (find_cep_parent.find('.find_cep').first().attr('number_parents') != 'undefined' && find_cep_parent.find('.find_cep').first().attr('number_parents') != undefined) {
                                find_cep_parent.find('.autocomplete_address').first().val(data.address);
                                find_cep_parent.find('.autocomplete_neighborhood').first().val(data.neighborhood);
                                find_cep_parent.find('.autocomplete_city').first().val(data.city);
                                find_cep_parent.find('.autocomplete_address_completion').first().val(data.address_completion);
                                find_cep_parent.find('.autocomplete_number').first().val(data.number);
                                find_cep_parent.find('.autocomplete_state').first().val(data.state);
                                find_cep_parent.find('.autocomplete_number').first().focus();
                            } else {
                                $('.autocomplete_address').val(data.address);
                                $('.autocomplete_neighborhood').val(data.neighborhood);
                                $('.autocomplete_city').val(data.city);
                                $('.autocomplete_address_completion').val(data.address_completion);
                                $('.autocomplete_number').val(data.number);
                                $('.autocomplete_state').val(data.state);
                                $('.autocomplete_number').focus();
                            }
                            toastr.success('Endereço encontrado.');
                        } else {
                            toastr.warning('Endereço não encontrado');
                        }

                        icon_spinner.hide();
                        app.pageLoading(false);
                    }, 'json').fail(function (jqXHR, textStatus, errorThrown) {
                        toastr.options = {"closeButton": true, "timeOut": "70000", "progressBar": true}
                        toastr.error('Falha de comunicação com servidor, verifique sua conexão e tente novamente');
                        toastr.options = {}

                        icon_spinner.hide();
                        app.pageLoading(false);
                    });
                }
            });
        },
        adaptHeightBanner: function () {
            if ($(window).width() >= 991) {
                $('.container-general').css('top', $('header').height());
            } else {
                $('.container-general').css('top', $('#top-mobile').height());
            }
        },
        activeMenu: function () {
            $('header').animate({left: "0"}, 1000);
            $('header').addClass('active');
            $('#responsive-menu').removeClass('type-02');
            $('#responsive-menu').addClass('type-01');
        },
        disableMenu: function () {
            $('header').animate({left: "-100%"}, 1000);
            $('header').removeClass('active');
            $('#responsive-menu').addClass('type-02');
            $('#responsive-menu').removeClass('type-01');
        },
        parallax: function () {
            $('.bgParallax').each(function () {
                var $obj = $(this);

                $(window).scroll(function () {
                    var yPos = -($(window).scrollTop() / $obj.data('speed'));

                    var bgpos = '50% ' + yPos + 'px';

                    $obj.css('background-position', bgpos);

                });
            });
        },
        goslideShow: function () {
            $('div, img').slideShow({
                timeOut: 2000,
                showNavigation: true,
                pauseOnHover: true,
                swipeNavigation: true
            });

            var navbar = $('.navbar')

            navbar.animate({top: '-100px'}, function () {
                navbar.hide();
            });
        },
        onResize: function () {
            app.parallax();

            if ($(document).width() >= 991) {
                app.activeMenu();
            }

            app.adaptHeightBanner();
            app.goslideShow();
        },
        onScroll: function () {
            app.parallax();

            if ($(document).scrollTop() > app.pageHeight) {
                $('#go-top').fadeIn('show');
            } else {
                $('#go-top').fadeOut('show');
            }

            if ($(window).width() >= 991) {
                if ($(document).scrollTop() > 0) {
                    $('header .top-2').hide();
                } else {
                    $('header .top-2').show();
                }
            } else {
                $('header .top-2').show();
            }
        },
        onReady: function (ev) {
            app.pageLoading(true);
            app.parallax();

            var hash = window.location.hash;

            if (hash.length > 0) {
                $('html, body').animate({scrollTop: $('' + hash + '').offset().top - 126}, 'show');
            }

            app.adaptHeightBanner();
            app.goslideShow();
        },
        onLoad: function (ev) {
            app.pageLoading(false);
        },
        dateFormat: function (date, of, to) {
            try {
                if (date.isObject()) {

                    var newDate = new Date(date);
                    newDate.setDate(newDate.getDate());
                    return newDate;

                } else {

                    var split = '';
                    split = ((date.indexOf("-") > 0) ? '-' : split);
                    split = ((date.indexOf("/") > 0) ? '/' : split);

                    if (of == 'US' && to == 'BR') {
                        var date = date.split(split);
                        date = date[2] + '-' + date[1] + '-' + date[0];
                    } else if (of == 'BR' && to == 'US') {
                        var date = date.split(split);
                        date = date[2] + '-' + date[1] + '-' + date[0];
                    } else {
                        return false;
                    }

                    var newDate = new Date(date);
                    newDate.setDate(newDate.getDate());
                    return newDate;
                }

                return false;
            } catch (err) {
                //console.warn('ERROR in dateFormat: ' + err.message);
                return false;
            }
        },
        addDays: function (date, amount) {
            try {
                var tzOff = date.getTimezoneOffset() * 60 * 1000,
                    t = date.getTime(),
                    d = new Date(),
                    tzOff2;

                t += (1000 * 60 * 60 * 24) * amount;
                d.setTime(t);

                tzOff2 = d.getTimezoneOffset() * 60 * 1000;
                if (tzOff != tzOff2) {
                    var diff = tzOff2 - tzOff;
                    t += diff;
                    d.setTime(t);
                }

                return d;
            } catch (err) {
                //console.warn('ERROR in setControlsDateSecondary: ' + err.message);
                return false;
            }
        },
        pageLoading: function (what) {
            if (what) {
                $('#loadingPage').fadeIn('fast');
            } else {
                $('#loadingPage').fadeOut('fast');
            }

            var top = ((this.bodyHeight != '') ? (this.bodyHeight / 2) : (app.pageHeight / 2));
            $('.loading', '#loadingPage').css('top', top);
        },
        getDateDiff: function (date1, date2, interval) {
            try {
                var second = 1000,
                    minute = second * 60,
                    hour = minute * 60,
                    day = hour * 24,
                    week = day * 7;

                if (!date1 || !date2 || !interval) {
                    return false;
                }
                var dateone = new Date(date1);
                var datetwo = new Date(date2);
                var timediff = dateone.getTime() - datetwo.getTime();
                if (isNaN(timediff)) return NaN;
                switch (interval) {
                    case "years":
                        return dateone.getFullYear() - datetwo.getFullYear();
                    case "months":
                        return ((dateone.getFullYear() * 12 + dateone.getMonth()) - (datetwo.getFullYear() * 12 + datetwo.getMonth()));
                    case "weeks":
                        return Math.floor(timediff / week);
                    case "days":
                        return Math.floor(timediff / day);
                    case "hours":
                        return Math.floor(timediff / hour);
                    case "minutes":
                        return Math.floor(timediff / minute);
                    case "seconds":
                        return Math.floor(timediff / second);
                    default:
                        return undefined;
                }
            } catch (error) {
                //console.warn('Error getDateDiff: ', error.message);
            }
        },
        scroolMoving: function (position, time) {
            var pageParent = $('html, body', app.parent);
            var time = (parseInt(time)) ? time : 800;
            pageParent.animate({scrollTop: position}, time);
        },
        setMask: function () {
            $(".card_validity").mask("99/9999");
            $(".credit_card").mask("9999 999 9999 9999");
            $(".mask_cpf").mask("999.999.999-99");
            $(".mask_cnpj").mask("99.999.999/9999-99");
            $(".mask_birthdate").mask("99/99/9999");
            $('.mask_phone').mask("(99) 9999-9999");
            $(".cep").mask("99.999-999");

            $('.mask_cellular').mask("(99) 9999-9999?9").ready(function (event) {
                try {
                    var target, phone, element;
                    target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                    phone = target.value.replace(/\D/g, '');
                    element = $(target);
                    element.unmask();
                    if (phone.length > 10) {
                        element.mask("(99) 99999-999?9");
                    } else {
                        element.mask("(99) 9999-9999?9");
                    }
                } catch (e) {

                }
            });

            $(".mask_cep").mask("99999-999");

            $(".mask_date").mask("99-99-9999");
            $(".mask_hour").mask("99:99");
            $(".mask_time").mask("99:99:99");
        },
        inlineFieldAlert: function (action, field_type, field, msg, class_type, toastr){

            var arrayClass = ['warning', 'error', 'info', 'success'];
            var icon = '';

            //input
            if (action == 'clean' && field_type == 'input') {
                var obgClass = field.parent();
                obgClass.find('.alert-msg').remove();

                jQuery.each(arrayClass, function (index, value){
                    obgClass.removeClass(value);
                });

                return true;
            }

            //select
            if (action == 'clean' && field_type == 'select') {
                var obgClass = field.parent();
                obgClass.find('.alert-msg').remove();

                jQuery.each(arrayClass, function (index, value){
                    obgClass.removeClass(value);
                });

                return true;
            }

            //input-prepend
            if (action == 'clean' && field_type == 'input-prepend') {
                var obgClass = field.parent().parent();
                obgClass.find('.alert-msg').remove();

                jQuery.each(arrayClass, function (index, value){
                    obgClass.removeClass(value);
                });

                return true;
            }

            //textarea
            if (action == 'clean' && field_type == 'textarea') {
                var obgClass = field.parent().parent();
                obgClass.find('.alert-msg').remove();

                jQuery.each(arrayClass, function (index, value){
                    obgClass.removeClass(value);
                });

                return true;
            }

            //checkbox
            if (action == 'clean' && field_type == 'checkbox') {
                var obgClass = field.parent().parent().parent().parent();
                obgClass.find('.alert-msg').remove();

                jQuery.each(arrayClass, function (index, value){
                    obgClass.removeClass(value);
                });

                return true;
            }

            if (toastr && class_type == 'warning') {
                parent.toastr.warning(msg);
            }
            if (toastr && class_type == 'error') {
                parent.toastr.error(msg);
            }
            if (toastr && class_type == 'info') {
                parent.toastr.info(msg);
            }
            if (toastr && class_type == 'success') {
                parent.toastr.success(msg);
            }

            if (class_type == 'warning') {
                icon = '<i class="icon-remove-sign"></i>';
            }
            if (class_type == 'error') {
                icon = '<i class="icon-remove-sign"></i>';
            }
            if (class_type == 'info') {
                icon = '<i class="icon-remove-sign"></i>';
            }
            if (class_type == 'success') {
                icon = '<i class="icon-ok-sign"></i>';
            }

            //input
            if (field_type == 'input') {
                var obgClass = field.parent();

                obgClass.find('.alert-msg').remove();

                if (msg != '') {
                    obgClass.append('<span class="alert-msg span12">' + icon + '' + msg + '</span>');
                }
                obgClass.addClass(class_type);
            }

            //select
            if (field_type == 'select') {
                var obgClass = field.parent();

                obgClass.find('.alert-msg').remove();

                if (msg != '') {
                    obgClass.append('<span class="alert-msg span12">' + icon + '' + msg + '</span>');
                }
                obgClass.addClass(class_type);
            }

            //input-prepend
            if (field_type == 'input-prepend') {
                var obgClass = field.parent().parent();

                obgClass.find('.alert-msg').remove();

                if (msg != '') {
                    obgClass.append('<span class="alert-msg span12">' + icon + '' + msg + '</span>');
                }
                obgClass.addClass(class_type);
            }

            //textarea
            if (field_type == 'textarea') {
                var obgClass = field.parent().parent();

                obgClass.find('.alert-msg').remove();

                if (msg != '') {
                    obgClass.append('<span class="alert-msg span12">' + icon + '' + msg + '</span>');
                }
                obgClass.addClass(class_type);
            }

            //checkbox
            if (field_type == 'checkbox') {
                var obgClass = field.parent().parent().parent().parent();

                obgClass.find('.alert-msg').remove();

                if (msg != '') {
                    obgClass.append('<span class="alert-msg span12">' + icon + '' + msg + '</span>');
                }
                obgClass.addClass(class_type);
            }
        },
    };
    app.init();
});