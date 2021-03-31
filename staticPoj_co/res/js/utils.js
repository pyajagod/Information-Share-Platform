(function (context) {
    /*序列串转为json*/
    var serializerToJson = function (serializerString) {
        var keyMapsArray = serializerString.split("&");
        var json = {};
        keyMapsArray && keyMapsArray.forEach(function (keyMap) {
            var key_value = keyMap.split("=");
            if (json[key_value[0]] && (Object.prototype.toString.call(json[key_value[0]]).toLowerCase() != '[object array]')) {
                json[key_value[0]] = [json[key_value[0]]];
                json[key_value[0]].push(decodeURIComponent(key_value[1]));
            } else if (json[key_value[0]] && (Object.prototype.toString.call(json[key_value[0]]).toLowerCase() === '[object array]')) {
                json[key_value[0]].push(decodeURIComponent(key_value[1]));
            } else {
                json[key_value[0]] = decodeURIComponent(key_value[1]);
            }
        });
        return json;
    };
    var jsonToSerializer = function (json) {
        var keys = Object.keys(json);
        var result = "";
        for (var i = 0; i < keys.length; i++) {
            if (i == 0) {
                result += keys[i] + '=' + encodeURIComponent(json[keys[i]]);
            } else if (i == keys.length - 1) {
                result += '&' + keys[i] + '=' + encodeURIComponent(json[keys[i]]);
            } else if (keys[i]) {
                result += '&' + keys[i] + '=' + encodeURIComponent(json[keys[i]]);
            }
        }
        return result;
    };
    /*获取URL中的参数*/
    var getUrlParameter = function (name, targetUrl) {
        var i,j;
        var url = targetUrl || location.href;

        //去掉hash
        if (url.indexOf('#') > -1) {
            url = url.slice(0, url.indexOf('#'));
        }

        var paraString = url.substring(url.indexOf("?") + 1, url.length).split("&");
        var paraObj = {}
        for (i = 0; j = paraString[i]; i++) {
            paraObj[j.substring(0, j.indexOf("=")).toLowerCase()] = j.substring(j.indexOf("=") + 1, j.length);
        }
        var returnValue = paraObj[name.toLowerCase()];
        if (typeof(returnValue) == "undefined") {
            return "";
        } else {
            return window.decodeURIComponent(returnValue);
        }
    };
    //浮窗信息
    function flash(target, content, duration, type) {
        var tipCtn = $(target).find(".tip-container");
        var bgColor = type === 'error'
            ? '#ee6b52'
            : (type === 'warning'
            ? '#f6953d'
            : '#000')
        if (tipCtn.length == 0) {
            tipCtn = $("<div class='tip-container'></div>");
            tipCtn.css({
                left: "50%",
                bottom: "50%",
                "-webkit-transform": " translateX(-50%)",
                transform: "translateX(-50%)",
                "min-width": "30%",
                "max-width": "80%",
                padding: "10px",
                position: $(target).is(document.body) ? "fixed" : 'absolute',
                background: bgColor,
                "text-align": "center",
                opacity: 0.8,
                color: "#fff",
                "font-size": "16px",
                display: "none",
                "border-radius": "4px",
                "z-index": 999999
            });
            tipCtn.appendTo($(target));
        } else {
            tipCtn.css({background: bgColor});
        }
        tipCtn.html(content);
        tipCtn.fadeIn(1500);
        if (duration && typeof duration == 'number') {
            setTimeout(function () {
                tipCtn.fadeOut(1500);
            }, duration);
        } else {
            tipCtn.fadeOut(1500);
        }
    };
    function loading(){
        var tipCtn = $(document.body).find(".loading_toast");
        if (tipCtn.length == 0) {
            tipCtn = $('<div id="loadingToast" class="loading_toast">\
                        <div class="gif-loading">\
                        </div>\
                    </div>\
                    ');
            tipCtn.appendTo($(document.body));
        } else {
            tipCtn.show();
        }
    }
    function loadingHide(){
        var tipCtn = $(document.body).find(".loading_toast");
        setTimeout(function(){
            tipCtn.hide();
            $('body,html').css({"position":"relative","top":"initial","left":"initial","right":"initial"});
        },200);
    };
    //检测移动设备
  var checkMobile = function () {
    var ua = navigator.userAgent;
    ua = ua
      ? ua.toLowerCase().replace(/-/g, "")
      : "";
    if (ua.match(/(Android)/i)) {
      return "android";
    }
    if (ua.match(/(iPhone|iPod)/i)) {
      return "iphone";
    }
    if (ua.match(/(iPad)/i)) {
      return "ipad";
    }
    if (ua.match(/(Windows Phone)/i)) {
      return "windows phone"
    } //windows phone
    if (ua.match(/(Symbian)/i)) {
      return "symbian"
    } //塞班
    if (ua.match(/(Nokia)/i)) {
      return "nokia"
    } //塞班
    if (ua.match(/(PlayBook)/i)) {
      return "playbook"
    } //黑莓playbook
    if (ua.match(/(BB)/i)) {
      return "blackberry"
    } //黑莓
    if (ua.match(/(KFAPWI)/i)) {
      return "kindlefire"
    } //kindle
    //UC Browser
    if (ua.match(/(U;)/i)) {
      if (ua.match(/(Adr)/i)) {
        return "android";
      }
    }
    if (ua.match(/(U;)/i)) {
      if (ua.match(/(iPh)/i)) {
        return "iphone";
      }
    }
    if (ua.match(/(U;)/i)) {
      if (ua.match(/(iPd)/i)) {
        return "ipad";
      }
    }
    return "";
  };
    var utils = {
        serializerToJson: serializerToJson,
        jsonToSerializer: jsonToSerializer,
        getParameter: getUrlParameter,
        flash: flash,
        loading: loading,
        loadingHide: loadingHide,
        checkMobile: checkMobile,
    };
    window.utils = utils;
    var define = window.define;
    var module = window.module;
    if (define && typeof define && define.amd) {
        define(['jquery'], function ($) {
            return utils;
        });
    } else if (typeof window.module == 'object' && window.module.exports) {
        module.exports = utils;
    } else {
        context.utils = utils;
    }
})(window);
