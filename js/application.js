if (typeof jQuery === 'undefined') {
  throw new Error('Requires jQuery');
}

jQuery.noConflict();

!function ($) {
  $(function () {

    // IE10 viewport hack for Surface/desktop Windows 8
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
      var msViewportStyle = document.createElement("style");
      msViewportStyle.appendChild(
        document.createTextNode(
          "@-ms-viewport{width:auto!important}"
        )
      );
      document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
    }

    // Call Tooltip
    $('.hasTooltip').tooltip();

    // Call Button & Input Tooltip
    $('.extra-tooltip').tooltip({
      container: "body"
    });

    // Call popover
    $('.hasPopover').popover({
      trigger: "hover",
      html: true
    });

    // Call Button & Input Popover
    $('.extra-popover').popover({
      container: "body"
    });

    // Call Remote in Modal
    $('.modal-remote').click(function () {
      var target = $(this).data('target');
      var url = $(this).attr('href');

      if (target === 'undefined') {
        target = "#modal-remote";
      }
      if ($(this).data('title') !== 'undefined') {
        $(target + ' .modal-content .modal-header').append('<h4>' + $(this).data('title') + '</h4>');
      }
      $(target + ' .modal-content .modal-body').html('<iframe src="' + url + '" frameborder="0"></iframe>');
      $(target).modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });
      return false;
    });

    // Scroll top
    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
        $('.scroll-top').fadeIn();
      } else {
        $('.scroll-top').fadeOut();
      }
    });
    $('.scroll-top').click(function () {
      $('html, body').animate({
        scrollTop: 0
      }, 800);
      return false;
    });

    // Fixed navbar
    $(window).scroll(function () {
      if (($(this).scrollTop() > 200 && !$('.wrap-header').first().is('nav')) || $(this).scrollTop() > 240) {
        $('.navbar-fixed').addClass('navbar-fixed-top');
      } else {
        $('.navbar-fixed').removeClass('navbar-fixed-top');
      }
    });

    // Logout
    $('#logout').click(function () {
      $('#login-form').submit();
    });

    // Rating
    $('.rating span').click(function () {
      var rate = $(this).data('value');
      $("input[name='user_rating']").val(rate);
      $('.rating').submit();
    });
  });
}(jQuery);