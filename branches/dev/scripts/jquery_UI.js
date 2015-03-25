/*! jQuery UI - v1.10.3 - 2013-05-23
 * http://jqueryui.com
 * Includes: jquery.ui.core.js, jquery.ui.widget.js, jquery.ui.mouse.js, jquery.ui.position.js, jquery.ui.draggable.js, jquery.ui.droppable.js, jquery.ui.resizable.js, jquery.ui.selectable.js, jquery.ui.sortable.js, jquery.ui.accordion.js, jquery.ui.autocomplete.js, jquery.ui.button.js, jquery.ui.datepicker.js, jquery.ui.dialog.js, jquery.ui.menu.js, jquery.ui.progressbar.js, jquery.ui.slider.js, jquery.ui.spinner.js, jquery.ui.tabs.js, jquery.ui.tooltip.js, jquery.ui.effect.js, jquery.ui.effect-blind.js, jquery.ui.effect-bounce.js, jquery.ui.effect-clip.js, jquery.ui.effect-drop.js, jquery.ui.effect-explode.js, jquery.ui.effect-fade.js, jquery.ui.effect-fold.js, jquery.ui.effect-highlight.js, jquery.ui.effect-pulsate.js, jquery.ui.effect-scale.js, jquery.ui.effect-shake.js, jquery.ui.effect-slide.js, jquery.ui.effect-transfer.js
 * Copyright 2013 jQuery Foundation and other contributors Licensed MIT */
(function (k, m) {
    function n(c, d) {
        var h, f, b, g = c.nodeName.toLowerCase();
        return "area" === g ? (h = c.parentNode, f = h.name, c.href && f && "map" === h.nodeName.toLowerCase() ? (b = k("img[usemap=#" + f + "]")[0], !!b && l(b)) : !1) : (/input|select|textarea|button|object/.test(g) ? !c.disabled : "a" === g ? c.href || d : d) && l(c)
    }
    function l(b) {
        return k.expr.filters.visible(b) && !k(b).parents().addBack().filter(function () {
            return "hidden" === k.css(this, "visibility")
        }).length
    }
    var a = 0,
            e = /^ui-id-\d+$/;
    k.ui = k.ui || {}, k.extend(k.ui, {
        version: "1.10.3",
        keyCode: {
            BACKSPACE: 8,
            COMMA: 188,
            DELETE: 46,
            DOWN: 40,
            END: 35,
            ENTER: 13,
            ESCAPE: 27,
            HOME: 36,
            LEFT: 37,
            NUMPAD_ADD: 107,
            NUMPAD_DECIMAL: 110,
            NUMPAD_DIVIDE: 111,
            NUMPAD_ENTER: 108,
            NUMPAD_MULTIPLY: 106,
            NUMPAD_SUBTRACT: 109,
            PAGE_DOWN: 34,
            PAGE_UP: 33,
            PERIOD: 190,
            RIGHT: 39,
            SPACE: 32,
            TAB: 9,
            UP: 38
        }
    }), k.fn.extend({
        focus: function (b) {
            return function (d, c) {
                return "number" == typeof d ? this.each(function () {
                    var f = this;
                    setTimeout(function () {
                        k(f).focus(), c && c.call(f)
                    }, d)
                }) : b.apply(this, arguments)
            }
        }(k.fn.focus),
        scrollParent: function () {
            var b;
            return b = k.ui.ie && /(static|relative)/.test(this.css("position")) || /absolute/.test(this.css("position")) ? this.parents().filter(function () {
                return /(relative|absolute|fixed)/.test(k.css(this, "position")) && /(auto|scroll)/.test(k.css(this, "overflow") + k.css(this, "overflow-y") + k.css(this, "overflow-x"))
            }).eq(0) : this.parents().filter(function () {
                return /(auto|scroll)/.test(k.css(this, "overflow") + k.css(this, "overflow-y") + k.css(this, "overflow-x"))
            }).eq(0), /fixed/.test(this.css("position")) || !b.length ? k(document) : b
        },
        zIndex: function (d) {
            if (d !== m) {
                return this.css("zIndex", d)
            }
            if (this.length) {
                for (var c, f, b = k(this[0]); b.length && b[0] !== document; ) {
                    if (c = b.css("position"), ("absolute" === c || "relative" === c || "fixed" === c) && (f = parseInt(b.css("zIndex"), 10), !isNaN(f) && 0 !== f)) {
                        return f
                    }
                    b = b.parent()
                }
            }
            return 0
        },
        uniqueId: function () {
            return this.each(function () {
                this.id || (this.id = "ui-id-" + ++a)
            })
        },
        removeUniqueId: function () {
            return this.each(function () {
                e.test(this.id) && k(this).removeAttr("id")
            })
        }
    }), k.extend(k.expr[":"], {
        data: k.expr.createPseudo ? k.expr.createPseudo(function (b) {
            return function (c) {
                return !!k.data(c, b)
            }
        }) : function (d, b, c) {
            return !!k.data(d, c[3])
        },
        focusable: function (b) {
            return n(b, !isNaN(k.attr(b, "tabindex")))
        },
        tabbable: function (c) {
            var b = k.attr(c, "tabindex"),
                    d = isNaN(b);
            return (d || b >= 0) && n(c, !d)
        }
    }), k("<a>").outerWidth(1).jquery || k.each(["Width", "Height"], function (d, c) {
        function h(q, s, p, v) {
            return k.each(f, function () {
                s -= parseFloat(k.css(q, "padding" + this)) || 0, p && (s -= parseFloat(k.css(q, "border" + this + "Width")) || 0), v && (s -= parseFloat(k.css(q, "margin" + this)) || 0)
            }), s
        }
        var f = "Width" === c ? ["Left", "Right"] : ["Top", "Bottom"],
                b = c.toLowerCase(),
                g = {
                    innerWidth: k.fn.innerWidth,
                    innerHeight: k.fn.innerHeight,
                    outerWidth: k.fn.outerWidth,
                    outerHeight: k.fn.outerHeight
                };
        k.fn["inner" + c] = function (o) {
            return o === m ? g["inner" + c].call(this) : this.each(function () {
                k(this).css(b, h(this, o) + "px")
            })
        }, k.fn["outer" + c] = function (p, o) {
            return "number" != typeof p ? g["outer" + c].call(this, p) : this.each(function () {
                k(this).css(b, h(this, p, !0, o) + "px")
            })
        }
    }), k.fn.addBack || (k.fn.addBack = function (b) {
        return this.add(null == b ? this.prevObject : this.prevObject.filter(b))
    }), k("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (k.fn.removeData = function (b) {
        return function (c) {
            return arguments.length ? b.call(this, k.camelCase(c)) : b.call(this)
        }
    }(k.fn.removeData)), k.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), k.support.selectstart = "onselectstart" in document.createElement("div"), k.fn.extend({
        disableSelection: function () {
            return this.bind((k.support.selectstart ? "selectstart" : "mousedown") + ".ui-disableSelection", function (b) {
                b.preventDefault()
            })
        },
        enableSelection: function () {
            return this.unbind(".ui-disableSelection")
        }
    }), k.extend(k.ui, {
        plugin: {
            add: function (c, d, b) {
                var f, g = k.ui[c].prototype;
                for (f in b) {
                    g.plugins[f] = g.plugins[f] || [], g.plugins[f].push([d, b[f]])
                }
            },
            call: function (f, b, c) {
                var g, d = f.plugins[b];
                if (d && f.element[0].parentNode && 11 !== f.element[0].parentNode.nodeType) {
                    for (g = 0; d.length > g; g++) {
                        f.options[d[g][0]] && d[g][1].apply(f.element, c)
                    }
                }
            }
        },
        hasScroll: function (c, d) {
            if ("hidden" === k(c).css("overflow")) {
                return !1
            }
            var b = d && "left" === d ? "scrollLeft" : "scrollTop",
                    f = !1;
            return c[b] > 0 ? !0 : (c[b] = 1, f = c[b] > 0, c[b] = 0, f)
        }
    })
})(jQuery);
(function (k, e) {
    var g = 0,
            l = Array.prototype.slice,
            h = k.cleanData;
    k.cleanData = function (b) {
        for (var c, a = 0; null != (c = b[a]); a++) {
            try {
                k(c).triggerHandler("remove")
            } catch (d) {
            }
        }
        h(b)
    }, k.widget = function (b, o, d) {
        var s, n, f, a, c = {}, r = b.split(".")[0];
        b = b.split(".")[1], s = r + "-" + b, d || (d = o, o = k.Widget), k.expr[":"][s.toLowerCase()] = function (m) {
            return !!k.data(m, s)
        }, k[r] = k[r] || {}, n = k[r][b], f = k[r][b] = function (m, p) {
            return this._createWidget ? (arguments.length && this._createWidget(m, p), e) : new f(m, p)
        }, k.extend(f, n, {
            version: d.version,
            _proto: k.extend({}, d),
            _childConstructors: []
        }), a = new o, a.options = k.widget.extend({}, a.options), k.each(d, function (p, m) {
            return k.isFunction(m) ? (c[p] = function () {
                var q = function () {
                    return o.prototype[p].apply(this, arguments)
                }, u = function (v) {
                    return o.prototype[p].apply(this, v)
                };
                return function () {
                    var v, x = this._super,
                            w = this._superApply;
                    return this._super = q, this._superApply = u, v = m.apply(this, arguments), this._super = x, this._superApply = w, v
                }
            }(), e) : (c[p] = m, e)
        }), f.prototype = k.widget.extend(a, {
            widgetEventPrefix: n ? a.widgetEventPrefix : b
        }, c, {
            constructor: f,
            namespace: r,
            widgetName: b,
            widgetFullName: s
        }), n ? (k.each(n._childConstructors, function (m, p) {
            var q = p.prototype;
            k.widget(q.namespace + "." + q.widgetName, f, p._proto)
        }), delete n._childConstructors) : o._childConstructors.push(f), k.widget.bridge(b, f)
    }, k.widget.extend = function (d) {
        for (var n, f, b = l.call(arguments, 1), a = 0, c = b.length; c > a; a++) {
            for (n in b[a]) {
                f = b[a][n], b[a].hasOwnProperty(n) && f !== e && (d[n] = k.isPlainObject(f) ? k.isPlainObject(d[n]) ? k.widget.extend({}, d[n], f) : k.widget.extend({}, f) : f)
            }
        }
        return d
    }, k.widget.bridge = function (b, a) {
        var c = a.prototype.widgetFullName || b;
        k.fn[b] = function (q) {
            var o = "string" == typeof q,
                    d = l.call(arguments, 1),
                    f = this;
            return q = !o && d.length ? k.widget.extend.apply(null, [q].concat(d)) : q, o ? this.each(function () {
                var m, n = k.data(this, c);
                return n ? k.isFunction(n[q]) && "_" !== q.charAt(0) ? (m = n[q].apply(n, d), m !== n && m !== e ? (f = m && m.jquery ? f.pushStack(m.get()) : m, !1) : e) : k.error("no such method '" + q + "' for " + b + " widget instance") : k.error("cannot call methods on " + b + " prior to initialization; attempted to call method '" + q + "'")
            }) : this.each(function () {
                var m = k.data(this, c);
                m ? m.option(q || {})._init() : k.data(this, c, new a(q, this))
            }), f
        }
    }, k.Widget = function () {
    }, k.Widget._childConstructors = [], k.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        defaultElement: "<div>",
        options: {
            disabled: !1,
            create: null
        },
        _createWidget: function (b, a) {
            a = k(a || this.defaultElement || this)[0], this.element = k(a), this.uuid = g++, this.eventNamespace = "." + this.widgetName + this.uuid, this.options = k.widget.extend({}, this.options, this._getCreateOptions(), b), this.bindings = k(), this.hoverable = k(), this.focusable = k(), a !== this && (k.data(a, this.widgetFullName, this), this._on(!0, this.element, {
                remove: function (c) {
                    c.target === a && this.destroy()
                }
            }), this.document = k(a.style ? a.ownerDocument : a.document || a), this.window = k(this.document[0].defaultView || this.document[0].parentWindow)), this._create(), this._trigger("create", null, this._getCreateEventData()), this._init()
        },
        _getCreateOptions: k.noop,
        _getCreateEventData: k.noop,
        _create: k.noop,
        _init: k.noop,
        destroy: function () {
            this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetName).removeData(this.widgetFullName).removeData(k.camelCase(this.widgetFullName)), this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled"), this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")
        },
        _destroy: k.noop,
        widget: function () {
            return this.element
        },
        option: function (f, d) {
            var a, n, c, b = f;
            if (0 === arguments.length) {
                return k.widget.extend({}, this.options)
            }
            if ("string" == typeof f) {
                if (b = {}, a = f.split("."), f = a.shift(), a.length) {
                    for (n = b[f] = k.widget.extend({}, this.options[f]), c = 0; a.length - 1 > c; c++) {
                        n[a[c]] = n[a[c]] || {}, n = n[a[c]]
                    }
                    if (f = a.pop(), d === e) {
                        return n[f] === e ? null : n[f]
                    }
                    n[f] = d
                } else {
                    if (d === e) {
                        return this.options[f] === e ? null : this.options[f]
                    }
                    b[f] = d
                }
            }
            return this._setOptions(b), this
        },
        _setOptions: function (a) {
            var b;
            for (b in a) {
                this._setOption(b, a[b])
            }
            return this
        },
        _setOption: function (a, b) {
            return this.options[a] = b, "disabled" === a && (this.widget().toggleClass(this.widgetFullName + "-disabled ui-state-disabled", !!b).attr("aria-disabled", b), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")), this
        },
        enable: function () {
            return this._setOption("disabled", !1)
        },
        disable: function () {
            return this._setOption("disabled", !0)
        },
        _on: function (d, c, a) {
            var f, b = this;
            "boolean" != typeof d && (a = c, c = d, d = !1), a ? (c = f = k(c), this.bindings = this.bindings.add(c)) : (a = c, c = this.element, f = this.widget()), k.each(a, function (o, w) {
                function x() {
                    return d || b.options.disabled !== !0 && !k(this).hasClass("ui-state-disabled") ? ("string" == typeof w ? b[w] : w).apply(b, arguments) : e
                }
                "string" != typeof w && (x.guid = w.guid = w.guid || x.guid || k.guid++);
                var n = o.match(/^(\w+)\s*(.*)$/),
                        y = n[1] + b.eventNamespace,
                        u = n[2];
                u ? f.delegate(u, y, x) : c.bind(y, x)
            })
        },
        _off: function (a, b) {
            b = (b || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, a.unbind(b).undelegate(b)
        },
        _delay: function (a, c) {
            function d() {
                return ("string" == typeof a ? b[a] : a).apply(b, arguments)
            }
            var b = this;
            return setTimeout(d, c || 0)
        },
        _hoverable: function (a) {
            this.hoverable = this.hoverable.add(a), this._on(a, {
                mouseenter: function (b) {
                    k(b.currentTarget).addClass("ui-state-hover")
                },
                mouseleave: function (b) {
                    k(b.currentTarget).removeClass("ui-state-hover")
                }
            })
        },
        _focusable: function (a) {
            this.focusable = this.focusable.add(a), this._on(a, {
                focusin: function (b) {
                    k(b.currentTarget).addClass("ui-state-focus")
                },
                focusout: function (b) {
                    k(b.currentTarget).removeClass("ui-state-focus")
                }
            })
        },
        _trigger: function (d, f, c) {
            var a, n, b = this.options[d];
            if (c = c || {}, f = k.Event(f), f.type = (d === this.widgetEventPrefix ? d : this.widgetEventPrefix + d).toLowerCase(), f.target = this.element[0], n = f.originalEvent) {
                for (a in n) {
                    a in f || (f[a] = n[a])
                }
            }
            return this.element.trigger(f, c), !(k.isFunction(b) && b.apply(this.element[0], [f].concat(c)) === !1 || f.isDefaultPrevented())
        }
    }, k.each({
        show: "fadeIn",
        hide: "fadeOut"
    }, function (a, b) {
        k.Widget.prototype["_" + a] = function (f, o, n) {
            "string" == typeof o && (o = {
                effect: o
            });
            var d, c = o ? o === !0 || "number" == typeof o ? b : o.effect || b : a;
            o = o || {}, "number" == typeof o && (o = {
                duration: o
            }), d = !k.isEmptyObject(o), o.complete = n, o.delay && f.delay(o.delay), d && k.effects && k.effects.effect[c] ? f[a](o) : c !== a && f[c] ? f[c](o.duration, o.easing, n) : f.queue(function (m) {
                k(this)[a](), n && n.call(f[0]), m()
            })
        }
    })
})(jQuery);
(function (c) {
    var d = !1;
    c(document).mouseup(function () {
        d = !1
    }), c.widget("ui.mouse", {
        version: "1.10.3",
        options: {
            cancel: "input,textarea,button,select,option",
            distance: 1,
            delay: 0
        },
        _mouseInit: function () {
            var a = this;
            this.element.bind("mousedown." + this.widgetName, function (b) {
                return a._mouseDown(b)
            }).bind("click." + this.widgetName, function (b) {
                return !0 === c.data(b.target, a.widgetName + ".preventClickEvent") ? (c.removeData(b.target, a.widgetName + ".preventClickEvent"), b.stopImmediatePropagation(), !1) : undefined
            }), this.started = !1
        },
        _mouseDestroy: function () {
            this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && c(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate)
        },
        _mouseDown: function (g) {
            if (!d) {
                this._mouseStarted && this._mouseUp(g), this._mouseDownEvent = g;
                var b = this,
                        a = 1 === g.which,
                        h = "string" == typeof this.options.cancel && g.target.nodeName ? c(g.target).closest(this.options.cancel).length : !1;
                return a && !h && this._mouseCapture(g) ? (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function () {
                    b.mouseDelayMet = !0
                }, this.options.delay)), this._mouseDistanceMet(g) && this._mouseDelayMet(g) && (this._mouseStarted = this._mouseStart(g) !== !1, !this._mouseStarted) ? (g.preventDefault(), !0) : (!0 === c.data(g.target, this.widgetName + ".preventClickEvent") && c.removeData(g.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function (e) {
                    return b._mouseMove(e)
                }, this._mouseUpDelegate = function (e) {
                    return b._mouseUp(e)
                }, c(document).bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), g.preventDefault(), d = !0, !0)) : !0
            }
        },
        _mouseMove: function (a) {
            return c.ui.ie && (!document.documentMode || 9 > document.documentMode) && !a.button ? this._mouseUp(a) : this._mouseStarted ? (this._mouseDrag(a), a.preventDefault()) : (this._mouseDistanceMet(a) && this._mouseDelayMet(a) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, a) !== !1, this._mouseStarted ? this._mouseDrag(a) : this._mouseUp(a)), !this._mouseStarted)
        },
        _mouseUp: function (a) {
            return c(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, a.target === this._mouseDownEvent.target && c.data(a.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(a)), !1
        },
        _mouseDistanceMet: function (a) {
            return Math.max(Math.abs(this._mouseDownEvent.pageX - a.pageX), Math.abs(this._mouseDownEvent.pageY - a.pageY)) >= this.options.distance
        },
        _mouseDelayMet: function () {
            return this.mouseDelayMet
        },
        _mouseStart: function () {
        },
        _mouseDrag: function () {
        },
        _mouseStop: function () {
        },
        _mouseCapture: function () {
            return !0
        }
    })
})(jQuery);
(function (H, o) {
    function u(k, g, b) {
        return [parseFloat(k[0]) * (n.test(k[0]) ? g / 100 : 1), parseFloat(k[1]) * (n.test(k[1]) ? b / 100 : 1)]
    }
    function G(g, b) {
        return parseInt(H.css(g, b), 10) || 0
    }
    function h(g) {
        var b = g[0];
        return 9 === b.nodeType ? {
            width: g.width(),
            height: g.height(),
            offset: {
                top: 0,
                left: 0
            }
        } : H.isWindow(b) ? {
            width: g.width(),
            height: g.height(),
            offset: {
                top: g.scrollTop(),
                left: g.scrollLeft()
            }
        } : b.preventDefault ? {
            width: 0,
            height: 0,
            offset: {
                top: b.pageY,
                left: b.pageX
            }
        } : {
            width: g.outerWidth(),
            height: g.outerHeight(),
            offset: g.offset()
        }
    }
    H.ui = H.ui || {};
    var d, l = Math.max,
            p = Math.abs,
            s = Math.round,
            c = /left|center|right/,
            e = /top|center|bottom/,
            a = /[\+\-]\d+(\.[\d]+)?%?/,
            f = /^\w+/,
            n = /%$/,
            r = H.fn.position;
    H.position = {
        scrollbarWidth: function () {
            if (d !== o) {
                return d
            }
            var b, m, g = H("<div style='display:block;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
                    k = g.children()[0];
            return H("body").append(g), b = k.offsetWidth, g.css("overflow", "scroll"), m = k.offsetWidth, b === m && (m = g[0].clientWidth), g.remove(), d = b - m
        },
        getScrollInfo: function (g) {
            var m = g.isWindow ? "" : g.element.css("overflow-x"),
                    k = g.isWindow ? "" : g.element.css("overflow-y"),
                    b = "scroll" === m || "auto" === m && g.width < g.element[0].scrollWidth,
                    q = "scroll" === k || "auto" === k && g.height < g.element[0].scrollHeight;
            return {
                width: q ? H.position.scrollbarWidth() : 0,
                height: b ? H.position.scrollbarWidth() : 0
            }
        },
        getWithinInfo: function (g) {
            var b = H(g || window),
                    k = H.isWindow(b[0]);
            return {
                element: b,
                isWindow: k,
                offset: b.offset() || {
                    left: 0,
                    top: 0
                },
                scrollLeft: b.scrollLeft(),
                scrollTop: b.scrollTop(),
                width: k ? b.width() : b.outerWidth(),
                height: k ? b.height() : b.outerHeight()
            }
        }
    }, H.fn.position = function (m) {
        if (!m || !m.of) {
            return r.apply(this, arguments)
        }
        m = H.extend({}, m);
        var C, x, w, q, y, g, B = H(m.of),
                k = H.position.getWithinInfo(m.within),
                A = H.position.getScrollInfo(k),
                b = (m.collision || "flip").split(" "),
                v = {};
        return g = h(B), B[0].preventDefault && (m.at = "left top"), x = g.width, w = g.height, q = g.offset, y = H.extend({}, q), H.each(["my", "at"], function () {
            var F, D, E = (m[this] || "").split(" ");
            1 === E.length && (E = c.test(E[0]) ? E.concat(["center"]) : e.test(E[0]) ? ["center"].concat(E) : ["center", "center"]), E[0] = c.test(E[0]) ? E[0] : "center", E[1] = e.test(E[1]) ? E[1] : "center", F = a.exec(E[0]), D = a.exec(E[1]), v[this] = [F ? F[0] : 0, D ? D[0] : 0], m[this] = [f.exec(E[0])[0], f.exec(E[1])[0]]
        }), 1 === b.length && (b[1] = b[0]), "right" === m.at[0] ? y.left += x : "center" === m.at[0] && (y.left += x / 2), "bottom" === m.at[1] ? y.top += w : "center" === m.at[1] && (y.top += w / 2), C = u(v.at, x, w), y.left += C[0], y.top += C[1], this.each(function () {
            var D, X, M = H(this),
                    E = M.outerWidth(),
                    S = M.outerHeight(),
                    U = G(this, "marginLeft"),
                    F = G(this, "marginTop"),
                    W = E + U + G(this, "marginRight") + A.width,
                    V = S + F + G(this, "marginBottom") + A.height,
                    R = H.extend({}, y),
                    T = u(v.my, M.outerWidth(), M.outerHeight());
            "right" === m.my[0] ? R.left -= E : "center" === m.my[0] && (R.left -= E / 2), "bottom" === m.my[1] ? R.top -= S : "center" === m.my[1] && (R.top -= S / 2), R.left += T[0], R.top += T[1], H.support.offsetFractions || (R.left = s(R.left), R.top = s(R.top)), D = {
                marginLeft: U,
                marginTop: F
            }, H.each(["left", "top"], function (J, I) {
                H.ui.position[b[J]] && H.ui.position[b[J]][I](R, {
                    targetWidth: x,
                    targetHeight: w,
                    elemWidth: E,
                    elemHeight: S,
                    collisionPosition: D,
                    collisionWidth: W,
                    collisionHeight: V,
                    offset: [C[0] + T[0], C[1] + T[1]],
                    my: m.my,
                    at: m.at,
                    within: k,
                    elem: M
                })
            }), m.using && (X = function (L) {
                var N = q.left - R.left,
                        J = N + x - E,
                        I = q.top - R.top,
                        O = I + w - S,
                        K = {
                            target: {
                                element: B,
                                left: q.left,
                                top: q.top,
                                width: x,
                                height: w
                            },
                            element: {
                                element: M,
                                left: R.left,
                                top: R.top,
                                width: E,
                                height: S
                            },
                            horizontal: 0 > J ? "left" : N > 0 ? "right" : "center",
                            vertical: 0 > O ? "top" : I > 0 ? "bottom" : "middle"
                        };
                E > x && x > p(N + J) && (K.horizontal = "center"), S > w && w > p(I + O) && (K.vertical = "middle"), K.important = l(p(N), p(J)) > l(p(I), p(O)) ? "horizontal" : "vertical", m.using.call(this, L, K)
            }), M.offset(H.extend(R, {
                using: X
            }))
        })
    }, H.ui.position = {
        fit: {
            left: function (w, y) {
                var g, v = y.within,
                        m = v.isWindow ? v.scrollLeft : v.offset.left,
                        x = v.width,
                        q = w.left - y.collisionPosition.marginLeft,
                        b = m - q,
                        k = q + y.collisionWidth - x - m;
                y.collisionWidth > x ? b > 0 && 0 >= k ? (g = w.left + b + y.collisionWidth - x - m, w.left += b - g) : w.left = k > 0 && 0 >= b ? m : b > k ? m + x - y.collisionWidth : m : b > 0 ? w.left += b : k > 0 ? w.left -= k : w.left = l(w.left - q, w.left)
            },
            top: function (w, y) {
                var g, v = y.within,
                        m = v.isWindow ? v.scrollTop : v.offset.top,
                        x = y.within.height,
                        q = w.top - y.collisionPosition.marginTop,
                        b = m - q,
                        k = q + y.collisionHeight - x - m;
                y.collisionHeight > x ? b > 0 && 0 >= k ? (g = w.top + b + y.collisionHeight - x - m, w.top += b - g) : w.top = k > 0 && 0 >= b ? m : b > k ? m + x - y.collisionHeight : m : b > 0 ? w.top += b : k > 0 ? w.top -= k : w.top = l(w.top - q, w.top)
            }
        },
        flip: {
            left: function (k, x) {
                var B, g, D = x.within,
                        q = D.offset.left + D.scrollLeft,
                        E = D.width,
                        A = D.isWindow ? D.scrollLeft : D.offset.left,
                        C = k.left - x.collisionPosition.marginLeft,
                        v = C - A,
                        m = C + x.collisionWidth - E - A,
                        w = "left" === x.my[0] ? -x.elemWidth : "right" === x.my[0] ? x.elemWidth : 0,
                        b = "left" === x.at[0] ? x.targetWidth : "right" === x.at[0] ? -x.targetWidth : 0,
                        y = -2 * x.offset[0];
                0 > v ? (B = k.left + w + b + y + x.collisionWidth - E - q, (0 > B || p(v) > B) && (k.left += w + b + y)) : m > 0 && (g = k.left - x.collisionPosition.marginLeft + w + b + y - A, (g > 0 || m > p(g)) && (k.left += w + b + y))
            },
            top: function (k, x) {
                var B, g, E = x.within,
                        q = E.offset.top + E.scrollTop,
                        F = E.height,
                        A = E.isWindow ? E.scrollTop : E.offset.top,
                        C = k.top - x.collisionPosition.marginTop,
                        v = C - A,
                        m = C + x.collisionHeight - F - A,
                        w = "top" === x.my[1],
                        b = w ? -x.elemHeight : "bottom" === x.my[1] ? x.elemHeight : 0,
                        y = "top" === x.at[1] ? x.targetHeight : "bottom" === x.at[1] ? -x.targetHeight : 0,
                        D = -2 * x.offset[1];
                0 > v ? (g = k.top + b + y + D + x.collisionHeight - F - q, k.top + b + y + D > v && (0 > g || p(v) > g) && (k.top += b + y + D)) : m > 0 && (B = k.top - x.collisionPosition.marginTop + b + y + D - A, k.top + b + y + D > m && (B > 0 || m > p(B)) && (k.top += b + y + D))
            }
        },
        flipfit: {
            left: function () {
                H.ui.position.flip.left.apply(this, arguments), H.ui.position.fit.left.apply(this, arguments)
            },
            top: function () {
                H.ui.position.flip.top.apply(this, arguments), H.ui.position.fit.top.apply(this, arguments)
            }
        }
    },
    function () {
        var b, v, m, g, w, q = document.getElementsByTagName("body")[0],
                k = document.createElement("div");
        b = document.createElement(q ? "div" : "body"), m = {
            visibility: "hidden",
            width: 0,
            height: 0,
            border: 0,
            margin: 0,
            background: "none"
        }, q && H.extend(m, {
            position: "absolute",
            left: "-1000px",
            top: "-1000px"
        });
        for (w in m) {
            b.style[w] = m[w]
        }
        b.appendChild(k), v = q || document.documentElement, v.insertBefore(b, v.firstChild), k.style.cssText = "position: absolute; left: 10.7432222px;", g = H(k).offset().left, H.support.offsetFractions = g > 10 && 11 > g, b.innerHTML = "", v.removeChild(b)
    }()
})(jQuery);
(function (b) {
    b.widget("ui.draggable", b.ui.mouse, {
        version: "1.10.3",
        widgetEventPrefix: "drag",
        options: {
            addClasses: !0,
            appendTo: "parent",
            axis: !1,
            connectToSortable: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            iframeFix: !1,
            opacity: !1,
            refreshPositions: !1,
            revert: !1,
            revertDuration: 500,
            scope: "default",
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            snap: !1,
            snapMode: "both",
            snapTolerance: 20,
            stack: !1,
            zIndex: !1,
            drag: null,
            start: null,
            stop: null
        },
        _create: function () {
            "original" !== this.options.helper || /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative"), this.options.addClasses && this.element.addClass("ui-draggable"), this.options.disabled && this.element.addClass("ui-draggable-disabled"), this._mouseInit()
        },
        _destroy: function () {
            this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"), this._mouseDestroy()
        },
        _mouseCapture: function (d) {
            var a = this.options;
            return this.helper || a.disabled || b(d.target).closest(".ui-resizable-handle").length > 0 ? !1 : (this.handle = this._getHandle(d), this.handle ? (b(a.iframeFix === !0 ? "iframe" : a.iframeFix).each(function () {
                b("<div class='ui-draggable-iframeFix' style='background: #fff;'></div>").css({
                    width: this.offsetWidth + "px",
                    height: this.offsetHeight + "px",
                    position: "absolute",
                    opacity: "0.001",
                    zIndex: 1000
                }).css(b(this).offset()).appendTo("body")
            }), !0) : !1)
        },
        _mouseStart: function (d) {
            var a = this.options;
            return this.helper = this._createHelper(d), this.helper.addClass("ui-draggable-dragging"), this._cacheHelperProportions(), b.ui.ddmanager && (b.ui.ddmanager.current = this), this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(), this.offsetParent = this.helper.offsetParent(), this.offsetParentCssPosition = this.offsetParent.css("position"), this.offset = this.positionAbs = this.element.offset(), this.offset = {
                top: this.offset.top - this.margins.top,
                left: this.offset.left - this.margins.left
            }, this.offset.scroll = !1, b.extend(this.offset, {
                click: {
                    left: d.pageX - this.offset.left,
                    top: d.pageY - this.offset.top
                },
                parent: this._getParentOffset(),
                relative: this._getRelativeOffset()
            }), this.originalPosition = this.position = this._generatePosition(d), this.originalPageX = d.pageX, this.originalPageY = d.pageY, a.cursorAt && this._adjustOffsetFromHelper(a.cursorAt), this._setContainment(), this._trigger("start", d) === !1 ? (this._clear(), !1) : (this._cacheHelperProportions(), b.ui.ddmanager && !a.dropBehaviour && b.ui.ddmanager.prepareOffsets(this, d), this._mouseDrag(d, !0), b.ui.ddmanager && b.ui.ddmanager.dragStart(this, d), !0)
        },
        _mouseDrag: function (f, a) {
            if ("fixed" === this.offsetParentCssPosition && (this.offset.parent = this._getParentOffset()), this.position = this._generatePosition(f), this.positionAbs = this._convertPositionTo("absolute"), !a) {
                var e = this._uiHash();
                if (this._trigger("drag", f, e) === !1) {
                    return this._mouseUp({}), !1
                }
                this.position = e.position
            }
            return this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), b.ui.ddmanager && b.ui.ddmanager.drag(this, f), !1
        },
        _mouseStop: function (f) {
            var a = this,
                    e = !1;
            return b.ui.ddmanager && !this.options.dropBehaviour && (e = b.ui.ddmanager.drop(this, f)), this.dropped && (e = this.dropped, this.dropped = !1), "original" !== this.options.helper || b.contains(this.element[0].ownerDocument, this.element[0]) ? ("invalid" === this.options.revert && !e || "valid" === this.options.revert && e || this.options.revert === !0 || b.isFunction(this.options.revert) && this.options.revert.call(this.element, e) ? b(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function () {
                a._trigger("stop", f) !== !1 && a._clear()
            }) : this._trigger("stop", f) !== !1 && this._clear(), !1) : !1
        },
        _mouseUp: function (a) {
            return b("div.ui-draggable-iframeFix").each(function () {
                this.parentNode.removeChild(this)
            }), b.ui.ddmanager && b.ui.ddmanager.dragStop(this, a), b.ui.mouse.prototype._mouseUp.call(this, a)
        },
        cancel: function () {
            return this.helper.is(".ui-draggable-dragging") ? this._mouseUp({}) : this._clear(), this
        },
        _getHandle: function (a) {
            return this.options.handle ? !!b(a.target).closest(this.element.find(this.options.handle)).length : !0
        },
        _createHelper: function (f) {
            var a = this.options,
                    e = b.isFunction(a.helper) ? b(a.helper.apply(this.element[0], [f])) : "clone" === a.helper ? this.element.clone().removeAttr("id") : this.element;
            return e.parents("body").length || e.appendTo("parent" === a.appendTo ? this.element[0].parentNode : a.appendTo), e[0] === this.element[0] || /(fixed|absolute)/.test(e.css("position")) || e.css("position", "absolute"), e
        },
        _adjustOffsetFromHelper: function (a) {
            "string" == typeof a && (a = a.split(" ")), b.isArray(a) && (a = {
                left: +a[0],
                top: +a[1] || 0
            }), "left" in a && (this.offset.click.left = a.left + this.margins.left), "right" in a && (this.offset.click.left = this.helperProportions.width - a.right + this.margins.left), "top" in a && (this.offset.click.top = a.top + this.margins.top), "bottom" in a && (this.offset.click.top = this.helperProportions.height - a.bottom + this.margins.top)
        },
        _getParentOffset: function () {
            var a = this.offsetParent.offset();
            return "absolute" === this.cssPosition && this.scrollParent[0] !== document && b.contains(this.scrollParent[0], this.offsetParent[0]) && (a.left += this.scrollParent.scrollLeft(), a.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && b.ui.ie) && (a = {
                top: 0,
                left: 0
            }), {
                top: a.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: a.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function () {
            if ("relative" === this.cssPosition) {
                var a = this.element.position();
                return {
                    top: a.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                    left: a.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
                }
            }
            return {
                top: 0,
                left: 0
            }
        },
        _cacheMargins: function () {
            this.margins = {
                left: parseInt(this.element.css("marginLeft"), 10) || 0,
                top: parseInt(this.element.css("marginTop"), 10) || 0,
                right: parseInt(this.element.css("marginRight"), 10) || 0,
                bottom: parseInt(this.element.css("marginBottom"), 10) || 0
            }
        },
        _cacheHelperProportions: function () {
            this.helperProportions = {
                width: this.helper.outerWidth(),
                height: this.helper.outerHeight()
            }
        },
        _setContainment: function () {
            var h, a, g, f = this.options;
            return f.containment ? "window" === f.containment ? (this.containment = [b(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, b(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, b(window).scrollLeft() + b(window).width() - this.helperProportions.width - this.margins.left, b(window).scrollTop() + (b(window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top], undefined) : "document" === f.containment ? (this.containment = [0, 0, b(document).width() - this.helperProportions.width - this.margins.left, (b(document).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top], undefined) : f.containment.constructor === Array ? (this.containment = f.containment, undefined) : ("parent" === f.containment && (f.containment = this.helper[0].parentNode), a = b(f.containment), g = a[0], g && (h = "hidden" !== a.css("overflow"), this.containment = [(parseInt(a.css("borderLeftWidth"), 10) || 0) + (parseInt(a.css("paddingLeft"), 10) || 0), (parseInt(a.css("borderTopWidth"), 10) || 0) + (parseInt(a.css("paddingTop"), 10) || 0), (h ? Math.max(g.scrollWidth, g.offsetWidth) : g.offsetWidth) - (parseInt(a.css("borderRightWidth"), 10) || 0) - (parseInt(a.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (h ? Math.max(g.scrollHeight, g.offsetHeight) : g.offsetHeight) - (parseInt(a.css("borderBottomWidth"), 10) || 0) - (parseInt(a.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom], this.relative_container = a), undefined) : (this.containment = null, undefined)
        },
        _convertPositionTo: function (h, a) {
            a || (a = this.position);
            var g = "absolute" === h ? 1 : -1,
                    f = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && b.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent;
            return this.offset.scroll || (this.offset.scroll = {
                top: f.scrollTop(),
                left: f.scrollLeft()
            }), {
                top: a.top + this.offset.relative.top * g + this.offset.parent.top * g - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : this.offset.scroll.top) * g,
                left: a.left + this.offset.relative.left * g + this.offset.parent.left * g - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : this.offset.scroll.left) * g
            }
        },
        _generatePosition: function (h) {
            var o, a, r, l, s = this.options,
                    u = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && b.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                    n = h.pageX,
                    q = h.pageY;
            return this.offset.scroll || (this.offset.scroll = {
                top: u.scrollTop(),
                left: u.scrollLeft()
            }), this.originalPosition && (this.containment && (this.relative_container ? (a = this.relative_container.offset(), o = [this.containment[0] + a.left, this.containment[1] + a.top, this.containment[2] + a.left, this.containment[3] + a.top]) : o = this.containment, h.pageX - this.offset.click.left < o[0] && (n = o[0] + this.offset.click.left), h.pageY - this.offset.click.top < o[1] && (q = o[1] + this.offset.click.top), h.pageX - this.offset.click.left > o[2] && (n = o[2] + this.offset.click.left), h.pageY - this.offset.click.top > o[3] && (q = o[3] + this.offset.click.top)), s.grid && (r = s.grid[1] ? this.originalPageY + Math.round((q - this.originalPageY) / s.grid[1]) * s.grid[1] : this.originalPageY, q = o ? r - this.offset.click.top >= o[1] || r - this.offset.click.top > o[3] ? r : r - this.offset.click.top >= o[1] ? r - s.grid[1] : r + s.grid[1] : r, l = s.grid[0] ? this.originalPageX + Math.round((n - this.originalPageX) / s.grid[0]) * s.grid[0] : this.originalPageX, n = o ? l - this.offset.click.left >= o[0] || l - this.offset.click.left > o[2] ? l : l - this.offset.click.left >= o[0] ? l - s.grid[0] : l + s.grid[0] : l)), {
                top: q - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : this.offset.scroll.top),
                left: n - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : this.offset.scroll.left)
            }
        },
        _clear: function () {
            this.helper.removeClass("ui-draggable-dragging"), this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(), this.helper = null, this.cancelHelperRemoval = !1
        },
        _trigger: function (f, a, e) {
            return e = e || this._uiHash(), b.ui.plugin.call(this, f, [a, e]), "drag" === f && (this.positionAbs = this._convertPositionTo("absolute")), b.Widget.prototype._trigger.call(this, f, a, e)
        },
        plugins: {},
        _uiHash: function () {
            return {
                helper: this.helper,
                position: this.position,
                originalPosition: this.originalPosition,
                offset: this.positionAbs
            }
        }
    }), b.ui.plugin.add("draggable", "connectToSortable", {
        start: function (k, l) {
            var h = b(this).data("ui-draggable"),
                    g = h.options,
                    a = b.extend({}, l, {
                        item: h.element
                    });
            h.sortables = [], b(g.connectToSortable).each(function () {
                var c = b.data(this, "ui-sortable");
                c && !c.options.disabled && (h.sortables.push({
                    instance: c,
                    shouldRevert: c.options.revert
                }), c.refreshPositions(), c._trigger("activate", k, a))
            })
        },
        stop: function (h, a) {
            var g = b(this).data("ui-draggable"),
                    f = b.extend({}, a, {
                        item: g.element
                    });
            b.each(g.sortables, function () {
                this.instance.isOver ? (this.instance.isOver = 0, g.cancelHelperRemoval = !0, this.instance.cancelHelperRemoval = !1, this.shouldRevert && (this.instance.options.revert = this.shouldRevert), this.instance._mouseStop(h), this.instance.options.helper = this.instance.options._helper, "original" === g.options.helper && this.instance.currentItem.css({
                    top: "auto",
                    left: "auto"
                })) : (this.instance.cancelHelperRemoval = !1, this.instance._trigger("deactivate", h, f))
            })
        },
        drag: function (h, a) {
            var g = b(this).data("ui-draggable"),
                    f = this;
            b.each(g.sortables, function () {
                var d = !1,
                        c = this;
                this.instance.positionAbs = g.positionAbs, this.instance.helperProportions = g.helperProportions, this.instance.offset.click = g.offset.click, this.instance._intersectsWith(this.instance.containerCache) && (d = !0, b.each(g.sortables, function () {
                    return this.instance.positionAbs = g.positionAbs, this.instance.helperProportions = g.helperProportions, this.instance.offset.click = g.offset.click, this !== c && this.instance._intersectsWith(this.instance.containerCache) && b.contains(c.instance.element[0], this.instance.element[0]) && (d = !1), d
                })), d ? (this.instance.isOver || (this.instance.isOver = 1, this.instance.currentItem = b(f).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item", !0), this.instance.options._helper = this.instance.options.helper, this.instance.options.helper = function () {
                    return a.helper[0]
                }, h.target = this.instance.currentItem[0], this.instance._mouseCapture(h, !0), this.instance._mouseStart(h, !0, !0), this.instance.offset.click.top = g.offset.click.top, this.instance.offset.click.left = g.offset.click.left, this.instance.offset.parent.left -= g.offset.parent.left - this.instance.offset.parent.left, this.instance.offset.parent.top -= g.offset.parent.top - this.instance.offset.parent.top, g._trigger("toSortable", h), g.dropped = this.instance.element, g.currentItem = g.element, this.instance.fromOutside = g), this.instance.currentItem && this.instance._mouseDrag(h)) : this.instance.isOver && (this.instance.isOver = 0, this.instance.cancelHelperRemoval = !0, this.instance.options.revert = !1, this.instance._trigger("out", h, this.instance._uiHash(this.instance)), this.instance._mouseStop(h, !0), this.instance.options.helper = this.instance.options._helper, this.instance.currentItem.remove(), this.instance.placeholder && this.instance.placeholder.remove(), g._trigger("fromSortable", h), g.dropped = !1)
            })
        }
    }), b.ui.plugin.add("draggable", "cursor", {
        start: function () {
            var d = b("body"),
                    a = b(this).data("ui-draggable").options;
            d.css("cursor") && (a._cursor = d.css("cursor")), d.css("cursor", a.cursor)
        },
        stop: function () {
            var a = b(this).data("ui-draggable").options;
            a._cursor && b("body").css("cursor", a._cursor)
        }
    }), b.ui.plugin.add("draggable", "opacity", {
        start: function (h, a) {
            var g = b(a.helper),
                    f = b(this).data("ui-draggable").options;
            g.css("opacity") && (f._opacity = g.css("opacity")), g.css("opacity", f.opacity)
        },
        stop: function (f, a) {
            var e = b(this).data("ui-draggable").options;
            e._opacity && b(a.helper).css("opacity", e._opacity)
        }
    }), b.ui.plugin.add("draggable", "scroll", {
        start: function () {
            var a = b(this).data("ui-draggable");
            a.scrollParent[0] !== document && "HTML" !== a.scrollParent[0].tagName && (a.overflowOffset = a.scrollParent.offset())
        },
        drag: function (h) {
            var a = b(this).data("ui-draggable"),
                    g = a.options,
                    f = !1;
            a.scrollParent[0] !== document && "HTML" !== a.scrollParent[0].tagName ? (g.axis && "x" === g.axis || (a.overflowOffset.top + a.scrollParent[0].offsetHeight - h.pageY < g.scrollSensitivity ? a.scrollParent[0].scrollTop = f = a.scrollParent[0].scrollTop + g.scrollSpeed : h.pageY - a.overflowOffset.top < g.scrollSensitivity && (a.scrollParent[0].scrollTop = f = a.scrollParent[0].scrollTop - g.scrollSpeed)), g.axis && "y" === g.axis || (a.overflowOffset.left + a.scrollParent[0].offsetWidth - h.pageX < g.scrollSensitivity ? a.scrollParent[0].scrollLeft = f = a.scrollParent[0].scrollLeft + g.scrollSpeed : h.pageX - a.overflowOffset.left < g.scrollSensitivity && (a.scrollParent[0].scrollLeft = f = a.scrollParent[0].scrollLeft - g.scrollSpeed))) : (g.axis && "x" === g.axis || (h.pageY - b(document).scrollTop() < g.scrollSensitivity ? f = b(document).scrollTop(b(document).scrollTop() - g.scrollSpeed) : b(window).height() - (h.pageY - b(document).scrollTop()) < g.scrollSensitivity && (f = b(document).scrollTop(b(document).scrollTop() + g.scrollSpeed))), g.axis && "y" === g.axis || (h.pageX - b(document).scrollLeft() < g.scrollSensitivity ? f = b(document).scrollLeft(b(document).scrollLeft() - g.scrollSpeed) : b(window).width() - (h.pageX - b(document).scrollLeft()) < g.scrollSensitivity && (f = b(document).scrollLeft(b(document).scrollLeft() + g.scrollSpeed)))), f !== !1 && b.ui.ddmanager && !g.dropBehaviour && b.ui.ddmanager.prepareOffsets(a, h)
        }
    }), b.ui.plugin.add("draggable", "snap", {
        start: function () {
            var d = b(this).data("ui-draggable"),
                    a = d.options;
            d.snapElements = [], b(a.snap.constructor !== String ? a.snap.items || ":data(ui-draggable)" : a.snap).each(function () {
                var f = b(this),
                        c = f.offset();
                this !== d.element[0] && d.snapElements.push({
                    item: this,
                    width: f.outerWidth(),
                    height: f.outerHeight(),
                    top: c.top,
                    left: c.left
                })
            })
        },
        drag: function (n, o) {
            var l, s, a, u, O, m, p, y, d, f, v = b(this).data("ui-draggable"),
                    g = v.options,
                    r = g.snapTolerance,
                    h = o.offset.left,
                    P = h + v.helperProportions.width,
                    c = o.offset.top,
                    Q = c + v.helperProportions.height;
            for (d = v.snapElements.length - 1; d >= 0; d--) {
                O = v.snapElements[d].left, m = O + v.snapElements[d].width, p = v.snapElements[d].top, y = p + v.snapElements[d].height, O - r > P || h > m + r || p - r > Q || c > y + r || !b.contains(v.snapElements[d].item.ownerDocument, v.snapElements[d].item) ? (v.snapElements[d].snapping && v.options.snap.release && v.options.snap.release.call(v.element, n, b.extend(v._uiHash(), {
                    snapItem: v.snapElements[d].item
                })), v.snapElements[d].snapping = !1) : ("inner" !== g.snapMode && (l = r >= Math.abs(p - Q), s = r >= Math.abs(y - c), a = r >= Math.abs(O - P), u = r >= Math.abs(m - h), l && (o.position.top = v._convertPositionTo("relative", {
                    top: p - v.helperProportions.height,
                    left: 0
                }).top - v.margins.top), s && (o.position.top = v._convertPositionTo("relative", {
                    top: y,
                    left: 0
                }).top - v.margins.top), a && (o.position.left = v._convertPositionTo("relative", {
                    top: 0,
                    left: O - v.helperProportions.width
                }).left - v.margins.left), u && (o.position.left = v._convertPositionTo("relative", {
                    top: 0,
                    left: m
                }).left - v.margins.left)), f = l || s || a || u, "outer" !== g.snapMode && (l = r >= Math.abs(p - c), s = r >= Math.abs(y - Q), a = r >= Math.abs(O - h), u = r >= Math.abs(m - P), l && (o.position.top = v._convertPositionTo("relative", {
                    top: p,
                    left: 0
                }).top - v.margins.top), s && (o.position.top = v._convertPositionTo("relative", {
                    top: y - v.helperProportions.height,
                    left: 0
                }).top - v.margins.top), a && (o.position.left = v._convertPositionTo("relative", {
                    top: 0,
                    left: O
                }).left - v.margins.left), u && (o.position.left = v._convertPositionTo("relative", {
                    top: 0,
                    left: m - v.helperProportions.width
                }).left - v.margins.left)), !v.snapElements[d].snapping && (l || s || a || u || f) && v.options.snap.snap && v.options.snap.snap.call(v.element, n, b.extend(v._uiHash(), {
                    snapItem: v.snapElements[d].item
                })), v.snapElements[d].snapping = l || s || a || u || f)
            }
        }
    }), b.ui.plugin.add("draggable", "stack", {
        start: function () {
            var f, a = this.data("ui-draggable").options,
                    e = b.makeArray(b(a.stack)).sort(function (c, d) {
                return (parseInt(b(c).css("zIndex"), 10) || 0) - (parseInt(b(d).css("zIndex"), 10) || 0)
            });
            e.length && (f = parseInt(b(e[0]).css("zIndex"), 10) || 0, b(e).each(function (c) {
                b(this).css("zIndex", f + c)
            }), this.css("zIndex", f + e.length))
        }
    }), b.ui.plugin.add("draggable", "zIndex", {
        start: function (h, a) {
            var g = b(a.helper),
                    f = b(this).data("ui-draggable").options;
            g.css("zIndex") && (f._zIndex = g.css("zIndex")), g.css("zIndex", f.zIndex)
        },
        stop: function (f, a) {
            var e = b(this).data("ui-draggable").options;
            e._zIndex && b(a.helper).css("zIndex", e._zIndex)
        }
    })
})(jQuery);
(function (c) {
    function d(a, b, e) {
        return a > b && b + e > a
    }
    c.widget("ui.droppable", {
        version: "1.10.3",
        widgetEventPrefix: "drop",
        options: {
            accept: "*",
            activeClass: !1,
            addClasses: !0,
            greedy: !1,
            hoverClass: !1,
            scope: "default",
            tolerance: "intersect",
            activate: null,
            deactivate: null,
            drop: null,
            out: null,
            over: null
        },
        _create: function () {
            var a = this.options,
                    b = a.accept;
            this.isover = !1, this.isout = !0, this.accept = c.isFunction(b) ? b : function (e) {
                return e.is(b)
            }, this.proportions = {
                width: this.element[0].offsetWidth,
                height: this.element[0].offsetHeight
            }, c.ui.ddmanager.droppables[a.scope] = c.ui.ddmanager.droppables[a.scope] || [], c.ui.ddmanager.droppables[a.scope].push(this), a.addClasses && this.element.addClass("ui-droppable")
        },
        _destroy: function () {
            for (var a = 0, b = c.ui.ddmanager.droppables[this.options.scope]; b.length > a; a++) {
                b[a] === this && b.splice(a, 1)
            }
            this.element.removeClass("ui-droppable ui-droppable-disabled")
        },
        _setOption: function (a, b) {
            "accept" === a && (this.accept = c.isFunction(b) ? b : function (e) {
                return e.is(b)
            }), c.Widget.prototype._setOption.apply(this, arguments)
        },
        _activate: function (a) {
            var b = c.ui.ddmanager.current;
            this.options.activeClass && this.element.addClass(this.options.activeClass), b && this._trigger("activate", a, this.ui(b))
        },
        _deactivate: function (a) {
            var b = c.ui.ddmanager.current;
            this.options.activeClass && this.element.removeClass(this.options.activeClass), b && this._trigger("deactivate", a, this.ui(b))
        },
        _over: function (a) {
            var b = c.ui.ddmanager.current;
            b && (b.currentItem || b.element)[0] !== this.element[0] && this.accept.call(this.element[0], b.currentItem || b.element) && (this.options.hoverClass && this.element.addClass(this.options.hoverClass), this._trigger("over", a, this.ui(b)))
        },
        _out: function (a) {
            var b = c.ui.ddmanager.current;
            b && (b.currentItem || b.element)[0] !== this.element[0] && this.accept.call(this.element[0], b.currentItem || b.element) && (this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("out", a, this.ui(b)))
        },
        _drop: function (g, h) {
            var b = h || c.ui.ddmanager.current,
                    a = !1;
            return b && (b.currentItem || b.element)[0] !== this.element[0] ? (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function () {
                var e = c.data(this, "ui-droppable");
                return e.options.greedy && !e.options.disabled && e.options.scope === b.options.scope && e.accept.call(e.element[0], b.currentItem || b.element) && c.ui.intersect(b, c.extend(e, {
                    offset: e.element.offset()
                }), e.options.tolerance) ? (a = !0, !1) : undefined
            }), a ? !1 : this.accept.call(this.element[0], b.currentItem || b.element) ? (this.options.activeClass && this.element.removeClass(this.options.activeClass), this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("drop", g, this.ui(b)), this.element) : !1) : !1
        },
        ui: function (a) {
            return {
                draggable: a.currentItem || a.element,
                helper: a.helper,
                position: a.position,
                offset: a.positionAbs
            }
        }
    }), c.ui.intersect = function (u, F, a) {
        if (!F.offset) {
            return !1
        }
        var n, h, o = (u.positionAbs || u.position.absolute).left,
                r = o + u.helperProportions.width,
                E = (u.positionAbs || u.position.absolute).top,
                e = E + u.helperProportions.height,
                b = F.offset.left,
                l = b + F.proportions.width,
                s = F.offset.top,
                p = s + F.proportions.height;
        switch (a) {
            case "fit":
                return o >= b && l >= r && E >= s && p >= e;
            case "intersect":
                return o + u.helperProportions.width / 2 > b && l > r - u.helperProportions.width / 2 && E + u.helperProportions.height / 2 > s && p > e - u.helperProportions.height / 2;
            case "pointer":
                return n = (u.positionAbs || u.position.absolute).left + (u.clickOffset || u.offset.click).left, h = (u.positionAbs || u.position.absolute).top + (u.clickOffset || u.offset.click).top, d(h, s, F.proportions.height) && d(n, b, F.proportions.width);
            case "touch":
                return (E >= s && p >= E || e >= s && p >= e || s > E && e > p) && (o >= b && l >= o || r >= b && l >= r || b > o && r > l);
            default:
                return !1
        }
    }, c.ui.ddmanager = {
        current: null,
        droppables: {
            "default": []
        },
        prepareOffsets: function (n, o) {
            var m, a, p = c.ui.ddmanager.droppables[n.options.scope] || [],
                    b = o ? o.type : null,
                    l = (n.currentItem || n.element).find(":data(ui-droppable)").addBack();
            c: for (m = 0; p.length > m; m++) {
                if (!(p[m].options.disabled || n && !p[m].accept.call(p[m].element[0], n.currentItem || n.element))) {
                    for (a = 0; l.length > a; a++) {
                        if (l[a] === p[m].element[0]) {
                            p[m].proportions.height = 0;
                            continue c
                        }
                    }
                    p[m].visible = "none" !== p[m].element.css("display"), p[m].visible && ("mousedown" === b && p[m]._activate.call(p[m], o), p[m].offset = p[m].element.offset(), p[m].proportions = {
                        width: p[m].element[0].offsetWidth,
                        height: p[m].element[0].offsetHeight
                    })
                }
            }
        },
        drop: function (b, f) {
            var a = !1;
            return c.each((c.ui.ddmanager.droppables[b.options.scope] || []).slice(), function () {
                this.options && (!this.options.disabled && this.visible && c.ui.intersect(b, this, this.options.tolerance) && (a = this._drop.call(this, f) || a), !this.options.disabled && this.visible && this.accept.call(this.element[0], b.currentItem || b.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this, f)))
            }), a
        },
        dragStart: function (a, b) {
            a.element.parentsUntil("body").bind("scroll.droppable", function () {
                a.options.refreshPositions || c.ui.ddmanager.prepareOffsets(a, b)
            })
        },
        drag: function (a, b) {
            a.options.refreshPositions && c.ui.ddmanager.prepareOffsets(a, b), c.each(c.ui.ddmanager.droppables[a.options.scope] || [], function () {
                if (!this.options.disabled && !this.greedyChild && this.visible) {
                    var o, l, p, m = c.ui.intersect(a, this, this.options.tolerance),
                            n = !m && this.isover ? "isout" : m && !this.isover ? "isover" : null;
                    n && (this.options.greedy && (l = this.options.scope, p = this.element.parents(":data(ui-droppable)").filter(function () {
                        return c.data(this, "ui-droppable").options.scope === l
                    }), p.length && (o = c.data(p[0], "ui-droppable"), o.greedyChild = "isover" === n)), o && "isover" === n && (o.isover = !1, o.isout = !0, o._out.call(o, b)), this[n] = !0, this["isout" === n ? "isover" : "isout"] = !1, this["isover" === n ? "_over" : "_out"].call(this, b), o && "isout" === n && (o.isout = !1, o.isover = !0, o._over.call(o, b)))
                }
            })
        },
        dragStop: function (a, b) {
            a.element.parentsUntil("body").unbind("scroll.droppable"), a.options.refreshPositions || c.ui.ddmanager.prepareOffsets(a, b)
        }
    }
})(jQuery);
(function (f) {
    function d(a) {
        return parseInt(a, 10) || 0
    }
    function e(a) {
        return !isNaN(parseInt(a, 10))
    }
    f.widget("ui.resizable", f.ui.mouse, {
        version: "1.10.3",
        widgetEventPrefix: "resize",
        options: {
            alsoResize: !1,
            animate: !1,
            animateDuration: "slow",
            animateEasing: "swing",
            aspectRatio: !1,
            autoHide: !1,
            containment: !1,
            ghost: !1,
            grid: !1,
            handles: "e,s,se",
            helper: !1,
            maxHeight: null,
            maxWidth: null,
            minHeight: 10,
            minWidth: 10,
            zIndex: 90,
            resize: null,
            start: null,
            stop: null
        },
        _create: function () {
            var n, o, m, a, p, b = this,
                    c = this.options;
            if (this.element.addClass("ui-resizable"), f.extend(this, {
                _aspectRatio: !!c.aspectRatio,
                aspectRatio: c.aspectRatio,
                originalElement: this.element,
                _proportionallyResizeElements: [],
                _helper: c.helper || c.ghost || c.animate ? c.helper || "ui-resizable-helper" : null
            }), this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i) && (this.element.wrap(f("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
                position: this.element.css("position"),
                width: this.element.outerWidth(),
                height: this.element.outerHeight(),
                top: this.element.css("top"),
                left: this.element.css("left")
            })), this.element = this.element.parent().data("ui-resizable", this.element.data("ui-resizable")), this.elementIsWrapper = !0, this.element.css({
                marginLeft: this.originalElement.css("marginLeft"),
                marginTop: this.originalElement.css("marginTop"),
                marginRight: this.originalElement.css("marginRight"),
                marginBottom: this.originalElement.css("marginBottom")
            }), this.originalElement.css({
                marginLeft: 0,
                marginTop: 0,
                marginRight: 0,
                marginBottom: 0
            }), this.originalResizeStyle = this.originalElement.css("resize"), this.originalElement.css("resize", "none"), this._proportionallyResizeElements.push(this.originalElement.css({
                position: "static",
                zoom: 1,
                display: "block"
            })), this.originalElement.css({
                margin: this.originalElement.css("margin")
            }), this._proportionallyResize()), this.handles = c.handles || (f(".ui-resizable-handle", this.element).length ? {
                n: ".ui-resizable-n",
                e: ".ui-resizable-e",
                s: ".ui-resizable-s",
                w: ".ui-resizable-w",
                se: ".ui-resizable-se",
                sw: ".ui-resizable-sw",
                ne: ".ui-resizable-ne",
                nw: ".ui-resizable-nw"
            } : "e,s,se"), this.handles.constructor === String) {
                for ("all" === this.handles && (this.handles = "n,e,s,w,se,sw,ne,nw"), n = this.handles.split(","), this.handles = {}, o = 0; n.length > o; o++) {
                    m = f.trim(n[o]), p = "ui-resizable-" + m, a = f("<div class='ui-resizable-handle " + p + "'></div>"), a.css({
                        zIndex: c.zIndex
                    }), "se" === m && a.addClass("ui-icon ui-icon-gripsmall-diagonal-se"), this.handles[m] = ".ui-resizable-" + m, this.element.append(a)
                }
            }
            this._renderAxis = function (l) {
                var s, k, h, g;
                l = l || this.element;
                for (s in this.handles) {
                    this.handles[s].constructor === String && (this.handles[s] = f(this.handles[s], this.element).show()), this.elementIsWrapper && this.originalElement[0].nodeName.match(/textarea|input|select|button/i) && (k = f(this.handles[s], this.element), g = /sw|ne|nw|se|n|s/.test(s) ? k.outerHeight() : k.outerWidth(), h = ["padding", /ne|nw|n/.test(s) ? "Top" : /se|sw|s/.test(s) ? "Bottom" : /^e$/.test(s) ? "Right" : "Left"].join(""), l.css(h, g), this._proportionallyResize()), f(this.handles[s]).length
                }
            }, this._renderAxis(this.element), this._handles = f(".ui-resizable-handle", this.element).disableSelection(), this._handles.mouseover(function () {
                b.resizing || (this.className && (a = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)), b.axis = a && a[1] ? a[1] : "se")
            }), c.autoHide && (this._handles.hide(), f(this.element).addClass("ui-resizable-autohide").mouseenter(function () {
                c.disabled || (f(this).removeClass("ui-resizable-autohide"), b._handles.show())
            }).mouseleave(function () {
                c.disabled || b.resizing || (f(this).addClass("ui-resizable-autohide"), b._handles.hide())
            })), this._mouseInit()
        },
        _destroy: function () {
            this._mouseDestroy();
            var a, b = function (c) {
                f(c).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove()
            };
            return this.elementIsWrapper && (b(this.element), a = this.element, this.originalElement.css({
                position: a.css("position"),
                width: a.outerWidth(),
                height: a.outerHeight(),
                top: a.css("top"),
                left: a.css("left")
            }).insertAfter(a), a.remove()), this.originalElement.css("resize", this.originalResizeStyle), b(this.originalElement), this
        },
        _mouseCapture: function (c) {
            var h, b, a = !1;
            for (h in this.handles) {
                b = f(this.handles[h])[0], (b === c.target || f.contains(b, c.target)) && (a = !0)
            }
            return !this.options.disabled && a
        },
        _mouseStart: function (o) {
            var h, a, p, b = this.options,
                    c = this.element.position(),
                    n = this.element;
            return this.resizing = !0, /absolute/.test(n.css("position")) ? n.css({
                position: "absolute",
                top: n.css("top"),
                left: n.css("left")
            }) : n.is(".ui-draggable") && n.css({
                position: "absolute",
                top: c.top,
                left: c.left
            }), this._renderProxy(), h = d(this.helper.css("left")), a = d(this.helper.css("top")), b.containment && (h += f(b.containment).scrollLeft() || 0, a += f(b.containment).scrollTop() || 0), this.offset = this.helper.offset(), this.position = {
                left: h,
                top: a
            }, this.size = this._helper ? {
                width: n.outerWidth(),
                height: n.outerHeight()
            } : {
                width: n.width(),
                height: n.height()
            }, this.originalSize = this._helper ? {
                width: n.outerWidth(),
                height: n.outerHeight()
            } : {
                width: n.width(),
                height: n.height()
            }, this.originalPosition = {
                left: h,
                top: a
            }, this.sizeDiff = {
                width: n.outerWidth() - n.width(),
                height: n.outerHeight() - n.height()
            }, this.originalMousePosition = {
                left: o.pageX,
                top: o.pageY
            }, this.aspectRatio = "number" == typeof b.aspectRatio ? b.aspectRatio : this.originalSize.width / this.originalSize.height || 1, p = f(".ui-resizable-" + this.axis).css("cursor"), f("body").css("cursor", "auto" === p ? this.axis + "-resize" : p), n.addClass("ui-resizable-resizing"), this._propagate("start", o), !0
        },
        _mouseDrag: function (c) {
            var b, a = this.helper,
                    n = {}, s = this.originalMousePosition,
                    o = this.axis,
                    r = this.position.top,
                    E = this.position.left,
                    l = this.size.width,
                    h = this.size.height,
                    u = c.pageX - s.left || 0,
                    D = c.pageY - s.top || 0,
                    p = this._change[o];
            return p ? (b = p.apply(this, [c, u, D]), this._updateVirtualBoundaries(c.shiftKey), (this._aspectRatio || c.shiftKey) && (b = this._updateRatio(b, c)), b = this._respectSize(b, c), this._updateCache(b), this._propagate("resize", c), this.position.top !== r && (n.top = this.position.top + "px"), this.position.left !== E && (n.left = this.position.left + "px"), this.size.width !== l && (n.width = this.size.width + "px"), this.size.height !== h && (n.height = this.size.height + "px"), a.css(n), !this._helper && this._proportionallyResizeElements.length && this._proportionallyResize(), f.isEmptyObject(n) || this._trigger("resize", c, this.ui()), !1) : !1
        },
        _mouseStop: function (u) {
            this.resizing = !1;
            var h, s, n, b, o, r, c, l = this.options,
                    a = this;
            return this._helper && (h = this._proportionallyResizeElements, s = h.length && /textarea/i.test(h[0].nodeName), n = s && f.ui.hasScroll(h[0], "left") ? 0 : a.sizeDiff.height, b = s ? 0 : a.sizeDiff.width, o = {
                width: a.helper.width() - b,
                height: a.helper.height() - n
            }, r = parseInt(a.element.css("left"), 10) + (a.position.left - a.originalPosition.left) || null, c = parseInt(a.element.css("top"), 10) + (a.position.top - a.originalPosition.top) || null, l.animate || this.element.css(f.extend(o, {
                top: c,
                left: r
            })), a.helper.height(a.size.height), a.helper.width(a.size.width), this._helper && !l.animate && this._proportionallyResize()), f("body").css("cursor", "auto"), this.element.removeClass("ui-resizable-resizing"), this._propagate("stop", u), this._helper && this.helper.remove(), !1
        },
        _updateVirtualBoundaries: function (c) {
            var p, o, a, q, b, n = this.options;
            b = {
                minWidth: e(n.minWidth) ? n.minWidth : 0,
                maxWidth: e(n.maxWidth) ? n.maxWidth : 1 / 0,
                minHeight: e(n.minHeight) ? n.minHeight : 0,
                maxHeight: e(n.maxHeight) ? n.maxHeight : 1 / 0
            }, (this._aspectRatio || c) && (p = b.minHeight * this.aspectRatio, a = b.minWidth / this.aspectRatio, o = b.maxHeight * this.aspectRatio, q = b.maxWidth / this.aspectRatio, p > b.minWidth && (b.minWidth = p), a > b.minHeight && (b.minHeight = a), b.maxWidth > o && (b.maxWidth = o), b.maxHeight > q && (b.maxHeight = q)), this._vBoundaries = b
        },
        _updateCache: function (a) {
            this.offset = this.helper.offset(), e(a.left) && (this.position.left = a.left), e(a.top) && (this.position.top = a.top), e(a.height) && (this.size.height = a.height), e(a.width) && (this.size.width = a.width)
        },
        _updateRatio: function (b) {
            var k = this.position,
                    c = this.size,
                    a = this.axis;
            return e(b.height) ? b.width = b.height * this.aspectRatio : e(b.width) && (b.height = b.width / this.aspectRatio), "sw" === a && (b.left = k.left + (c.width - b.width), b.top = null), "nw" === a && (b.top = k.top + (c.height - b.height), b.left = k.left + (c.width - b.width)), b
        },
        _respectSize: function (b) {
            var s = this._vBoundaries,
                    r = this.axis,
                    l = e(b.width) && s.maxWidth && s.maxWidth < b.width,
                    A = e(b.height) && s.maxHeight && s.maxHeight < b.height,
                    n = e(b.width) && s.minWidth && s.minWidth > b.width,
                    o = e(b.height) && s.minHeight && s.minHeight > b.height,
                    c = this.originalPosition.left + this.originalSize.width,
                    h = this.position.top + this.size.height,
                    u = /sw|nw|w/.test(r),
                    a = /nw|ne|n/.test(r);
            return n && (b.width = s.minWidth), o && (b.height = s.minHeight), l && (b.width = s.maxWidth), A && (b.height = s.maxHeight), n && u && (b.left = c - s.minWidth), l && u && (b.left = c - s.maxWidth), o && a && (b.top = h - s.minHeight), A && a && (b.top = h - s.maxHeight), b.width || b.height || b.left || !b.top ? b.width || b.height || b.top || !b.left || (b.left = null) : b.top = null, b
        },
        _proportionallyResize: function () {
            if (this._proportionallyResizeElements.length) {
                var b, m, n, c, a, o = this.helper || this.element;
                for (b = 0; this._proportionallyResizeElements.length > b; b++) {
                    if (a = this._proportionallyResizeElements[b], !this.borderDif) {
                        for (this.borderDif = [], n = [a.css("borderTopWidth"), a.css("borderRightWidth"), a.css("borderBottomWidth"), a.css("borderLeftWidth")], c = [a.css("paddingTop"), a.css("paddingRight"), a.css("paddingBottom"), a.css("paddingLeft")], m = 0; n.length > m; m++) {
                            this.borderDif[m] = (parseInt(n[m], 10) || 0) + (parseInt(c[m], 10) || 0)
                        }
                    }
                    a.css({
                        height: o.height() - this.borderDif[0] - this.borderDif[2] || 0,
                        width: o.width() - this.borderDif[1] - this.borderDif[3] || 0
                    })
                }
            }
        },
        _renderProxy: function () {
            var a = this.element,
                    b = this.options;
            this.elementOffset = a.offset(), this._helper ? (this.helper = this.helper || f("<div style='overflow:hidden;'></div>"), this.helper.addClass(this._helper).css({
                width: this.element.outerWidth() - 1,
                height: this.element.outerHeight() - 1,
                position: "absolute",
                left: this.elementOffset.left + "px",
                top: this.elementOffset.top + "px",
                zIndex: ++b.zIndex
            }), this.helper.appendTo("body").disableSelection()) : this.helper = this.element
        },
        _change: {
            e: function (a, b) {
                return {
                    width: this.originalSize.width + b
                }
            },
            w: function (a, c) {
                var k = this.originalSize,
                        b = this.originalPosition;
                return {
                    left: b.left + c,
                    width: k.width - c
                }
            },
            n: function (b, l, m) {
                var c = this.originalSize,
                        a = this.originalPosition;
                return {
                    top: a.top + m,
                    height: c.height - m
                }
            },
            s: function (a, b, c) {
                return {
                    height: this.originalSize.height + c
                }
            },
            se: function (b, c, a) {
                return f.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [b, c, a]))
            },
            sw: function (b, c, a) {
                return f.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [b, c, a]))
            },
            ne: function (b, c, a) {
                return f.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [b, c, a]))
            },
            nw: function (b, c, a) {
                return f.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [b, c, a]))
            }
        },
        _propagate: function (a, b) {
            f.ui.plugin.call(this, a, [b, this.ui()]), "resize" !== a && this._trigger(a, b, this.ui())
        },
        plugins: {},
        ui: function () {
            return {
                originalElement: this.originalElement,
                element: this.element,
                helper: this.helper,
                position: this.position,
                size: this.size,
                originalSize: this.originalSize,
                originalPosition: this.originalPosition
            }
        }
    }), f.ui.plugin.add("resizable", "animate", {
        stop: function (u) {
            var h = f(this).data("ui-resizable"),
                    s = h.options,
                    n = h._proportionallyResizeElements,
                    b = n.length && /textarea/i.test(n[0].nodeName),
                    o = b && f.ui.hasScroll(n[0], "left") ? 0 : h.sizeDiff.height,
                    r = b ? 0 : h.sizeDiff.width,
                    c = {
                        width: h.size.width - r,
                        height: h.size.height - o
                    }, l = parseInt(h.element.css("left"), 10) + (h.position.left - h.originalPosition.left) || null,
                    a = parseInt(h.element.css("top"), 10) + (h.position.top - h.originalPosition.top) || null;
            h.element.animate(f.extend(c, a && l ? {
                top: a,
                left: l
            } : {}), {
                duration: s.animateDuration,
                easing: s.animateEasing,
                step: function () {
                    var g = {
                        width: parseInt(h.element.css("width"), 10),
                        height: parseInt(h.element.css("height"), 10),
                        top: parseInt(h.element.css("top"), 10),
                        left: parseInt(h.element.css("left"), 10)
                    };
                    n && n.length && f(n[0]).css({
                        width: g.width,
                        height: g.height
                    }), h._updateCache(g), h._propagate("resize", u)
                }
            })
        }
    }), f.ui.plugin.add("resizable", "containment", {
        start: function () {
            var a, b, l, r, n, p, C, h = f(this).data("ui-resizable"),
                    c = h.options,
                    s = h.element,
                    u = c.containment,
                    o = u instanceof f ? u.get(0) : /parent/.test(u) ? s.parent().get(0) : u;
            o && (h.containerElement = f(o), /document/.test(u) || u === document ? (h.containerOffset = {
                left: 0,
                top: 0
            }, h.containerPosition = {
                left: 0,
                top: 0
            }, h.parentData = {
                element: f(document),
                left: 0,
                top: 0,
                width: f(document).width(),
                height: f(document).height() || document.body.parentNode.scrollHeight
            }) : (a = f(o), b = [], f(["Top", "Right", "Left", "Bottom"]).each(function (k, g) {
                b[k] = d(a.css("padding" + g))
            }), h.containerOffset = a.offset(), h.containerPosition = a.position(), h.containerSize = {
                height: a.innerHeight() - b[3],
                width: a.innerWidth() - b[1]
            }, l = h.containerOffset, r = h.containerSize.height, n = h.containerSize.width, p = f.ui.hasScroll(o, "left") ? o.scrollWidth : n, C = f.ui.hasScroll(o) ? o.scrollHeight : r, h.parentData = {
                element: o,
                left: l.left,
                top: l.top,
                width: p,
                height: C
            }))
        },
        resize: function (s) {
            var h, c, n, B, o = f(this).data("ui-resizable"),
                    r = o.options,
                    b = o.containerOffset,
                    l = o.position,
                    u = o._aspectRatio || s.shiftKey,
                    C = {
                        top: 0,
                        left: 0
                    }, a = o.containerElement;
            a[0] !== document && /static/.test(a.css("position")) && (C = b), l.left < (o._helper ? b.left : 0) && (o.size.width = o.size.width + (o._helper ? o.position.left - b.left : o.position.left - C.left), u && (o.size.height = o.size.width / o.aspectRatio), o.position.left = r.helper ? b.left : 0), l.top < (o._helper ? b.top : 0) && (o.size.height = o.size.height + (o._helper ? o.position.top - b.top : o.position.top), u && (o.size.width = o.size.height * o.aspectRatio), o.position.top = o._helper ? b.top : 0), o.offset.left = o.parentData.left + o.position.left, o.offset.top = o.parentData.top + o.position.top, h = Math.abs((o._helper ? o.offset.left - C.left : o.offset.left - C.left) + o.sizeDiff.width), c = Math.abs((o._helper ? o.offset.top - C.top : o.offset.top - b.top) + o.sizeDiff.height), n = o.containerElement.get(0) === o.element.parent().get(0), B = /relative|absolute/.test(o.containerElement.css("position")), n && B && (h -= o.parentData.left), h + o.size.width >= o.parentData.width && (o.size.width = o.parentData.width - h, u && (o.size.height = o.size.width / o.aspectRatio)), c + o.size.height >= o.parentData.height && (o.size.height = o.parentData.height - c, u && (o.size.width = o.size.height * o.aspectRatio))
        },
        stop: function () {
            var a = f(this).data("ui-resizable"),
                    h = a.options,
                    s = a.containerOffset,
                    n = a.containerPosition,
                    b = a.containerElement,
                    o = f(a.helper),
                    r = o.offset(),
                    c = o.outerWidth() - a.sizeDiff.width,
                    l = o.outerHeight() - a.sizeDiff.height;
            a._helper && !h.animate && /relative/.test(b.css("position")) && f(this).css({
                left: r.left - n.left - s.left,
                width: c,
                height: l
            }), a._helper && !h.animate && /static/.test(b.css("position")) && f(this).css({
                left: r.left - n.left - s.left,
                width: c,
                height: l
            })
        }
    }), f.ui.plugin.add("resizable", "alsoResize", {
        start: function () {
            var b = f(this).data("ui-resizable"),
                    c = b.options,
                    a = function (h) {
                        f(h).each(function () {
                            var g = f(this);
                            g.data("ui-resizable-alsoresize", {
                                width: parseInt(g.width(), 10),
                                height: parseInt(g.height(), 10),
                                left: parseInt(g.css("left"), 10),
                                top: parseInt(g.css("top"), 10)
                            })
                        })
                    };
            "object" != typeof c.alsoResize || c.alsoResize.parentNode ? a(c.alsoResize) : c.alsoResize.length ? (c.alsoResize = c.alsoResize[0], a(c.alsoResize)) : f.each(c.alsoResize, function (h) {
                a(h)
            })
        },
        resize: function (n, q) {
            var c = f(this).data("ui-resizable"),
                    o = c.options,
                    r = c.originalSize,
                    a = c.originalPosition,
                    b = {
                        height: c.size.height - r.height || 0,
                        width: c.size.width - r.width || 0,
                        top: c.position.top - a.top || 0,
                        left: c.position.left - a.left || 0
                    }, h = function (g, k) {
                f(g).each(function () {
                    var p = f(this),
                            l = f(this).data("ui-resizable-alsoresize"),
                            v = {}, m = k && k.length ? k : p.parents(q.originalElement[0]).length ? ["width", "height"] : ["width", "height", "top", "left"];
                    f.each(m, function (s, u) {
                        var x = (l[u] || 0) + (b[u] || 0);
                        x && x >= 0 && (v[u] = x || null)
                    }), p.css(v)
                })
            };
            "object" != typeof o.alsoResize || o.alsoResize.nodeType ? h(o.alsoResize) : f.each(o.alsoResize, function (k, g) {
                h(k, g)
            })
        },
        stop: function () {
            f(this).removeData("resizable-alsoresize")
        }
    }), f.ui.plugin.add("resizable", "ghost", {
        start: function () {
            var b = f(this).data("ui-resizable"),
                    c = b.options,
                    a = b.size;
            b.ghost = b.originalElement.clone(), b.ghost.css({
                opacity: 0.25,
                display: "block",
                position: "relative",
                height: a.height,
                width: a.width,
                margin: 0,
                left: 0,
                top: 0
            }).addClass("ui-resizable-ghost").addClass("string" == typeof c.ghost ? c.ghost : ""), b.ghost.appendTo(b.helper)
        },
        resize: function () {
            var a = f(this).data("ui-resizable");
            a.ghost && a.ghost.css({
                position: "relative",
                height: a.size.height,
                width: a.size.width
            })
        },
        stop: function () {
            var a = f(this).data("ui-resizable");
            a.ghost && a.helper && a.helper.get(0).removeChild(a.ghost.get(0))
        }
    }), f.ui.plugin.add("resizable", "grid", {
        resize: function () {
            var r = f(this).data("ui-resizable"),
                    h = r.options,
                    o = r.size,
                    u = r.originalSize,
                    L = r.originalPosition,
                    c = r.axis,
                    m = "number" == typeof h.grid ? [h.grid, h.grid] : h.grid,
                    g = m[0] || 1,
                    n = m[1] || 1,
                    s = Math.round((o.width - u.width) / g) * g,
                    M = Math.round((o.height - u.height) / n) * n,
                    N = u.width + s,
                    l = u.height + M,
                    a = h.maxWidth && N > h.maxWidth,
                    p = h.maxHeight && l > h.maxHeight,
                    b = h.minWidth && h.minWidth > N,
                    v = h.minHeight && h.minHeight > l;
            h.grid = m, b && (N += g), v && (l += n), a && (N -= g), p && (l -= n), /^(se|s|e)$/.test(c) ? (r.size.width = N, r.size.height = l) : /^(ne)$/.test(c) ? (r.size.width = N, r.size.height = l, r.position.top = L.top - M) : /^(sw)$/.test(c) ? (r.size.width = N, r.size.height = l, r.position.left = L.left - s) : (r.size.width = N, r.size.height = l, r.position.top = L.top - M, r.position.left = L.left - s)
        }
    })
})(jQuery);
(function (b) {
    b.widget("ui.selectable", b.ui.mouse, {
        version: "1.10.3",
        options: {
            appendTo: "body",
            autoRefresh: !0,
            distance: 0,
            filter: "*",
            tolerance: "touch",
            selected: null,
            selecting: null,
            start: null,
            stop: null,
            unselected: null,
            unselecting: null
        },
        _create: function () {
            var d, a = this;
            this.element.addClass("ui-selectable"), this.dragged = !1, this.refresh = function () {
                d = b(a.options.filter, a.element[0]), d.addClass("ui-selectee"), d.each(function () {
                    var c = b(this),
                            f = c.offset();
                    b.data(this, "selectable-item", {
                        element: this,
                        $element: c,
                        left: f.left,
                        top: f.top,
                        right: f.left + c.outerWidth(),
                        bottom: f.top + c.outerHeight(),
                        startselected: !1,
                        selected: c.hasClass("ui-selected"),
                        selecting: c.hasClass("ui-selecting"),
                        unselecting: c.hasClass("ui-unselecting")
                    })
                })
            }, this.refresh(), this.selectees = d.addClass("ui-selectee"), this._mouseInit(), this.helper = b("<div class='ui-selectable-helper'></div>")
        },
        _destroy: function () {
            this.selectees.removeClass("ui-selectee").removeData("selectable-item"), this.element.removeClass("ui-selectable ui-selectable-disabled"), this._mouseDestroy()
        },
        _mouseStart: function (f) {
            var a = this,
                    e = this.options;
            this.opos = [f.pageX, f.pageY], this.options.disabled || (this.selectees = b(e.filter, this.element[0]), this._trigger("start", f), b(e.appendTo).append(this.helper), this.helper.css({
                left: f.pageX,
                top: f.pageY,
                width: 0,
                height: 0
            }), e.autoRefresh && this.refresh(), this.selectees.filter(".ui-selected").each(function () {
                var c = b.data(this, "selectable-item");
                c.startselected = !0, f.metaKey || f.ctrlKey || (c.$element.removeClass("ui-selected"), c.selected = !1, c.$element.addClass("ui-unselecting"), c.unselecting = !0, a._trigger("unselecting", f, {
                    unselecting: c.element
                }))
            }), b(f.target).parents().addBack().each(function () {
                var d, c = b.data(this, "selectable-item");
                return c ? (d = !f.metaKey && !f.ctrlKey || !c.$element.hasClass("ui-selected"), c.$element.removeClass(d ? "ui-unselecting" : "ui-selected").addClass(d ? "ui-selecting" : "ui-unselecting"), c.unselecting = !d, c.selecting = d, c.selected = d, d ? a._trigger("selecting", f, {
                    selecting: c.element
                }) : a._trigger("unselecting", f, {
                    unselecting: c.element
                }), !1) : undefined
            }))
        },
        _mouseDrag: function (q) {
            if (this.dragged = !0, !this.options.disabled) {
                var r, o = this,
                        h = this.options,
                        a = this.opos[0],
                        m = this.opos[1],
                        n = q.pageX,
                        p = q.pageY;
                return a > n && (r = n, n = a, a = r), m > p && (r = p, p = m, m = r), this.helper.css({
                    left: a,
                    top: m,
                    width: n - a,
                    height: p - m
                }), this.selectees.each(function () {
                    var c = b.data(this, "selectable-item"),
                            d = !1;
                    c && c.element !== o.element[0] && ("touch" === h.tolerance ? d = !(c.left > n || a > c.right || c.top > p || m > c.bottom) : "fit" === h.tolerance && (d = c.left > a && n > c.right && c.top > m && p > c.bottom), d ? (c.selected && (c.$element.removeClass("ui-selected"), c.selected = !1), c.unselecting && (c.$element.removeClass("ui-unselecting"), c.unselecting = !1), c.selecting || (c.$element.addClass("ui-selecting"), c.selecting = !0, o._trigger("selecting", q, {
                        selecting: c.element
                    }))) : (c.selecting && ((q.metaKey || q.ctrlKey) && c.startselected ? (c.$element.removeClass("ui-selecting"), c.selecting = !1, c.$element.addClass("ui-selected"), c.selected = !0) : (c.$element.removeClass("ui-selecting"), c.selecting = !1, c.startselected && (c.$element.addClass("ui-unselecting"), c.unselecting = !0), o._trigger("unselecting", q, {
                        unselecting: c.element
                    }))), c.selected && (q.metaKey || q.ctrlKey || c.startselected || (c.$element.removeClass("ui-selected"), c.selected = !1, c.$element.addClass("ui-unselecting"), c.unselecting = !0, o._trigger("unselecting", q, {
                        unselecting: c.element
                    })))))
                }), !1
            }
        },
        _mouseStop: function (d) {
            var a = this;
            return this.dragged = !1, b(".ui-unselecting", this.element[0]).each(function () {
                var c = b.data(this, "selectable-item");
                c.$element.removeClass("ui-unselecting"), c.unselecting = !1, c.startselected = !1, a._trigger("unselected", d, {
                    unselected: c.element
                })
            }), b(".ui-selecting", this.element[0]).each(function () {
                var c = b.data(this, "selectable-item");
                c.$element.removeClass("ui-selecting").addClass("ui-selected"), c.selecting = !1, c.selected = !0, c.startselected = !0, a._trigger("selected", d, {
                    selected: c.element
                })
            }), this._trigger("stop", d), this.helper.remove(), !1
        }
    })
})(jQuery);
(function (d) {
    function f(b, a, c) {
        return b > a && a + c > b
    }
    function e(a) {
        return /left|right/.test(a.css("float")) || /inline|table-cell/.test(a.css("display"))
    }
    d.widget("ui.sortable", d.ui.mouse, {
        version: "1.10.3",
        widgetEventPrefix: "sort",
        ready: !1,
        options: {
            appendTo: "parent",
            axis: !1,
            connectWith: !1,
            containment: !1,
            cursor: "auto",
            cursorAt: !1,
            dropOnEmpty: !0,
            forcePlaceholderSize: !1,
            forceHelperSize: !1,
            grid: !1,
            handle: !1,
            helper: "original",
            items: "> *",
            opacity: !1,
            placeholder: !1,
            revert: !1,
            scroll: !0,
            scrollSensitivity: 20,
            scrollSpeed: 20,
            scope: "default",
            tolerance: "intersect",
            zIndex: 1000,
            activate: null,
            beforeStop: null,
            change: null,
            deactivate: null,
            out: null,
            over: null,
            receive: null,
            remove: null,
            sort: null,
            start: null,
            stop: null,
            update: null
        },
        _create: function () {
            var a = this.options;
            this.containerCache = {}, this.element.addClass("ui-sortable"), this.refresh(), this.floating = this.items.length ? "x" === a.axis || e(this.items[0].item) : !1, this.offset = this.element.offset(), this._mouseInit(), this.ready = !0
        },
        _destroy: function () {
            this.element.removeClass("ui-sortable ui-sortable-disabled"), this._mouseDestroy();
            for (var a = this.items.length - 1; a >= 0; a--) {
                this.items[a].item.removeData(this.widgetName + "-item")
            }
            return this
        },
        _setOption: function (a, b) {
            "disabled" === a ? (this.options[a] = b, this.widget().toggleClass("ui-sortable-disabled", !!b)) : d.Widget.prototype._setOption.apply(this, arguments)
        },
        _mouseCapture: function (b, l) {
            var c = null,
                    a = !1,
                    m = this;
            return this.reverting ? !1 : this.options.disabled || "static" === this.options.type ? !1 : (this._refreshItems(b), d(b.target).parents().each(function () {
                return d.data(this, m.widgetName + "-item") === m ? (c = d(this), !1) : undefined
            }), d.data(b.target, m.widgetName + "-item") === m && (c = d(b.target)), c ? !this.options.handle || l || (d(this.options.handle, c).find("*").addBack().each(function () {
                this === b.target && (a = !0)
            }), a) ? (this.currentItem = c, this._removeCurrentsFromItems(), !0) : !1 : !1)
        },
        _mouseStart: function (c, n, m) {
            var a, o, b = this.options;
            if (this.currentContainer = this, this.refreshPositions(), this.helper = this._createHelper(c), this._cacheHelperProportions(), this._cacheMargins(), this.scrollParent = this.helper.scrollParent(), this.offset = this.currentItem.offset(), this.offset = {
                top: this.offset.top - this.margins.top,
                left: this.offset.left - this.margins.left
            }, d.extend(this.offset, {
                click: {
                    left: c.pageX - this.offset.left,
                    top: c.pageY - this.offset.top
                },
                parent: this._getParentOffset(),
                relative: this._getRelativeOffset()
            }), this.helper.css("position", "absolute"), this.cssPosition = this.helper.css("position"), this.originalPosition = this._generatePosition(c), this.originalPageX = c.pageX, this.originalPageY = c.pageY, b.cursorAt && this._adjustOffsetFromHelper(b.cursorAt), this.domPosition = {
                prev: this.currentItem.prev()[0],
                parent: this.currentItem.parent()[0]
            }, this.helper[0] !== this.currentItem[0] && this.currentItem.hide(), this._createPlaceholder(), b.containment && this._setContainment(), b.cursor && "auto" !== b.cursor && (o = this.document.find("body"), this.storedCursor = o.css("cursor"), o.css("cursor", b.cursor), this.storedStylesheet = d("<style>*{ cursor: " + b.cursor + " !important; }</style>").appendTo(o)), b.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")), this.helper.css("opacity", b.opacity)), b.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), this.helper.css("zIndex", b.zIndex)), this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()), this._trigger("start", c, this._uiHash()), this._preserveHelperProportions || this._cacheHelperProportions(), !m) {
                for (a = this.containers.length - 1; a >= 0; a--) {
                    this.containers[a]._trigger("activate", c, this._uiHash(this))
                }
            }
            return d.ui.ddmanager && (d.ui.ddmanager.current = this), d.ui.ddmanager && !b.dropBehaviour && d.ui.ddmanager.prepareOffsets(this, c), this.dragging = !0, this.helper.addClass("ui-sortable-helper"), this._mouseDrag(c), !0
        },
        _mouseDrag: function (c) {
            var p, o, a, q, b = this.options,
                    n = !1;
            for (this.position = this._generatePosition(c), this.positionAbs = this._convertPositionTo("absolute"), this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs), this.options.scroll && (this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top + this.scrollParent[0].offsetHeight - c.pageY < b.scrollSensitivity ? this.scrollParent[0].scrollTop = n = this.scrollParent[0].scrollTop + b.scrollSpeed : c.pageY - this.overflowOffset.top < b.scrollSensitivity && (this.scrollParent[0].scrollTop = n = this.scrollParent[0].scrollTop - b.scrollSpeed), this.overflowOffset.left + this.scrollParent[0].offsetWidth - c.pageX < b.scrollSensitivity ? this.scrollParent[0].scrollLeft = n = this.scrollParent[0].scrollLeft + b.scrollSpeed : c.pageX - this.overflowOffset.left < b.scrollSensitivity && (this.scrollParent[0].scrollLeft = n = this.scrollParent[0].scrollLeft - b.scrollSpeed)) : (c.pageY - d(document).scrollTop() < b.scrollSensitivity ? n = d(document).scrollTop(d(document).scrollTop() - b.scrollSpeed) : d(window).height() - (c.pageY - d(document).scrollTop()) < b.scrollSensitivity && (n = d(document).scrollTop(d(document).scrollTop() + b.scrollSpeed)), c.pageX - d(document).scrollLeft() < b.scrollSensitivity ? n = d(document).scrollLeft(d(document).scrollLeft() - b.scrollSpeed) : d(window).width() - (c.pageX - d(document).scrollLeft()) < b.scrollSensitivity && (n = d(document).scrollLeft(d(document).scrollLeft() + b.scrollSpeed))), n !== !1 && d.ui.ddmanager && !b.dropBehaviour && d.ui.ddmanager.prepareOffsets(this, c)), this.positionAbs = this._convertPositionTo("absolute"), this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), p = this.items.length - 1; p >= 0; p--) {
                if (o = this.items[p], a = o.item[0], q = this._intersectsWithPointer(o), q && o.instance === this.currentContainer && a !== this.currentItem[0] && this.placeholder[1 === q ? "next" : "prev"]()[0] !== a && !d.contains(this.placeholder[0], a) && ("semi-dynamic" === this.options.type ? !d.contains(this.element[0], a) : !0)) {
                    if (this.direction = 1 === q ? "down" : "up", "pointer" !== this.options.tolerance && !this._intersectsWithSides(o)) {
                        break
                    }
                    this._rearrange(c, o), this._trigger("change", c, this._uiHash());
                    break
                }
            }
            return this._contactContainers(c), d.ui.ddmanager && d.ui.ddmanager.drag(this, c), this._trigger("sort", c, this._uiHash()), this.lastPositionAbs = this.positionAbs, !1
        },
        _mouseStop: function (c, n) {
            if (c) {
                if (d.ui.ddmanager && !this.options.dropBehaviour && d.ui.ddmanager.drop(this, c), this.options.revert) {
                    var m = this,
                            a = this.placeholder.offset(),
                            o = this.options.axis,
                            b = {};
                    o && "x" !== o || (b.left = a.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollLeft)), o && "y" !== o || (b.top = a.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollTop)), this.reverting = !0, d(this.helper).animate(b, parseInt(this.options.revert, 10) || 500, function () {
                        m._clear(c)
                    })
                } else {
                    this._clear(c, n)
                }
                return !1
            }
        },
        cancel: function () {
            if (this.dragging) {
                this._mouseUp({
                    target: null
                }), "original" === this.options.helper ? this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") : this.currentItem.show();
                for (var a = this.containers.length - 1; a >= 0; a--) {
                    this.containers[a]._trigger("deactivate", null, this._uiHash(this)), this.containers[a].containerCache.over && (this.containers[a]._trigger("out", null, this._uiHash(this)), this.containers[a].containerCache.over = 0)
                }
            }
            return this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), d.extend(this, {
                helper: null,
                dragging: !1,
                reverting: !1,
                _noFinalSort: null
            }), this.domPosition.prev ? d(this.domPosition.prev).after(this.currentItem) : d(this.domPosition.parent).prepend(this.currentItem)), this
        },
        serialize: function (a) {
            var c = this._getItemsAsjQuery(a && a.connected),
                    b = [];
            return a = a || {}, d(c).each(function () {
                var g = (d(a.item || this).attr(a.attribute || "id") || "").match(a.expression || /(.+)[\-=_](.+)/);
                g && b.push((a.key || g[1] + "[]") + "=" + (a.key && a.expression ? g[1] : g[2]))
            }), !b.length && a.key && b.push(a.key + "="), b.join("&")
        },
        toArray: function (a) {
            var c = this._getItemsAsjQuery(a && a.connected),
                    b = [];
            return a = a || {}, c.each(function () {
                b.push(d(a.item || this).attr(a.attribute || "id") || "")
            }), b
        },
        _intersectsWith: function (a) {
            var u = this.positionAbs.left,
                    G = u + this.helperProportions.width,
                    H = this.positionAbs.top,
                    n = H + this.helperProportions.height,
                    h = a.left,
                    o = h + a.width,
                    r = a.top,
                    F = r + a.height,
                    c = this.offset.click.top,
                    l = this.offset.click.left,
                    b = "x" === this.options.axis || H + c > r && F > H + c,
                    s = "y" === this.options.axis || u + l > h && o > u + l,
                    p = b && s;
            return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width" : "height"] > a[this.floating ? "width" : "height"] ? p : u + this.helperProportions.width / 2 > h && o > G - this.helperProportions.width / 2 && H + this.helperProportions.height / 2 > r && F > n - this.helperProportions.height / 2
        },
        _intersectsWithPointer: function (l) {
            var m = "x" === this.options.axis || f(this.positionAbs.top + this.offset.click.top, l.top, l.height),
                    c = "y" === this.options.axis || f(this.positionAbs.left + this.offset.click.left, l.left, l.width),
                    a = m && c,
                    n = this._getDragVerticalDirection(),
                    b = this._getDragHorizontalDirection();
            return a ? this.floating ? b && "right" === b || "down" === n ? 2 : 1 : n && ("down" === n ? 2 : 1) : !1
        },
        _intersectsWithSides: function (c) {
            var k = f(this.positionAbs.top + this.offset.click.top, c.top + c.height / 2, c.height),
                    b = f(this.positionAbs.left + this.offset.click.left, c.left + c.width / 2, c.width),
                    a = this._getDragVerticalDirection(),
                    l = this._getDragHorizontalDirection();
            return this.floating && l ? "right" === l && b || "left" === l && !b : a && ("down" === a && k || "up" === a && !k)
        },
        _getDragVerticalDirection: function () {
            var a = this.positionAbs.top - this.lastPositionAbs.top;
            return 0 !== a && (a > 0 ? "down" : "up")
        },
        _getDragHorizontalDirection: function () {
            var a = this.positionAbs.left - this.lastPositionAbs.left;
            return 0 !== a && (a > 0 ? "right" : "left")
        },
        refresh: function (a) {
            return this._refreshItems(a), this.refreshPositions(), this
        },
        _connectWith: function () {
            var a = this.options;
            return a.connectWith.constructor === String ? [a.connectWith] : a.connectWith
        },
        _getItemsAsjQuery: function (a) {
            var o, c, n, s, r = [],
                    b = [],
                    h = this._connectWith();
            if (h && a) {
                for (o = h.length - 1; o >= 0; o--) {
                    for (n = d(h[o]), c = n.length - 1; c >= 0; c--) {
                        s = d.data(n[c], this.widgetFullName), s && s !== this && !s.options.disabled && b.push([d.isFunction(s.options.items) ? s.options.items.call(s.element) : d(s.options.items, s.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), s])
                    }
                }
            }
            for (b.push([d.isFunction(this.options.items) ? this.options.items.call(this.element, null, {
                    options: this.options,
                    item: this.currentItem
                }) : d(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]), o = b.length - 1; o >= 0; o--) {
                b[o][0].each(function () {
                    r.push(this)
                })
            }
            return d(r)
        },
        _removeCurrentsFromItems: function () {
            var a = this.currentItem.find(":data(" + this.widgetName + "-item)");
            this.items = d.grep(this.items, function (b) {
                for (var c = 0; a.length > c; c++) {
                    if (a[c] === b.item[0]) {
                        return !1
                    }
                }
                return !0
            })
        },
        _refreshItems: function (D) {
            this.items = [], this.containers = [this];
            var c, b, n, s, o, r, a, l, u = this.items,
                    h = [
                        [d.isFunction(this.options.items) ? this.options.items.call(this.element[0], D, {
                                item: this.currentItem
                            }) : d(this.options.items, this.element), this]
                    ],
                    C = this._connectWith();
            if (C && this.ready) {
                for (c = C.length - 1; c >= 0; c--) {
                    for (n = d(C[c]), b = n.length - 1; b >= 0; b--) {
                        s = d.data(n[b], this.widgetFullName), s && s !== this && !s.options.disabled && (h.push([d.isFunction(s.options.items) ? s.options.items.call(s.element[0], D, {
                                item: this.currentItem
                            }) : d(s.options.items, s.element), s]), this.containers.push(s))
                    }
                }
            }
            for (c = h.length - 1; c >= 0; c--) {
                for (o = h[c][1], r = h[c][0], b = 0, l = r.length; l > b; b++) {
                    a = d(r[b]), a.data(this.widgetName + "-item", o), u.push({
                        item: a,
                        instance: o,
                        width: 0,
                        height: 0,
                        left: 0,
                        top: 0
                    })
                }
            }
        },
        refreshPositions: function (b) {
            this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset());
            var l, c, a, m;
            for (l = this.items.length - 1; l >= 0; l--) {
                c = this.items[l], c.instance !== this.currentContainer && this.currentContainer && c.item[0] !== this.currentItem[0] || (a = this.options.toleranceElement ? d(this.options.toleranceElement, c.item) : c.item, b || (c.width = a.outerWidth(), c.height = a.outerHeight()), m = a.offset(), c.left = m.left, c.top = m.top)
            }
            if (this.options.custom && this.options.custom.refreshContainers) {
                this.options.custom.refreshContainers.call(this)
            } else {
                for (l = this.containers.length - 1; l >= 0; l--) {
                    m = this.containers[l].element.offset(), this.containers[l].containerCache.left = m.left, this.containers[l].containerCache.top = m.top, this.containers[l].containerCache.width = this.containers[l].element.outerWidth(), this.containers[l].containerCache.height = this.containers[l].element.outerHeight()
                }
            }
            return this
        },
        _createPlaceholder: function (a) {
            a = a || this;
            var c, b = a.options;
            b.placeholder && b.placeholder.constructor !== String || (c = b.placeholder, b.placeholder = {
                element: function () {
                    var k = a.currentItem[0].nodeName.toLowerCase(),
                            g = d("<" + k + ">", a.document[0]).addClass(c || a.currentItem[0].className + " ui-sortable-placeholder").removeClass("ui-sortable-helper");
                    return "tr" === k ? a.currentItem.children().each(function () {
                        d("<td>&#160;</td>", a.document[0]).attr("colspan", d(this).attr("colspan") || 1).appendTo(g)
                    }) : "img" === k && g.attr("src", a.currentItem.attr("src")), c || g.css("visibility", "hidden"), g
                },
                update: function (k, g) {
                    (!c || b.forcePlaceholderSize) && (g.height() || g.height(a.currentItem.innerHeight() - parseInt(a.currentItem.css("paddingTop") || 0, 10) - parseInt(a.currentItem.css("paddingBottom") || 0, 10)), g.width() || g.width(a.currentItem.innerWidth() - parseInt(a.currentItem.css("paddingLeft") || 0, 10) - parseInt(a.currentItem.css("paddingRight") || 0, 10)))
                }
            }), a.placeholder = d(b.placeholder.element.call(a.element, a.currentItem)), a.currentItem.after(a.placeholder), b.placeholder.update(a, a.placeholder)
        },
        _contactContainers: function (F) {
            var c, b, m, o, r, s, h, a, l, n, p = null,
                    u = null;
            for (c = this.containers.length - 1; c >= 0; c--) {
                if (!d.contains(this.currentItem[0], this.containers[c].element[0])) {
                    if (this._intersectsWith(this.containers[c].containerCache)) {
                        if (p && d.contains(this.containers[c].element[0], p.element[0])) {
                            continue
                        }
                        p = this.containers[c], u = c
                    } else {
                        this.containers[c].containerCache.over && (this.containers[c]._trigger("out", F, this._uiHash(this)), this.containers[c].containerCache.over = 0)
                    }
                }
            }
            if (p) {
                if (1 === this.containers.length) {
                    this.containers[u].containerCache.over || (this.containers[u]._trigger("over", F, this._uiHash(this)), this.containers[u].containerCache.over = 1)
                } else {
                    for (m = 10000, o = null, n = p.floating || e(this.currentItem), r = n ? "left" : "top", s = n ? "width" : "height", h = this.positionAbs[r] + this.offset.click[r], b = this.items.length - 1; b >= 0; b--) {
                        d.contains(this.containers[u].element[0], this.items[b].item[0]) && this.items[b].item[0] !== this.currentItem[0] && (!n || f(this.positionAbs.top + this.offset.click.top, this.items[b].top, this.items[b].height)) && (a = this.items[b].item.offset()[r], l = !1, Math.abs(a - h) > Math.abs(a + this.items[b][s] - h) && (l = !0, a += this.items[b][s]), m > Math.abs(a - h) && (m = Math.abs(a - h), o = this.items[b], this.direction = l ? "up" : "down"))
                    }
                    if (!o && !this.options.dropOnEmpty) {
                        return
                    }
                    if (this.currentContainer === this.containers[u]) {
                        return
                    }
                    o ? this._rearrange(F, o, null, !0) : this._rearrange(F, null, this.containers[u].element, !0), this._trigger("change", F, this._uiHash()), this.containers[u]._trigger("change", F, this._uiHash(this)), this.currentContainer = this.containers[u], this.options.placeholder.update(this.currentContainer, this.placeholder), this.containers[u]._trigger("over", F, this._uiHash(this)), this.containers[u].containerCache.over = 1
                }
            }
        },
        _createHelper: function (a) {
            var c = this.options,
                    b = d.isFunction(c.helper) ? d(c.helper.apply(this.element[0], [a, this.currentItem])) : "clone" === c.helper ? this.currentItem.clone() : this.currentItem;
            return b.parents("body").length || d("parent" !== c.appendTo ? c.appendTo : this.currentItem[0].parentNode)[0].appendChild(b[0]), b[0] === this.currentItem[0] && (this._storedCSS = {
                width: this.currentItem[0].style.width,
                height: this.currentItem[0].style.height,
                position: this.currentItem.css("position"),
                top: this.currentItem.css("top"),
                left: this.currentItem.css("left")
            }), (!b[0].style.width || c.forceHelperSize) && b.width(this.currentItem.width()), (!b[0].style.height || c.forceHelperSize) && b.height(this.currentItem.height()), b
        },
        _adjustOffsetFromHelper: function (a) {
            "string" == typeof a && (a = a.split(" ")), d.isArray(a) && (a = {
                left: +a[0],
                top: +a[1] || 0
            }), "left" in a && (this.offset.click.left = a.left + this.margins.left), "right" in a && (this.offset.click.left = this.helperProportions.width - a.right + this.margins.left), "top" in a && (this.offset.click.top = a.top + this.margins.top), "bottom" in a && (this.offset.click.top = this.helperProportions.height - a.bottom + this.margins.top)
        },
        _getParentOffset: function () {
            this.offsetParent = this.helper.offsetParent();
            var a = this.offsetParent.offset();
            return "absolute" === this.cssPosition && this.scrollParent[0] !== document && d.contains(this.scrollParent[0], this.offsetParent[0]) && (a.left += this.scrollParent.scrollLeft(), a.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && d.ui.ie) && (a = {
                top: 0,
                left: 0
            }), {
                top: a.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                left: a.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
            }
        },
        _getRelativeOffset: function () {
            if ("relative" === this.cssPosition) {
                var a = this.currentItem.position();
                return {
                    top: a.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                    left: a.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
                }
            }
            return {
                top: 0,
                left: 0
            }
        },
        _cacheMargins: function () {
            this.margins = {
                left: parseInt(this.currentItem.css("marginLeft"), 10) || 0,
                top: parseInt(this.currentItem.css("marginTop"), 10) || 0
            }
        },
        _cacheHelperProportions: function () {
            this.helperProportions = {
                width: this.helper.outerWidth(),
                height: this.helper.outerHeight()
            }
        },
        _setContainment: function () {
            var b, k, c, a = this.options;
            "parent" === a.containment && (a.containment = this.helper[0].parentNode), ("document" === a.containment || "window" === a.containment) && (this.containment = [0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, d("document" === a.containment ? document : window).width() - this.helperProportions.width - this.margins.left, (d("document" === a.containment ? document : window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]), /^(document|window|parent)$/.test(a.containment) || (b = d(a.containment)[0], k = d(a.containment).offset(), c = "hidden" !== d(b).css("overflow"), this.containment = [k.left + (parseInt(d(b).css("borderLeftWidth"), 10) || 0) + (parseInt(d(b).css("paddingLeft"), 10) || 0) - this.margins.left, k.top + (parseInt(d(b).css("borderTopWidth"), 10) || 0) + (parseInt(d(b).css("paddingTop"), 10) || 0) - this.margins.top, k.left + (c ? Math.max(b.scrollWidth, b.offsetWidth) : b.offsetWidth) - (parseInt(d(b).css("borderLeftWidth"), 10) || 0) - (parseInt(d(b).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, k.top + (c ? Math.max(b.scrollHeight, b.offsetHeight) : b.offsetHeight) - (parseInt(d(b).css("borderTopWidth"), 10) || 0) - (parseInt(d(b).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top])
        },
        _convertPositionTo: function (b, l) {
            l || (l = this.position);
            var c = "absolute" === b ? 1 : -1,
                    a = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && d.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                    m = /(html|body)/i.test(a[0].tagName);
            return {
                top: l.top + this.offset.relative.top * c + this.offset.parent.top * c - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : m ? 0 : a.scrollTop()) * c,
                left: l.left + this.offset.relative.left * c + this.offset.parent.left * c - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : m ? 0 : a.scrollLeft()) * c
            }
        },
        _generatePosition: function (a) {
            var o, c, n = this.options,
                    s = a.pageX,
                    r = a.pageY,
                    b = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && d.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                    h = /(html|body)/i.test(b[0].tagName);
            return "relative" !== this.cssPosition || this.scrollParent[0] !== document && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative = this._getRelativeOffset()), this.originalPosition && (this.containment && (a.pageX - this.offset.click.left < this.containment[0] && (s = this.containment[0] + this.offset.click.left), a.pageY - this.offset.click.top < this.containment[1] && (r = this.containment[1] + this.offset.click.top), a.pageX - this.offset.click.left > this.containment[2] && (s = this.containment[2] + this.offset.click.left), a.pageY - this.offset.click.top > this.containment[3] && (r = this.containment[3] + this.offset.click.top)), n.grid && (o = this.originalPageY + Math.round((r - this.originalPageY) / n.grid[1]) * n.grid[1], r = this.containment ? o - this.offset.click.top >= this.containment[1] && o - this.offset.click.top <= this.containment[3] ? o : o - this.offset.click.top >= this.containment[1] ? o - n.grid[1] : o + n.grid[1] : o, c = this.originalPageX + Math.round((s - this.originalPageX) / n.grid[0]) * n.grid[0], s = this.containment ? c - this.offset.click.left >= this.containment[0] && c - this.offset.click.left <= this.containment[2] ? c : c - this.offset.click.left >= this.containment[0] ? c - n.grid[0] : c + n.grid[0] : c)), {
                top: r - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : h ? 0 : b.scrollTop()),
                left: s - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : h ? 0 : b.scrollLeft())
            }
        },
        _rearrange: function (l, b, m, c) {
            m ? m[0].appendChild(this.placeholder[0]) : b.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? b.item[0] : b.item[0].nextSibling), this.counter = this.counter ? ++this.counter : 1;
            var a = this.counter;
            this._delay(function () {
                a === this.counter && this.refreshPositions(!c)
            })
        },
        _clear: function (c, a) {
            this.reverting = !1;
            var k, b = [];
            if (!this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem), this._noFinalSort = null, this.helper[0] === this.currentItem[0]) {
                for (k in this._storedCSS) {
                    ("auto" === this._storedCSS[k] || "static" === this._storedCSS[k]) && (this._storedCSS[k] = "")
                }
                this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")
            } else {
                this.currentItem.show()
            }
            for (this.fromOutside && !a && b.push(function (g) {
                this._trigger("receive", g, this._uiHash(this.fromOutside))
            }), !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || a || b.push(function (g) {
                this._trigger("update", g, this._uiHash())
            }), this !== this.currentContainer && (a || (b.push(function (g) {
                this._trigger("remove", g, this._uiHash())
            }), b.push(function (g) {
                return function (h) {
                    g._trigger("receive", h, this._uiHash(this))
                }
            }.call(this, this.currentContainer)), b.push(function (g) {
                return function (h) {
                    g._trigger("update", h, this._uiHash(this))
                }
            }.call(this, this.currentContainer)))), k = this.containers.length - 1; k >= 0; k--) {
                a || b.push(function (g) {
                    return function (h) {
                        g._trigger("deactivate", h, this._uiHash(this))
                    }
                }.call(this, this.containers[k])), this.containers[k].containerCache.over && (b.push(function (g) {
                    return function (h) {
                        g._trigger("out", h, this._uiHash(this))
                    }
                }.call(this, this.containers[k])), this.containers[k].containerCache.over = 0)
            }
            if (this.storedCursor && (this.document.find("body").css("cursor", this.storedCursor), this.storedStylesheet.remove()), this._storedOpacity && this.helper.css("opacity", this._storedOpacity), this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "" : this._storedZIndex), this.dragging = !1, this.cancelHelperRemoval) {
                if (!a) {
                    for (this._trigger("beforeStop", c, this._uiHash()), k = 0; b.length > k; k++) {
                        b[k].call(this, c)
                    }
                    this._trigger("stop", c, this._uiHash())
                }
                return this.fromOutside = !1, !1
            }
            if (a || this._trigger("beforeStop", c, this._uiHash()), this.placeholder[0].parentNode.removeChild(this.placeholder[0]), this.helper[0] !== this.currentItem[0] && this.helper.remove(), this.helper = null, !a) {
                for (k = 0; b.length > k; k++) {
                    b[k].call(this, c)
                }
                this._trigger("stop", c, this._uiHash())
            }
            return this.fromOutside = !1, !0
        },
        _trigger: function () {
            d.Widget.prototype._trigger.apply(this, arguments) === !1 && this.cancel()
        },
        _uiHash: function (a) {
            var b = a || this;
            return {
                helper: b.helper,
                placeholder: b.placeholder || d([]),
                position: b.position,
                originalPosition: b.originalPosition,
                offset: b.positionAbs,
                item: b.currentItem,
                sender: a ? a.element : null
            }
        }
    })
})(jQuery);
(function (e) {
    var g = 0,
            f = {}, h = {};
    f.height = f.paddingTop = f.paddingBottom = f.borderTopWidth = f.borderBottomWidth = "hide", h.height = h.paddingTop = h.paddingBottom = h.borderTopWidth = h.borderBottomWidth = "show", e.widget("ui.accordion", {
        version: "1.10.3",
        options: {
            active: 0,
            animate: {},
            collapsible: !1,
            event: "click",
            header: "> li > :first-child,> :not(li):even",
            heightStyle: "auto",
            icons: {
                activeHeader: "ui-icon-triangle-1-s",
                header: "ui-icon-triangle-1-e"
            },
            activate: null,
            beforeActivate: null
        },
        _create: function () {
            var a = this.options;
            this.prevShow = this.prevHide = e(), this.element.addClass("ui-accordion ui-widget ui-helper-reset").attr("role", "tablist"), a.collapsible || a.active !== !1 && null != a.active || (a.active = 0), this._processPanels(), 0 > a.active && (a.active += this.headers.length), this._refresh()
        },
        _getCreateEventData: function () {
            return {
                header: this.active,
                panel: this.active.length ? this.active.next() : e(),
                content: this.active.length ? this.active.next() : e()
            }
        },
        _createIcons: function () {
            var a = this.options.icons;
            a && (e("<span>").addClass("ui-accordion-header-icon ui-icon " + a.header).prependTo(this.headers), this.active.children(".ui-accordion-header-icon").removeClass(a.header).addClass(a.activeHeader), this.headers.addClass("ui-accordion-icons"))
        },
        _destroyIcons: function () {
            this.headers.removeClass("ui-accordion-icons").children(".ui-accordion-header-icon").remove()
        },
        _destroy: function () {
            var a;
            this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role"), this.headers.removeClass("ui-accordion-header ui-accordion-header-active ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-selected").removeAttr("aria-controls").removeAttr("tabIndex").each(function () {
                /^ui-accordion/.test(this.id) && this.removeAttribute("id")
            }), this._destroyIcons(), a = this.headers.next().css("display", "").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-labelledby").removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-state-disabled").each(function () {
                /^ui-accordion/.test(this.id) && this.removeAttribute("id")
            }), "content" !== this.options.heightStyle && a.css("height", "")
        },
        _setOption: function (b, a) {
            return "active" === b ? (this._activate(a), undefined) : ("event" === b && (this.options.event && this._off(this.headers, this.options.event), this._setupEvents(a)), this._super(b, a), "collapsible" !== b || a || this.options.active !== !1 || this._activate(0), "icons" === b && (this._destroyIcons(), a && this._createIcons()), "disabled" === b && this.headers.add(this.headers.next()).toggleClass("ui-state-disabled", !!a), undefined)
        },
        _keydown: function (b) {
            if (!b.altKey && !b.ctrlKey) {
                var d = e.ui.keyCode,
                        c = this.headers.length,
                        a = this.headers.index(b.target),
                        m = !1;
                switch (b.keyCode) {
                    case d.RIGHT:
                    case d.DOWN:
                        m = this.headers[(a + 1) % c];
                        break;
                    case d.LEFT:
                    case d.UP:
                        m = this.headers[(a - 1 + c) % c];
                        break;
                    case d.SPACE:
                    case d.ENTER:
                        this._eventHandler(b);
                        break;
                    case d.HOME:
                        m = this.headers[0];
                        break;
                    case d.END:
                        m = this.headers[c - 1]
                }
                m && (e(b.target).attr("tabIndex", -1), e(m).attr("tabIndex", 0), m.focus(), b.preventDefault())
            }
        },
        _panelKeyDown: function (a) {
            a.keyCode === e.ui.keyCode.UP && a.ctrlKey && e(a.currentTarget).prev().focus()
        },
        refresh: function () {
            var a = this.options;
            this._processPanels(), a.active === !1 && a.collapsible === !0 || !this.headers.length ? (a.active = !1, this.active = e()) : a.active === !1 ? this._activate(0) : this.active.length && !e.contains(this.element[0], this.active[0]) ? this.headers.length === this.headers.find(".ui-state-disabled").length ? (a.active = !1, this.active = e()) : this._activate(Math.max(0, a.active - 1)) : a.active = this.headers.index(this.active), this._destroyIcons(), this._refresh()
        },
        _processPanels: function () {
            this.headers = this.element.find(this.options.header).addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all"), this.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").filter(":not(.ui-accordion-content-active)").hide()
        },
        _refresh: function () {
            var d, c = this.options,
                    a = c.heightStyle,
                    l = this.element.parent(),
                    b = this.accordionId = "ui-accordion-" + (this.element.attr("id") || ++g);
            this.active = this._findActive(c.active).addClass("ui-accordion-header-active ui-state-active ui-corner-top").removeClass("ui-corner-all"), this.active.next().addClass("ui-accordion-content-active").show(), this.headers.attr("role", "tab").each(function (s) {
                var k = e(this),
                        u = k.attr("id"),
                        r = k.next(),
                        n = r.attr("id");
                u || (u = b + "-header-" + s, k.attr("id", u)), n || (n = b + "-panel-" + s, r.attr("id", n)), k.attr("aria-controls", n), r.attr("aria-labelledby", u)
            }).next().attr("role", "tabpanel"), this.headers.not(this.active).attr({
                "aria-selected": "false",
                tabIndex: -1
            }).next().attr({
                "aria-expanded": "false",
                "aria-hidden": "true"
            }).hide(), this.active.length ? this.active.attr({
                "aria-selected": "true",
                tabIndex: 0
            }).next().attr({
                "aria-expanded": "true",
                "aria-hidden": "false"
            }) : this.headers.eq(0).attr("tabIndex", 0), this._createIcons(), this._setupEvents(c.event), "fill" === a ? (d = l.height(), this.element.siblings(":visible").each(function () {
                var k = e(this),
                        n = k.css("position");
                "absolute" !== n && "fixed" !== n && (d -= k.outerHeight(!0))
            }), this.headers.each(function () {
                d -= e(this).outerHeight(!0)
            }), this.headers.next().each(function () {
                e(this).height(Math.max(0, d - e(this).innerHeight() + e(this).height()))
            }).css("overflow", "auto")) : "auto" === a && (d = 0, this.headers.next().each(function () {
                d = Math.max(d, e(this).css("height", "").height())
            }).height(d))
        },
        _activate: function (a) {
            var b = this._findActive(a)[0];
            b !== this.active[0] && (b = b || this.active[0], this._eventHandler({
                target: b,
                currentTarget: b,
                preventDefault: e.noop
            }))
        },
        _findActive: function (a) {
            return "number" == typeof a ? this.headers.eq(a) : e()
        },
        _setupEvents: function (a) {
            var b = {
                keydown: "_keydown"
            };
            a && e.each(a.split(" "), function (d, c) {
                b[c] = "_eventHandler"
            }), this._off(this.headers.add(this.headers.next())), this._on(this.headers, b), this._on(this.headers.next(), {
                keydown: "_panelKeyDown"
            }), this._hoverable(this.headers), this._focusable(this.headers)
        },
        _eventHandler: function (s) {
            var b = this.options,
                    o = this.active,
                    d = e(s.currentTarget),
                    r = d[0] === o[0],
                    l = r && b.collapsible,
                    n = l ? e() : d.next(),
                    a = o.next(),
                    c = {
                        oldHeader: o,
                        oldPanel: a,
                        newHeader: l ? e() : d,
                        newPanel: n
                    };
            s.preventDefault(), r && !b.collapsible || this._trigger("beforeActivate", s, c) === !1 || (b.active = l ? !1 : this.headers.index(d), this.active = r ? e() : d, this._toggle(c), o.removeClass("ui-accordion-header-active ui-state-active"), b.icons && o.children(".ui-accordion-header-icon").removeClass(b.icons.activeHeader).addClass(b.icons.header), r || (d.removeClass("ui-corner-all").addClass("ui-accordion-header-active ui-state-active ui-corner-top"), b.icons && d.children(".ui-accordion-header-icon").removeClass(b.icons.header).addClass(b.icons.activeHeader), d.next().addClass("ui-accordion-content-active")))
        },
        _toggle: function (a) {
            var c = a.newPanel,
                    b = this.prevShow.length ? this.prevShow : a.oldPanel;
            this.prevShow.add(this.prevHide).stop(!0, !0), this.prevShow = c, this.prevHide = b, this.options.animate ? this._animate(c, b, a) : (b.hide(), c.show(), this._toggleComplete(a)), b.attr({
                "aria-expanded": "false",
                "aria-hidden": "true"
            }), b.prev().attr("aria-selected", "false"), c.length && b.length ? b.prev().attr("tabIndex", -1) : c.length && this.headers.filter(function () {
                return 0 === e(this).attr("tabIndex")
            }).attr("tabIndex", -1), c.attr({
                "aria-expanded": "true",
                "aria-hidden": "false"
            }).prev().attr({
                "aria-selected": "true",
                tabIndex: 0
            })
        },
        _animate: function (b, C, d) {
            var p, l, o, D = this,
                    a = 0,
                    r = b.length && (!C.length || b.index() < C.index()),
                    c = this.options.animate || {}, u = r && c.down || c,
                    n = function () {
                        D._toggleComplete(d)
                    };
            return "number" == typeof u && (o = u), "string" == typeof u && (l = u), l = l || u.easing || c.easing, o = o || u.duration || c.duration, C.length ? b.length ? (p = b.show().outerHeight(), C.animate(f, {
                duration: o,
                easing: l,
                step: function (m, k) {
                    k.now = Math.round(m)
                }
            }), b.hide().animate(h, {
                duration: o,
                easing: l,
                complete: n,
                step: function (k, m) {
                    m.now = Math.round(k), "height" !== m.prop ? a += m.now : "content" !== D.options.heightStyle && (m.now = Math.round(p - C.outerHeight() - a), a = 0)
                }
            }), undefined) : C.animate(f, o, l, n) : b.animate(h, o, l, n)
        },
        _toggleComplete: function (b) {
            var a = b.oldPanel;
            a.removeClass("ui-accordion-content-active").prev().removeClass("ui-corner-top").addClass("ui-corner-all"), a.length && (a.parent()[0].className = a.parent()[0].className), this._trigger("activate", null, b)
        }
    })
})(jQuery);
(function (d) {
    var c = 0;
    d.widget("ui.autocomplete", {
        version: "1.10.3",
        defaultElement: "<input>",
        options: {
            appendTo: null,
            autoFocus: !1,
            delay: 300,
            minLength: 1,
            position: {
                my: "left top",
                at: "left bottom",
                collision: "none"
            },
            source: null,
            change: null,
            close: null,
            focus: null,
            open: null,
            response: null,
            search: null,
            select: null
        },
        pending: 0,
        _create: function () {
            var e, m, l, a = this.element[0].nodeName.toLowerCase(),
                    n = "textarea" === a,
                    b = "input" === a;
            this.isMultiLine = n ? !0 : b ? !1 : this.element.prop("isContentEditable"), this.valueMethod = this.element[n || b ? "val" : "text"], this.isNewMenu = !0, this.element.addClass("ui-autocomplete-input").attr("autocomplete", "off"), this._on(this.element, {
                keydown: function (f) {
                    if (this.element.prop("readOnly")) {
                        return e = !0, l = !0, m = !0, undefined
                    }
                    e = !1, l = !1, m = !1;
                    var g = d.ui.keyCode;
                    switch (f.keyCode) {
                        case g.PAGE_UP:
                            e = !0, this._move("previousPage", f);
                            break;
                        case g.PAGE_DOWN:
                            e = !0, this._move("nextPage", f);
                            break;
                        case g.UP:
                            e = !0, this._keyEvent("previous", f);
                            break;
                        case g.DOWN:
                            e = !0, this._keyEvent("next", f);
                            break;
                        case g.ENTER:
                        case g.NUMPAD_ENTER:
                            this.menu.active && (e = !0, f.preventDefault(), this.menu.select(f));
                            break;
                        case g.TAB:
                            this.menu.active && this.menu.select(f);
                            break;
                        case g.ESCAPE:
                            this.menu.element.is(":visible") && (this._value(this.term), this.close(f), f.preventDefault());
                            break;
                        default:
                            m = !0, this._searchTimeout(f)
                    }
                },
                keypress: function (g) {
                    if (e) {
                        return e = !1, (!this.isMultiLine || this.menu.element.is(":visible")) && g.preventDefault(), undefined
                    }
                    if (!m) {
                        var f = d.ui.keyCode;
                        switch (g.keyCode) {
                            case f.PAGE_UP:
                                this._move("previousPage", g);
                                break;
                            case f.PAGE_DOWN:
                                this._move("nextPage", g);
                                break;
                            case f.UP:
                                this._keyEvent("previous", g);
                                break;
                            case f.DOWN:
                                this._keyEvent("next", g)
                        }
                    }
                },
                input: function (f) {
                    return l ? (l = !1, f.preventDefault(), undefined) : (this._searchTimeout(f), undefined)
                },
                focus: function () {
                    this.selectedItem = null, this.previous = this._value()
                },
                blur: function (f) {
                    return this.cancelBlur ? (delete this.cancelBlur, undefined) : (clearTimeout(this.searching), this.close(f), this._change(f), undefined)
                }
            }), this._initSource(), this.menu = d("<ul>").addClass("ui-autocomplete ui-front").appendTo(this._appendTo()).menu({
                role: null
            }).hide().data("ui-menu"), this._on(this.menu.element, {
                mousedown: function (f) {
                    f.preventDefault(), this.cancelBlur = !0, this._delay(function () {
                        delete this.cancelBlur
                    });
                    var g = this.menu.element[0];
                    d(f.target).closest(".ui-menu-item").length || this._delay(function () {
                        var h = this;
                        this.document.one("mousedown", function (k) {
                            k.target === h.element[0] || k.target === g || d.contains(g, k.target) || h.close()
                        })
                    })
                },
                menufocus: function (h, g) {
                    if (this.isNewMenu && (this.isNewMenu = !1, h.originalEvent && /^mouse/.test(h.originalEvent.type))) {
                        return this.menu.blur(), this.document.one("mousemove", function () {
                            d(h.target).trigger(h.originalEvent)
                        }), undefined
                    }
                    var f = g.item.data("ui-autocomplete-item");
                    !1 !== this._trigger("focus", h, {
                        item: f
                    }) ? h.originalEvent && /^key/.test(h.originalEvent.type) && this._value(f.value) : this.liveRegion.text(f.value)
                },
                menuselect: function (f, h) {
                    var g = h.item.data("ui-autocomplete-item"),
                            k = this.previous;
                    this.element[0] !== this.document[0].activeElement && (this.element.focus(), this.previous = k, this._delay(function () {
                        this.previous = k, this.selectedItem = g
                    })), !1 !== this._trigger("select", f, {
                        item: g
                    }) && this._value(g.value), this.term = this._value(), this.close(f), this.selectedItem = g
                }
            }), this.liveRegion = d("<span>", {
                role: "status",
                "aria-live": "polite"
            }).addClass("ui-helper-hidden-accessible").insertBefore(this.element), this._on(this.window, {
                beforeunload: function () {
                    this.element.removeAttr("autocomplete")
                }
            })
        },
        _destroy: function () {
            clearTimeout(this.searching), this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete"), this.menu.element.remove(), this.liveRegion.remove()
        },
        _setOption: function (b, a) {
            this._super(b, a), "source" === b && this._initSource(), "appendTo" === b && this.menu.element.appendTo(this._appendTo()), "disabled" === b && a && this.xhr && this.xhr.abort()
        },
        _appendTo: function () {
            var a = this.options.appendTo;
            return a && (a = a.jquery || a.nodeType ? d(a) : this.document.find(a).eq(0)), a || (a = this.element.closest(".ui-front")), a.length || (a = this.document[0].body), a
        },
        _initSource: function () {
            var a, e, b = this;
            d.isArray(this.options.source) ? (a = this.options.source, this.source = function (h, f) {
                f(d.ui.autocomplete.filter(a, h.term))
            }) : "string" == typeof this.options.source ? (e = this.options.source, this.source = function (k, f) {
                b.xhr && b.xhr.abort(), b.xhr = d.ajax({
                    url: e,
                    data: k,
                    dataType: "json",
                    success: function (g) {
                        f(g)
                    },
                    error: function () {
                        f([])
                    }
                })
            }) : this.source = this.options.source
        },
        _searchTimeout: function (a) {
            clearTimeout(this.searching), this.searching = this._delay(function () {
                this.term !== this._value() && (this.selectedItem = null, this.search(null, a))
            }, this.options.delay)
        },
        search: function (b, a) {
            return b = null != b ? b : this._value(), this.term = this._value(), b.length < this.options.minLength ? this.close(a) : this._trigger("search", a) !== !1 ? this._search(b) : undefined
        },
        _search: function (a) {
            this.pending++, this.element.addClass("ui-autocomplete-loading"), this.cancelSearch = !1, this.source({
                term: a
            }, this._response())
        },
        _response: function () {
            var a = this,
                    b = ++c;
            return function (f) {
                b === c && a.__response(f), a.pending--, a.pending || a.element.removeClass("ui-autocomplete-loading")
            }
        },
        __response: function (a) {
            a && (a = this._normalize(a)), this._trigger("response", null, {
                content: a
            }), !this.options.disabled && a && a.length && !this.cancelSearch ? (this._suggest(a), this._trigger("open")) : this._close()
        },
        close: function (a) {
            this.cancelSearch = !0, this._close(a)
        },
        _close: function (a) {
            this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.blur(), this.isNewMenu = !0, this._trigger("close", a))
        },
        _change: function (a) {
            this.previous !== this._value() && this._trigger("change", a, {
                item: this.selectedItem
            })
        },
        _normalize: function (a) {
            return a.length && a[0].label && a[0].value ? a : d.map(a, function (b) {
                return "string" == typeof b ? {
                    label: b,
                    value: b
                } : d.extend({
                    label: b.label || b.value,
                    value: b.value || b.label
                }, b)
            })
        },
        _suggest: function (a) {
            var b = this.menu.element.empty();
            this._renderMenu(b, a), this.isNewMenu = !0, this.menu.refresh(), b.show(), this._resizeMenu(), b.position(d.extend({
                of: this.element
            }, this.options.position)), this.options.autoFocus && this.menu.next()
        },
        _resizeMenu: function () {
            var a = this.menu.element;
            a.outerWidth(Math.max(a.width("").outerWidth() + 1, this.element.outerWidth()))
        },
        _renderMenu: function (a, e) {
            var b = this;
            d.each(e, function (f, h) {
                b._renderItemData(a, h)
            })
        },
        _renderItemData: function (b, a) {
            return this._renderItem(b, a).data("ui-autocomplete-item", a)
        },
        _renderItem: function (a, b) {
            return d("<li>").append(d("<a>").text(b.label)).appendTo(a)
        },
        _move: function (b, a) {
            return this.menu.element.is(":visible") ? this.menu.isFirstItem() && /^previous/.test(b) || this.menu.isLastItem() && /^next/.test(b) ? (this._value(this.term), this.menu.blur(), undefined) : (this.menu[b](a), undefined) : (this.search(null, a), undefined)
        },
        widget: function () {
            return this.menu.element
        },
        _value: function () {
            return this.valueMethod.apply(this.element, arguments)
        },
        _keyEvent: function (b, a) {
            (!this.isMultiLine || this.menu.element.is(":visible")) && (this._move(b, a), a.preventDefault())
        }
    }), d.extend(d.ui.autocomplete, {
        escapeRegex: function (a) {
            return a.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
        },
        filter: function (a, e) {
            var b = RegExp(d.ui.autocomplete.escapeRegex(e), "i");
            return d.grep(a, function (f) {
                return b.test(f.label || f.value || f)
            })
        }
    }), d.widget("ui.autocomplete", d.ui.autocomplete, {
        options: {
            messages: {
                noResults: "No search results.",
                results: function (a) {
                    return a + (a > 1 ? " results are" : " result is") + " available, use up and down arrow keys to navigate."
                }
            }
        },
        __response: function (b) {
            var a;
            this._superApply(arguments), this.options.disabled || this.cancelSearch || (a = b && b.length ? this.options.messages.results(b.length) : this.options.messages.noResults, this.liveRegion.text(a))
        }
    })
})(jQuery);
(function (a) {
    var h, n, w, r, e = "ui-button ui-widget ui-state-default ui-corner-all",
            s = "ui-state-hover ui-state-active ",
            v = "ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",
            l = function () {
                var b = a(this);
                setTimeout(function () {
                    b.find(":ui-button").button("refresh")
                }, 1)
            }, o = function (c) {
        var b = c.name,
                d = c.form,
                f = a([]);
        return b && (b = b.replace(/'/g, "\\'"), f = d ? a(d).find("[name='" + b + "']") : a("[name='" + b + "']", c.ownerDocument).filter(function () {
            return !this.form
        })), f
    };
    a.widget("ui.button", {
        version: "1.10.3",
        defaultElement: "<button>",
        options: {
            disabled: null,
            text: !0,
            label: null,
            icons: {
                primary: null,
                secondary: null
            }
        },
        _create: function () {
            this.element.closest("form").unbind("reset" + this.eventNamespace).bind("reset" + this.eventNamespace, l), "boolean" != typeof this.options.disabled ? this.options.disabled = !!this.element.prop("disabled") : this.element.prop("disabled", this.options.disabled), this._determineButtonType(), this.hasTitle = !!this.buttonElement.attr("title");
            var c = this,
                    f = this.options,
                    g = "checkbox" === this.type || "radio" === this.type,
                    b = g ? "" : "ui-state-active",
                    d = "ui-state-focus";
            null === f.label && (f.label = "input" === this.type ? this.buttonElement.val() : this.buttonElement.html()), this._hoverable(this.buttonElement), this.buttonElement.addClass(e).attr("role", "button").bind("mouseenter" + this.eventNamespace, function () {
                f.disabled || this === h && a(this).addClass("ui-state-active")
            }).bind("mouseleave" + this.eventNamespace, function () {
                f.disabled || a(this).removeClass(b)
            }).bind("click" + this.eventNamespace, function (k) {
                f.disabled && (k.preventDefault(), k.stopImmediatePropagation())
            }), this.element.bind("focus" + this.eventNamespace, function () {
                c.buttonElement.addClass(d)
            }).bind("blur" + this.eventNamespace, function () {
                c.buttonElement.removeClass(d)
            }), g && (this.element.bind("change" + this.eventNamespace, function () {
                r || c.refresh()
            }), this.buttonElement.bind("mousedown" + this.eventNamespace, function (k) {
                f.disabled || (r = !1, n = k.pageX, w = k.pageY)
            }).bind("mouseup" + this.eventNamespace, function (k) {
                f.disabled || (n !== k.pageX || w !== k.pageY) && (r = !0)
            })), "checkbox" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, function () {
                return f.disabled || r ? !1 : undefined
            }) : "radio" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, function () {
                if (f.disabled || r) {
                    return !1
                }
                a(this).addClass("ui-state-active"), c.buttonElement.attr("aria-pressed", "true");
                var k = c.element[0];
                o(k).not(k).map(function () {
                    return a(this).button("widget")[0]
                }).removeClass("ui-state-active").attr("aria-pressed", "false")
            }) : (this.buttonElement.bind("mousedown" + this.eventNamespace, function () {
                return f.disabled ? !1 : (a(this).addClass("ui-state-active"), h = this, c.document.one("mouseup", function () {
                    h = null
                }), undefined)
            }).bind("mouseup" + this.eventNamespace, function () {
                return f.disabled ? !1 : (a(this).removeClass("ui-state-active"), undefined)
            }).bind("keydown" + this.eventNamespace, function (k) {
                return f.disabled ? !1 : ((k.keyCode === a.ui.keyCode.SPACE || k.keyCode === a.ui.keyCode.ENTER) && a(this).addClass("ui-state-active"), undefined)
            }).bind("keyup" + this.eventNamespace + " blur" + this.eventNamespace, function () {
                a(this).removeClass("ui-state-active")
            }), this.buttonElement.is("a") && this.buttonElement.keyup(function (k) {
                k.keyCode === a.ui.keyCode.SPACE && a(this).click()
            })), this._setOption("disabled", f.disabled), this._resetButton()
        },
        _determineButtonType: function () {
            var d, c, b;
            this.type = this.element.is("[type=checkbox]") ? "checkbox" : this.element.is("[type=radio]") ? "radio" : this.element.is("input") ? "input" : "button", "checkbox" === this.type || "radio" === this.type ? (d = this.element.parents().last(), c = "label[for='" + this.element.attr("id") + "']", this.buttonElement = d.find(c), this.buttonElement.length || (d = d.length ? d.siblings() : this.element.siblings(), this.buttonElement = d.filter(c), this.buttonElement.length || (this.buttonElement = d.find(c))), this.element.addClass("ui-helper-hidden-accessible"), b = this.element.is(":checked"), b && this.buttonElement.addClass("ui-state-active"), this.buttonElement.prop("aria-pressed", b)) : this.buttonElement = this.element
        },
        widget: function () {
            return this.buttonElement
        },
        _destroy: function () {
            this.element.removeClass("ui-helper-hidden-accessible"), this.buttonElement.removeClass(e + " " + s + " " + v).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html()), this.hasTitle || this.buttonElement.removeAttr("title")
        },
        _setOption: function (b, c) {
            return this._super(b, c), "disabled" === b ? (c ? this.element.prop("disabled", !0) : this.element.prop("disabled", !1), undefined) : (this._resetButton(), undefined)
        },
        refresh: function () {
            var b = this.element.is("input, button") ? this.element.is(":disabled") : this.element.hasClass("ui-button-disabled");
            b !== this.options.disabled && this._setOption("disabled", b), "radio" === this.type ? o(this.element[0]).each(function () {
                a(this).is(":checked") ? a(this).button("widget").addClass("ui-state-active").attr("aria-pressed", "true") : a(this).button("widget").removeClass("ui-state-active").attr("aria-pressed", "false")
            }) : "checkbox" === this.type && (this.element.is(":checked") ? this.buttonElement.addClass("ui-state-active").attr("aria-pressed", "true") : this.buttonElement.removeClass("ui-state-active").attr("aria-pressed", "false"))
        },
        _resetButton: function () {
            if ("input" === this.type) {
                return this.options.label && this.element.val(this.options.label), undefined
            }
            var f = this.buttonElement.removeClass(v),
                    b = a("<span></span>", this.document[0]).addClass("ui-button-text").html(this.options.label).appendTo(f.empty()).text(),
                    g = this.options.icons,
                    c = g.primary && g.secondary,
                    d = [];
            g.primary || g.secondary ? (this.options.text && d.push("ui-button-text-icon" + (c ? "s" : g.primary ? "-primary" : "-secondary")), g.primary && f.prepend("<span class='ui-button-icon-primary ui-icon " + g.primary + "'></span>"), g.secondary && f.append("<span class='ui-button-icon-secondary ui-icon " + g.secondary + "'></span>"), this.options.text || (d.push(c ? "ui-button-icons-only" : "ui-button-icon-only"), this.hasTitle || f.attr("title", a.trim(b)))) : d.push("ui-button-text-only"), f.addClass(d.join(" "))
        }
    }), a.widget("ui.buttonset", {
        version: "1.10.3",
        options: {
            items: "button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)"
        },
        _create: function () {
            this.element.addClass("ui-buttonset")
        },
        _init: function () {
            this.refresh()
        },
        _setOption: function (b, c) {
            "disabled" === b && this.buttons.button("option", b, c), this._super(b, c)
        },
        refresh: function () {
            var b = "rtl" === this.element.css("direction");
            this.buttons = this.element.find(this.options.items).filter(":ui-button").button("refresh").end().not(":ui-button").button().end().map(function () {
                return a(this).button("widget")[0]
            }).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(b ? "ui-corner-right" : "ui-corner-left").end().filter(":last").addClass(b ? "ui-corner-left" : "ui-corner-right").end().end()
        },
        _destroy: function () {
            this.element.removeClass("ui-buttonset"), this.buttons.map(function () {
                return a(this).button("widget")[0]
            }).removeClass("ui-corner-left ui-corner-right").end().button("destroy")
        }
    })
})(jQuery);
(function (o, l) {
    function p() {
        this._curInst = null, this._keyEvent = !1, this._disabledInputs = [], this._datepickerShowing = !1, this._inDialog = !1, this._mainDivId = "ui-datepicker-div", this._inlineClass = "ui-datepicker-inline", this._appendClass = "ui-datepicker-append", this._triggerClass = "ui-datepicker-trigger", this._dialogClass = "ui-datepicker-dialog", this._disableClass = "ui-datepicker-disabled", this._unselectableClass = "ui-datepicker-unselectable", this._currentClass = "ui-datepicker-current-day", this._dayOverClass = "ui-datepicker-days-cell-over", this.regional = [], this.regional[""] = {
            closeText: "Done",
            prevText: "Prev",
            nextText: "Next",
            currentText: "Today",
            monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
            weekHeader: "Wk",
            dateFormat: "mm/dd/yy",
            firstDay: 0,
            isRTL: !1,
            showMonthAfterYear: !1,
            yearSuffix: ""
        }, this._defaults = {
            showOn: "focus",
            showAnim: "fadeIn",
            showOptions: {},
            defaultDate: null,
            appendText: "",
            buttonText: "...",
            buttonImage: "",
            buttonImageOnly: !1,
            hideIfNoPrevNext: !1,
            navigationAsDateFormat: !1,
            gotoCurrent: !1,
            changeMonth: !1,
            changeYear: !1,
            yearRange: "c-10:c+10",
            showOtherMonths: !1,
            selectOtherMonths: !1,
            showWeek: !1,
            calculateWeek: this.iso8601Week,
            shortYearCutoff: "+10",
            minDate: null,
            maxDate: null,
            duration: "fast",
            beforeShowDay: null,
            beforeShow: null,
            onSelect: null,
            onChangeMonthYear: null,
            onClose: null,
            numberOfMonths: 1,
            showCurrentAtPos: 0,
            stepMonths: 1,
            stepBigMonths: 12,
            altField: "",
            altFormat: "",
            constrainInput: !0,
            showButtonPanel: !1,
            autoSize: !1,
            disabled: !1
        }, o.extend(this._defaults, this.regional[""]), this.dpDiv = n(o("<div id='" + this._mainDivId + "' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))
    }
    function n(c) {
        var b = "button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";
        return c.delegate(b, "mouseout", function () {
            o(this).removeClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && o(this).removeClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && o(this).removeClass("ui-datepicker-next-hover")
        }).delegate(b, "mouseover", function () {
            o.datepicker._isDisabledDatepicker(a.inline ? c.parent()[0] : a.input[0]) || (o(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"), o(this).addClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && o(this).addClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && o(this).addClass("ui-datepicker-next-hover"))
        })
    }
    function e(b, d) {
        o.extend(b, d);
        for (var c in d) {
            null == d[c] && (b[c] = d[c])
        }
        return b
    }
    o.extend(o.ui, {
        datepicker: {
            version: "1.10.3"
        }
    });
    var a, m = "datepicker";
    o.extend(p.prototype, {
        markerClassName: "hasDatepicker",
        maxRows: 4,
        _widgetDatepicker: function () {
            return this.dpDiv
        },
        setDefaults: function (b) {
            return e(this._defaults, b || {}), this
        },
        _attachDatepicker: function (f, b) {
            var g, d, c;
            g = f.nodeName.toLowerCase(), d = "div" === g || "span" === g, f.id || (this.uuid += 1, f.id = "dp" + this.uuid), c = this._newInst(o(f), d), c.settings = o.extend({}, b || {}), "input" === g ? this._connectDatepicker(f, c) : d && this._inlineDatepicker(f, c)
        },
        _newInst: function (d, c) {
            var b = d[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1");
            return {
                id: b,
                input: d,
                selectedDay: 0,
                selectedMonth: 0,
                selectedYear: 0,
                drawMonth: 0,
                drawYear: 0,
                inline: c,
                dpDiv: c ? n(o("<div class='" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")) : this.dpDiv
            }
        },
        _connectDatepicker: function (b, d) {
            var c = o(b);
            d.append = o([]), d.trigger = o([]), c.hasClass(this.markerClassName) || (this._attachments(c, d), c.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp), this._autoSize(d), o.data(b, m, d), d.settings.disabled && this._disableDatepicker(b))
        },
        _attachments: function (g, b) {
            var k, d, c, h = this._get(b, "appendText"),
                    f = this._get(b, "isRTL");
            b.append && b.append.remove(), h && (b.append = o("<span class='" + this._appendClass + "'>" + h + "</span>"), g[f ? "before" : "after"](b.append)), g.unbind("focus", this._showDatepicker), b.trigger && b.trigger.remove(), k = this._get(b, "showOn"), ("focus" === k || "both" === k) && g.focus(this._showDatepicker), ("button" === k || "both" === k) && (d = this._get(b, "buttonText"), c = this._get(b, "buttonImage"), b.trigger = o(this._get(b, "buttonImageOnly") ? o("<img/>").addClass(this._triggerClass).attr({
                src: c,
                alt: d,
                title: d
            }) : o("<button type='button'></button>").addClass(this._triggerClass).html(c ? o("<img/>").attr({
                src: c,
                alt: d,
                title: d
            }) : d)), g[f ? "before" : "after"](b.trigger), b.trigger.click(function () {
                return o.datepicker._datepickerShowing && o.datepicker._lastInput === g[0] ? o.datepicker._hideDatepicker() : o.datepicker._datepickerShowing && o.datepicker._lastInput !== g[0] ? (o.datepicker._hideDatepicker(), o.datepicker._showDatepicker(g[0])) : o.datepicker._showDatepicker(g[0]), !1
            }))
        },
        _autoSize: function (k) {
            if (this._get(k, "autoSize") && !k.inline) {
                var f, b, h, d, c = new Date(2009, 11, 20),
                        g = this._get(k, "dateFormat");
                g.match(/[DM]/) && (f = function (q) {
                    for (b = 0, h = 0, d = 0; q.length > d; d++) {
                        q[d].length > b && (b = q[d].length, h = d)
                    }
                    return h
                }, c.setMonth(f(this._get(k, g.match(/MM/) ? "monthNames" : "monthNamesShort"))), c.setDate(f(this._get(k, g.match(/DD/) ? "dayNames" : "dayNamesShort")) + 20 - c.getDay())), k.input.attr("size", this._formatDate(k, c).length)
            }
        },
        _inlineDatepicker: function (b, d) {
            var c = o(b);
            c.hasClass(this.markerClassName) || (c.addClass(this.markerClassName).append(d.dpDiv), o.data(b, m, d), this._setDate(d, this._getDefaultDate(d), !0), this._updateDatepicker(d), this._updateAlternate(d), d.settings.disabled && this._disableDatepicker(b), d.dpDiv.css("display", "block"))
        },
        _dialogDatepicker: function (D, b, c, g, h) {
            var E, d, s, f, u, k = this._dialogInst;
            return k || (this.uuid += 1, E = "dp" + this.uuid, this._dialogInput = o("<input type='text' id='" + E + "' style='position: absolute; top: -100px; width: 0px;'/>"), this._dialogInput.keydown(this._doKeyDown), o("body").append(this._dialogInput), k = this._dialogInst = this._newInst(this._dialogInput, !1), k.settings = {}, o.data(this._dialogInput[0], m, k)), e(k.settings, g || {}), b = b && b.constructor === Date ? this._formatDate(k, b) : b, this._dialogInput.val(b), this._pos = h ? h.length ? h : [h.pageX, h.pageY] : null, this._pos || (d = document.documentElement.clientWidth, s = document.documentElement.clientHeight, f = document.documentElement.scrollLeft || document.body.scrollLeft, u = document.documentElement.scrollTop || document.body.scrollTop, this._pos = [d / 2 - 100 + f, s / 2 - 150 + u]), this._dialogInput.css("left", this._pos[0] + 20 + "px").css("top", this._pos[1] + "px"), k.settings.onSelect = c, this._inDialog = !0, this.dpDiv.addClass(this._dialogClass), this._showDatepicker(this._dialogInput[0]), o.blockUI && o.blockUI(this.dpDiv), o.data(this._dialogInput[0], m, k), this
        },
        _destroyDatepicker: function (b) {
            var d, c = o(b),
                    f = o.data(b, m);
            c.hasClass(this.markerClassName) && (d = b.nodeName.toLowerCase(), o.removeData(b, m), "input" === d ? (f.append.remove(), f.trigger.remove(), c.removeClass(this.markerClassName).unbind("focus", this._showDatepicker).unbind("keydown", this._doKeyDown).unbind("keypress", this._doKeyPress).unbind("keyup", this._doKeyUp)) : ("div" === d || "span" === d) && c.removeClass(this.markerClassName).empty())
        },
        _enableDatepicker: function (f) {
            var b, g, d = o(f),
                    c = o.data(f, m);
            d.hasClass(this.markerClassName) && (b = f.nodeName.toLowerCase(), "input" === b ? (f.disabled = !1, c.trigger.filter("button").each(function () {
                this.disabled = !1
            }).end().filter("img").css({
                opacity: "1.0",
                cursor: ""
            })) : ("div" === b || "span" === b) && (g = d.children("." + this._inlineClass), g.children().removeClass("ui-state-disabled"), g.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !1)), this._disabledInputs = o.map(this._disabledInputs, function (h) {
                return h === f ? null : h
            }))
        },
        _disableDatepicker: function (f) {
            var b, g, d = o(f),
                    c = o.data(f, m);
            d.hasClass(this.markerClassName) && (b = f.nodeName.toLowerCase(), "input" === b ? (f.disabled = !0, c.trigger.filter("button").each(function () {
                this.disabled = !0
            }).end().filter("img").css({
                opacity: "0.5",
                cursor: "default"
            })) : ("div" === b || "span" === b) && (g = d.children("." + this._inlineClass), g.children().addClass("ui-state-disabled"), g.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !0)), this._disabledInputs = o.map(this._disabledInputs, function (h) {
                return h === f ? null : h
            }), this._disabledInputs[this._disabledInputs.length] = f)
        },
        _isDisabledDatepicker: function (c) {
            if (!c) {
                return !1
            }
            for (var b = 0; this._disabledInputs.length > b; b++) {
                if (this._disabledInputs[b] === c) {
                    return !0
                }
            }
            return !1
        },
        _getInst: function (c) {
            try {
                return o.data(c, m)
            } catch (b) {
                throw "Missing instance data for this datepicker"
            }
        },
        _optionDatepicker: function (r, g, b) {
            var f, d, k, h, c = this._getInst(r);
            return 2 === arguments.length && "string" == typeof g ? "defaults" === g ? o.extend({}, o.datepicker._defaults) : c ? "all" === g ? o.extend({}, c.settings) : this._get(c, g) : null : (f = g || {}, "string" == typeof g && (f = {}, f[g] = b), c && (this._curInst === c && this._hideDatepicker(), d = this._getDateDatepicker(r, !0), k = this._getMinMaxDate(c, "min"), h = this._getMinMaxDate(c, "max"), e(c.settings, f), null !== k && f.dateFormat !== l && f.minDate === l && (c.settings.minDate = this._formatDate(c, k)), null !== h && f.dateFormat !== l && f.maxDate === l && (c.settings.maxDate = this._formatDate(c, h)), "disabled" in f && (f.disabled ? this._disableDatepicker(r) : this._enableDatepicker(r)), this._attachments(o(r), c), this._autoSize(c), this._setDate(c, d), this._updateAlternate(c), this._updateDatepicker(c)), l)
        },
        _changeDatepicker: function (d, b, c) {
            this._optionDatepicker(d, b, c)
        },
        _refreshDatepicker: function (c) {
            var b = this._getInst(c);
            b && this._updateDatepicker(b)
        },
        _setDateDatepicker: function (d, b) {
            var c = this._getInst(d);
            c && (this._setDate(c, b), this._updateDatepicker(c), this._updateAlternate(c))
        },
        _getDateDatepicker: function (d, b) {
            var c = this._getInst(d);
            return c && !c.inline && this._setDateFromField(c, b), c ? this._getDate(c) : null
        },
        _doKeyDown: function (g) {
            var b, k, d, c = o.datepicker._getInst(g.target),
                    h = !0,
                    f = c.dpDiv.is(".ui-datepicker-rtl");
            if (c._keyEvent = !0, o.datepicker._datepickerShowing) {
                switch (g.keyCode) {
                    case 9:
                        o.datepicker._hideDatepicker(), h = !1;
                        break;
                    case 13:
                        return d = o("td." + o.datepicker._dayOverClass + ":not(." + o.datepicker._currentClass + ")", c.dpDiv), d[0] && o.datepicker._selectDay(g.target, c.selectedMonth, c.selectedYear, d[0]), b = o.datepicker._get(c, "onSelect"), b ? (k = o.datepicker._formatDate(c), b.apply(c.input ? c.input[0] : null, [k, c])) : o.datepicker._hideDatepicker(), !1;
                    case 27:
                        o.datepicker._hideDatepicker();
                        break;
                    case 33:
                        o.datepicker._adjustDate(g.target, g.ctrlKey ? -o.datepicker._get(c, "stepBigMonths") : -o.datepicker._get(c, "stepMonths"), "M");
                        break;
                    case 34:
                        o.datepicker._adjustDate(g.target, g.ctrlKey ? +o.datepicker._get(c, "stepBigMonths") : +o.datepicker._get(c, "stepMonths"), "M");
                        break;
                    case 35:
                        (g.ctrlKey || g.metaKey) && o.datepicker._clearDate(g.target), h = g.ctrlKey || g.metaKey;
                        break;
                    case 36:
                        (g.ctrlKey || g.metaKey) && o.datepicker._gotoToday(g.target), h = g.ctrlKey || g.metaKey;
                        break;
                    case 37:
                        (g.ctrlKey || g.metaKey) && o.datepicker._adjustDate(g.target, f ? 1 : -1, "D"), h = g.ctrlKey || g.metaKey, g.originalEvent.altKey && o.datepicker._adjustDate(g.target, g.ctrlKey ? -o.datepicker._get(c, "stepBigMonths") : -o.datepicker._get(c, "stepMonths"), "M");
                        break;
                    case 38:
                        (g.ctrlKey || g.metaKey) && o.datepicker._adjustDate(g.target, -7, "D"), h = g.ctrlKey || g.metaKey;
                        break;
                    case 39:
                        (g.ctrlKey || g.metaKey) && o.datepicker._adjustDate(g.target, f ? -1 : 1, "D"), h = g.ctrlKey || g.metaKey, g.originalEvent.altKey && o.datepicker._adjustDate(g.target, g.ctrlKey ? +o.datepicker._get(c, "stepBigMonths") : +o.datepicker._get(c, "stepMonths"), "M");
                        break;
                    case 40:
                        (g.ctrlKey || g.metaKey) && o.datepicker._adjustDate(g.target, 7, "D"), h = g.ctrlKey || g.metaKey;
                        break;
                    default:
                        h = !1
                }
            } else {
                36 === g.keyCode && g.ctrlKey ? o.datepicker._showDatepicker(this) : h = !1
            }
            h && (g.preventDefault(), g.stopPropagation())
        },
        _doKeyPress: function (c) {
            var b, f, d = o.datepicker._getInst(c.target);
            return o.datepicker._get(d, "constrainInput") ? (b = o.datepicker._possibleChars(o.datepicker._get(d, "dateFormat")), f = String.fromCharCode(null == c.charCode ? c.keyCode : c.charCode), c.ctrlKey || c.metaKey || " " > f || !b || b.indexOf(f) > -1) : l
        },
        _doKeyUp: function (b) {
            var d, c = o.datepicker._getInst(b.target);
            if (c.input.val() !== c.lastVal) {
                try {
                    d = o.datepicker.parseDate(o.datepicker._get(c, "dateFormat"), c.input ? c.input.val() : null, o.datepicker._getFormatConfig(c)), d && (o.datepicker._setDateFromField(c), o.datepicker._updateAlternate(c), o.datepicker._updateDatepicker(c))
                } catch (f) {
                }
            }
            return !0
        },
        _showDatepicker: function (d) {
            if (d = d.target || d, "input" !== d.nodeName.toLowerCase() && (d = o("input", d.parentNode)[0]), !o.datepicker._isDisabledDatepicker(d) && o.datepicker._lastInput !== d) {
                var k, g, r, f, c, h, b;
                k = o.datepicker._getInst(d), o.datepicker._curInst && o.datepicker._curInst !== k && (o.datepicker._curInst.dpDiv.stop(!0, !0), k && o.datepicker._datepickerShowing && o.datepicker._hideDatepicker(o.datepicker._curInst.input[0])), g = o.datepicker._get(k, "beforeShow"), r = g ? g.apply(d, [d, k]) : {}, r !== !1 && (e(k.settings, r), k.lastVal = null, o.datepicker._lastInput = d, o.datepicker._setDateFromField(k), o.datepicker._inDialog && (d.value = ""), o.datepicker._pos || (o.datepicker._pos = o.datepicker._findPos(d), o.datepicker._pos[1] += d.offsetHeight), f = !1, o(d).parents().each(function () {
                    return f |= "fixed" === o(this).css("position"), !f
                }), c = {
                    left: o.datepicker._pos[0],
                    top: o.datepicker._pos[1]
                }, o.datepicker._pos = null, k.dpDiv.empty(), k.dpDiv.css({
                    position: "absolute",
                    display: "block",
                    top: "-1000px"
                }), o.datepicker._updateDatepicker(k), c = o.datepicker._checkOffset(k, c, f), k.dpDiv.css({
                    position: o.datepicker._inDialog && o.blockUI ? "static" : f ? "fixed" : "absolute",
                    display: "none",
                    left: c.left + "px",
                    top: c.top + "px"
                }), k.inline || (h = o.datepicker._get(k, "showAnim"), b = o.datepicker._get(k, "duration"), k.dpDiv.zIndex(o(d).zIndex() + 1), o.datepicker._datepickerShowing = !0, o.effects && o.effects.effect[h] ? k.dpDiv.show(h, o.datepicker._get(k, "showOptions"), b) : k.dpDiv[h || "show"](h ? b : null), o.datepicker._shouldFocusInput(k) && k.input.focus(), o.datepicker._curInst = k))
            }
        },
        _updateDatepicker: function (g) {
            this.maxRows = 4, a = g, g.dpDiv.empty().append(this._generateHTML(g)), this._attachHandlers(g), g.dpDiv.find("." + this._dayOverClass + " a").mouseover();
            var d, c = this._getNumberOfMonths(g),
                    f = c[1],
                    b = 17;
            g.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""), f > 1 && g.dpDiv.addClass("ui-datepicker-multi-" + f).css("width", b * f + "em"), g.dpDiv[(1 !== c[0] || 1 !== c[1] ? "add" : "remove") + "Class"]("ui-datepicker-multi"), g.dpDiv[(this._get(g, "isRTL") ? "add" : "remove") + "Class"]("ui-datepicker-rtl"), g === o.datepicker._curInst && o.datepicker._datepickerShowing && o.datepicker._shouldFocusInput(g) && g.input.focus(), g.yearshtml && (d = g.yearshtml, setTimeout(function () {
                d === g.yearshtml && g.yearshtml && g.dpDiv.find("select.ui-datepicker-year:first").replaceWith(g.yearshtml), d = g.yearshtml = null
            }, 0))
        },
        _shouldFocusInput: function (b) {
            return b.input && b.input.is(":visible") && !b.input.is(":disabled") && !b.input.is(":focus")
        },
        _checkOffset: function (h, r, d) {
            var b = h.dpDiv.outerWidth(),
                    g = h.dpDiv.outerHeight(),
                    f = h.input ? h.input.outerWidth() : 0,
                    c = h.input ? h.input.outerHeight() : 0,
                    k = document.documentElement.clientWidth + (d ? 0 : o(document).scrollLeft()),
                    s = document.documentElement.clientHeight + (d ? 0 : o(document).scrollTop());
            return r.left -= this._get(h, "isRTL") ? b - f : 0, r.left -= d && r.left === h.input.offset().left ? o(document).scrollLeft() : 0, r.top -= d && r.top === h.input.offset().top + c ? o(document).scrollTop() : 0, r.left -= Math.min(r.left, r.left + b > k && k > b ? Math.abs(r.left + b - k) : 0), r.top -= Math.min(r.top, r.top + g > s && s > g ? Math.abs(g + c) : 0), r
        },
        _findPos: function (b) {
            for (var d, c = this._getInst(b), f = this._get(c, "isRTL"); b && ("hidden" === b.type || 1 !== b.nodeType || o.expr.filters.hidden(b)); ) {
                b = b[f ? "previousSibling" : "nextSibling"]
            }
            return d = o(b).offset(), [d.left, d.top]
        },
        _hideDatepicker: function (g) {
            var b, h, d, c, f = this._curInst;
            !f || g && f !== o.data(g, m) || this._datepickerShowing && (b = this._get(f, "showAnim"), h = this._get(f, "duration"), d = function () {
                o.datepicker._tidyDialog(f)
            }, o.effects && (o.effects.effect[b] || o.effects[b]) ? f.dpDiv.hide(b, o.datepicker._get(f, "showOptions"), h, d) : f.dpDiv["slideDown" === b ? "slideUp" : "fadeIn" === b ? "fadeOut" : "hide"](b ? h : null, d), b || d(), this._datepickerShowing = !1, c = this._get(f, "onClose"), c && c.apply(f.input ? f.input[0] : null, [f.input ? f.input.val() : "", f]), this._lastInput = null, this._inDialog && (this._dialogInput.css({
                position: "absolute",
                left: "0",
                top: "-100px"
            }), o.blockUI && (o.unblockUI(), o("body").append(this.dpDiv))), this._inDialog = !1)
        },
        _tidyDialog: function (b) {
            b.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")
        },
        _checkExternalClick: function (b) {
            if (o.datepicker._curInst) {
                var d = o(b.target),
                        c = o.datepicker._getInst(d[0]);
                (d[0].id !== o.datepicker._mainDivId && 0 === d.parents("#" + o.datepicker._mainDivId).length && !d.hasClass(o.datepicker.markerClassName) && !d.closest("." + o.datepicker._triggerClass).length && o.datepicker._datepickerShowing && (!o.datepicker._inDialog || !o.blockUI) || d.hasClass(o.datepicker.markerClassName) && o.datepicker._curInst !== c) && o.datepicker._hideDatepicker()
            }
        },
        _adjustDate: function (f, b, g) {
            var d = o(f),
                    c = this._getInst(d[0]);
            this._isDisabledDatepicker(d[0]) || (this._adjustInstDate(c, b + ("M" === g ? this._get(c, "showCurrentAtPos") : 0), g), this._updateDatepicker(c))
        },
        _gotoToday: function (b) {
            var d, c = o(b),
                    f = this._getInst(c[0]);
            this._get(f, "gotoCurrent") && f.currentDay ? (f.selectedDay = f.currentDay, f.drawMonth = f.selectedMonth = f.currentMonth, f.drawYear = f.selectedYear = f.currentYear) : (d = new Date, f.selectedDay = d.getDate(), f.drawMonth = f.selectedMonth = d.getMonth(), f.drawYear = f.selectedYear = d.getFullYear()), this._notifyChange(f), this._adjustDate(c)
        },
        _selectMonthYear: function (f, b, g) {
            var d = o(f),
                    c = this._getInst(d[0]);
            c["selected" + ("M" === g ? "Month" : "Year")] = c["draw" + ("M" === g ? "Month" : "Year")] = parseInt(b.options[b.selectedIndex].value, 10), this._notifyChange(c), this._adjustDate(d)
        },
        _selectDay: function (f, b, h, d) {
            var c, g = o(f);
            o(d).hasClass(this._unselectableClass) || this._isDisabledDatepicker(g[0]) || (c = this._getInst(g[0]), c.selectedDay = c.currentDay = o("a", d).html(), c.selectedMonth = c.currentMonth = b, c.selectedYear = c.currentYear = h, this._selectDate(f, this._formatDate(c, c.currentDay, c.currentMonth, c.currentYear)))
        },
        _clearDate: function (c) {
            var b = o(c);
            this._selectDate(b, "")
        },
        _selectDate: function (f, b) {
            var g, d = o(f),
                    c = this._getInst(d[0]);
            b = null != b ? b : this._formatDate(c), c.input && c.input.val(b), this._updateAlternate(c), g = this._get(c, "onSelect"), g ? g.apply(c.input ? c.input[0] : null, [b, c]) : c.input && c.input.trigger("change"), c.inline ? this._updateDatepicker(c) : (this._hideDatepicker(), this._lastInput = c.input[0], "object" != typeof c.input[0] && c.input.focus(), this._lastInput = null)
        },
        _updateAlternate: function (f) {
            var b, g, d, c = this._get(f, "altField");
            c && (b = this._get(f, "altFormat") || this._get(f, "dateFormat"), g = this._getDate(f), d = this.formatDate(b, g, this._getFormatConfig(f)), o(c).each(function () {
                o(this).val(d)
            }))
        },
        noWeekends: function (c) {
            var b = c.getDay();
            return [b > 0 && 6 > b, ""]
        },
        iso8601Week: function (d) {
            var b, c = new Date(d.getTime());
            return c.setDate(c.getDate() + 4 - (c.getDay() || 7)), b = c.getTime(), c.setMonth(0), c.setDate(1), Math.floor(Math.round((b - c) / 86400000) / 7) + 1
        },
        parseDate: function (s, X, x) {
            if (null == s || null == X) {
                throw "Invalid arguments"
            }
            if (X = "object" == typeof X ? "" + X : X + "", "" === X) {
                return null
            }
            var c, W, y, r, v = 0,
                    f = (x ? x.shortYearCutoff : null) || this._defaults.shortYearCutoff,
                    Z = "string" != typeof f ? f : (new Date).getFullYear() % 100 + parseInt(f, 10),
                    g = (x ? x.dayNamesShort : null) || this._defaults.dayNamesShort,
                    D = (x ? x.dayNames : null) || this._defaults.dayNames,
                    h = (x ? x.monthNamesShort : null) || this._defaults.monthNamesShort,
                    w = (x ? x.monthNames : null) || this._defaults.monthNames,
                    k = -1,
                    ab = -1,
                    b = -1,
                    d = -1,
                    ad = !1,
                    aa = function (A) {
                        var q = s.length > c + 1 && s.charAt(c + 1) === A;
                        return q && c++, q
                    }, u = function (E) {
                var C = aa(E),
                        q = "@" === E ? 14 : "!" === E ? 20 : "y" === E && C ? 4 : "o" === E ? 3 : 2,
                        B = RegExp("^\\d{1," + q + "}"),
                        A = X.substring(v).match(B);
                if (!A) {
                    throw "Missing number at position " + v
                }
                return v += A[0].length, parseInt(A[0], 10)
            }, ac = function (q, B, A) {
                var E = -1,
                        C = o.map(aa(q) ? A : B, function (F, G) {
                            return [[G, F]]
                        }).sort(function (F, G) {
                    return -(F[1].length - G[1].length)
                });
                if (o.each(C, function (H, F) {
                    var G = F[1];
                    return X.substr(v, G.length).toLowerCase() === G.toLowerCase() ? (E = F[0], v += G.length, !1) : l
                }), -1 !== E) {
                    return E + 1
                }
                throw "Unknown name at position " + v
            }, Y = function () {
                if (X.charAt(v) !== s.charAt(c)) {
                    throw "Unexpected literal at position " + v
                }
                v++
            };
            for (c = 0; s.length > c; c++) {
                if (ad) {
                    "'" !== s.charAt(c) || aa("'") ? Y() : ad = !1
                } else {
                    switch (s.charAt(c)) {
                        case "d":
                            b = u("d");
                            break;
                        case "D":
                            ac("D", g, D);
                            break;
                        case "o":
                            d = u("o");
                            break;
                        case "m":
                            ab = u("m");
                            break;
                        case "M":
                            ab = ac("M", h, w);
                            break;
                        case "y":
                            k = u("y");
                            break;
                        case "@":
                            r = new Date(u("@")), k = r.getFullYear(), ab = r.getMonth() + 1, b = r.getDate();
                            break;
                        case "!":
                            r = new Date((u("!") - this._ticksTo1970) / 10000), k = r.getFullYear(), ab = r.getMonth() + 1, b = r.getDate();
                            break;
                        case "'":
                            aa("'") ? Y() : ad = !0;
                            break;
                        default:
                            Y()
                    }
                }
            }
            if (X.length > v && (y = X.substr(v), !/^\s+/.test(y))) {
                throw "Extra/unparsed characters found in date: " + y
            }
            if (-1 === k ? k = (new Date).getFullYear() : 100 > k && (k += (new Date).getFullYear() - (new Date).getFullYear() % 100 + (Z >= k ? 0 : -100)), d > -1) {
                for (ab = 1, b = d; ; ) {
                    if (W = this._getDaysInMonth(k, ab - 1), W >= b) {
                        break
                    }
                    ab++, b -= W
                }
            }
            if (r = this._daylightSavingAdjust(new Date(k, ab - 1, b)), r.getFullYear() !== k || r.getMonth() + 1 !== ab || r.getDate() !== b) {
                throw "Invalid date"
            }
            return r
        },
        ATOM: "yy-mm-dd",
        COOKIE: "D, dd M yy",
        ISO_8601: "yy-mm-dd",
        RFC_822: "D, d M y",
        RFC_850: "DD, dd-M-y",
        RFC_1036: "D, d M y",
        RFC_1123: "D, d M yy",
        RFC_2822: "D, d M yy",
        RSS: "D, d M y",
        TICKS: "!",
        TIMESTAMP: "@",
        W3C: "yy-mm-dd",
        _ticksTo1970: 10000000 * 60 * 60 * 24 * (718685 + Math.floor(492.5) - Math.floor(19.7) + Math.floor(4.925)),
        formatDate: function (I, r, u) {
            if (!r) {
                return ""
            }
            var H, d = (u ? u.dayNamesShort : null) || this._defaults.dayNamesShort,
                    c = (u ? u.dayNames : null) || this._defaults.dayNames,
                    k = (u ? u.monthNamesShort : null) || this._defaults.monthNamesShort,
                    g = (u ? u.monthNames : null) || this._defaults.monthNames,
                    s = function (v) {
                        var q = I.length > H + 1 && I.charAt(H + 1) === v;
                        return q && H++, q
                    }, G = function (v, w, q) {
                var x = "" + w;
                if (s(v)) {
                    for (; q > x.length; ) {
                        x = "0" + x
                    }
                }
                return x
            }, f = function (v, w, q, x) {
                return s(v) ? x[w] : q[w]
            }, b = "",
                    h = !1;
            if (r) {
                for (H = 0; I.length > H; H++) {
                    if (h) {
                        "'" !== I.charAt(H) || s("'") ? b += I.charAt(H) : h = !1
                    } else {
                        switch (I.charAt(H)) {
                            case "d":
                                b += G("d", r.getDate(), 2);
                                break;
                            case "D":
                                b += f("D", r.getDay(), d, c);
                                break;
                            case "o":
                                b += G("o", Math.round((new Date(r.getFullYear(), r.getMonth(), r.getDate()).getTime() - new Date(r.getFullYear(), 0, 0).getTime()) / 86400000), 3);
                                break;
                            case "m":
                                b += G("m", r.getMonth() + 1, 2);
                                break;
                            case "M":
                                b += f("M", r.getMonth(), k, g);
                                break;
                            case "y":
                                b += s("y") ? r.getFullYear() : (10 > r.getYear() % 100 ? "0" : "") + r.getYear() % 100;
                                break;
                            case "@":
                                b += r.getTime();
                                break;
                            case "!":
                                b += 10000 * r.getTime() + this._ticksTo1970;
                                break;
                            case "'":
                                s("'") ? b += "'" : h = !0;
                                break;
                            default:
                                b += I.charAt(H)
                        }
                    }
                }
            }
            return b
        },
        _possibleChars: function (d) {
            var g, c = "",
                    b = !1,
                    f = function (h) {
                        var k = d.length > g + 1 && d.charAt(g + 1) === h;
                        return k && g++, k
                    };
            for (g = 0; d.length > g; g++) {
                if (b) {
                    "'" !== d.charAt(g) || f("'") ? c += d.charAt(g) : b = !1
                } else {
                    switch (d.charAt(g)) {
                        case "d":
                        case "m":
                        case "y":
                        case "@":
                            c += "0123456789";
                            break;
                        case "D":
                        case "M":
                            return null;
                        case "'":
                            f("'") ? c += "'" : b = !0;
                            break;
                        default:
                            c += d.charAt(g)
                    }
                }
            }
            return c
        },
        _get: function (c, b) {
            return c.settings[b] !== l ? c.settings[b] : this._defaults[b]
        },
        _setDateFromField: function (r, g) {
            if (r.input.val() !== r.lastVal) {
                var c = this._get(r, "dateFormat"),
                        k = r.lastVal = r.input ? r.input.val() : null,
                        b = this._getDefaultDate(r),
                        f = b,
                        h = this._getFormatConfig(r);
                try {
                    f = this.parseDate(c, k, h) || b
                } catch (d) {
                    k = g ? "" : k
                }
                r.selectedDay = f.getDate(), r.drawMonth = r.selectedMonth = f.getMonth(), r.drawYear = r.selectedYear = f.getFullYear(), r.currentDay = k ? f.getDate() : 0, r.currentMonth = k ? f.getMonth() : 0, r.currentYear = k ? f.getFullYear() : 0, this._adjustInstDate(r)
            }
        },
        _getDefaultDate: function (b) {
            return this._restrictMinMax(b, this._determineDate(b, this._get(b, "defaultDate"), new Date))
        },
        _determineDate: function (f, b, h) {
            var d = function (k) {
                var q = new Date;
                return q.setDate(q.getDate() + k), q
            }, c = function (r) {
                try {
                    return o.datepicker.parseDate(o.datepicker._get(f, "dateFormat"), r, o.datepicker._getFormatConfig(f))
                } catch (F) {
                }
                for (var D = (r.toLowerCase().match(/^c/) ? o.datepicker._getDate(f) : null) || new Date, s = D.getFullYear(), q = D.getMonth(), E = D.getDate(), k = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g, u = k.exec(r); u; ) {
                    switch (u[2] || "d") {
                        case "d":
                        case "D":
                            E += parseInt(u[1], 10);
                            break;
                        case "w":
                        case "W":
                            E += 7 * parseInt(u[1], 10);
                            break;
                        case "m":
                        case "M":
                            q += parseInt(u[1], 10), E = Math.min(E, o.datepicker._getDaysInMonth(s, q));
                            break;
                        case "y":
                        case "Y":
                            s += parseInt(u[1], 10), E = Math.min(E, o.datepicker._getDaysInMonth(s, q))
                    }
                    u = k.exec(r)
                }
                return new Date(s, q, E)
            }, g = null == b || "" === b ? h : "string" == typeof b ? c(b) : "number" == typeof b ? isNaN(b) ? h : d(b) : new Date(b.getTime());
            return g = g && "Invalid Date" == "" + g ? h : g, g && (g.setHours(0), g.setMinutes(0), g.setSeconds(0), g.setMilliseconds(0)), this._daylightSavingAdjust(g)
        },
        _daylightSavingAdjust: function (b) {
            return b ? (b.setHours(b.getHours() > 12 ? b.getHours() + 2 : 0), b) : null
        },
        _setDate: function (k, f, b) {
            var h = !f,
                    d = k.selectedMonth,
                    c = k.selectedYear,
                    g = this._restrictMinMax(k, this._determineDate(k, f, new Date));
            k.selectedDay = k.currentDay = g.getDate(), k.drawMonth = k.selectedMonth = k.currentMonth = g.getMonth(), k.drawYear = k.selectedYear = k.currentYear = g.getFullYear(), d === k.selectedMonth && c === k.selectedYear || b || this._notifyChange(k), this._adjustInstDate(k), k.input && k.input.val(h ? "" : this._formatDate(k))
        },
        _getDate: function (c) {
            var b = !c.currentYear || c.input && "" === c.input.val() ? null : this._daylightSavingAdjust(new Date(c.currentYear, c.currentMonth, c.currentDay));
            return b
        },
        _attachHandlers: function (b) {
            var d = this._get(b, "stepMonths"),
                    c = "#" + b.id.replace(/\\\\/g, "\\");
            b.dpDiv.find("[data-handler]").map(function () {
                var f = {
                    prev: function () {
                        o.datepicker._adjustDate(c, -d, "M")
                    },
                    next: function () {
                        o.datepicker._adjustDate(c, +d, "M")
                    },
                    hide: function () {
                        o.datepicker._hideDatepicker()
                    },
                    today: function () {
                        o.datepicker._gotoToday(c)
                    },
                    selectDay: function () {
                        return o.datepicker._selectDay(c, +this.getAttribute("data-month"), +this.getAttribute("data-year"), this), !1
                    },
                    selectMonth: function () {
                        return o.datepicker._selectMonthYear(c, this, "M"), !1
                    },
                    selectYear: function () {
                        return o.datepicker._selectMonthYear(c, this, "Y"), !1
                    }
                };
                o(this).bind(this.getAttribute("data-event"), f[this.getAttribute("data-handler")])
            })
        },
        _generateHTML: function (aa) {
            var L, P, Z, U, al, Y, V, O, S, an, ab, K, W, M, T, N, ac, ak, am, af, ae, R, ad, c, C, b, u, B, v, k, x, ai, ag, h, d, f, w, F, Q, A = new Date,
                    s = this._daylightSavingAdjust(new Date(A.getFullYear(), A.getMonth(), A.getDate())),
                    I = this._get(aa, "isRTL"),
                    aj = this._get(aa, "showButtonPanel"),
                    q = this._get(aa, "hideIfNoPrevNext"),
                    r = this._get(aa, "navigationAsDateFormat"),
                    y = this._getNumberOfMonths(aa),
                    E = this._get(aa, "showCurrentAtPos"),
                    D = this._get(aa, "stepMonths"),
                    X = 1 !== y[0] || 1 !== y[1],
                    H = this._daylightSavingAdjust(aa.currentDay ? new Date(aa.currentYear, aa.currentMonth, aa.currentDay) : new Date(9999, 9, 9)),
                    g = this._getMinMaxDate(aa, "min"),
                    ah = this._getMinMaxDate(aa, "max"),
                    J = aa.drawMonth - E,
                    G = aa.drawYear;
            if (0 > J && (J += 12, G--), ah) {
                for (L = this._daylightSavingAdjust(new Date(ah.getFullYear(), ah.getMonth() - y[0] * y[1] + 1, ah.getDate())), L = g && g > L ? g : L; this._daylightSavingAdjust(new Date(G, J, 1)) > L; ) {
                    J--, 0 > J && (J = 11, G--)
                }
            }
            for (aa.drawMonth = J, aa.drawYear = G, P = this._get(aa, "prevText"), P = r ? this.formatDate(P, this._daylightSavingAdjust(new Date(G, J - D, 1)), this._getFormatConfig(aa)) : P, Z = this._canAdjustMonth(aa, -1, G, J) ? "<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='" + P + "'><span class='ui-icon ui-icon-circle-triangle-" + (I ? "e" : "w") + "'>" + P + "</span></a>" : q ? "" : "<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='" + P + "'><span class='ui-icon ui-icon-circle-triangle-" + (I ? "e" : "w") + "'>" + P + "</span></a>", U = this._get(aa, "nextText"), U = r ? this.formatDate(U, this._daylightSavingAdjust(new Date(G, J + D, 1)), this._getFormatConfig(aa)) : U, al = this._canAdjustMonth(aa, 1, G, J) ? "<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='" + U + "'><span class='ui-icon ui-icon-circle-triangle-" + (I ? "w" : "e") + "'>" + U + "</span></a>" : q ? "" : "<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='" + U + "'><span class='ui-icon ui-icon-circle-triangle-" + (I ? "w" : "e") + "'>" + U + "</span></a>", Y = this._get(aa, "currentText"), V = this._get(aa, "gotoCurrent") && aa.currentDay ? H : s, Y = r ? this.formatDate(Y, V, this._getFormatConfig(aa)) : Y, O = aa.inline ? "" : "<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>" + this._get(aa, "closeText") + "</button>", S = aj ? "<div class='ui-datepicker-buttonpane ui-widget-content'>" + (I ? O : "") + (this._isInRange(aa, V) ? "<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>" + Y + "</button>" : "") + (I ? "" : O) + "</div>" : "", an = parseInt(this._get(aa, "firstDay"), 10), an = isNaN(an) ? 0 : an, ab = this._get(aa, "showWeek"), K = this._get(aa, "dayNames"), W = this._get(aa, "dayNamesMin"), M = this._get(aa, "monthNames"), T = this._get(aa, "monthNamesShort"), N = this._get(aa, "beforeShowDay"), ac = this._get(aa, "showOtherMonths"), ak = this._get(aa, "selectOtherMonths"), am = this._getDefaultDate(aa), af = "", R = 0; y[0] > R; R++) {
                for (ad = "", this.maxRows = 4, c = 0; y[1] > c; c++) {
                    if (C = this._daylightSavingAdjust(new Date(G, J, aa.selectedDay)), b = " ui-corner-all", u = "", X) {
                        if (u += "<div class='ui-datepicker-group", y[1] > 1) {
                            switch (c) {
                                case 0:
                                    u += " ui-datepicker-group-first", b = " ui-corner-" + (I ? "right" : "left");
                                    break;
                                case y[1] - 1:
                                    u += " ui-datepicker-group-last", b = " ui-corner-" + (I ? "left" : "right");
                                    break;
                                default:
                                    u += " ui-datepicker-group-middle", b = ""
                            }
                        }
                        u += "'>"
                    }
                    for (u += "<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix" + b + "'>" + (/all|left/.test(b) && 0 === R ? I ? al : Z : "") + (/all|right/.test(b) && 0 === R ? I ? Z : al : "") + this._generateMonthYearHeader(aa, J, G, g, ah, R > 0 || c > 0, M, T) + "</div><table class='ui-datepicker-calendar'><thead><tr>", B = ab ? "<th class='ui-datepicker-week-col'>" + this._get(aa, "weekHeader") + "</th>" : "", ae = 0; 7 > ae; ae++) {
                        v = (ae + an) % 7, B += "<th" + ((ae + an + 6) % 7 >= 5 ? " class='ui-datepicker-week-end'" : "") + "><span title='" + K[v] + "'>" + W[v] + "</span></th>"
                    }
                    for (u += B + "</tr></thead><tbody>", k = this._getDaysInMonth(G, J), G === aa.selectedYear && J === aa.selectedMonth && (aa.selectedDay = Math.min(aa.selectedDay, k)), x = (this._getFirstDayOfMonth(G, J) - an + 7) % 7, ai = Math.ceil((x + k) / 7), ag = X ? this.maxRows > ai ? this.maxRows : ai : ai, this.maxRows = ag, h = this._daylightSavingAdjust(new Date(G, J, 1 - x)), d = 0; ag > d; d++) {
                        for (u += "<tr>", f = ab ? "<td class='ui-datepicker-week-col'>" + this._get(aa, "calculateWeek")(h) + "</td>" : "", ae = 0; 7 > ae; ae++) {
                            w = N ? N.apply(aa.input ? aa.input[0] : null, [h]) : [!0, ""], F = h.getMonth() !== J, Q = F && !ak || !w[0] || g && g > h || ah && h > ah, f += "<td class='" + ((ae + an + 6) % 7 >= 5 ? " ui-datepicker-week-end" : "") + (F ? " ui-datepicker-other-month" : "") + (h.getTime() === C.getTime() && J === aa.selectedMonth && aa._keyEvent || am.getTime() === h.getTime() && am.getTime() === C.getTime() ? " " + this._dayOverClass : "") + (Q ? " " + this._unselectableClass + " ui-state-disabled" : "") + (F && !ac ? "" : " " + w[1] + (h.getTime() === H.getTime() ? " " + this._currentClass : "") + (h.getTime() === s.getTime() ? " ui-datepicker-today" : "")) + "'" + (F && !ac || !w[2] ? "" : " title='" + w[2].replace(/'/g, "&#39;") + "'") + (Q ? "" : " data-handler='selectDay' data-event='click' data-month='" + h.getMonth() + "' data-year='" + h.getFullYear() + "'") + ">" + (F && !ac ? "&#xa0;" : Q ? "<span class='ui-state-default'>" + h.getDate() + "</span>" : "<a class='ui-state-default" + (h.getTime() === s.getTime() ? " ui-state-highlight" : "") + (h.getTime() === H.getTime() ? " ui-state-active" : "") + (F ? " ui-priority-secondary" : "") + "' href='#'>" + h.getDate() + "</a>") + "</td>", h.setDate(h.getDate() + 1), h = this._daylightSavingAdjust(h)
                        }
                        u += f + "</tr>"
                    }
                    J++, J > 11 && (J = 0, G++), u += "</tbody></table>" + (X ? "</div>" + (y[0] > 0 && c === y[1] - 1 ? "<div class='ui-datepicker-row-break'></div>" : "") : ""), ad += u
                }
                af += ad
            }
            return af += S, aa._keyEvent = !1, af
        },
        _generateMonthYearHeader: function (aa, h, u, Z, U, c, X, V) {
            var s, S, f, v, g, W, k, T, r = this._get(aa, "changeMonth"),
                    y = this._get(aa, "changeYear"),
                    b = this._get(aa, "showMonthAfterYear"),
                    d = "<div class='ui-datepicker-title'>",
                    Y = "";
            if (c || !r) {
                Y += "<span class='ui-datepicker-month'>" + X[h] + "</span>"
            } else {
                for (s = Z && Z.getFullYear() === u, S = U && U.getFullYear() === u, Y += "<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>", f = 0; 12 > f; f++) {
                    (!s || f >= Z.getMonth()) && (!S || U.getMonth() >= f) && (Y += "<option value='" + f + "'" + (f === h ? " selected='selected'" : "") + ">" + V[f] + "</option>")
                }
                Y += "</select>"
            }
            if (b || (d += Y + (!c && r && y ? "" : "&#xa0;")), !aa.yearshtml) {
                if (aa.yearshtml = "", c || !y) {
                    d += "<span class='ui-datepicker-year'>" + u + "</span>"
                } else {
                    for (v = this._get(aa, "yearRange").split(":"), g = (new Date).getFullYear(), W = function (w) {
                        var q = w.match(/c[+\-].*/) ? u + parseInt(w.substring(1), 10) : w.match(/[+\-].*/) ? g + parseInt(w, 10) : parseInt(w, 10);
                        return isNaN(q) ? g : q
                    }, k = W(v[0]), T = Math.max(k, W(v[1] || "")), k = Z ? Math.max(k, Z.getFullYear()) : k, T = U ? Math.min(T, U.getFullYear()) : T, aa.yearshtml += "<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>"; T >= k; k++) {
                        aa.yearshtml += "<option value='" + k + "'" + (k === u ? " selected='selected'" : "") + ">" + k + "</option>"
                    }
                    aa.yearshtml += "</select>", d += aa.yearshtml, aa.yearshtml = null
                }
            }
            return d += this._get(aa, "yearSuffix"), b && (d += (!c && r && y ? "" : "&#xa0;") + Y), d += "</div>"
        },
        _adjustInstDate: function (k, f, b) {
            var h = k.drawYear + ("Y" === b ? f : 0),
                    d = k.drawMonth + ("M" === b ? f : 0),
                    c = Math.min(k.selectedDay, this._getDaysInMonth(h, d)) + ("D" === b ? f : 0),
                    g = this._restrictMinMax(k, this._daylightSavingAdjust(new Date(h, d, c)));
            k.selectedDay = g.getDate(), k.drawMonth = k.selectedMonth = g.getMonth(), k.drawYear = k.selectedYear = g.getFullYear(), ("M" === b || "Y" === b) && this._notifyChange(k)
        },
        _restrictMinMax: function (d, g) {
            var c = this._getMinMaxDate(d, "min"),
                    b = this._getMinMaxDate(d, "max"),
                    f = c && c > g ? c : g;
            return b && f > b ? b : f
        },
        _notifyChange: function (c) {
            var b = this._get(c, "onChangeMonthYear");
            b && b.apply(c.input ? c.input[0] : null, [c.selectedYear, c.selectedMonth + 1, c])
        },
        _getNumberOfMonths: function (c) {
            var b = this._get(c, "numberOfMonths");
            return null == b ? [1, 1] : "number" == typeof b ? [1, b] : b
        },
        _getMinMaxDate: function (c, b) {
            return this._determineDate(c, this._get(c, b + "Date"), null)
        },
        _getDaysInMonth: function (c, b) {
            return 32 - this._daylightSavingAdjust(new Date(c, b, 32)).getDate()
        },
        _getFirstDayOfMonth: function (c, b) {
            return new Date(c, b, 1).getDay()
        },
        _canAdjustMonth: function (h, f, b, g) {
            var d = this._getNumberOfMonths(h),
                    c = this._daylightSavingAdjust(new Date(b, g + (0 > f ? f : d[0] * d[1]), 1));
            return 0 > f && c.setDate(this._getDaysInMonth(c.getFullYear(), c.getMonth())), this._isInRange(h, c)
        },
        _isInRange: function (h, r) {
            var b, g, c = this._getMinMaxDate(h, "min"),
                    k = this._getMinMaxDate(h, "max"),
                    f = null,
                    d = null,
                    s = this._get(h, "yearRange");
            return s && (b = s.split(":"), g = (new Date).getFullYear(), f = parseInt(b[0], 10), d = parseInt(b[1], 10), b[0].match(/[+\-].*/) && (f += g), b[1].match(/[+\-].*/) && (d += g)), (!c || r.getTime() >= c.getTime()) && (!k || r.getTime() <= k.getTime()) && (!f || r.getFullYear() >= f) && (!d || d >= r.getFullYear())
        },
        _getFormatConfig: function (c) {
            var b = this._get(c, "shortYearCutoff");
            return b = "string" != typeof b ? b : (new Date).getFullYear() % 100 + parseInt(b, 10), {
                shortYearCutoff: b,
                dayNamesShort: this._get(c, "dayNamesShort"),
                dayNames: this._get(c, "dayNames"),
                monthNamesShort: this._get(c, "monthNamesShort"),
                monthNames: this._get(c, "monthNames")
            }
        },
        _formatDate: function (d, g, c, b) {
            g || (d.currentDay = d.selectedDay, d.currentMonth = d.selectedMonth, d.currentYear = d.selectedYear);
            var f = g ? "object" == typeof g ? g : this._daylightSavingAdjust(new Date(b, c, g)) : this._daylightSavingAdjust(new Date(d.currentYear, d.currentMonth, d.currentDay));
            return this.formatDate(this._get(d, "dateFormat"), f, this._getFormatConfig(d))
        }
    }), o.fn.datepicker = function (c) {
        if (!this.length) {
            return this
        }
        o.datepicker.initialized || (o(document).mousedown(o.datepicker._checkExternalClick), o.datepicker.initialized = !0), 0 === o("#" + o.datepicker._mainDivId).length && o("body").append(o.datepicker.dpDiv);
        var b = Array.prototype.slice.call(arguments, 1);
        return "string" != typeof c || "isDisabled" !== c && "getDate" !== c && "widget" !== c ? "option" === c && 2 === arguments.length && "string" == typeof arguments[1] ? o.datepicker["_" + c + "Datepicker"].apply(o.datepicker, [this[0]].concat(b)) : this.each(function () {
            "string" == typeof c ? o.datepicker["_" + c + "Datepicker"].apply(o.datepicker, [this].concat(b)) : o.datepicker._attachDatepicker(this, c)
        }) : o.datepicker["_" + c + "Datepicker"].apply(o.datepicker, [this[0]].concat(b))
    }, o.datepicker = new p, o.datepicker.initialized = !1, o.datepicker.uuid = (new Date).getTime(), o.datepicker.version = "1.10.3"
})(jQuery);
(function (d) {
    var f = {
        buttons: !0,
        height: !0,
        maxHeight: !0,
        maxWidth: !0,
        minHeight: !0,
        minWidth: !0,
        width: !0
    }, e = {
        maxHeight: !0,
        maxWidth: !0,
        minHeight: !0,
        minWidth: !0
    };
    d.widget("ui.dialog", {
        version: "1.10.3",
        options: {
            appendTo: "body",
            autoOpen: !0,
            buttons: [],
            closeOnEscape: !0,
            closeText: "close",
            dialogClass: "",
            draggable: !0,
            hide: null,
            height: "auto",
            maxHeight: null,
            maxWidth: null,
            minHeight: 150,
            minWidth: 150,
            modal: !1,
            position: {
                my: "center",
                at: "center",
                of: window,
                collision: "fit",
                using: function (a) {
                    var b = d(this).css(a).offset().top;
                    0 > b && d(this).css("top", a.top - b)
                }
            },
            resizable: !0,
            show: null,
            title: null,
            width: 300,
            beforeClose: null,
            close: null,
            drag: null,
            dragStart: null,
            dragStop: null,
            focus: null,
            open: null,
            resize: null,
            resizeStart: null,
            resizeStop: null
        },
        _create: function () {
            this.originalCss = {
                display: this.element[0].style.display,
                width: this.element[0].style.width,
                minHeight: this.element[0].style.minHeight,
                maxHeight: this.element[0].style.maxHeight,
                height: this.element[0].style.height
            }, this.originalPosition = {
                parent: this.element.parent(),
                index: this.element.parent().children().index(this.element)
            }, this.originalTitle = this.element.attr("title"), this.options.title = this.options.title || this.originalTitle, this._createWrapper(), this.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(this.uiDialog), this._createTitlebar(), this._createButtonPane(), this.options.draggable && d.fn.draggable && this._makeDraggable(), this.options.resizable && d.fn.resizable && this._makeResizable(), this._isOpen = !1
        },
        _init: function () {
            this.options.autoOpen && this.open()
        },
        _appendTo: function () {
            var a = this.options.appendTo;
            return a && (a.jquery || a.nodeType) ? d(a) : this.document.find(a || "body").eq(0)
        },
        _destroy: function () {
            var b, a = this.originalPosition;
            this._destroyOverlay(), this.element.removeUniqueId().removeClass("ui-dialog-content ui-widget-content").css(this.originalCss).detach(), this.uiDialog.stop(!0, !0).remove(), this.originalTitle && this.element.attr("title", this.originalTitle), b = a.parent.children().eq(a.index), b.length && b[0] !== this.element[0] ? b.before(this.element) : a.parent.append(this.element)
        },
        widget: function () {
            return this.uiDialog
        },
        disable: d.noop,
        enable: d.noop,
        close: function (a) {
            var b = this;
            this._isOpen && this._trigger("beforeClose", a) !== !1 && (this._isOpen = !1, this._destroyOverlay(), this.opener.filter(":focusable").focus().length || d(this.document[0].activeElement).blur(), this._hide(this.uiDialog, this.options.hide, function () {
                b._trigger("close", a)
            }))
        },
        isOpen: function () {
            return this._isOpen
        },
        moveToTop: function () {
            this._moveToTop()
        },
        _moveToTop: function (b, a) {
            var c = !!this.uiDialog.nextAll(":visible").insertBefore(this.uiDialog).length;
            return c && !a && this._trigger("focus", b), c
        },
        open: function () {
            var a = this;
            return this._isOpen ? (this._moveToTop() && this._focusTabbable(), undefined) : (this._isOpen = !0, this.opener = d(this.document[0].activeElement), this._size(), this._position(), this._createOverlay(), this._moveToTop(null, !0), this._show(this.uiDialog, this.options.show, function () {
                a._focusTabbable(), a._trigger("focus")
            }), this._trigger("open"), undefined)
        },
        _focusTabbable: function () {
            var a = this.element.find("[autofocus]");
            a.length || (a = this.element.find(":tabbable")), a.length || (a = this.uiDialogButtonPane.find(":tabbable")), a.length || (a = this.uiDialogTitlebarClose.filter(":tabbable")), a.length || (a = this.uiDialog), a.eq(0).focus()
        },
        _keepFocus: function (a) {
            function b() {
                var c = this.document[0].activeElement,
                        k = this.uiDialog[0] === c || d.contains(this.uiDialog[0], c);
                k || this._focusTabbable()
            }
            a.preventDefault(), b.call(this), this._delay(b)
        },
        _createWrapper: function () {
            this.uiDialog = d("<div>").addClass("ui-dialog ui-widget ui-widget-content ui-corner-all ui-front " + this.options.dialogClass).hide().attr({
                tabIndex: -1,
                role: "dialog"
            }).appendTo(this._appendTo()), this._on(this.uiDialog, {
                keydown: function (b) {
                    if (this.options.closeOnEscape && !b.isDefaultPrevented() && b.keyCode && b.keyCode === d.ui.keyCode.ESCAPE) {
                        return b.preventDefault(), this.close(b), undefined
                    }
                    if (b.keyCode === d.ui.keyCode.TAB) {
                        var k = this.uiDialog.find(":tabbable"),
                                c = k.filter(":first"),
                                a = k.filter(":last");
                        b.target !== a[0] && b.target !== this.uiDialog[0] || b.shiftKey ? b.target !== c[0] && b.target !== this.uiDialog[0] || !b.shiftKey || (a.focus(1), b.preventDefault()) : (c.focus(1), b.preventDefault())
                    }
                },
                mousedown: function (a) {
                    this._moveToTop(a) && this._focusTabbable()
                }
            }), this.element.find("[aria-describedby]").length || this.uiDialog.attr({
                "aria-describedby": this.element.uniqueId().attr("id")
            })
        },
        _createTitlebar: function () {
            var a;
            this.uiDialogTitlebar = d("<div>").addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(this.uiDialog), this._on(this.uiDialogTitlebar, {
                mousedown: function (b) {
                    d(b.target).closest(".ui-dialog-titlebar-close") || this.uiDialog.focus()
                }
            }), this.uiDialogTitlebarClose = d("<button></button>").button({
                label: this.options.closeText,
                icons: {
                    primary: "ui-icon-closethick"
                },
                text: !1
            }).addClass("ui-dialog-titlebar-close").appendTo(this.uiDialogTitlebar), this._on(this.uiDialogTitlebarClose, {
                click: function (b) {
                    b.preventDefault(), this.close(b)
                }
            }), a = d("<span>").uniqueId().addClass("ui-dialog-title").prependTo(this.uiDialogTitlebar), this._title(a), this.uiDialog.attr({
                "aria-labelledby": a.attr("id")
            })
        },
        _title: function (a) {
            this.options.title || a.html("&#160;"), a.text(this.options.title)
        },
        _createButtonPane: function () {
            this.uiDialogButtonPane = d("<div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"), this.uiButtonSet = d("<div>").addClass("ui-dialog-buttonset").appendTo(this.uiDialogButtonPane), this._createButtons()
        },
        _createButtons: function () {
            var a = this,
                    b = this.options.buttons;
            return this.uiDialogButtonPane.remove(), this.uiButtonSet.empty(), d.isEmptyObject(b) || d.isArray(b) && !b.length ? (this.uiDialog.removeClass("ui-dialog-buttons"), undefined) : (d.each(b, function (m, l) {
                var c, n;
                l = d.isFunction(l) ? {
                    click: l,
                    text: m
                } : l, l = d.extend({
                    type: "button"
                }, l), c = l.click, l.click = function () {
                    c.apply(a.element[0], arguments)
                }, n = {
                    icons: l.icons,
                    text: l.showText
                }, delete l.icons, delete l.showText, d("<button></button>", l).button(n).appendTo(a.uiButtonSet)
            }), this.uiDialog.addClass("ui-dialog-buttons"), this.uiDialogButtonPane.appendTo(this.uiDialog), undefined)
        },
        _makeDraggable: function () {
            function a(g) {
                return {
                    position: g.position,
                    offset: g.offset
                }
            }
            var c = this,
                    b = this.options;
            this.uiDialog.draggable({
                cancel: ".ui-dialog-content, .ui-dialog-titlebar-close",
                handle: ".ui-dialog-titlebar",
                containment: "document",
                start: function (k, g) {
                    d(this).addClass("ui-dialog-dragging"), c._blockFrames(), c._trigger("dragStart", k, a(g))
                },
                drag: function (k, g) {
                    c._trigger("drag", k, a(g))
                },
                stop: function (g, k) {
                    b.position = [k.position.left - c.document.scrollLeft(), k.position.top - c.document.scrollTop()], d(this).removeClass("ui-dialog-dragging"), c._unblockFrames(), c._trigger("dragStop", g, a(k))
                }
            })
        },
        _makeResizable: function () {
            function c(g) {
                return {
                    originalPosition: g.originalPosition,
                    originalSize: g.originalSize,
                    position: g.position,
                    size: g.size
                }
            }
            var n = this,
                    m = this.options,
                    a = m.resizable,
                    o = this.uiDialog.css("position"),
                    b = "string" == typeof a ? a : "n,e,s,w,se,sw,ne,nw";
            this.uiDialog.resizable({
                cancel: ".ui-dialog-content",
                containment: "document",
                alsoResize: this.element,
                maxWidth: m.maxWidth,
                maxHeight: m.maxHeight,
                minWidth: m.minWidth,
                minHeight: this._minHeight(),
                handles: b,
                start: function (h, g) {
                    d(this).addClass("ui-dialog-resizing"), n._blockFrames(), n._trigger("resizeStart", h, c(g))
                },
                resize: function (h, g) {
                    n._trigger("resize", h, c(g))
                },
                stop: function (g, h) {
                    m.height = d(this).height(), m.width = d(this).width(), d(this).removeClass("ui-dialog-resizing"), n._unblockFrames(), n._trigger("resizeStop", g, c(h))
                }
            }).css("position", o)
        },
        _minHeight: function () {
            var a = this.options;
            return "auto" === a.height ? a.minHeight : Math.min(a.minHeight, a.height)
        },
        _position: function () {
            var a = this.uiDialog.is(":visible");
            a || this.uiDialog.show(), this.uiDialog.position(this.options.position), a || this.uiDialog.hide()
        },
        _setOptions: function (c) {
            var a = this,
                    h = !1,
                    b = {};
            d.each(c, function (l, g) {
                a._setOption(l, g), l in f && (h = !0), l in e && (b[l] = g)
            }), h && (this._size(), this._position()), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", b)
        },
        _setOption: function (l, b) {
            var m, c, a = this.uiDialog;
            "dialogClass" === l && a.removeClass(this.options.dialogClass).addClass(b), "disabled" !== l && (this._super(l, b), "appendTo" === l && this.uiDialog.appendTo(this._appendTo()), "buttons" === l && this._createButtons(), "closeText" === l && this.uiDialogTitlebarClose.button({
                label: "" + b
            }), "draggable" === l && (m = a.is(":data(ui-draggable)"), m && !b && a.draggable("destroy"), !m && b && this._makeDraggable()), "position" === l && this._position(), "resizable" === l && (c = a.is(":data(ui-resizable)"), c && !b && a.resizable("destroy"), c && "string" == typeof b && a.resizable("option", "handles", b), c || b === !1 || this._makeResizable()), "title" === l && this._title(this.uiDialogTitlebar.find(".ui-dialog-title")))
        },
        _size: function () {
            var c, a, k, b = this.options;
            this.element.show().css({
                width: "auto",
                minHeight: 0,
                maxHeight: "none",
                height: 0
            }), b.minWidth > b.width && (b.width = b.minWidth), c = this.uiDialog.css({
                height: "auto",
                width: b.width
            }).outerHeight(), a = Math.max(0, b.minHeight - c), k = "number" == typeof b.maxHeight ? Math.max(0, b.maxHeight - c) : "none", "auto" === b.height ? this.element.css({
                minHeight: a,
                maxHeight: k,
                height: "auto"
            }) : this.element.height(Math.max(0, b.height - c)), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", "minHeight", this._minHeight())
        },
        _blockFrames: function () {
            this.iframeBlocks = this.document.find("iframe").map(function () {
                var a = d(this);
                return d("<div>").css({
                    position: "absolute",
                    width: a.outerWidth(),
                    height: a.outerHeight()
                }).appendTo(a.parent()).offset(a.offset())[0]
            })
        },
        _unblockFrames: function () {
            this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks)
        },
        _allowInteraction: function (a) {
            return d(a.target).closest(".ui-dialog").length ? !0 : !!d(a.target).closest(".ui-datepicker").length
        },
        _createOverlay: function () {
            if (this.options.modal) {
                var a = this,
                        b = this.widgetFullName;
                d.ui.dialog.overlayInstances || this._delay(function () {
                    d.ui.dialog.overlayInstances && this.document.bind("focusin.dialog", function (c) {
                        a._allowInteraction(c) || (c.preventDefault(), d(".ui-dialog:visible:last .ui-dialog-content").data(b)._focusTabbable())
                    })
                }), this.overlay = d("<div>").addClass("ui-widget-overlay ui-front").appendTo(this._appendTo()), this._on(this.overlay, {
                    mousedown: "_keepFocus"
                }), d.ui.dialog.overlayInstances++
            }
        },
        _destroyOverlay: function () {
            this.options.modal && this.overlay && (d.ui.dialog.overlayInstances--, d.ui.dialog.overlayInstances || this.document.unbind("focusin.dialog"), this.overlay.remove(), this.overlay = null)
        }
    }), d.ui.dialog.overlayInstances = 0, d.uiBackCompat !== !1 && d.widget("ui.dialog", d.ui.dialog, {
        _position: function () {
            var b, k = this.options.position,
                    c = [],
                    a = [0, 0];
            k ? (("string" == typeof k || "object" == typeof k && "0" in k) && (c = k.split ? k.split(" ") : [k[0], k[1]], 1 === c.length && (c[1] = c[0]), d.each(["left", "top"], function (h, g) {
                +c[h] === c[h] && (a[h] = c[h], c[h] = g)
            }), k = {
                my: c[0] + (0 > a[0] ? a[0] : "+" + a[0]) + " " + c[1] + (0 > a[1] ? a[1] : "+" + a[1]),
                at: c.join(" ")
            }), k = d.extend({}, d.ui.dialog.prototype.options.position, k)) : k = d.ui.dialog.prototype.options.position, b = this.uiDialog.is(":visible"), b || this.uiDialog.show(), this.uiDialog.position(k), b || this.uiDialog.hide()
        }
    })
})(jQuery);
(function (b) {
    b.widget("ui.menu", {
        version: "1.10.3",
        defaultElement: "<ul>",
        delay: 300,
        options: {
            icons: {
                submenu: "ui-icon-carat-1-e"
            },
            menus: "ul",
            position: {
                my: "left top",
                at: "right top"
            },
            role: "menu",
            blur: null,
            focus: null,
            select: null
        },
        _create: function () {
            this.activeMenu = this.element, this.mouseHandled = !1, this.element.uniqueId().addClass("ui-menu ui-widget ui-widget-content ui-corner-all").toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length).attr({
                role: this.options.role,
                tabIndex: 0
            }).bind("click" + this.eventNamespace, b.proxy(function (a) {
                this.options.disabled && a.preventDefault()
            }, this)), this.options.disabled && this.element.addClass("ui-state-disabled").attr("aria-disabled", "true"), this._on({
                "mousedown .ui-menu-item > a": function (a) {
                    a.preventDefault()
                },
                "click .ui-state-disabled > a": function (a) {
                    a.preventDefault()
                },
                "click .ui-menu-item:has(a)": function (d) {
                    var a = b(d.target).closest(".ui-menu-item");
                    !this.mouseHandled && a.not(".ui-state-disabled").length && (this.mouseHandled = !0, this.select(d), a.has(".ui-menu").length ? this.expand(d) : this.element.is(":focus") || (this.element.trigger("focus", [!0]), this.active && 1 === this.active.parents(".ui-menu").length && clearTimeout(this.timer)))
                },
                "mouseenter .ui-menu-item": function (d) {
                    var a = b(d.currentTarget);
                    a.siblings().children(".ui-state-active").removeClass("ui-state-active"), this.focus(d, a)
                },
                mouseleave: "collapseAll",
                "mouseleave .ui-menu": "collapseAll",
                focus: function (f, e) {
                    var a = this.active || this.element.children(".ui-menu-item").eq(0);
                    e || this.focus(f, a)
                },
                blur: function (a) {
                    this._delay(function () {
                        b.contains(this.element[0], this.document[0].activeElement) || this.collapseAll(a)
                    })
                },
                keydown: "_keydown"
            }), this.refresh(), this._on(this.document, {
                click: function (a) {
                    b(a.target).closest(".ui-menu").length || this.collapseAll(a), this.mouseHandled = !1
                }
            })
        },
        _destroy: function () {
            this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeClass("ui-menu ui-widget ui-widget-content ui-corner-all ui-menu-icons").removeAttr("role").removeAttr("tabIndex").removeAttr("aria-labelledby").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-disabled").removeUniqueId().show(), this.element.find(".ui-menu-item").removeClass("ui-menu-item").removeAttr("role").removeAttr("aria-disabled").children("a").removeUniqueId().removeClass("ui-corner-all ui-state-hover").removeAttr("tabIndex").removeAttr("role").removeAttr("aria-haspopup").children().each(function () {
                var a = b(this);
                a.data("ui-menu-submenu-carat") && a.remove()
            }), this.element.find(".ui-menu-divider").removeClass("ui-menu-divider ui-widget-content")
        },
        _keydown: function (n) {
            function r(c) {
                return c.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
            }
            var p, e, a, h, o, q = !0;
            switch (n.keyCode) {
                case b.ui.keyCode.PAGE_UP:
                    this.previousPage(n);
                    break;
                case b.ui.keyCode.PAGE_DOWN:
                    this.nextPage(n);
                    break;
                case b.ui.keyCode.HOME:
                    this._move("first", "first", n);
                    break;
                case b.ui.keyCode.END:
                    this._move("last", "last", n);
                    break;
                case b.ui.keyCode.UP:
                    this.previous(n);
                    break;
                case b.ui.keyCode.DOWN:
                    this.next(n);
                    break;
                case b.ui.keyCode.LEFT:
                    this.collapse(n);
                    break;
                case b.ui.keyCode.RIGHT:
                    this.active && !this.active.is(".ui-state-disabled") && this.expand(n);
                    break;
                case b.ui.keyCode.ENTER:
                case b.ui.keyCode.SPACE:
                    this._activate(n);
                    break;
                case b.ui.keyCode.ESCAPE:
                    this.collapse(n);
                    break;
                default:
                    q = !1, e = this.previousFilter || "", a = String.fromCharCode(n.keyCode), h = !1, clearTimeout(this.filterTimer), a === e ? h = !0 : a = e + a, o = RegExp("^" + r(a), "i"), p = this.activeMenu.children(".ui-menu-item").filter(function () {
                        return o.test(b(this).children("a").text())
                    }), p = h && -1 !== p.index(this.active.next()) ? this.active.nextAll(".ui-menu-item") : p, p.length || (a = String.fromCharCode(n.keyCode), o = RegExp("^" + r(a), "i"), p = this.activeMenu.children(".ui-menu-item").filter(function () {
                        return o.test(b(this).children("a").text())
                    })), p.length ? (this.focus(n, p), p.length > 1 ? (this.previousFilter = a, this.filterTimer = this._delay(function () {
                        delete this.previousFilter
                    }, 1000)) : delete this.previousFilter) : delete this.previousFilter
            }
            q && n.preventDefault()
        },
        _activate: function (a) {
            this.active.is(".ui-state-disabled") || (this.active.children("a[aria-haspopup='true']").length ? this.expand(a) : this.select(a))
        },
        refresh: function () {
            var e, a = this.options.icons.submenu,
                    f = this.element.find(this.options.menus);
            f.filter(":not(.ui-menu)").addClass("ui-menu ui-widget ui-widget-content ui-corner-all").hide().attr({
                role: this.options.role,
                "aria-hidden": "true",
                "aria-expanded": "false"
            }).each(function () {
                var d = b(this),
                        k = d.prev("a"),
                        c = b("<span>").addClass("ui-menu-icon ui-icon " + a).data("ui-menu-submenu-carat", !0);
                k.attr("aria-haspopup", "true").prepend(c), d.attr("aria-labelledby", k.attr("id"))
            }), e = f.add(this.element), e.children(":not(.ui-menu-item):has(a)").addClass("ui-menu-item").attr("role", "presentation").children("a").uniqueId().addClass("ui-corner-all").attr({
                tabIndex: -1,
                role: this._itemRole()
            }), e.children(":not(.ui-menu-item)").each(function () {
                var c = b(this);
                /[^\-\u2014\u2013\s]/.test(c.text()) || c.addClass("ui-widget-content ui-menu-divider")
            }), e.children(".ui-state-disabled").attr("aria-disabled", "true"), this.active && !b.contains(this.element[0], this.active[0]) && this.blur()
        },
        _itemRole: function () {
            return {
                menu: "menuitem",
                listbox: "option"
            }[this.options.role]
        },
        _setOption: function (a, d) {
            "icons" === a && this.element.find(".ui-menu-icon").removeClass(this.options.icons.submenu).addClass(d.submenu), this._super(a, d)
        },
        focus: function (h, e) {
            var a, g;
            this.blur(h, h && "focus" === h.type), this._scrollIntoView(e), this.active = e.first(), g = this.active.children("a").addClass("ui-state-focus"), this.options.role && this.element.attr("aria-activedescendant", g.attr("id")), this.active.parent().closest(".ui-menu-item").children("a:first").addClass("ui-state-active"), h && "keydown" === h.type ? this._close() : this.timer = this._delay(function () {
                this._close()
            }, this.delay), a = e.children(".ui-menu"), a.length && /^mouse/.test(h.type) && this._startOpening(a), this.activeMenu = e.parent(), this._trigger("focus", h, {
                item: e
            })
        },
        _scrollIntoView: function (m) {
            var p, o, e, a, l, n;
            this._hasScroll() && (p = parseFloat(b.css(this.activeMenu[0], "borderTopWidth")) || 0, o = parseFloat(b.css(this.activeMenu[0], "paddingTop")) || 0, e = m.offset().top - this.activeMenu.offset().top - p - o, a = this.activeMenu.scrollTop(), l = this.activeMenu.height(), n = m.height(), 0 > e ? this.activeMenu.scrollTop(a + e) : e + n > l && this.activeMenu.scrollTop(a + e - l + n))
        },
        blur: function (a, d) {
            d || clearTimeout(this.timer), this.active && (this.active.children("a").removeClass("ui-state-focus"), this.active = null, this._trigger("blur", a, {
                item: this.active
            }))
        },
        _startOpening: function (a) {
            clearTimeout(this.timer), "true" === a.attr("aria-hidden") && (this.timer = this._delay(function () {
                this._close(), this._open(a)
            }, this.delay))
        },
        _open: function (d) {
            var a = b.extend({
                of: this.active
            }, this.options.position);
            clearTimeout(this.timer), this.element.find(".ui-menu").not(d.parents(".ui-menu")).hide().attr("aria-hidden", "true"), d.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(a)
        },
        collapseAll: function (d, a) {
            clearTimeout(this.timer), this.timer = this._delay(function () {
                var c = a ? this.element : b(d && d.target).closest(this.element.find(".ui-menu"));
                c.length || (c = this.element), this._close(c), this.blur(d), this.activeMenu = c
            }, this.delay)
        },
        _close: function (a) {
            a || (a = this.active ? this.active.parent() : this.element), a.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false").end().find("a.ui-state-active").removeClass("ui-state-active")
        },
        collapse: function (a) {
            var d = this.active && this.active.parent().closest(".ui-menu-item", this.element);
            d && d.length && (this._close(), this.focus(a, d))
        },
        expand: function (a) {
            var d = this.active && this.active.children(".ui-menu ").children(".ui-menu-item").first();
            d && d.length && (this._open(d.parent()), this._delay(function () {
                this.focus(a, d)
            }))
        },
        next: function (a) {
            this._move("next", "first", a)
        },
        previous: function (a) {
            this._move("prev", "last", a)
        },
        isFirstItem: function () {
            return this.active && !this.active.prevAll(".ui-menu-item").length
        },
        isLastItem: function () {
            return this.active && !this.active.nextAll(".ui-menu-item").length
        },
        _move: function (h, e, a) {
            var g;
            this.active && (g = "first" === h || "last" === h ? this.active["first" === h ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) : this.active[h + "All"](".ui-menu-item").eq(0)), g && g.length && this.active || (g = this.activeMenu.children(".ui-menu-item")[e]()), this.focus(a, g)
        },
        nextPage: function (g) {
            var a, h, e;
            return this.active ? (this.isLastItem() || (this._hasScroll() ? (h = this.active.offset().top, e = this.element.height(), this.active.nextAll(".ui-menu-item").each(function () {
                return a = b(this), 0 > a.offset().top - h - e
            }), this.focus(g, a)) : this.focus(g, this.activeMenu.children(".ui-menu-item")[this.active ? "last" : "first"]())), undefined) : (this.next(g), undefined)
        },
        previousPage: function (g) {
            var a, h, e;
            return this.active ? (this.isFirstItem() || (this._hasScroll() ? (h = this.active.offset().top, e = this.element.height(), this.active.prevAll(".ui-menu-item").each(function () {
                return a = b(this), a.offset().top - h + e > 0
            }), this.focus(g, a)) : this.focus(g, this.activeMenu.children(".ui-menu-item").first())), undefined) : (this.next(g), undefined)
        },
        _hasScroll: function () {
            return this.element.outerHeight() < this.element.prop("scrollHeight")
        },
        select: function (d) {
            this.active = this.active || b(d.target).closest(".ui-menu-item");
            var a = {
                item: this.active
            };
            this.active.has(".ui-menu").length || this.collapseAll(d, !0), this._trigger("select", d, a)
        }
    })
})(jQuery);
(function (d, c) {
    d.widget("ui.progressbar", {
        version: "1.10.3",
        options: {
            max: 100,
            value: 0,
            change: null,
            complete: null
        },
        min: 0,
        _create: function () {
            this.oldValue = this.options.value = this._constrainedValue(), this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({
                role: "progressbar",
                "aria-valuemin": this.min
            }), this.valueDiv = d("<div class='ui-progressbar-value ui-widget-header ui-corner-left'></div>").appendTo(this.element), this._refreshValue()
        },
        _destroy: function () {
            this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"), this.valueDiv.remove()
        },
        value: function (a) {
            return a === c ? this.options.value : (this.options.value = this._constrainedValue(a), this._refreshValue(), c)
        },
        _constrainedValue: function (a) {
            return a === c && (a = this.options.value), this.indeterminate = a === !1, "number" != typeof a && (a = 0), this.indeterminate ? !1 : Math.min(this.options.max, Math.max(this.min, a))
        },
        _setOptions: function (b) {
            var a = b.value;
            delete b.value, this._super(b), this.options.value = this._constrainedValue(a), this._refreshValue()
        },
        _setOption: function (b, a) {
            "max" === b && (a = Math.max(this.min, a)), this._super(b, a)
        },
        _percentage: function () {
            return this.indeterminate ? 100 : 100 * (this.options.value - this.min) / (this.options.max - this.min)
        },
        _refreshValue: function () {
            var a = this.options.value,
                    b = this._percentage();
            this.valueDiv.toggle(this.indeterminate || a > this.min).toggleClass("ui-corner-right", a === this.options.max).width(b.toFixed(0) + "%"), this.element.toggleClass("ui-progressbar-indeterminate", this.indeterminate), this.indeterminate ? (this.element.removeAttr("aria-valuenow"), this.overlayDiv || (this.overlayDiv = d("<div class='ui-progressbar-overlay'></div>").appendTo(this.valueDiv))) : (this.element.attr({
                "aria-valuemax": this.options.max,
                "aria-valuenow": a
            }), this.overlayDiv && (this.overlayDiv.remove(), this.overlayDiv = null)), this.oldValue !== a && (this.oldValue = a, this._trigger("change")), a === this.options.max && this._trigger("complete")
        }
    })
})(jQuery);
(function (d) {
    var c = 5;
    d.widget("ui.slider", d.ui.mouse, {
        version: "1.10.3",
        widgetEventPrefix: "slide",
        options: {
            animate: !1,
            distance: 0,
            max: 100,
            min: 0,
            orientation: "horizontal",
            range: !1,
            step: 1,
            value: 0,
            values: null,
            change: null,
            slide: null,
            start: null,
            stop: null
        },
        _create: function () {
            this._keySliding = !1, this._mouseSliding = !1, this._animateOff = !0, this._handleIndex = null, this._detectOrientation(), this._mouseInit(), this.element.addClass("ui-slider ui-slider-" + this.orientation + " ui-widget ui-widget-content ui-corner-all"), this._refresh(), this._setOption("disabled", this.options.disabled), this._animateOff = !1
        },
        _refresh: function () {
            this._createRange(), this._createHandles(), this._setupEvents(), this._refreshValue()
        },
        _createHandles: function () {
            var e, m, l = this.options,
                    a = this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),
                    n = "<a class='ui-slider-handle ui-state-default ui-corner-all' href='#'></a>",
                    b = [];
            for (m = l.values && l.values.length || 1, a.length > m && (a.slice(m).remove(), a = a.slice(0, m)), e = a.length; m > e; e++) {
                b.push(n)
            }
            this.handles = a.add(d(b.join("")).appendTo(this.element)), this.handle = this.handles.eq(0), this.handles.each(function (f) {
                d(this).data("ui-slider-handle-index", f)
            })
        },
        _createRange: function () {
            var a = this.options,
                    b = "";
            a.range ? (a.range === !0 && (a.values ? a.values.length && 2 !== a.values.length ? a.values = [a.values[0], a.values[0]] : d.isArray(a.values) && (a.values = a.values.slice(0)) : a.values = [this._valueMin(), this._valueMin()]), this.range && this.range.length ? this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({
                left: "",
                bottom: ""
            }) : (this.range = d("<div></div>").appendTo(this.element), b = "ui-slider-range ui-widget-header ui-corner-all"), this.range.addClass(b + ("min" === a.range || "max" === a.range ? " ui-slider-range-" + a.range : ""))) : this.range = d([])
        },
        _setupEvents: function () {
            var a = this.handles.add(this.range).filter("a");
            this._off(a), this._on(a, this._handleEvents), this._hoverable(a), this._focusable(a)
        },
        _destroy: function () {
            this.handles.remove(), this.range.remove(), this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all"), this._mouseDestroy()
        },
        _mouseCapture: function (a) {
            var e, r, l, u, n, o, b, h, s = this,
                    A = this.options;
            return A.disabled ? !1 : (this.elementSize = {
                width: this.element.outerWidth(),
                height: this.element.outerHeight()
            }, this.elementOffset = this.element.offset(), e = {
                x: a.pageX,
                y: a.pageY
            }, r = this._normValueFromMouse(e), l = this._valueMax() - this._valueMin() + 1, this.handles.each(function (f) {
                var g = Math.abs(r - s.values(f));
                (l > g || l === g && (f === s._lastChangedValue || s.values(f) === A.min)) && (l = g, u = d(this), n = f)
            }), o = this._start(a, n), o === !1 ? !1 : (this._mouseSliding = !0, this._handleIndex = n, u.addClass("ui-state-active").focus(), b = u.offset(), h = !d(a.target).parents().addBack().is(".ui-slider-handle"), this._clickOffset = h ? {
                left: 0,
                top: 0
            } : {
                left: a.pageX - b.left - u.width() / 2,
                top: a.pageY - b.top - u.height() / 2 - (parseInt(u.css("borderTopWidth"), 10) || 0) - (parseInt(u.css("borderBottomWidth"), 10) || 0) + (parseInt(u.css("marginTop"), 10) || 0)
            }, this.handles.hasClass("ui-state-hover") || this._slide(a, n, r), this._animateOff = !0, !0))
        },
        _mouseStart: function () {
            return !0
        },
        _mouseDrag: function (b) {
            var a = {
                x: b.pageX,
                y: b.pageY
            }, e = this._normValueFromMouse(a);
            return this._slide(b, this._handleIndex, e), !1
        },
        _mouseStop: function (a) {
            return this.handles.removeClass("ui-state-active"), this._mouseSliding = !1, this._stop(a, this._handleIndex), this._change(a, this._handleIndex), this._handleIndex = null, this._clickOffset = null, this._animateOff = !1, !1
        },
        _detectOrientation: function () {
            this.orientation = "vertical" === this.options.orientation ? "vertical" : "horizontal"
        },
        _normValueFromMouse: function (l) {
            var b, m, e, a, n;
            return "horizontal" === this.orientation ? (b = this.elementSize.width, m = l.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0)) : (b = this.elementSize.height, m = l.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0)), e = m / b, e > 1 && (e = 1), 0 > e && (e = 0), "vertical" === this.orientation && (e = 1 - e), a = this._valueMax() - this._valueMin(), n = this._valueMin() + e * a, this._trimAlignValue(n)
        },
        _start: function (b, a) {
            var e = {
                handle: this.handles[a],
                value: this.value()
            };
            return this.options.values && this.options.values.length && (e.value = this.values(a), e.values = this.values()), this._trigger("start", b, e)
        },
        _slide: function (l, b, m) {
            var e, a, n;
            this.options.values && this.options.values.length ? (e = this.values(b ? 0 : 1), 2 === this.options.values.length && this.options.range === !0 && (0 === b && m > e || 1 === b && e > m) && (m = e), m !== this.values(b) && (a = this.values(), a[b] = m, n = this._trigger("slide", l, {
                handle: this.handles[b],
                value: m,
                values: a
            }), e = this.values(b ? 0 : 1), n !== !1 && this.values(b, m, !0))) : m !== this.value() && (n = this._trigger("slide", l, {
                handle: this.handles[b],
                value: m
            }), n !== !1 && this.value(m))
        },
        _stop: function (b, a) {
            var e = {
                handle: this.handles[a],
                value: this.value()
            };
            this.options.values && this.options.values.length && (e.value = this.values(a), e.values = this.values()), this._trigger("stop", b, e)
        },
        _change: function (b, a) {
            if (!this._keySliding && !this._mouseSliding) {
                var e = {
                    handle: this.handles[a],
                    value: this.value()
                };
                this.options.values && this.options.values.length && (e.value = this.values(a), e.values = this.values()), this._lastChangedValue = a, this._trigger("change", b, e)
            }
        },
        value: function (a) {
            return arguments.length ? (this.options.value = this._trimAlignValue(a), this._refreshValue(), this._change(null, 0), undefined) : this._value()
        },
        values: function (b, k) {
            var e, a, l;
            if (arguments.length > 1) {
                return this.options.values[b] = this._trimAlignValue(k), this._refreshValue(), this._change(null, b), undefined
            }
            if (!arguments.length) {
                return this._values()
            }
            if (!d.isArray(arguments[0])) {
                return this.options.values && this.options.values.length ? this._values(b) : this.value()
            }
            for (e = this.options.values, a = arguments[0], l = 0; e.length > l; l += 1) {
                e[l] = this._trimAlignValue(a[l]), this._change(null, l)
            }
            this._refreshValue()
        },
        _setOption: function (b, h) {
            var e, a = 0;
            switch ("range" === b && this.options.range === !0 && ("min" === h ? (this.options.value = this._values(0), this.options.values = null) : "max" === h && (this.options.value = this._values(this.options.values.length - 1), this.options.values = null)), d.isArray(this.options.values) && (a = this.options.values.length), d.Widget.prototype._setOption.apply(this, arguments), b) {
                case "orientation":
                    this._detectOrientation(), this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-" + this.orientation), this._refreshValue();
                    break;
                case "value":
                    this._animateOff = !0, this._refreshValue(), this._change(null, 0), this._animateOff = !1;
                    break;
                case "values":
                    for (this._animateOff = !0, this._refreshValue(), e = 0; a > e; e += 1) {
                        this._change(null, e)
                    }
                    this._animateOff = !1;
                    break;
                case "min":
                case "max":
                    this._animateOff = !0, this._refreshValue(), this._animateOff = !1;
                    break;
                case "range":
                    this._animateOff = !0, this._refresh(), this._animateOff = !1
            }
        },
        _value: function () {
            var a = this.options.value;
            return a = this._trimAlignValue(a)
        },
        _values: function (e) {
            var a, h, b;
            if (arguments.length) {
                return a = this.options.values[e], a = this._trimAlignValue(a)
            }
            if (this.options.values && this.options.values.length) {
                for (h = this.options.values.slice(), b = 0; h.length > b; b += 1) {
                    h[b] = this._trimAlignValue(h[b])
                }
                return h
            }
            return []
        },
        _trimAlignValue: function (e) {
            if (this._valueMin() >= e) {
                return this._valueMin()
            }
            if (e >= this._valueMax()) {
                return this._valueMax()
            }
            var a = this.options.step > 0 ? this.options.step : 1,
                    h = (e - this._valueMin()) % a,
                    b = e - h;
            return 2 * Math.abs(h) >= a && (b += h > 0 ? a : -a), parseFloat(b.toFixed(5))
        },
        _valueMin: function () {
            return this.options.min
        },
        _valueMax: function () {
            return this.options.max
        },
        _refreshValue: function () {
            var b, h, s, n, a, o = this.options.range,
                    r = this.options,
                    e = this,
                    l = this._animateOff ? !1 : r.animate,
                    u = {};
            this.options.values && this.options.values.length ? this.handles.each(function (f) {
                h = 100 * ((e.values(f) - e._valueMin()) / (e._valueMax() - e._valueMin())), u["horizontal" === e.orientation ? "left" : "bottom"] = h + "%", d(this).stop(1, 1)[l ? "animate" : "css"](u, r.animate), e.options.range === !0 && ("horizontal" === e.orientation ? (0 === f && e.range.stop(1, 1)[l ? "animate" : "css"]({
                    left: h + "%"
                }, r.animate), 1 === f && e.range[l ? "animate" : "css"]({
                    width: h - b + "%"
                }, {
                    queue: !1,
                    duration: r.animate
                })) : (0 === f && e.range.stop(1, 1)[l ? "animate" : "css"]({
                    bottom: h + "%"
                }, r.animate), 1 === f && e.range[l ? "animate" : "css"]({
                    height: h - b + "%"
                }, {
                    queue: !1,
                    duration: r.animate
                }))), b = h
            }) : (s = this.value(), n = this._valueMin(), a = this._valueMax(), h = a !== n ? 100 * ((s - n) / (a - n)) : 0, u["horizontal" === this.orientation ? "left" : "bottom"] = h + "%", this.handle.stop(1, 1)[l ? "animate" : "css"](u, r.animate), "min" === o && "horizontal" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
                width: h + "%"
            }, r.animate), "max" === o && "horizontal" === this.orientation && this.range[l ? "animate" : "css"]({
                width: 100 - h + "%"
            }, {
                queue: !1,
                duration: r.animate
            }), "min" === o && "vertical" === this.orientation && this.range.stop(1, 1)[l ? "animate" : "css"]({
                height: h + "%"
            }, r.animate), "max" === o && "vertical" === this.orientation && this.range[l ? "animate" : "css"]({
                height: 100 - h + "%"
            }, {
                queue: !1,
                duration: r.animate
            }))
        },
        _handleEvents: {
            keydown: function (m) {
                var l, a, n, b, k = d(m.target).data("ui-slider-handle-index");
                switch (m.keyCode) {
                    case d.ui.keyCode.HOME:
                    case d.ui.keyCode.END:
                    case d.ui.keyCode.PAGE_UP:
                    case d.ui.keyCode.PAGE_DOWN:
                    case d.ui.keyCode.UP:
                    case d.ui.keyCode.RIGHT:
                    case d.ui.keyCode.DOWN:
                    case d.ui.keyCode.LEFT:
                        if (m.preventDefault(), !this._keySliding && (this._keySliding = !0, d(m.target).addClass("ui-state-active"), l = this._start(m, k), l === !1)) {
                            return
                        }
                }
                switch (b = this.options.step, a = n = this.options.values && this.options.values.length ? this.values(k) : this.value(), m.keyCode) {
                    case d.ui.keyCode.HOME:
                        n = this._valueMin();
                        break;
                    case d.ui.keyCode.END:
                        n = this._valueMax();
                        break;
                    case d.ui.keyCode.PAGE_UP:
                        n = this._trimAlignValue(a + (this._valueMax() - this._valueMin()) / c);
                        break;
                    case d.ui.keyCode.PAGE_DOWN:
                        n = this._trimAlignValue(a - (this._valueMax() - this._valueMin()) / c);
                        break;
                    case d.ui.keyCode.UP:
                    case d.ui.keyCode.RIGHT:
                        if (a === this._valueMax()) {
                            return
                        }
                        n = this._trimAlignValue(a + b);
                        break;
                    case d.ui.keyCode.DOWN:
                    case d.ui.keyCode.LEFT:
                        if (a === this._valueMin()) {
                            return
                        }
                        n = this._trimAlignValue(a - b)
                }
                this._slide(m, k, n)
            },
            click: function (a) {
                a.preventDefault()
            },
            keyup: function (a) {
                var b = d(a.target).data("ui-slider-handle-index");
                this._keySliding && (this._keySliding = !1, this._stop(a, b), this._change(a, b), d(a.target).removeClass("ui-state-active"))
            }
        }
    })
})(jQuery);
(function (d) {
    function c(a) {
        return function () {
            var b = this.element.val();
            a.apply(this, arguments), this._refresh(), b !== this.element.val() && this._trigger("change")
        }
    }
    d.widget("ui.spinner", {
        version: "1.10.3",
        defaultElement: "<input>",
        widgetEventPrefix: "spin",
        options: {
            culture: null,
            icons: {
                down: "ui-icon-triangle-1-s",
                up: "ui-icon-triangle-1-n"
            },
            incremental: !0,
            max: null,
            min: null,
            numberFormat: null,
            page: 10,
            step: 1,
            change: null,
            spin: null,
            start: null,
            stop: null
        },
        _create: function () {
            this._setOption("max", this.options.max), this._setOption("min", this.options.min), this._setOption("step", this.options.step), this._value(this.element.val(), !0), this._draw(), this._on(this._events), this._refresh(), this._on(this.window, {
                beforeunload: function () {
                    this.element.removeAttr("autocomplete")
                }
            })
        },
        _getCreateOptions: function () {
            var a = {}, b = this.element;
            return d.each(["min", "max", "step"], function (l, k) {
                var h = b.attr(k);
                void 0 !== h && h.length && (a[k] = h)
            }), a
        },
        _events: {
            keydown: function (a) {
                this._start(a) && this._keydown(a) && a.preventDefault()
            },
            keyup: "_stop",
            focus: function () {
                this.previous = this.element.val()
            },
            blur: function (a) {
                return this.cancelBlur ? (delete this.cancelBlur, void 0) : (this._stop(), this._refresh(), this.previous !== this.element.val() && this._trigger("change", a), void 0)
            },
            mousewheel: function (b, a) {
                if (a) {
                    if (!this.spinning && !this._start(b)) {
                        return !1
                    }
                    this._spin((a > 0 ? 1 : -1) * this.options.step, b), clearTimeout(this.mousewheelTimer), this.mousewheelTimer = this._delay(function () {
                        this.spinning && this._stop(b)
                    }, 100), b.preventDefault()
                }
            },
            "mousedown .ui-spinner-button": function (a) {
                function e() {
                    var f = this.element[0] === this.document[0].activeElement;
                    f || (this.element.focus(), this.previous = b, this._delay(function () {
                        this.previous = b
                    }))
                }
                var b;
                b = this.element[0] === this.document[0].activeElement ? this.previous : this.element.val(), a.preventDefault(), e.call(this), this.cancelBlur = !0, this._delay(function () {
                    delete this.cancelBlur, e.call(this)
                }), this._start(a) !== !1 && this._repeat(null, d(a.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, a)
            },
            "mouseup .ui-spinner-button": "_stop",
            "mouseenter .ui-spinner-button": function (a) {
                return d(a.currentTarget).hasClass("ui-state-active") ? this._start(a) === !1 ? !1 : (this._repeat(null, d(a.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, a), void 0) : void 0
            },
            "mouseleave .ui-spinner-button": "_stop"
        },
        _draw: function () {
            var a = this.uiSpinner = this.element.addClass("ui-spinner-input").attr("autocomplete", "off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml());
            this.element.attr("role", "spinbutton"), this.buttons = a.find(".ui-spinner-button").attr("tabIndex", -1).button().removeClass("ui-corner-all"), this.buttons.height() > Math.ceil(0.5 * a.height()) && a.height() > 0 && a.height(a.height()), this.options.disabled && this.disable()
        },
        _keydown: function (a) {
            var e = this.options,
                    b = d.ui.keyCode;
            switch (a.keyCode) {
                case b.UP:
                    return this._repeat(null, 1, a), !0;
                case b.DOWN:
                    return this._repeat(null, -1, a), !0;
                case b.PAGE_UP:
                    return this._repeat(null, e.page, a), !0;
                case b.PAGE_DOWN:
                    return this._repeat(null, -e.page, a), !0
            }
            return !1
        },
        _uiSpinnerHtml: function () {
            return "<span class='ui-spinner ui-widget ui-widget-content ui-corner-all'></span>"
        },
        _buttonHtml: function () {
            return "<a class='ui-spinner-button ui-spinner-up ui-corner-tr'><span class='ui-icon " + this.options.icons.up + "'>&#9650;</span></a><a class='ui-spinner-button ui-spinner-down ui-corner-br'><span class='ui-icon " + this.options.icons.down + "'>&#9660;</span></a>"
        },
        _start: function (a) {
            return this.spinning || this._trigger("start", a) !== !1 ? (this.counter || (this.counter = 1), this.spinning = !0, !0) : !1
        },
        _repeat: function (b, a, e) {
            b = b || 500, clearTimeout(this.timer), this.timer = this._delay(function () {
                this._repeat(40, a, e)
            }, b), this._spin(a * this.options.step, e)
        },
        _spin: function (b, a) {
            var e = this.value() || 0;
            this.counter || (this.counter = 1), e = this._adjustValue(e + b * this._increment(this.counter)), this.spinning && this._trigger("spin", a, {
                value: e
            }) === !1 || (this._value(e), this.counter++)
        },
        _increment: function (a) {
            var b = this.options.incremental;
            return b ? d.isFunction(b) ? b(a) : Math.floor(a * a * a / 50000 - a * a / 500 + 17 * a / 200 + 1) : 1
        },
        _precision: function () {
            var a = this._precisionOf(this.options.step);
            return null !== this.options.min && (a = Math.max(a, this._precisionOf(this.options.min))), a
        },
        _precisionOf: function (b) {
            var a = "" + b,
                    e = a.indexOf(".");
            return -1 === e ? 0 : a.length - e - 1
        },
        _adjustValue: function (e) {
            var a, h, b = this.options;
            return a = null !== b.min ? b.min : 0, h = e - a, h = Math.round(h / b.step) * b.step, e = a + h, e = parseFloat(e.toFixed(this._precision())), null !== b.max && e > b.max ? b.max : null !== b.min && b.min > e ? b.min : e
        },
        _stop: function (a) {
            this.spinning && (clearTimeout(this.timer), clearTimeout(this.mousewheelTimer), this.counter = 0, this.spinning = !1, this._trigger("stop", a))
        },
        _setOption: function (b, a) {
            if ("culture" === b || "numberFormat" === b) {
                var e = this._parse(this.element.val());
                return this.options[b] = a, this.element.val(this._format(e)), void 0
            }
            ("max" === b || "min" === b || "step" === b) && "string" == typeof a && (a = this._parse(a)), "icons" === b && (this.buttons.first().find(".ui-icon").removeClass(this.options.icons.up).addClass(a.up), this.buttons.last().find(".ui-icon").removeClass(this.options.icons.down).addClass(a.down)), this._super(b, a), "disabled" === b && (a ? (this.element.prop("disabled", !0), this.buttons.button("disable")) : (this.element.prop("disabled", !1), this.buttons.button("enable")))
        },
        _setOptions: c(function (a) {
            this._super(a), this._value(this.element.val())
        }),
        _parse: function (a) {
            return "string" == typeof a && "" !== a && (a = window.Globalize && this.options.numberFormat ? Globalize.parseFloat(a, 10, this.options.culture) : +a), "" === a || isNaN(a) ? null : a
        },
        _format: function (a) {
            return "" === a ? "" : window.Globalize && this.options.numberFormat ? Globalize.format(a, this.options.numberFormat, this.options.culture) : a
        },
        _refresh: function () {
            this.element.attr({
                "aria-valuemin": this.options.min,
                "aria-valuemax": this.options.max,
                "aria-valuenow": this._parse(this.element.val())
            })
        },
        _value: function (b, a) {
            var e;
            "" !== b && (e = this._parse(b), null !== e && (a || (e = this._adjustValue(e)), b = this._format(e))), this.element.val(b), this._refresh()
        },
        _destroy: function () {
            this.element.removeClass("ui-spinner-input").prop("disabled", !1).removeAttr("autocomplete").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"), this.uiSpinner.replaceWith(this.element)
        },
        stepUp: c(function (a) {
            this._stepUp(a)
        }),
        _stepUp: function (a) {
            this._start() && (this._spin((a || 1) * this.options.step), this._stop())
        },
        stepDown: c(function (a) {
            this._stepDown(a)
        }),
        _stepDown: function (a) {
            this._start() && (this._spin((a || 1) * -this.options.step), this._stop())
        },
        pageUp: c(function (a) {
            this._stepUp((a || 1) * this.options.page)
        }),
        pageDown: c(function (a) {
            this._stepDown((a || 1) * this.options.page)
        }),
        value: function (a) {
            return arguments.length ? (c(this._value).call(this, a), void 0) : this._parse(this.element.val())
        },
        widget: function () {
            return this.uiSpinner
        }
    })
})(jQuery);
(function (m, k) {
    function n() {
        return ++e
    }
    function l(b) {
        return b.hash.length > 1 && decodeURIComponent(b.href.replace(a, "")) === decodeURIComponent(location.href.replace(a, ""))
    }
    var e = 0,
            a = /#.*$/;
    m.widget("ui.tabs", {
        version: "1.10.3",
        delay: 300,
        options: {
            active: null,
            collapsible: !1,
            event: "click",
            heightStyle: "content",
            hide: null,
            show: null,
            activate: null,
            beforeActivate: null,
            beforeLoad: null,
            load: null
        },
        _create: function () {
            var c = this,
                    b = this.options;
            this.running = !1, this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all").toggleClass("ui-tabs-collapsible", b.collapsible).delegate(".ui-tabs-nav > li", "mousedown" + this.eventNamespace, function (d) {
                m(this).is(".ui-state-disabled") && d.preventDefault()
            }).delegate(".ui-tabs-anchor", "focus" + this.eventNamespace, function () {
                m(this).closest("li").is(".ui-state-disabled") && this.blur()
            }), this._processTabs(), b.active = this._initialActive(), m.isArray(b.disabled) && (b.disabled = m.unique(b.disabled.concat(m.map(this.tabs.filter(".ui-state-disabled"), function (d) {
                return c.tabs.index(d)
            }))).sort()), this.active = this.options.active !== !1 && this.anchors.length ? this._findActive(b.active) : m(), this._refresh(), this.active.length && this.load(b.active)
        },
        _initialActive: function () {
            var b = this.options.active,
                    d = this.options.collapsible,
                    c = location.hash.substring(1);
            return null === b && (c && this.tabs.each(function (f, g) {
                return m(g).attr("aria-controls") === c ? (b = f, !1) : k
            }), null === b && (b = this.tabs.index(this.tabs.filter(".ui-tabs-active"))), (null === b || -1 === b) && (b = this.tabs.length ? 0 : !1)), b !== !1 && (b = this.tabs.index(this.tabs.eq(b)), -1 === b && (b = d ? !1 : 0)), !d && b === !1 && this.anchors.length && (b = 0), b
        },
        _getCreateEventData: function () {
            return {
                tab: this.active,
                panel: this.active.length ? this._getPanelForTab(this.active) : m()
            }
        },
        _tabKeydown: function (d) {
            var c = m(this.document[0].activeElement).closest("li"),
                    b = this.tabs.index(c),
                    f = !0;
            if (!this._handlePageNav(d)) {
                switch (d.keyCode) {
                    case m.ui.keyCode.RIGHT:
                    case m.ui.keyCode.DOWN:
                        b++;
                        break;
                    case m.ui.keyCode.UP:
                    case m.ui.keyCode.LEFT:
                        f = !1, b--;
                        break;
                    case m.ui.keyCode.END:
                        b = this.anchors.length - 1;
                        break;
                    case m.ui.keyCode.HOME:
                        b = 0;
                        break;
                    case m.ui.keyCode.SPACE:
                        return d.preventDefault(), clearTimeout(this.activating), this._activate(b), k;
                    case m.ui.keyCode.ENTER:
                        return d.preventDefault(), clearTimeout(this.activating), this._activate(b === this.options.active ? !1 : b), k;
                    default:
                        return
                }
                d.preventDefault(), clearTimeout(this.activating), b = this._focusNextTab(b, f), d.ctrlKey || (c.attr("aria-selected", "false"), this.tabs.eq(b).attr("aria-selected", "true"), this.activating = this._delay(function () {
                    this.option("active", b)
                }, this.delay))
            }
        },
        _panelKeydown: function (b) {
            this._handlePageNav(b) || b.ctrlKey && b.keyCode === m.ui.keyCode.UP && (b.preventDefault(), this.active.focus())
        },
        _handlePageNav: function (b) {
            return b.altKey && b.keyCode === m.ui.keyCode.PAGE_UP ? (this._activate(this._focusNextTab(this.options.active - 1, !1)), !0) : b.altKey && b.keyCode === m.ui.keyCode.PAGE_DOWN ? (this._activate(this._focusNextTab(this.options.active + 1, !0)), !0) : k
        },
        _findNextTab: function (d, c) {
            function f() {
                return d > b && (d = 0), 0 > d && (d = b), d
            }
            for (var b = this.tabs.length - 1; -1 !== m.inArray(f(), this.options.disabled); ) {
                d = c ? d + 1 : d - 1
            }
            return d
        },
        _focusNextTab: function (b, c) {
            return b = this._findNextTab(b, c), this.tabs.eq(b).focus(), b
        },
        _setOption: function (c, b) {
            return "active" === c ? (this._activate(b), k) : "disabled" === c ? (this._setupDisabled(b), k) : (this._super(c, b), "collapsible" === c && (this.element.toggleClass("ui-tabs-collapsible", b), b || this.options.active !== !1 || this._activate(0)), "event" === c && this._setupEvents(b), "heightStyle" === c && this._setupHeightStyle(b), k)
        },
        _tabId: function (b) {
            return b.attr("aria-controls") || "ui-tabs-" + n()
        },
        _sanitizeSelector: function (b) {
            return b ? b.replace(/[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g, "\\$&") : ""
        },
        refresh: function () {
            var c = this.options,
                    b = this.tablist.children(":has(a[href])");
            c.disabled = m.map(b.filter(".ui-state-disabled"), function (d) {
                return b.index(d)
            }), this._processTabs(), c.active !== !1 && this.anchors.length ? this.active.length && !m.contains(this.tablist[0], this.active[0]) ? this.tabs.length === c.disabled.length ? (c.active = !1, this.active = m()) : this._activate(this._findNextTab(Math.max(0, c.active - 1), !1)) : c.active = this.tabs.index(this.active) : (c.active = !1, this.active = m()), this._refresh()
        },
        _refresh: function () {
            this._setupDisabled(this.options.disabled), this._setupEvents(this.options.event), this._setupHeightStyle(this.options.heightStyle), this.tabs.not(this.active).attr({
                "aria-selected": "false",
                tabIndex: -1
            }), this.panels.not(this._getPanelForTab(this.active)).hide().attr({
                "aria-expanded": "false",
                "aria-hidden": "true"
            }), this.active.length ? (this.active.addClass("ui-tabs-active ui-state-active").attr({
                "aria-selected": "true",
                tabIndex: 0
            }), this._getPanelForTab(this.active).show().attr({
                "aria-expanded": "true",
                "aria-hidden": "false"
            })) : this.tabs.eq(0).attr("tabIndex", 0)
        },
        _processTabs: function () {
            var b = this;
            this.tablist = this._getList().addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").attr("role", "tablist"), this.tabs = this.tablist.find("> li:has(a[href])").addClass("ui-state-default ui-corner-top").attr({
                role: "tab",
                tabIndex: -1
            }), this.anchors = this.tabs.map(function () {
                return m("a", this)[0]
            }).addClass("ui-tabs-anchor").attr({
                role: "presentation",
                tabIndex: -1
            }), this.panels = m(), this.anchors.each(function (u, d) {
                var g, f, h, o = m(d).uniqueId().attr("id"),
                        r = m(d).closest("li"),
                        c = r.attr("aria-controls");
                l(d) ? (g = d.hash, f = b.element.find(b._sanitizeSelector(g))) : (h = b._tabId(r), g = "#" + h, f = b.element.find(g), f.length || (f = b._createPanel(h), f.insertAfter(b.panels[u - 1] || b.tablist)), f.attr("aria-live", "polite")), f.length && (b.panels = b.panels.add(f)), c && r.data("ui-tabs-aria-controls", c), r.attr({
                    "aria-controls": g.substring(1),
                    "aria-labelledby": o
                }), f.attr("aria-labelledby", o)
            }), this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").attr("role", "tabpanel")
        },
        _getList: function () {
            return this.element.find("ol,ul").eq(0)
        },
        _createPanel: function (b) {
            return m("<div>").attr("id", b).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").data("ui-tabs-destroy", !0)
        },
        _setupDisabled: function (c) {
            m.isArray(c) && (c.length ? c.length === this.anchors.length && (c = !0) : c = !1);
            for (var b, d = 0; b = this.tabs[d]; d++) {
                c === !0 || -1 !== m.inArray(d, c) ? m(b).addClass("ui-state-disabled").attr("aria-disabled", "true") : m(b).removeClass("ui-state-disabled").removeAttr("aria-disabled")
            }
            this.options.disabled = c
        },
        _setupEvents: function (c) {
            var b = {
                click: function (d) {
                    d.preventDefault()
                }
            };
            c && m.each(c.split(" "), function (f, d) {
                b[d] = "_eventHandler"
            }), this._off(this.anchors.add(this.tabs).add(this.panels)), this._on(this.anchors, b), this._on(this.tabs, {
                keydown: "_tabKeydown"
            }), this._on(this.panels, {
                keydown: "_panelKeydown"
            }), this._focusable(this.tabs), this._hoverable(this.tabs)
        },
        _setupHeightStyle: function (c) {
            var b, d = this.element.parent();
            "fill" === c ? (b = d.height(), b -= this.element.outerHeight() - this.element.height(), this.element.siblings(":visible").each(function () {
                var g = m(this),
                        f = g.css("position");
                "absolute" !== f && "fixed" !== f && (b -= g.outerHeight(!0))
            }), this.element.children().not(this.panels).each(function () {
                b -= m(this).outerHeight(!0)
            }), this.panels.each(function () {
                m(this).height(Math.max(0, b - m(this).innerHeight() + m(this).height()))
            }).css("overflow", "auto")) : "auto" === c && (b = 0, this.panels.each(function () {
                b = Math.max(b, m(this).height("").height())
            }).height(b))
        },
        _eventHandler: function (r) {
            var u = this.options,
                    c = this.active,
                    d = m(r.currentTarget),
                    o = d.closest("li"),
                    g = o[0] === c[0],
                    h = g && u.collapsible,
                    s = h ? m() : this._getPanelForTab(o),
                    b = c.length ? this._getPanelForTab(c) : m(),
                    f = {
                        oldTab: c,
                        oldPanel: b,
                        newTab: h ? m() : o,
                        newPanel: s
                    };
            r.preventDefault(), o.hasClass("ui-state-disabled") || o.hasClass("ui-tabs-loading") || this.running || g && !u.collapsible || this._trigger("beforeActivate", r, f) === !1 || (u.active = h ? !1 : this.tabs.index(o), this.active = g ? m() : o, this.xhr && this.xhr.abort(), b.length || s.length || m.error("jQuery UI Tabs: Mismatching fragment identifier."), s.length && this.load(this.tabs.index(o), r), this._toggle(r, f))
        },
        _toggle: function (h, c) {
            function b() {
                d.running = !1, d._trigger("activate", h, c)
            }
            function f() {
                c.newTab.closest("li").addClass("ui-tabs-active ui-state-active"), g.length && d.options.show ? d._show(g, d.options.show, b) : (g.show(), b())
            }
            var d = this,
                    g = c.newPanel,
                    o = c.oldPanel;
            this.running = !0, o.length && this.options.hide ? this._hide(o, this.options.hide, function () {
                c.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"), f()
            }) : (c.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"), o.hide(), f()), o.attr({
                "aria-expanded": "false",
                "aria-hidden": "true"
            }), c.oldTab.attr("aria-selected", "false"), g.length && o.length ? c.oldTab.attr("tabIndex", -1) : g.length && this.tabs.filter(function () {
                return 0 === m(this).attr("tabIndex")
            }).attr("tabIndex", -1), g.attr({
                "aria-expanded": "true",
                "aria-hidden": "false"
            }), c.newTab.attr({
                "aria-selected": "true",
                tabIndex: 0
            })
        },
        _activate: function (c) {
            var b, d = this._findActive(c);
            d[0] !== this.active[0] && (d.length || (d = this.active), b = d.find(".ui-tabs-anchor")[0], this._eventHandler({
                target: b,
                currentTarget: b,
                preventDefault: m.noop
            }))
        },
        _findActive: function (b) {
            return b === !1 ? m() : this.tabs.eq(b)
        },
        _getIndex: function (b) {
            return "string" == typeof b && (b = this.anchors.index(this.anchors.filter("[href$='" + b + "']"))), b
        },
        _destroy: function () {
            this.xhr && this.xhr.abort(), this.element.removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible"), this.tablist.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").removeAttr("role"), this.anchors.removeClass("ui-tabs-anchor").removeAttr("role").removeAttr("tabIndex").removeUniqueId(), this.tabs.add(this.panels).each(function () {
                m.data(this, "ui-tabs-destroy") ? m(this).remove() : m(this).removeClass("ui-state-default ui-state-active ui-state-disabled ui-corner-top ui-corner-bottom ui-widget-content ui-tabs-active ui-tabs-panel").removeAttr("tabIndex").removeAttr("aria-live").removeAttr("aria-busy").removeAttr("aria-selected").removeAttr("aria-labelledby").removeAttr("aria-hidden").removeAttr("aria-expanded").removeAttr("role")
            }), this.tabs.each(function () {
                var c = m(this),
                        b = c.data("ui-tabs-aria-controls");
                b ? c.attr("aria-controls", b).removeData("ui-tabs-aria-controls") : c.removeAttr("aria-controls")
            }), this.panels.show(), "content" !== this.options.heightStyle && this.panels.css("height", "")
        },
        enable: function (b) {
            var c = this.options.disabled;
            c !== !1 && (b === k ? c = !1 : (b = this._getIndex(b), c = m.isArray(c) ? m.map(c, function (d) {
                return d !== b ? d : null
            }) : m.map(this.tabs, function (f, d) {
                return d !== b ? d : null
            })), this._setupDisabled(c))
        },
        disable: function (b) {
            var c = this.options.disabled;
            if (c !== !0) {
                if (b === k) {
                    c = !0
                } else {
                    if (b = this._getIndex(b), -1 !== m.inArray(b, c)) {
                        return
                    }
                    c = m.isArray(c) ? m.merge([b], c).sort() : [b]
                }
                this._setupDisabled(c)
            }
        },
        load: function (h, c) {
            h = this._getIndex(h);
            var f = this,
                    d = this.tabs.eq(h),
                    g = d.find(".ui-tabs-anchor"),
                    o = this._getPanelForTab(d),
                    b = {
                        tab: d,
                        panel: o
                    };
            l(g[0]) || (this.xhr = m.ajax(this._ajaxSettings(g, c, b)), this.xhr && "canceled" !== this.xhr.statusText && (d.addClass("ui-tabs-loading"), o.attr("aria-busy", "true"), this.xhr.success(function (p) {
                setTimeout(function () {
                    o.html(p), f._trigger("load", c, b)
                }, 1)
            }).complete(function (p, q) {
                setTimeout(function () {
                    "abort" === q && f.panels.stop(!1, !0), d.removeClass("ui-tabs-loading"), o.removeAttr("aria-busy"), p === f.xhr && delete f.xhr
                }, 1)
            })))
        },
        _ajaxSettings: function (d, c, f) {
            var b = this;
            return {
                url: d.attr("href"),
                beforeSend: function (g, h) {
                    return b._trigger("beforeLoad", c, m.extend({
                        jqXHR: g,
                        ajaxSettings: h
                    }, f))
                }
            }
        },
        _getPanelForTab: function (c) {
            var b = m(c).attr("aria-controls");
            return this.element.find(this._sanitizeSelector("#" + b))
        }
    })
})(jQuery);
(function (e) {
    function g(a, c) {
        var b = (a.attr("aria-describedby") || "").split(/\s+/);
        b.push(c), a.data("ui-tooltip-id", c).attr("aria-describedby", e.trim(b.join(" ")))
    }
    function f(b) {
        var d = b.data("ui-tooltip-id"),
                c = (b.attr("aria-describedby") || "").split(/\s+/),
                a = e.inArray(d, c);
        -1 !== a && c.splice(a, 1), b.removeData("ui-tooltip-id"), c = e.trim(c.join(" ")), c ? b.attr("aria-describedby", c) : b.removeAttr("aria-describedby")
    }
    var h = 0;
    e.widget("ui.tooltip", {
        version: "1.10.3",
        options: {
            content: function () {
                var a = e(this).attr("title") || "";
                return e("<a>").text(a).html()
            },
            hide: !0,
            items: "[title]:not([disabled])",
            position: {
                my: "left top+15",
                at: "left bottom",
                collision: "flipfit flip"
            },
            show: !0,
            tooltipClass: null,
            track: !1,
            close: null,
            open: null
        },
        _create: function () {
            this._on({
                mouseover: "open",
                focusin: "open"
            }), this.tooltips = {}, this.parents = {}, this.options.disabled && this._disable()
        },
        _setOption: function (a, c) {
            var b = this;
            return "disabled" === a ? (this[c ? "_disable" : "_enable"](), this.options[a] = c, void 0) : (this._super(a, c), "content" === a && e.each(this.tooltips, function (m, d) {
                b._updateContent(d)
            }), void 0)
        },
        _disable: function () {
            var a = this;
            e.each(this.tooltips, function (d, c) {
                var b = e.Event("blur");
                b.target = b.currentTarget = c[0], a.close(b, !0)
            }), this.element.find(this.options.items).addBack().each(function () {
                var b = e(this);
                b.is("[title]") && b.data("ui-tooltip-title", b.attr("title")).attr("title", "")
            })
        },
        _enable: function () {
            this.element.find(this.options.items).addBack().each(function () {
                var a = e(this);
                a.data("ui-tooltip-title") && a.attr("title", a.data("ui-tooltip-title"))
            })
        },
        open: function (a) {
            var c = this,
                    b = e(a ? a.target : this.element).closest(this.options.items);
            b.length && !b.data("ui-tooltip-id") && (b.attr("title") && b.data("ui-tooltip-title", b.attr("title")), b.data("ui-tooltip-open", !0), a && "mouseover" === a.type && b.parents().each(function () {
                var d, m = e(this);
                m.data("ui-tooltip-open") && (d = e.Event("blur"), d.target = d.currentTarget = this, c.close(d, !0)), m.attr("title") && (m.uniqueId(), c.parents[this.id] = {
                    element: this,
                    title: m.attr("title")
                }, m.attr("title", ""))
            }), this._updateContent(b, a))
        },
        _updateContent: function (d, b) {
            var n, c = this.options.content,
                    a = this,
                    o = b ? b.type : null;
            return "string" == typeof c ? this._open(b, d, c) : (n = c.call(d[0], function (k) {
                d.data("ui-tooltip-open") && a._delay(function () {
                    b && (b.type = o), this._open(b, d, k)
                })
            }), n && this._open(b, d, n), void 0)
        },
        _open: function (d, a, c) {
            function n(k) {
                o.of = k, l.is(":hidden") || l.position(o)
            }
            var l, r, b, o = e.extend({}, this.options.position);
            if (c) {
                if (l = this._find(a), l.length) {
                    return l.find(".ui-tooltip-content").html(c), void 0
                }
                a.is("[title]") && (d && "mouseover" === d.type ? a.attr("title", "") : a.removeAttr("title")), l = this._tooltip(a), g(a, l.attr("id")), l.find(".ui-tooltip-content").html(c), this.options.track && d && /^mouse/.test(d.type) ? (this._on(this.document, {
                    mousemove: n
                }), n(d)) : l.position(e.extend({
                    of: a
                }, this.options.position)), l.hide(), this._show(l, this.options.show), this.options.show && this.options.show.delay && (b = this.delayedShow = setInterval(function () {
                    l.is(":visible") && (n(o.of), clearInterval(b))
                }, e.fx.interval)), this._trigger("open", d, {
                    tooltip: l
                }), r = {
                    keyup: function (k) {
                        if (k.keyCode === e.ui.keyCode.ESCAPE) {
                            var m = e.Event(k);
                            m.currentTarget = a[0], this.close(m, !0)
                        }
                    },
                    remove: function () {
                        this._removeTooltip(l)
                    }
                }, d && "mouseover" !== d.type || (r.mouseleave = "close"), d && "focusin" !== d.type || (r.focusout = "close"), this._on(!0, a, r)
            }
        },
        close: function (b) {
            var c = this,
                    a = e(b ? b.currentTarget : this.element),
                    d = this._find(a);
            this.closing || (clearInterval(this.delayedShow), a.data("ui-tooltip-title") && a.attr("title", a.data("ui-tooltip-title")), f(a), d.stop(!0), this._hide(d, this.options.hide, function () {
                c._removeTooltip(e(this))
            }), a.removeData("ui-tooltip-open"), this._off(a, "mouseleave focusout keyup"), a[0] !== this.element[0] && this._off(a, "remove"), this._off(this.document, "mousemove"), b && "mouseleave" === b.type && e.each(this.parents, function (k, n) {
                e(n.element).attr("title", n.title), delete c.parents[k]
            }), this.closing = !0, this._trigger("close", b, {
                tooltip: d
            }), this.closing = !1)
        },
        _tooltip: function (b) {
            var c = "ui-tooltip-" + h++,
                    a = e("<div>").attr({
                id: c,
                role: "tooltip"
            }).addClass("ui-tooltip ui-widget ui-corner-all ui-widget-content " + (this.options.tooltipClass || ""));
            return e("<div>").addClass("ui-tooltip-content").appendTo(a), a.appendTo(this.document[0].body), this.tooltips[c] = b, a
        },
        _find: function (a) {
            var b = a.data("ui-tooltip-id");
            return b ? e("#" + b) : e()
        },
        _removeTooltip: function (a) {
            a.remove(), delete this.tooltips[a.attr("id")]
        },
        _destroy: function () {
            var a = this;
            e.each(this.tooltips, function (d, c) {
                var b = e.Event("blur");
                b.target = b.currentTarget = c[0], a.close(b, !0), e("#" + d).remove(), c.data("ui-tooltip-title") && (c.attr("title", c.data("ui-tooltip-title")), c.removeData("ui-tooltip-title"))
            })
        }
    })
})(jQuery);
(function (d, f) {
    var e = "ui-effects-";
    d.effects = {
        effect: {}
    },
    function (J, l) {
        function u(m, g, q) {
            var k = K[g.type] || {};
            return null == m ? q || !g.def ? null : g.def : (m = k.floor ? ~~m : parseFloat(m), isNaN(m) ? g.def : k.mod ? (m + k.mod) % k.mod : 0 > m ? 0 : m > k.max ? k.max : m)
        }
        function I(m) {
            var k = H(),
                    g = k._rgba = [];
            return m = m.toLowerCase(), r(s, function (x, y) {
                var v, w = y.re.exec(m),
                        q = w && y.parse(w),
                        A = y.space || "rgba";
                return q ? (v = k[A](q), k[b[A].cache] = v[b[A].cache], g = k._rgba = v._rgba, !1) : l
            }), g.length ? ("0,0,0,0" === g.join() && J.extend(g, a.transparent), k) : a[m]
        }
        function c(k, g, m) {
            return m = (m + 1) % 1, 1 > 6 * m ? k + 6 * (g - k) * m : 1 > 2 * m ? g : 2 > 3 * m ? k + 6 * (g - k) * (2 / 3 - m) : k
        }
        var a, n = "backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",
                p = /^([\-+])=\s*(\d+\.?\d*)/,
                s = [{
                        re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                        parse: function (g) {
                            return [g[1], g[2], g[3], g[4]]
                        }
                    }, {
                        re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                        parse: function (g) {
                            return [2.55 * g[1], 2.55 * g[2], 2.55 * g[3], g[4]]
                        }
                    }, {
                        re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,
                        parse: function (g) {
                            return [parseInt(g[1], 16), parseInt(g[2], 16), parseInt(g[3], 16)]
                        }
                    }, {
                        re: /#([a-f0-9])([a-f0-9])([a-f0-9])/,
                        parse: function (g) {
                            return [parseInt(g[1] + g[1], 16), parseInt(g[2] + g[2], 16), parseInt(g[3] + g[3], 16)]
                        }
                    }, {
                        re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                        space: "hsla",
                        parse: function (g) {
                            return [g[1], g[2] / 100, g[3] / 100, g[4]]
                        }
                    }],
                H = J.Color = function (k, q, m, g) {
                    return new J.Color.fn.parse(k, q, m, g)
                }, b = {
            rgba: {
                props: {
                    red: {
                        idx: 0,
                        type: "byte"
                    },
                    green: {
                        idx: 1,
                        type: "byte"
                    },
                    blue: {
                        idx: 2,
                        type: "byte"
                    }
                }
            },
            hsla: {
                props: {
                    hue: {
                        idx: 0,
                        type: "degrees"
                    },
                    saturation: {
                        idx: 1,
                        type: "percent"
                    },
                    lightness: {
                        idx: 2,
                        type: "percent"
                    }
                }
            }
        }, K = {
            "byte": {
                floor: !0,
                max: 255
            },
            percent: {
                max: 1
            },
            degrees: {
                mod: 360,
                floor: !0
            }
        }, h = H.support = {}, o = J("<p>")[0],
                r = J.each;
        o.style.cssText = "background-color:rgba(1,1,1,.5)", h.rgba = o.style.backgroundColor.indexOf("rgba") > -1, r(b, function (k, g) {
            g.cache = "_" + k, g.props.alpha = {
                idx: 3,
                type: "percent",
                def: 1
            }
        }), H.fn = J.extend(H.prototype, {
            parse: function (k, m, g, w) {
                if (k === l) {
                    return this._rgba = [null, null, null, null], this
                }
                (k.jquery || k.nodeType) && (k = J(k).css(m), m = l);
                var x = this,
                        q = J.type(k),
                        v = this._rgba = [];
                return m !== l && (k = [k, m, g, w], q = "array"), "string" === q ? this.parse(I(k) || a._default) : "array" === q ? (r(b.rgba.props, function (A, y) {
                    v[y.idx] = u(k[y.idx], y)
                }), this) : "object" === q ? (k instanceof H ? r(b, function (A, y) {
                    k[y.cache] && (x[y.cache] = k[y.cache].slice())
                }) : r(b, function (B, y) {
                    var A = y.cache;
                    r(y.props, function (D, C) {
                        if (!x[A] && y.to) {
                            if ("alpha" === D || null == k[D]) {
                                return
                            }
                            x[A] = y.to(x._rgba)
                        }
                        x[A][C.idx] = u(k[D], C, !0)
                    }), x[A] && 0 > J.inArray(null, x[A].slice(0, 3)) && (x[A][3] = 1, y.from && (x._rgba = y.from(x[A])))
                }), this) : l
            },
            is: function (m) {
                var q = H(m),
                        k = !0,
                        g = this;
                return r(b, function (y, v) {
                    var w, x = q[v.cache];
                    return x && (w = g[v.cache] || v.to && v.to(g._rgba) || [], r(v.props, function (A, B) {
                        return null != x[B.idx] ? k = x[B.idx] === w[B.idx] : l
                    })), k
                }), k
            },
            _space: function () {
                var k = [],
                        g = this;
                return r(b, function (q, m) {
                    g[m.cache] && k.push(q)
                }), k.pop()
            },
            transition: function (w, v) {
                var x = H(w),
                        k = x._space(),
                        y = b[k],
                        q = 0 === this.alpha() ? H("transparent") : this,
                        m = q[y.cache] || y.to(q._rgba),
                        g = m.slice();
                return x = x[y.cache], r(y.props, function (E, A) {
                    var D = A.idx,
                            C = m[D],
                            F = x[D],
                            B = K[A.type] || {};
                    null !== F && (null === C ? g[D] = F : (B.mod && (F - C > B.mod / 2 ? C += B.mod : C - F > B.mod / 2 && (C -= B.mod)), g[D] = u((F - C) * v + C, A)))
                }), this[k](g)
            },
            blend: function (k) {
                if (1 === this._rgba[3]) {
                    return this
                }
                var q = this._rgba.slice(),
                        m = q.pop(),
                        g = H(k)._rgba;
                return H(J.map(q, function (w, v) {
                    return (1 - m) * g[v] + m * w
                }))
            },
            toRgbaString: function () {
                var g = "rgba(",
                        k = J.map(this._rgba, function (q, m) {
                            return null == q ? m > 2 ? 1 : 0 : q
                        });
                return 1 === k[3] && (k.pop(), g = "rgb("), g + k.join() + ")"
            },
            toHslaString: function () {
                var g = "hsla(",
                        k = J.map(this.hsla(), function (q, m) {
                            return null == q && (q = m > 2 ? 1 : 0), m && 3 > m && (q = Math.round(100 * q) + "%"), q
                        });
                return 1 === k[3] && (k.pop(), g = "hsl("), g + k.join() + ")"
            },
            toHexString: function (g) {
                var m = this._rgba.slice(),
                        k = m.pop();
                return g && m.push(~~(255 * k)), "#" + J.map(m, function (q) {
                    return q = (q || 0).toString(16), 1 === q.length ? "0" + q : q
                }).join("")
            },
            toString: function () {
                return 0 === this._rgba[3] ? "transparent" : this.toRgbaString()
            }
        }), H.fn.parse.prototype = H.fn, b.hsla.to = function (m) {
            if (null == m[0] || null == m[1] || null == m[2]) {
                return [null, null, null, m[3]]
            }
            var A, C, k = m[0] / 255,
                    g = m[1] / 255,
                    w = m[2] / 255,
                    q = m[3],
                    x = Math.max(k, g, w),
                    B = Math.min(k, g, w),
                    D = x - B,
                    y = x + B,
                    v = 0.5 * y;
            return A = B === x ? 0 : k === x ? 60 * (g - w) / D + 360 : g === x ? 60 * (w - k) / D + 120 : 60 * (k - g) / D + 240, C = 0 === D ? 0 : 0.5 >= v ? D / y : D / (2 - y), [Math.round(A) % 360, C, v, null == q ? 1 : q]
        }, b.hsla.from = function (m) {
            if (null == m[0] || null == m[1] || null == m[2]) {
                return [null, null, null, m[3]]
            }
            var v = m[0] / 360,
                    q = m[1],
                    g = m[2],
                    w = m[3],
                    k = 0.5 >= g ? g * (1 + q) : g + q - g * q,
                    x = 2 * g - k;
            return [Math.round(255 * c(x, k, v + 1 / 3)), Math.round(255 * c(x, k, v)), Math.round(255 * c(x, k, v - 1 / 3)), w]
        }, r(b, function (m, k) {
            var w = k.props,
                    g = k.cache,
                    v = k.to,
                    q = k.from;
            H.fn[m] = function (C) {
                if (v && !this[g] && (this[g] = v(this._rgba)), C === l) {
                    return this[g].slice()
                }
                var x, A = J.type(C),
                        B = "array" === A || "object" === A ? C : arguments,
                        y = this[g].slice();
                return r(w, function (F, D) {
                    var E = B["object" === A ? F : D.idx];
                    null == E && (E = y[D.idx]), y[D.idx] = u(E, D)
                }), q ? (x = H(q(y)), x[g] = y, x) : H(y)
            }, r(w, function (y, x) {
                H.fn[y] || (H.fn[y] = function (A) {
                    var D, C = J.type(A),
                            E = "alpha" === y ? this._hsla ? "hsla" : "rgba" : m,
                            F = this[E](),
                            B = F[x.idx];
                    return "undefined" === C ? B : ("function" === C && (A = A.call(this, B), C = J.type(A)), null == A && x.empty ? this : ("string" === C && (D = p.exec(A), D && (A = B + parseFloat(D[2]) * ("+" === D[1] ? 1 : -1))), F[x.idx] = A, this[E](F)))
                })
            })
        }), H.hook = function (g) {
            var k = g.split(" ");
            r(k, function (m, q) {
                J.cssHooks[q] = {
                    set: function (y, v) {
                        var B, x, w = "";
                        if ("transparent" !== v && ("string" !== J.type(v) || (B = I(v)))) {
                            if (v = H(B || v), !h.rgba && 1 !== v._rgba[3]) {
                                for (x = "backgroundColor" === q ? y.parentNode : y;
                                        ("" === w || "transparent" === w) && x && x.style; ) {
                                    try {
                                        w = J.css(x, "backgroundColor"), x = x.parentNode
                                    } catch (A) {
                                    }
                                }
                                v = v.blend(w && "transparent" !== w ? w : "_default")
                            }
                            v = v.toRgbaString()
                        }
                        try {
                            y.style[q] = v
                        } catch (A) {
                        }
                    }
                }, J.fx.step[q] = function (v) {
                    v.colorInit || (v.start = H(v.elem, q), v.end = H(v.end), v.colorInit = !0), J.cssHooks[q].set(v.elem, v.start.transition(v.end, v.pos))
                }
            })
        }, H.hook(n), J.cssHooks.borderColor = {
            expand: function (k) {
                var g = {};
                return r(["Top", "Right", "Bottom", "Left"], function (q, m) {
                    g["border" + m + "Color"] = k
                }), g
            }
        }, a = J.Color.names = {
            aqua: "#00ffff",
            black: "#000000",
            blue: "#0000ff",
            fuchsia: "#ff00ff",
            gray: "#808080",
            green: "#008000",
            lime: "#00ff00",
            maroon: "#800000",
            navy: "#000080",
            olive: "#808000",
            purple: "#800080",
            red: "#ff0000",
            silver: "#c0c0c0",
            teal: "#008080",
            white: "#ffffff",
            yellow: "#ffff00",
            transparent: [null, null, null, 0],
            _default: "#ffffff"
        }
    }(jQuery),
            function () {
                function c(g) {
                    var p, n, r = g.ownerDocument.defaultView ? g.ownerDocument.defaultView.getComputedStyle(g, null) : g.currentStyle,
                            q = {};
                    if (r && r.length && r[0] && r[r[0]]) {
                        for (n = r.length; n--; ) {
                            p = r[n], "string" == typeof r[p] && (q[d.camelCase(p)] = r[p])
                        }
                    } else {
                        for (p in r) {
                            "string" == typeof r[p] && (q[p] = r[p])
                        }
                    }
                    return q
                }
                function b(n, q) {
                    var o, r, g = {};
                    for (o in q) {
                        r = q[o], n[o] !== r && (h[o] || (d.fx.step[o] || !isNaN(parseFloat(r))) && (g[o] = r))
                    }
                    return g
                }
                var a = ["add", "remove", "toggle"],
                        h = {
                            border: 1,
                            borderBottom: 1,
                            borderColor: 1,
                            borderLeft: 1,
                            borderRight: 1,
                            borderTop: 1,
                            borderWidth: 1,
                            margin: 1,
                            padding: 1
                        };
                d.each(["borderLeftStyle", "borderRightStyle", "borderBottomStyle", "borderTopStyle"], function (g, l) {
                    d.fx.step[l] = function (k) {
                        ("none" !== k.end && !k.setAttr || 1 === k.pos && !k.setAttr) && (jQuery.style(k.elem, l, k.end), k.setAttr = !0)
                    }
                }), d.fn.addBack || (d.fn.addBack = function (g) {
                    return this.add(null == g ? this.prevObject : this.prevObject.filter(g))
                }), d.effects.animateClass = function (s, q, r, g) {
                    var o = d.speed(q, r, g);
                    return this.queue(function () {
                        var n, k = d(this),
                                m = k.attr("class") || "",
                                l = o.children ? k.find("*").addBack() : k;
                        l = l.map(function () {
                            var p = d(this);
                            return {
                                el: p,
                                start: c(this)
                            }
                        }), n = function () {
                            d.each(a, function (p, u) {
                                s[u] && k[u + "Class"](s[u])
                            })
                        }, n(), l = l.map(function () {
                            return this.end = c(this.el[0]), this.diff = b(this.start, this.end), this
                        }), k.attr("class", m), l = l.map(function () {
                            var p = this,
                                    w = d.Deferred(),
                                    u = d.extend({}, o, {
                                        queue: !1,
                                        complete: function () {
                                            w.resolve(p)
                                        }
                                    });
                            return this.el.animate(this.diff, u), w.promise()
                        }), d.when.apply(d, l.get()).done(function () {
                            n(), d.each(arguments, function () {
                                var p = this.el;
                                d.each(this.diff, function (u) {
                                    p.css(u, "")
                                })
                            }), o.complete.call(k[0])
                        })
                    })
                }, d.fn.extend({
                    addClass: function (g) {
                        return function (p, n, r, q) {
                            return n ? d.effects.animateClass.call(this, {
                                add: p
                            }, n, r, q) : g.apply(this, arguments)
                        }
                    }(d.fn.addClass),
                    removeClass: function (g) {
                        return function (p, n, r, q) {
                            return arguments.length > 1 ? d.effects.animateClass.call(this, {
                                remove: p
                            }, n, r, q) : g.apply(this, arguments)
                        }
                    }(d.fn.removeClass),
                    toggleClass: function (g) {
                        return function (o, s, r, u, n) {
                            return "boolean" == typeof s || s === f ? r ? d.effects.animateClass.call(this, s ? {
                                add: o
                            } : {
                                remove: o
                            }, r, u, n) : g.apply(this, arguments) : d.effects.animateClass.call(this, {
                                toggle: o
                            }, s, r, u)
                        }
                    }(d.fn.toggleClass),
                    switchClass: function (g, p, n, r, q) {
                        return d.effects.animateClass.call(this, {
                            add: p,
                            remove: g
                        }, n, r, q)
                    }
                })
            }(),
            function () {
                function b(l, n, m, c) {
                    return d.isPlainObject(l) && (n = l, l = l.effect), l = {
                        effect: l
                    }, null == n && (n = {}), d.isFunction(n) && (c = n, m = null, n = {}), ("number" == typeof n || d.fx.speeds[n]) && (c = m, m = n, n = {}), d.isFunction(m) && (c = m, m = null), n && d.extend(l, n), m = m || n.duration, l.duration = d.fx.off ? 0 : "number" == typeof m ? m : m in d.fx.speeds ? d.fx.speeds[m] : d.fx.speeds._default, l.complete = c || n.complete, l
                }
                function a(c) {
                    return !c || "number" == typeof c || d.fx.speeds[c] ? !0 : "string" != typeof c || d.effects.effect[c] ? d.isFunction(c) ? !0 : "object" != typeof c || c.effect ? !1 : !0 : !0
                }
                d.extend(d.effects, {
                    version: "1.10.3",
                    save: function (l, c) {
                        for (var k = 0; c.length > k; k++) {
                            null !== c[k] && l.data(e + c[k], l[0].style[c[k]])
                        }
                    },
                    restore: function (m, l) {
                        var c, n;
                        for (n = 0; l.length > n; n++) {
                            null !== l[n] && (c = m.data(e + l[n]), c === f && (c = ""), m.css(l[n], c))
                        }
                    },
                    setMode: function (h, c) {
                        return "toggle" === c && (c = h.is(":hidden") ? "show" : "hide"), c
                    },
                    getBaseline: function (m, c) {
                        var n, l;
                        switch (m[0]) {
                            case "top":
                                n = 0;
                                break;
                            case "middle":
                                n = 0.5;
                                break;
                            case "bottom":
                                n = 1;
                                break;
                            default:
                                n = m[0] / c.height
                        }
                        switch (m[1]) {
                            case "left":
                                l = 0;
                                break;
                            case "center":
                                l = 0.5;
                                break;
                            case "right":
                                l = 1;
                                break;
                            default:
                                l = m[1] / c.width
                        }
                        return {
                            x: l,
                            y: n
                        }
                    },
                    createWrapper: function (o) {
                        if (o.parent().is(".ui-effects-wrapper")) {
                            return o.parent()
                        }
                        var q = {
                            width: o.outerWidth(!0),
                            height: o.outerHeight(!0),
                            "float": o.css("float")
                        }, p = d("<div></div>").addClass("ui-effects-wrapper").css({
                            fontSize: "100%",
                            background: "transparent",
                            border: "none",
                            margin: 0,
                            padding: 0
                        }),
                                c = {
                                    width: o.width(),
                                    height: o.height()
                                }, r = document.activeElement;
                        try {
                            r.id
                        } catch (n) {
                            r = document.body
                        }
                        return o.wrap(p), (o[0] === r || d.contains(o[0], r)) && d(r).focus(), p = o.parent(), "static" === o.css("position") ? (p.css({
                            position: "relative"
                        }), o.css({
                            position: "relative"
                        })) : (d.extend(q, {
                            position: o.css("position"),
                            zIndex: o.css("z-index")
                        }), d.each(["top", "left", "bottom", "right"], function (h, g) {
                            q[g] = o.css(g), isNaN(parseInt(q[g], 10)) && (q[g] = "auto")
                        }), o.css({
                            position: "relative",
                            top: 0,
                            left: 0,
                            right: "auto",
                            bottom: "auto"
                        })), o.css(c), p.css(q).show()
                    },
                    removeWrapper: function (c) {
                        var h = document.activeElement;
                        return c.parent().is(".ui-effects-wrapper") && (c.parent().replaceWith(c), (c[0] === h || d.contains(c[0], h)) && d(h).focus()), c
                    },
                    setTransition: function (l, n, m, c) {
                        return c = c || {}, d.each(n, function (k, g) {
                            var h = l.cssUnit(g);
                            h[0] > 0 && (c[g] = h[0] * m + h[1])
                        }), c
                    }
                }), d.fn.extend({
                    effect: function () {
                        function n(k) {
                            function r() {
                                d.isFunction(g) && g.call(h[0]), d.isFunction(k) && k()
                            }
                            var h = d(this),
                                    g = o.complete,
                                    l = o.mode;
                            (h.is(":hidden") ? "hide" === l : "show" === l) ? (h[l](), r()) : m.call(h[0], o, r)
                        }
                        var o = b.apply(this, arguments),
                                c = o.mode,
                                p = o.queue,
                                m = d.effects.effect[o.effect];
                        return d.fx.off || !m ? c ? this[c](o.duration, o.complete) : this.each(function () {
                            o.complete && o.complete.call(this)
                        }) : p === !1 ? this.each(n) : this.queue(p || "fx", n)
                    },
                    show: function (c) {
                        return function (k) {
                            if (a(k)) {
                                return c.apply(this, arguments)
                            }
                            var l = b.apply(this, arguments);
                            return l.mode = "show", this.effect.call(this, l)
                        }
                    }(d.fn.show),
                    hide: function (c) {
                        return function (k) {
                            if (a(k)) {
                                return c.apply(this, arguments)
                            }
                            var l = b.apply(this, arguments);
                            return l.mode = "hide", this.effect.call(this, l)
                        }
                    }(d.fn.hide),
                    toggle: function (c) {
                        return function (k) {
                            if (a(k) || "boolean" == typeof k) {
                                return c.apply(this, arguments)
                            }
                            var l = b.apply(this, arguments);
                            return l.mode = "toggle", this.effect.call(this, l)
                        }
                    }(d.fn.toggle),
                    cssUnit: function (c) {
                        var l = this.css(c),
                                k = [];
                        return d.each(["em", "px", "%", "pt"], function (h, g) {
                            l.indexOf(g) > 0 && (k = [parseFloat(l), g])
                        }), k
                    }
                })
            }(),
            function () {
                var a = {};
                d.each(["Quad", "Cubic", "Quart", "Quint", "Expo"], function (b, c) {
                    a[c] = function (h) {
                        return Math.pow(h, b + 2)
                    }
                }), d.extend(a, {
                    Sine: function (b) {
                        return 1 - Math.cos(b * Math.PI / 2)
                    },
                    Circ: function (b) {
                        return 1 - Math.sqrt(1 - b * b)
                    },
                    Elastic: function (b) {
                        return 0 === b || 1 === b ? b : -Math.pow(2, 8 * (b - 1)) * Math.sin((80 * (b - 1) - 7.5) * Math.PI / 15)
                    },
                    Back: function (b) {
                        return b * b * (3 * b - 2)
                    },
                    Bounce: function (c) {
                        for (var b, k = 4;
                                ((b = Math.pow(2, --k)) - 1) / 11 > c; ) {
                        }
                        return 1 / Math.pow(4, 3 - k) - 7.5625 * Math.pow((3 * b - 2) / 22 - c, 2)
                    }
                }), d.each(a, function (b, c) {
                    d.easing["easeIn" + b] = c, d.easing["easeOut" + b] = function (g) {
                        return 1 - c(1 - g)
                    }, d.easing["easeInOut" + b] = function (g) {
                        return 0.5 > g ? c(2 * g) / 2 : 1 - c(-2 * g + 2) / 2
                    }
                })
            }()
})(jQuery);
(function (d) {
    var f = /up|down|vertical/,
            e = /up|left|vertical|horizontal/;
    d.effects.effect.blind = function (p, r) {
        var v, c, m, h = d(this),
                n = ["position", "top", "bottom", "left", "right", "height", "width"],
                J = d.effects.setMode(h, p.mode || "hide"),
                s = p.direction || "up",
                a = f.test(s),
                l = a ? "height" : "width",
                b = a ? "top" : "left",
                o = e.test(s),
                g = {}, u = "show" === J;
        h.parent().is(".ui-effects-wrapper") ? d.effects.save(h.parent(), n) : d.effects.save(h, n), h.show(), v = d.effects.createWrapper(h).css({
            overflow: "hidden"
        }), c = v[l](), m = parseFloat(v.css(b)) || 0, g[l] = u ? c : 0, o || (h.css(a ? "bottom" : "right", 0).css(a ? "top" : "left", "auto").css({
            position: "absolute"
        }), g[b] = u ? m : c + m), u && (v.css(l, 0), o || v.css(b, m + c)), v.animate(g, {
            duration: p.duration,
            easing: p.easing,
            queue: !1,
            complete: function () {
                "hide" === J && h.hide(), d.effects.restore(h, n), d.effects.removeWrapper(h), r()
            }
        })
    }
})(jQuery);
(function (b) {
    b.effects.effect.bounce = function (g, p) {
        var m, u, c, v = b(this),
                R = ["position", "top", "bottom", "left", "right", "height", "width"],
                n = b.effects.setMode(v, g.mode || "effect"),
                r = "hide" === n,
                e = "show" === n,
                o = g.direction || "up",
                f = g.distance,
                y = g.times || 5,
                h = 2 * y + (e || r ? 1 : 0),
                s = g.duration / h,
                l = g.easing,
                Q = "up" === o || "down" === o ? "top" : "left",
                a = "up" === o || "left" === o,
                d = v.queue(),
                S = d.length;
        for ((e || r) && R.push("opacity"), b.effects.save(v, R), v.show(), b.effects.createWrapper(v), f || (f = v["top" === Q ? "outerHeight" : "outerWidth"]() / 3), e && (c = {
            opacity: 1
        }, c[Q] = 0, v.css("opacity", 0).css(Q, a ? 2 * -f : 2 * f).animate(c, s, l)), r && (f /= Math.pow(2, y - 1)), c = {}, c[Q] = 0, m = 0; y > m; m++) {
            u = {}, u[Q] = (a ? "-=" : "+=") + f, v.animate(u, s, l).animate(c, s, l), f = r ? 2 * f : f / 2
        }
        r && (u = {
            opacity: 0
        }, u[Q] = (a ? "-=" : "+=") + f, v.animate(u, s, l)), v.queue(function () {
            r && v.hide(), b.effects.restore(v, R), b.effects.removeWrapper(v), p()
        }), S > 1 && d.splice.apply(d, [1, 0].concat(d.splice(S, h + 1))), v.dequeue()
    }
})(jQuery);
(function (b) {
    b.effects.effect.clip = function (o, u) {
        var F, h, d, l = b(this),
                p = ["position", "top", "bottom", "left", "right", "height", "width"],
                s = b.effects.setMode(l, o.mode || "hide"),
                c = "show" === s,
                e = o.direction || "vertical",
                a = "vertical" === e,
                f = a ? "height" : "width",
                n = a ? "top" : "left",
                r = {};
        b.effects.save(l, p), l.show(), F = b.effects.createWrapper(l).css({
            overflow: "hidden"
        }), h = "IMG" === l[0].tagName ? F : l, d = h[f](), c && (h.css(f, 0), h.css(n, d / 2)), r[f] = c ? d : 0, r[n] = c ? 0 : d / 2, h.animate(r, {
            queue: !1,
            duration: o.duration,
            easing: o.easing,
            complete: function () {
                c || l.hide(), b.effects.restore(l, p), b.effects.removeWrapper(l), u()
            }
        })
    }
})(jQuery);
(function (b) {
    b.effects.effect.drop = function (c, h) {
        var s, n = b(this),
                y = ["position", "top", "bottom", "left", "right", "opacity", "height", "width"],
                o = b.effects.setMode(n, c.mode || "hide"),
                r = "show" === o,
                e = c.direction || "left",
                l = "up" === e || "down" === e ? "top" : "left",
                a = "up" === e || "left" === e ? "pos" : "neg",
                u = {
                    opacity: r ? 1 : 0
                };
        b.effects.save(n, y), n.show(), b.effects.createWrapper(n), s = c.distance || n["top" === l ? "outerHeight" : "outerWidth"](!0) / 2, r && n.css("opacity", 0).css(l, "pos" === a ? -s : s), u[l] = (r ? "pos" === a ? "+=" : "-=" : "pos" === a ? "-=" : "+=") + s, n.animate(u, {
            queue: !1,
            duration: c.duration,
            easing: c.easing,
            complete: function () {
                "hide" === o && n.hide(), b.effects.restore(n, y), b.effects.removeWrapper(n), h()
            }
        })
    }
})(jQuery);
(function (b) {
    b.effects.effect.explode = function (h, r) {
        function n() {
            d.push(this), d.length === O * f && v()
        }
        function v() {
            g.css({
                visibility: "visible"
            }), b(d).remove(), u || g.hide(), r()
        }
        var c, P, l, p, s, e, O = h.pieces ? Math.round(Math.sqrt(h.pieces)) : 3,
                f = O,
                g = b(this),
                m = b.effects.setMode(g, h.mode || "hide"),
                u = "show" === m,
                o = g.show().css("visibility", "hidden").offset(),
                Q = Math.ceil(g.outerWidth() / f),
                a = Math.ceil(g.outerHeight() / O),
                d = [];
        for (c = 0; O > c; c++) {
            for (p = o.top + c * a, e = c - (O - 1) / 2, P = 0; f > P; P++) {
                l = o.left + P * Q, s = P - (f - 1) / 2, g.clone().appendTo("body").wrap("<div></div>").css({
                    position: "absolute",
                    visibility: "visible",
                    left: -P * Q,
                    top: -c * a
                }).parent().addClass("ui-effects-explode").css({
                    position: "absolute",
                    overflow: "hidden",
                    width: Q,
                    height: a,
                    left: l + (u ? s * Q : 0),
                    top: p + (u ? e * a : 0),
                    opacity: u ? 0 : 1
                }).animate({
                    left: l + (u ? 0 : s * Q),
                    top: p + (u ? 0 : e * a),
                    opacity: u ? 1 : 0
                }, h.duration || 500, h.easing, n)
            }
        }
    }
})(jQuery);
(function (b) {
    b.effects.effect.fade = function (g, a) {
        var h = b(this),
                e = b.effects.setMode(h, g.mode || "toggle");
        h.animate({
            opacity: e
        }, {
            queue: !1,
            duration: g.duration,
            easing: g.easing,
            complete: a
        })
    }
})(jQuery);
(function (b) {
    b.effects.effect.fold = function (L, f) {
        var l, r, s = b(this),
                d = ["position", "top", "bottom", "left", "right", "height", "width"],
                m = b.effects.setMode(s, L.mode || "hide"),
                e = "show" === m,
                h = "hide" === m,
                u = L.size || 15,
                o = /([0-9]+)%/.exec(u),
                v = !!L.horizFirst,
                g = e !== v,
                a = g ? ["width", "height"] : ["height", "width"],
                n = L.duration / 2,
                c = {}, p = {};
        b.effects.save(s, d), s.show(), l = b.effects.createWrapper(s).css({
            overflow: "hidden"
        }), r = g ? [l.width(), l.height()] : [l.height(), l.width()], o && (u = parseInt(o[1], 10) / 100 * r[h ? 0 : 1]), e && l.css(v ? {
            height: 0,
            width: u
        } : {
            height: u,
            width: 0
        }), c[a[0]] = e ? r[0] : u, p[a[1]] = e ? r[1] : 0, l.animate(c, n, L.easing).animate(p, n, L.easing, function () {
            h && s.hide(), b.effects.restore(s, d), b.effects.removeWrapper(s), f()
        })
    }
})(jQuery);
(function (b) {
    b.effects.effect.highlight = function (l, n) {
        var m = b(this),
                e = ["backgroundImage", "backgroundColor", "opacity"],
                a = b.effects.setMode(m, l.mode || "show"),
                k = {
                    backgroundColor: m.css("backgroundColor")
                };
        "hide" === a && (k.opacity = 0), b.effects.save(m, e), m.show().css({
            backgroundImage: "none",
            backgroundColor: l.color || "#ffff99"
        }).animate(k, {
            queue: !1,
            duration: l.duration,
            easing: l.easing,
            complete: function () {
                "hide" === a && m.hide(), b.effects.restore(m, e), n()
            }
        })
    }
})(jQuery);
(function (b) {
    b.effects.effect.pulsate = function (u, c) {
        var a, l = b(this),
                e = b.effects.setMode(l, u.mode || "show"),
                n = "show" === e,
                r = "hide" === e,
                D = n || "hide" === e,
                h = 2 * (u.times || 5) + (D ? 1 : 0),
                p = u.duration / h,
                d = 0,
                s = l.queue(),
                o = s.length;
        for ((n || !l.is(":visible")) && (l.css("opacity", 0).show(), d = 1), a = 1; h > a; a++) {
            l.animate({
                opacity: d
            }, p, u.easing), d = 1 - d
        }
        l.animate({
            opacity: d
        }, p, u.easing), l.queue(function () {
            r && l.hide(), c()
        }), o > 1 && s.splice.apply(s, [1, 0].concat(s.splice(o, h + 1))), l.dequeue()
    }
})(jQuery);
(function (b) {
    b.effects.effect.puff = function (n, r) {
        var p = b(this),
                e = b.effects.setMode(p, n.mode || "hide"),
                a = "hide" === e,
                h = parseInt(n.percent, 10) || 150,
                o = h / 100,
                q = {
                    height: p.height(),
                    width: p.width(),
                    outerHeight: p.outerHeight(),
                    outerWidth: p.outerWidth()
                };
        b.extend(n, {
            effect: "scale",
            queue: !1,
            fade: !0,
            mode: e,
            complete: r,
            percent: a ? h : 100,
            from: a ? q : {
                height: q.height * o,
                width: q.width * o,
                outerHeight: q.outerHeight * o,
                outerWidth: q.outerWidth * o
            }
        }), p.effect(n)
    }, b.effects.effect.scale = function (c, h) {
        var s = b(this),
                n = b.extend(!0, {}, c),
                w = b.effects.setMode(s, c.mode || "effect"),
                o = parseInt(c.percent, 10) || (0 === parseInt(c.percent, 10) ? 0 : "hide" === w ? 0 : 100),
                r = c.direction || "both",
                e = c.origin,
                l = {
                    height: s.height(),
                    width: s.width(),
                    outerHeight: s.outerHeight(),
                    outerWidth: s.outerWidth()
                }, a = {
            y: "horizontal" !== r ? o / 100 : 1,
            x: "vertical" !== r ? o / 100 : 1
        };
        n.effect = "size", n.queue = !1, n.complete = h, "effect" !== w && (n.origin = e || ["middle", "center"], n.restore = !0), n.from = c.from || ("show" === w ? {
            height: 0,
            width: 0,
            outerHeight: 0,
            outerWidth: 0
        } : l), n.to = {
            height: l.height * a.y,
            width: l.width * a.x,
            outerHeight: l.outerHeight * a.y,
            outerWidth: l.outerWidth * a.x
        }, n.fade && ("show" === w && (n.from.opacity = 0, n.to.opacity = 1), "hide" === w && (n.from.opacity = 1, n.to.opacity = 0)), s.effect(n)
    }, b.effects.effect.size = function (h, r) {
        var n, v, c, P = b(this),
                l = ["position", "top", "bottom", "left", "right", "width", "height", "overflow", "opacity"],
                p = ["position", "top", "bottom", "left", "right", "overflow", "opacity"],
                s = ["width", "height", "overflow"],
                e = ["fontSize"],
                O = ["borderTopWidth", "borderBottomWidth", "paddingTop", "paddingBottom"],
                f = ["borderLeftWidth", "borderRightWidth", "paddingLeft", "paddingRight"],
                g = b.effects.setMode(P, h.mode || "effect"),
                m = h.restore || "effect" !== g,
                u = h.scale || "both",
                o = h.origin || ["middle", "center"],
                Q = P.css("position"),
                a = m ? l : p,
                d = {
                    height: 0,
                    width: 0,
                    outerHeight: 0,
                    outerWidth: 0
                };
        "show" === g && P.show(), n = {
            height: P.height(),
            width: P.width(),
            outerHeight: P.outerHeight(),
            outerWidth: P.outerWidth()
        }, "toggle" === h.mode && "show" === g ? (P.from = h.to || d, P.to = h.from || n) : (P.from = h.from || ("show" === g ? d : n), P.to = h.to || ("hide" === g ? d : n)), c = {
            from: {
                y: P.from.height / n.height,
                x: P.from.width / n.width
            },
            to: {
                y: P.to.height / n.height,
                x: P.to.width / n.width
            }
        }, ("box" === u || "both" === u) && (c.from.y !== c.to.y && (a = a.concat(O), P.from = b.effects.setTransition(P, O, c.from.y, P.from), P.to = b.effects.setTransition(P, O, c.to.y, P.to)), c.from.x !== c.to.x && (a = a.concat(f), P.from = b.effects.setTransition(P, f, c.from.x, P.from), P.to = b.effects.setTransition(P, f, c.to.x, P.to))), ("content" === u || "both" === u) && c.from.y !== c.to.y && (a = a.concat(e).concat(s), P.from = b.effects.setTransition(P, e, c.from.y, P.from), P.to = b.effects.setTransition(P, e, c.to.y, P.to)), b.effects.save(P, a), P.show(), b.effects.createWrapper(P), P.css("overflow", "hidden").css(P.from), o && (v = b.effects.getBaseline(o, n), P.from.top = (n.outerHeight - P.outerHeight()) * v.y, P.from.left = (n.outerWidth - P.outerWidth()) * v.x, P.to.top = (n.outerHeight - P.to.outerHeight) * v.y, P.to.left = (n.outerWidth - P.to.outerWidth) * v.x), P.css(P.from), ("content" === u || "both" === u) && (O = O.concat(["marginTop", "marginBottom"]).concat(e), f = f.concat(["marginLeft", "marginRight"]), s = l.concat(O).concat(f), P.find("*[width]").each(function () {
            var k = b(this),
                    q = {
                        height: k.height(),
                        width: k.width(),
                        outerHeight: k.outerHeight(),
                        outerWidth: k.outerWidth()
                    };
            m && b.effects.save(k, s), k.from = {
                height: q.height * c.from.y,
                width: q.width * c.from.x,
                outerHeight: q.outerHeight * c.from.y,
                outerWidth: q.outerWidth * c.from.x
            }, k.to = {
                height: q.height * c.to.y,
                width: q.width * c.to.x,
                outerHeight: q.height * c.to.y,
                outerWidth: q.width * c.to.x
            }, c.from.y !== c.to.y && (k.from = b.effects.setTransition(k, O, c.from.y, k.from), k.to = b.effects.setTransition(k, O, c.to.y, k.to)), c.from.x !== c.to.x && (k.from = b.effects.setTransition(k, f, c.from.x, k.from), k.to = b.effects.setTransition(k, f, c.to.x, k.to)), k.css(k.from), k.animate(k.to, h.duration, h.easing, function () {
                m && b.effects.restore(k, s)
            })
        })), P.animate(P.to, {
            queue: !1,
            duration: h.duration,
            easing: h.easing,
            complete: function () {
                0 === P.to.opacity && P.css("opacity", P.from.opacity), "hide" === g && P.hide(), b.effects.restore(P, a), m || ("static" === Q ? P.css({
                    position: "relative",
                    top: P.to.top,
                    left: P.to.left
                }) : b.each(["top", "left"], function (k, q) {
                    P.css(q, function (x, A) {
                        var y = parseInt(A, 10),
                                w = k ? P.to.left : P.to.top;
                        return "auto" === A ? w + "px" : y + w + "px"
                    })
                })), b.effects.removeWrapper(P), r()
            }
        })
    }
})(jQuery);
(function (b) {
    b.effects.effect.shake = function (h, p) {
        var u, v = b(this),
                c = ["position", "top", "bottom", "left", "right", "height", "width"],
                e = b.effects.setMode(v, h.mode || "effect"),
                l = h.direction || "left",
                o = h.distance || 20,
                r = h.times || 3,
                d = 2 * r + 1,
                M = Math.round(h.duration / d),
                f = "up" === l || "down" === l ? "top" : "left",
                g = "up" === l || "left" === l,
                m = {}, s = {}, n = {}, N = v.queue(),
                a = N.length;
        for (b.effects.save(v, c), v.show(), b.effects.createWrapper(v), m[f] = (g ? "-=" : "+=") + o, s[f] = (g ? "+=" : "-=") + 2 * o, n[f] = (g ? "-=" : "+=") + 2 * o, v.animate(m, M, h.easing), u = 1; r > u; u++) {
            v.animate(s, M, h.easing).animate(n, M, h.easing)
        }
        v.animate(s, M, h.easing).animate(m, M / 2, h.easing).queue(function () {
            "hide" === e && v.hide(), b.effects.restore(v, c), b.effects.removeWrapper(v), p()
        }), a > 1 && N.splice.apply(N, [1, 0].concat(N.splice(a, d + 1))), v.dequeue()
    }
})(jQuery);
(function (b) {
    b.effects.effect.slide = function (c, h) {
        var s, n = b(this),
                y = ["position", "top", "bottom", "left", "right", "width", "height"],
                o = b.effects.setMode(n, c.mode || "show"),
                r = "show" === o,
                e = c.direction || "left",
                l = "up" === e || "down" === e ? "top" : "left",
                a = "up" === e || "left" === e,
                u = {};
        b.effects.save(n, y), n.show(), s = c.distance || n["top" === l ? "outerHeight" : "outerWidth"](!0), b.effects.createWrapper(n).css({
            overflow: "hidden"
        }), r && n.css(l, a ? isNaN(s) ? "-" + s : -s : s), u[l] = (r ? a ? "+=" : "-=" : a ? "-=" : "+=") + s, n.animate(u, {
            queue: !1,
            duration: c.duration,
            easing: c.easing,
            complete: function () {
                "hide" === o && n.hide(), b.effects.restore(n, y), b.effects.removeWrapper(n), h()
            }
        })
    }
})(jQuery);
(function (b) {
    b.effects.effect.transfer = function (a, e) {
        var d = b(this),
                l = b(a.to),
                s = "fixed" === l.css("position"),
                n = b("body"),
                r = s ? n.scrollTop() : 0,
                c = s ? n.scrollLeft() : 0,
                h = l.offset(),
                u = {
                    top: h.top - r,
                    left: h.left - c,
                    height: l.innerHeight(),
                    width: l.innerWidth()
                }, o = d.offset(),
                B = b("<div class='ui-effects-transfer'></div>").appendTo(document.body).addClass(a.className).css({
            top: o.top - r,
            left: o.left - c,
            height: d.innerHeight(),
            width: d.innerWidth(),
            position: s ? "fixed" : "absolute"
        }).animate(u, a.duration, a.easing, function () {
            B.remove(), e()
        })
    }
})(jQuery);