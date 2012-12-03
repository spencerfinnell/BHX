jQuery(function($) {
  var tripbuilder;
  var app;
  return app = {
    init: function() {
      this.fancybox();
      this.home();
      return this.pages();
    },
    fancybox: function() {
      if ($.fancybox) {
        return $('.fancybox').click(function() {
          return $('.fancybox').fancybox({
            href: $(this).data('section'),
            minWidth: 445,
            width: 445,
            padding: 0,
            helpers: {
              overlay: {
                css: {
                  'background': 'rgba(245, 245, 245, .85)'
                }
              }
            }
          });
        });
      }
    },
    home: function() {
      if ($('#featured-slider').length) {
        return $('.featured-slider-slides').jCarousellite(function() {
          return {
            btnNext: $('#featured-slider-navigation .next'),
            btnPrev: $('#featured-slider-navigation .prev')
          };
        });
      }
    },
    pages: function() {
      return $('blockquote').each(function() {
        return $(this).find('p').prepend('<span class="quotemark">&#8220;</span>');
      });
    }
  };
});

tripbuilder = {
  init: function() {
    return this.filter();
  },
  filter: function() {
    return $('.build-criteria').each(function() {
      var items, legend, main;
      legend = $(this).find('legend');
      main = legend.find('input[type="checkbox"]');
      items = $(this).find('li');
      if (!main.is(':checked')) {
        legend.addClass('disabled');
        items.addClass('disabled');
        items.find('input[type="checkbox"]').attr('disabled', 'disabled');
      }
      return main.change(function() {
        items.toggleClass('disabled');
        legend.toggleClass('disabled');
        return items.find('input[type="checkbox"]').each(function() {
          if ($(this).prop('disabled', true)) {
            $(this).prop('disabled', false);
          } else {
            $(this).prop('disabled', true);
          }
          if ($(this).prop('checked', true)) {
            return $(this).prop('checked', false);
          } else {
            return $(this).prop('checked', true);
          }
        });
      });
    });
  }
  
app.init();

tripbuilder.init();
};