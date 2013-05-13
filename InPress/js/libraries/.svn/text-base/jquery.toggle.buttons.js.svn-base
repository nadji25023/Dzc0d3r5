!function (jQuery) {
  "use strict";
  // version: 2.8.2
  // by Mattia Larentis - follow me on twitter! @SpiritualGuru

  var addToAttribute = function (obj, array, value) {
    var i = 0
      , length = array.length;

    for (; i < length; i++) {
      obj = obj[array[i]] = obj[array[i]] || i == ( length - 1) ? value : {}
    }
  };

  jQuery.fn.toggleButtons = function (method) {
    var jQueryelement
      , jQuerydiv
      , jQuerycb
      , transitionSpeed = 0.05
      , methods = {
        init: function (opt) {
          this.each(function () {
              var jQueryspanLeft
                , jQueryspanRight
                , options
                , moving
                , dataAttribute = {};

              jQueryelement = jQuery(this);
              jQueryelement.addClass('toggle-button');

              jQuery.each(jQueryelement.data(), function (i, el) {
                var key
                  , tmp = {};

                if (i.indexOf("togglebutton") === 0) {
                  key = i.match(/[A-Z][a-z]+/g);
                  key = jQuery.map(key, function (n) {
                    return (n.toLowerCase());
                  });

                  addToAttribute(tmp, key, el);
                  dataAttribute = jQuery.extend(true, dataAttribute, tmp);
                }
              });

              options = jQuery.extend(true, {}, jQuery.fn.toggleButtons.defaults, opt, dataAttribute);

              jQuery(this).data('options', options);

              jQueryspanLeft = jQuery('<span></span>').addClass("labelLeft").text(options.label.enabled === undefined ? "ON" : options.label.enabled);
              jQueryspanRight = jQuery('<span></span>').addClass("labelRight").text(options.label.disabled === undefined ? "OFF " : options.label.disabled);

              // html layout
              jQuerycb = jQueryelement.find('input:checkbox')

              jQuerydiv = jQuerycb.wrap(jQuery('<div></div>')).parent();
              jQuerydiv.append(jQueryspanLeft);
              jQuerydiv.append(jQuery('<label></label>').attr('for', jQuerycb.attr('id') || ''));
              jQuerydiv.append(jQueryspanRight);

              if (jQuerycb.is(':checked'))
                jQueryelement.find('>div').css('left', "0");
              else jQueryelement.find('>div').css('left', "-50%");

              if (options.animated) {
                if (options.transitionspeed !== undefined)
                  if (/^(\d*%jQuery)/.test(options.transitionspeed))  // is a percent value?
                    transitionSpeed = 0.05 * parseInt(options.transitionspeed) / 100;
                  else
                    transitionSpeed = options.transitionspeed;
              }
              else transitionSpeed = 0;

              jQuery(this).data('transitionSpeed', transitionSpeed * 1000);


              options["width"] /= 2;

              // width of the bootstrap-toggle-button
              jQueryelement
                .css('width', options.width * 2)
                .find('>div').css('width', options.width * 3)
                .find('>span, >label').css('width', options.width);

              // height of the bootstrap-toggle-button
              jQueryelement
                .css('height', options.height)
                .find('span, label')
                .css('height', options.height)
                .filter('span')
                .css('line-height', options.height + "px");

              if (jQuerycb.is(':disabled'))
                jQuery(this).addClass('deactivate');

              jQueryelement.find('span').css(options.font);


              // enabled custom color
              if (options.style.enabled === undefined) {
                if (options.style.custom !== undefined && options.style.custom.enabled !== undefined && options.style.custom.enabled.background !== undefined) {
                  jQueryspanLeft.css('color', options.style.custom.enabled.color);
                  if (options.style.custom.enabled.gradient === undefined)
                    jQueryspanLeft.css('background', options.style.custom.enabled.background);
                  else jQuery.each(["-webkit-", "-moz-", "-o-", ""], function (i, el) {
                    jQueryspanLeft.css('background-image', el + 'linear-gradient(top, ' + options.style.custom.enabled.background + ',' + options.style.custom.enabled.gradient + ')');
                  });
                }
              }
              else jQueryspanLeft.addClass(options.style.enabled);

              // disabled custom color
              if (options.style.disabled === undefined) {
                if (options.style.custom !== undefined && options.style.custom.disabled !== undefined && options.style.custom.disabled.background !== undefined) {
                  jQueryspanRight.css('color', options.style.custom.disabled.color);
                  if (options.style.custom.disabled.gradient === undefined)
                    jQueryspanRight.css('background', options.style.custom.disabled.background);
                  else jQuery.each(["-webkit-", "-moz-", "-o-", ""], function (i, el) {
                    jQueryspanRight.css('background-image', el + 'linear-gradient(top, ' + options.style.custom.disabled.background + ',' + options.style.custom.disabled.gradient + ')');
                  });
                }
              }
              else jQueryspanRight.addClass(options.style.disabled);

              var changeStatus = function (jQuerythis) {
                jQuerythis.siblings('label')
                  .trigger('mousedown')
                  .trigger('mouseup')
                  .trigger('click');
              };

              jQueryspanLeft.on('click', function (e) {
                changeStatus(jQuery(this));
              });
              jQueryspanRight.on('click', function (e) {
                changeStatus(jQuery(this));
              });

              jQueryelement.find('input:checkbox').on('change', function (e, skipOnChange) {
                var jQueryelement = jQuery(this).parent()
                  , active = jQuery(this).is(':checked')
                  , jQuerytoggleButton = jQuery(this).closest('.toggle-button');

                jQueryelement.stop().animate({'left': active ? '0' : '-50%'}, jQuerytoggleButton.data('transitionSpeed'));

                options = jQuerytoggleButton.data('options');

                if (!skipOnChange)
                  options.onChange(jQueryelement, active, e);
              });

              jQueryelement.find('label').on('mousedown touchstart', function (e) {
                moving = false;
                e.preventDefault();
                e.stopImmediatePropagation();

                if (jQuery(this).closest('.toggle-button').is('.deactivate'))
                  jQuery(this).off('click');
                else {
                  jQuery(this).on('mousemove touchmove', function (e) {
                    var jQueryelement = jQuery(this).closest('.toggle-button')
                      , relativeX = (e.pageX || e.originalEvent.targetTouches[0].pageX) - jQueryelement.offset().left
                      , percent = ((relativeX / (options.width * 2)) * 100);
                    moving = true;

                    e.stopImmediatePropagation();
                    e.preventDefault();

                    if (percent < 25)
                      percent = 25;
                    else if (percent > 75)
                      percent = 75;

                    jQueryelement.find('>div').css('left', (percent - 75) + "%");
                  });

                  jQuery(this).on('click touchend', function (e) {
                    var jQuerytarget = jQuery(e.target)
                      , jQuerymyCheckBox = jQuerytarget.siblings('input:checkbox');

                    e.stopImmediatePropagation();
                    e.preventDefault();
                    jQuery(this).off('mouseleave');

                    if (moving)
                      if (parseInt(jQuery(this).parent().css('left')) < -25)
                        jQuerymyCheckBox.attr('checked', false);
                      else jQuerymyCheckBox.attr('checked', true);
                    else jQuerymyCheckBox.attr("checked", !jQuerymyCheckBox.is(":checked"));

                    jQuerymyCheckBox.trigger('change');
                  });

                  jQuery(this).on('mouseleave', function (e) {
                    var jQuerymyCheckBox = jQuery(this).siblings('input:checkbox');

                    e.preventDefault();
                    e.stopImmediatePropagation();

                    jQuery(this).off('mouseleave');
                    jQuery(this).trigger('mouseup');

                    if (parseInt(jQuery(this).parent().css('left')) < -25)
                      jQuerymyCheckBox.attr('checked', false);
                    else jQuerymyCheckBox.attr('checked', true);

                    jQuerymyCheckBox.trigger('change');
                  });

                  jQuery(this).on('mouseup', function (e) {
                    e.stopImmediatePropagation();
                    e.preventDefault();
                    jQuery(this).off('mousemove');
                  });
                }
              });
            }
          );
          return this;
        },
        toggleActivation: function () {
          jQuery(this).toggleClass('deactivate');
        },
        toggleState: function (skipOnChange) {
          var jQueryinput = jQuery(this).find('input:checkbox');
          jQueryinput.attr('checked', !jQueryinput.is(':checked')).trigger('change', skipOnChange);
        },
        setState: function(value, skipOnChange) {
          jQuery(this).find('input:checkbox').attr('checked', value).trigger('change', skipOnChange);
        },
        status: function () {
          return jQuery(this).find('input:checkbox').is(':checked');
        },
        destroy: function () {
          var jQuerydiv = jQuery(this).find('div')
            , jQuerycheckbox;

          jQuerydiv.find(':not(input:checkbox)').remove();

          jQuerycheckbox = jQuerydiv.children();
          jQuerycheckbox.unwrap().unwrap();

          jQuerycheckbox.unbind('change');

          return jQuerycheckbox;
        }
      };

    if (methods[method])
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    else if (typeof method === 'object' || !method)
      return methods.init.apply(this, arguments);
    else
      jQuery.error('Method ' + method + ' does not exist!');
  };

  jQuery.fn.toggleButtons.defaults = {
    onChange: function () {
    },
    width: 100,
    height: 25,
    font: {},
    animated: true,
    transitionspeed: undefined,
    label: {
      enabled: undefined,
      disabled: undefined
    },
    style: {
      enabled: undefined,
      disabled: undefined,
      custom: {
        enabled: {
          background: undefined,
          gradient: undefined,
          color: "#FFFFFF"
        },
        disabled: {
          background: undefined,
          gradient: undefined,
          color: "#FFFFFF"
        }
      }
    }
  };
}(jQuery);
