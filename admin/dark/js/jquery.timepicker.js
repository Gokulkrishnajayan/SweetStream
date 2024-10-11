"undefined" != typeof jQuery && function (c) { function u(e, t, i) { return new Array(i + 1 - e.length).join(t) + e } function l(e, t, i) { if (1 !== arguments.length) return 3 === arguments.length ? new Date(0, 0, 0, e, t, i) : 2 === arguments.length ? new Date(0, 0, 0, e, t, 0) : new Date(0, 0, 0); var n = e; return "string" == typeof n && (n = c.fn.timepicker.parseTime(n)), new Date(0, 0, 0, n.getHours(), n.getMinutes(), n.getSeconds()) } var m, d; c.TimePicker = function () { var t = this; t.container = c(".ui-timepicker-container"), t.ui = t.container.find(".ui-timepicker"), 0 === t.container.length && (t.container = c("<div></div>").addClass("ui-timepicker-container").addClass("ui-timepicker-hidden ui-helper-hidden").appendTo("body").hide(), t.ui = c("<div></div>").addClass("ui-timepicker").addClass("ui-widget ui-widget-content ui-menu").addClass("ui-corner-all").appendTo(t.container), t.viewport = c("<ul></ul>").addClass("ui-timepicker-viewport").appendTo(t.ui), "1.4.2" <= c.fn.jquery && t.ui.delegate("a", "mouseenter.timepicker", function () { t.activate(!1, c(this).parent()) }).delegate("a", "mouseleave.timepicker", function () { t.deactivate(!1) }).delegate("a", "click.timepicker", function (e) { e.preventDefault(), t.select(!1, c(this).parent()) })) }, c.TimePicker.count = 0, c.TimePicker.instance = function () { return c.TimePicker._instance || (c.TimePicker._instance = new c.TimePicker), c.TimePicker._instance }, c.TimePicker.prototype = { keyCode: { ALT: 18, BLOQ_MAYUS: 20, CTRL: 17, DOWN: 40, END: 35, ENTER: 13, HOME: 36, LEFT: 37, NUMPAD_ENTER: 108, PAGE_DOWN: 34, PAGE_UP: 33, RIGHT: 39, SHIFT: 16, TAB: 9, UP: 38 }, _items: function (e, t) { var i, n, r = c("<ul></ul>"), a = null; for (-1 === e.options.timeFormat.indexOf("m") && e.options.interval % 60 != 0 && (e.options.interval = 60 * Math.max(Math.round(e.options.interval / 60), 1)), i = t ? l(t) : e.options.startTime ? l(e.options.startTime) : l(e.options.startHour, e.options.startMinutes), n = new Date(i.getTime() + 864e5); i < n;)this._isValidTime(e, i) && (a = c("<li>").addClass("ui-menu-item").appendTo(r), c("<a>").addClass("ui-corner-all").text(c.fn.timepicker.formatTime(e.options.timeFormat, i)).appendTo(a), a.data("time-value", i)), i = new Date(i.getTime() + 60 * e.options.interval * 1e3); return r.children() }, _isValidTime: function (e, t) { var i = null, n = null; return t = l(t), null !== e.options.minTime ? i = l(e.options.minTime) : null === e.options.minHour && null === e.options.minMinutes || (i = l(e.options.minHour, e.options.minMinutes)), null !== e.options.maxTime ? n = l(e.options.maxTime) : null === e.options.maxHour && null === e.options.maxMinutes || (n = l(e.options.maxHour, e.options.maxMinutes)), null !== i && null !== n ? i <= t && t <= n : null !== i ? i <= t : null === n || t <= n }, _hasScroll: function () { var e = void 0 !== this.ui.prop ? "prop" : "attr"; return this.ui.height() < this.ui[e]("scrollHeight") }, _move: function (e, t, i) { var n, r = this; r.closed() && r.open(e), r.active && (n = r.active[t + "All"](".ui-menu-item").eq(0)).length ? r.activate(e, n) : r.activate(e, r.viewport.children(i)) }, register: function (e, t) { var i = this, n = {}; n.element = c(e), n.element.data("TimePicker") || (n.options = c.metadata ? c.extend({}, t, n.element.metadata()) : c.extend({}, t), n.widget = i, c.extend(n, { next: function () { return i.next(n) }, previous: function () { return i.previous(n) }, first: function () { return i.first(n) }, last: function () { return i.last(n) }, selected: function () { return i.selected(n) }, open: function () { return i.open(n) }, close: function () { return i.close(n) }, closed: function () { return i.closed(n) }, destroy: function () { return i.destroy(n) }, parse: function (e) { return i.parse(n, e) }, format: function (e, t) { return i.format(n, e, t) }, getTime: function () { return i.getTime(n) }, setTime: function (e, t) { return i.setTime(n, e, t) }, option: function (e, t) { return i.option(n, e, t) } }), i._setDefaultTime(n), i._addInputEventsHandlers(n), n.element.data("TimePicker", n)) }, _setDefaultTime: function (e) { "now" === e.options.defaultTime ? e.setTime(l(new Date)) : e.options.defaultTime && e.options.defaultTime.getFullYear ? e.setTime(l(e.options.defaultTime)) : e.options.defaultTime && e.setTime(c.fn.timepicker.parseTime(e.options.defaultTime)) }, _addInputEventsHandlers: function (t) { var i = this; t.element.bind("keydown.timepicker", function (e) { switch (e.which || e.keyCode) { case i.keyCode.ENTER: case i.keyCode.NUMPAD_ENTER: e.preventDefault(), i.closed() ? t.element.trigger("change.timepicker") : i.select(t, i.active); break; case i.keyCode.UP: t.previous(); break; case i.keyCode.DOWN: t.next(); break; default: i.closed() || t.close(!0) } }).bind("focus.timepicker", function () { t.open() }).bind("blur.timepicker", function () { setTimeout(function () { t.element.data("timepicker-user-clicked-outside") && t.close() }) }).bind("change.timepicker", function () { t.closed() && t.setTime(c.fn.timepicker.parseTime(t.element.val())) }) }, select: function (e, t) { var i = this, n = !1 === e ? i.instance : e; i.setTime(n, c.fn.timepicker.parseTime(t.children("a").text())), i.close(n, !0) }, activate: function (e, t) { var i, n, r, a = this; (!1 === e ? a.instance : e) === a.instance && (a.deactivate(), a._hasScroll() && (i = t.offset().top - a.ui.offset().top, n = a.ui.scrollTop(), r = a.ui.height(), i < 0 ? a.ui.scrollTop(n + i) : r <= i && a.ui.scrollTop(n + i - r + t.height())), a.active = t.eq(0).children("a").addClass("ui-state-hover").attr("id", "ui-active-item").end()) }, deactivate: function () { var e = this; e.active && (e.active.children("a").removeClass("ui-state-hover").removeAttr("id"), e.active = null) }, next: function (e) { return !this.closed() && this.instance !== e || this._move(e, "next", ".ui-menu-item:first"), e.element }, previous: function (e) { return !this.closed() && this.instance !== e || this._move(e, "prev", ".ui-menu-item:last"), e.element }, first: function (e) { return this.instance === e && (this.active && 0 === this.active.prevAll(".ui-menu-item").length) }, last: function (e) { return this.instance === e && (this.active && 0 === this.active.nextAll(".ui-menu-item").length) }, selected: function (e) { return this.instance === e && this.active ? this.active : null }, open: function (i) { var n = this, r = i.getTime(), e = i.options.dynamic && r; if (!i.options.dropdown) return i.element; switch (i.element.data("timepicker-event-namespace", Math.random()), c(document).bind("click.timepicker-" + i.element.data("timepicker-event-namespace"), function (e) { i.element.get(0) === e.target ? i.element.data("timepicker-user-clicked-outside", !1) : i.element.data("timepicker-user-clicked-outside", !0).blur() }), !i.rebuild && i.items && !e || (i.items = n._items(i, e ? r : null)), (i.rebuild || n.instance !== i || e) && (c.fn.jquery < "1.4.2" ? (n.viewport.children().remove(), n.viewport.append(i.items), n.viewport.find("a").bind("mouseover.timepicker", function () { n.activate(i, c(this).parent()) }).bind("mouseout.timepicker", function () { n.deactivate(i) }).bind("click.timepicker", function (e) { e.preventDefault(), n.select(i, c(this).parent()) })) : (n.viewport.children().detach(), n.viewport.append(i.items))), i.rebuild = !1, n.container.removeClass("ui-helper-hidden ui-timepicker-hidden ui-timepicker-standard ui-timepicker-corners").show(), i.options.theme) { case "standard": n.container.addClass("ui-timepicker-standard"); break; case "standard-rounded-corners": n.container.addClass("ui-timepicker-standard ui-timepicker-corners") }n.container.hasClass("ui-timepicker-no-scrollbar") || i.options.scrollbar || (n.container.addClass("ui-timepicker-no-scrollbar"), n.viewport.css({ paddingRight: 40 })); var t = n.container.outerHeight() - n.container.height(), a = i.options.zindex ? i.options.zindex : i.element.offsetParent().css("z-index"), s = i.element.offset(); n.container.css({ top: s.top + i.element.outerHeight(), left: s.left }), n.container.show(), n.container.css({ left: i.element.offset().left, height: n.ui.outerHeight() + t, width: i.element.outerWidth(), zIndex: a, cursor: "default" }); var o = n.container.width() - (n.ui.outerWidth() - n.ui.width()); return n.ui.css({ width: o }), n.viewport.css({ width: o }), i.items.css({ width: o }), n.instance = i, r ? i.items.each(function () { var e = c(this), t = c.fn.jquery < "1.4.2" ? c.fn.timepicker.parseTime(e.find("a").text()) : e.data("time-value"); return t.getTime() !== r.getTime() || (n.activate(i, e), !1) }) : n.deactivate(i), i.element }, close: function (e) { return this.instance === e && (this.container.addClass("ui-helper-hidden ui-timepicker-hidden").hide(), this.ui.scrollTop(0), this.ui.children().removeClass("ui-state-hover")), c(document).unbind("click.timepicker-" + e.element.data("timepicker-event-namespace")), e.element }, closed: function () { return this.ui.is(":hidden") }, destroy: function (e) { return this.close(e, !0), e.element.unbind(".timepicker").data("TimePicker", null) }, parse: function (e, t) { return c.fn.timepicker.parseTime(t) }, format: function (e, t, i) { return i = i || e.options.timeFormat, c.fn.timepicker.formatTime(i, t) }, getTime: function (e) { var t = c.fn.timepicker.parseTime(e.element.val()); return t instanceof Date && !this._isValidTime(e, t) ? null : t instanceof Date && e.selectedTime ? e.format(t) === e.format(e.selectedTime) ? e.selectedTime : t : t instanceof Date ? t : null }, setTime: function (e, t, i) { var n = e.selectedTime; if ("string" == typeof t && (t = e.parse(t)), t && t.getMinutes && this._isValidTime(e, t)) { if (t = l(t), e.selectedTime = t, e.element.val(e.format(t, e.options.timeFormat)), i) return e } else e.selectedTime = null; return null === n && null === e.selectedTime || (e.element.trigger("time-change", [t]), c.isFunction(e.options.change) && e.options.change.apply(e.element, [t])), e.element }, option: function (t, e, i) { if (void 0 === i) return t.options[e]; var n, r, a = t.getTime(); "string" == typeof e ? (n = {})[e] = i : n = e, r = ["minHour", "minMinutes", "minTime", "maxHour", "maxMinutes", "maxTime", "startHour", "startMinutes", "startTime", "timeFormat", "interval", "dropdown"], c.each(n, function (e) { t.options[e] = n[e], t.rebuild = t.rebuild || -1 < c.inArray(e, r) }), t.rebuild && t.setTime(a) } }, c.TimePicker.defaults = { timeFormat: "hh:mm p", minHour: null, minMinutes: null, minTime: null, maxHour: null, maxMinutes: null, maxTime: null, startHour: null, startMinutes: null, startTime: null, interval: 30, dynamic: !0, theme: "standard", zindex: null, dropdown: !0, scrollbar: !1, change: function () { } }, c.TimePicker.methods = { chainable: ["next", "previous", "open", "close", "destroy", "setTime"] }, c.fn.timepicker = function (t) { if ("string" == typeof t) { var i = Array.prototype.slice.call(arguments, 1), e = "option" === t && 2 < arguments.length || -1 !== c.inArray(t, c.TimePicker.methods.chainable) ? "each" : "map", n = this[e](function () { var e = c(this).data("TimePicker"); if ("object" == typeof e) return e[t].apply(e, i) }); return "map" === e && 1 === this.length ? c.makeArray(n).shift() : "map" === e ? c.makeArray(n) : n } if (1 === this.length && this.data("TimePicker")) return this.data("TimePicker"); var r = c.extend({}, c.TimePicker.defaults, t); return this.each(function () { c.TimePicker.instance().register(this, r) }) }, c.fn.timepicker.formatTime = function (e, t) { var i = t.getHours(), n = i % 12, r = t.getMinutes(), a = t.getSeconds(), s = { hh: u((0 == n ? 12 : n).toString(), "0", 2), HH: u(i.toString(), "0", 2), mm: u(r.toString(), "0", 2), ss: u(a.toString(), "0", 2), h: 0 == n ? 12 : n, H: i, m: r, s: a, p: 11 < i ? "PM" : "AM" }, o = e, c = ""; for (c in s) s.hasOwnProperty(c) && (o = o.replace(new RegExp(c, "g"), s[c])); return o = o.replace(new RegExp("a", "g"), 11 < i ? "pm" : "am") }, c.fn.timepicker.parseTime = (d = (m = [[/^(\d+)$/, "$1"], [/^:(\d)$/, "$10"], [/^:(\d+)/, "$1"], [/^(\d):([7-9])$/, "0$10$2"], [/^(\d):(\d\d)$/, "$1$2"], [/^(\d):(\d{1,})$/, "0$1$20"], [/^(\d\d):([7-9])$/, "$10$2"], [/^(\d\d):(\d)$/, "$1$20"], [/^(\d\d):(\d*)$/, "$1$2"], [/^(\d{3,}):(\d)$/, "$10$2"], [/^(\d{3,}):(\d{2,})/, "$1$2"], [/^(\d):(\d):(\d)$/, "0$10$20$3"], [/^(\d{1,2}):(\d):(\d\d)/, "$10$2$3"]]).length, function (e) { var t, i, n = l(new Date), r = !1, a = !1, s = !1; if (void 0 === e || !e.toLowerCase) return null; e = e.toLowerCase(), i = !(t = /a/.test(e)) && /p/.test(e), e = e.replace(/[^0-9:]/g, "").replace(/:+/g, ":"); for (var o = 0; o < d; o += 1)if (m[o][0].test(e)) { e = e.replace(m[o][0], m[o][1]); break } return 1 === (e = e.replace(/:/g, "")).length || 2 === e.length ? r = e : 3 === e.length || 5 === e.length ? (r = e.substr(0, 1), a = e.substr(1, 2), s = e.substr(3, 2)) : (4 === e.length || 5 < e.length) && (r = e.substr(0, 2), a = e.substr(2, 2), s = e.substr(4, 2)), 0 < e.length && e.length < 5 && (e.length < 3 && (a = 0), s = 0), !1 !== r && !1 !== a && !1 !== s && (r = parseInt(r, 10), a = parseInt(a, 10), s = parseInt(s, 10), t && 12 === r ? r = 0 : i && r < 12 && (r += 12), 24 < r ? 6 <= e.length ? c.fn.timepicker.parseTime(e.substr(0, 5)) : c.fn.timepicker.parseTime(e + "0" + (t ? "a" : "") + (i ? "p" : "")) : (n.setHours(r, a, s), n)) }) }(jQuery);