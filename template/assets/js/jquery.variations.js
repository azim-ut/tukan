/*
 * Variations Plugin
 */
(function(e, t, n, r) {
    e.fn.wc_variation_form_lightbox = function(mess_unavailable) {
        e.fn.wc_variation_form_lightbox.find_matching_variations = function(t, n) {
            var r = [];
            for (var i = 0; i < t.length; i++) {
                var s = t[i],
                    o = s.variation_id;
                e.fn.wc_variation_form_lightbox.variations_match(s.attributes, n) && r.push(s);
            }
            
            return r;
        };
        e.fn.wc_variation_form_lightbox.variations_match = function(e, t) {
            var n = !0;
            var attr_name;
            
            for (attr_name in e) {
                var i = e[attr_name],
                    s = t[attr_name];
                i !== r && s !== r && i.length != 0 && s.length != 0 && i != s && (n = !1);
            }
            
            return n;
        };
        this.unbind("check_variations update_variation_values found_variation");
        this.find(".reset_variations").unbind("click");
        this.find(".variations select").unbind("change focusin");
        $form = this.on("click", ".reset_variations", function(t) {
            e(this).closest(".variations_form").find(".variations select").val("").change();
            var n = e(this).closest(".product").find(".sku"),
                r = e(this).closest(".product").find(".product_weight"),
                i = e(this).closest(".product").find(".product_dimensions");
            n.attr("data-o_sku") && n.text(n.attr("data-o_sku"));
            r.attr("data-o_weight") && r.text(r.attr("data-o_weight"));
            i.attr("data-o_dimensions") && i.text(i.attr("data-o_dimensions"));
            e(this).parents('.product-lightbox').find('.nasa-mess-unavailable').remove();
            return !1;
        }).on("change", ".variations select", function(t) {
            $variation_form = e(this).closest(".variations_form");
            $variation_form.find("input[name=variation_id]").val("").change();
            $variation_form.trigger("woocommerce_variation_select_change").trigger("check_variations", ["", !1]);
            e(this).blur();
            e().uniform && e.isFunction(e.uniform.update) && e.uniform.update();
        }).on("focusin touchstart", ".variations select", function(t) {
            $variation_form = e(this).closest(".variations_form");
            $variation_form.trigger("woocommerce_variation_select_focusin").trigger("check_variations", [e(this).attr("name"), !0]);
        }).on("check_variations", function(n, r, i) {
            var s = !0,
                o = !1,
                u = !1,
                a = {},
                f = e(this),
                l = f.find(".reset_variations");
            f.find(".single_variation_wrap").show();
            f.find(".variations select").each(function() {
                e(this).val().length == 0 ? s = !1 : o = !0;
                if (r && e(this).attr("name") == r) {
                    s = !1;
                    a[e(this).attr("name")] = "";
                } else {
                    value = e(this).val();
                    a[e(this).attr("name")] = value;
                }
            });
            var c = parseInt(f.data("product_id")),
                h = f.data("product_variations");
            h || (h = t.product_variations[c]);
            h || (h = t.product_variations);
            h || (h = t["product_variations_" + c]);
            var p = e.fn.wc_variation_form_lightbox.find_matching_variations(h, a);
            if (s) {
                var d = p.shift();
                if (d) {
                    f.find("input[name=variation_id]").val(d.variation_id).change();
                    f.trigger("found_variation", [d]);
                } else {
                    f.find(".variations select").val("");
                    i || f.trigger("reset_image");
                    alert(woocommerce_params.i18n_no_matching_variations_text);
                }
            } else {
                f.trigger("update_variation_values", [p]);
                i || f.trigger("reset_image");
                r || f.find(".single_variation_wrap").css({'opacity': 0.6});
                f.parents('.product-lightbox').find('.nasa-mess-unavailable').remove();
            }
            o ? l.css("visibility") == "hidden" && l.css("visibility", "visible").hide().fadeIn() : l.css("visibility", "hidden");
            
            /* setTimeout(function() {
                var _lightbox = f.parents('.product-lightbox');
                var _h_r = _lightbox.find('.product-lightbox-inner').outerHeight();
                var _h_l = _lightbox.find('.product-img').outerHeight();
                if(_h_l > 0 && _h_r > _h_l) {
                    _lightbox.find('.product-img').animate({'top': (_h_r - _h_l) / 2}, 300);
                }
            }, 300); */
        }).on("reset_image", function(t) {
            var n = e(this).parents(".product-lightbox"),
                i = n.find(".product-img .owl-item:eq(0) img"),
                s = n.find("div.images a.zoom:eq(0)"),
                o = i.attr("data-o_src"),
                u = i.attr("data-o_title"),
                a = i.attr("data-o_alt"),
                f = s.attr("data-o_href");
            o != r && i.attr("src", o);
            f != r && s.attr("href", f);
            if (u != r) {
                i.attr("title", u);
                s.attr("title", u);
            }
            a != r && i.attr("alt", a);
            n.find('.nasa-mess-unavailable').remove();
        }).on("update_variation_values", function(t, n) {
            $variation_form = e(this).closest(".variations_form");
            $variation_form.find(".variations select").each(function(t, r) {
                current_attr_select = e(r);
                current_attr_select.data("attribute_options") || current_attr_select.data("attribute_options", current_attr_select.find("option:gt(0)").get());
                current_attr_select.find("option:gt(0)").remove();
                current_attr_select.append(current_attr_select.data("attribute_options"));
                current_attr_select.find("option:gt(0)").removeClass("active");
                var i = current_attr_select.attr("name");
                for (num in n) {
                    if (typeof n[num] != "undefined") {
                        var s = n[num].attributes;
                        for (attr_name in s) {
                            var o = s[attr_name];
                            if (attr_name == i){
                                if (o) {
                                    o = e("<div/>").html(o).text();
                                    o = o.replace(/'/g, "\\'");
                                    o = o.replace(/"/g, '\\"');
                                    current_attr_select.find('option[value="' + o + '"]').addClass("active");
                                } else {
                                    current_attr_select.find("option:gt(0)").addClass("active");
                                }
                            }
                        }
                    }
                }
                current_attr_select.find("option:gt(0):not(.active)").remove();
            });
            $variation_form.trigger("woocommerce_update_variation_values");
        }).on("found_variation", function(t, n) {
            var i = e(this),
                s = e(this).parents(".product-lightbox"),
                o = s.find(".product-img .owl-item:eq(0) img"),
                u = s.find("div.images a.zoom:eq(0)"),
                a = o.attr("data-o_src"),
                f = o.attr("data-o_title"),
                l = o.attr("data-o_alt"),
                c = u.attr("data-o_href"),
                h = n.image.src,
                p = n.image.link,
                d = n.image.title,
                v = n.image.alt;
            i.find(".variations_button").show();
            i.find(".single_variation").html(n.price_html + n.availability_html);
            if (a == r) {
                a = o.attr("src") ? o.attr("src") : "";
                o.attr("data-o_src", a);
            }
            if (c == r) {
                c = u.attr("href") ? u.attr("href") : "";
                u.attr("data-o_href", c);
            }
            if (f == r) {
                f = o.attr("title") ? o.attr("title") : "";
                o.attr("data-o_title", f);
            }
            if (l == r) {
                l = o.attr("alt") ? o.attr("alt") : "";
                o.attr("data-o_alt", l);
            }
            if (h && h.length > 1) {
                o.attr("src", h).attr("alt", v).attr("title", d);
                u.attr("href", p).attr("title", d);
            } else {
                o.attr("src", a).attr("alt", l).attr("title", f);
                u.attr("href", c).attr("title", f);
            }
            var m = i.find(".single_variation_wrap"),
                g = s.find(".product_meta").find(".sku"),
                y = s.find(".product_weight"),
                b = s.find(".product_dimensions");
            g.attr("data-o_sku") || g.attr("data-o_sku", g.text());
            y.attr("data-o_weight") || y.attr("data-o_weight", y.text());
            b.attr("data-o_dimensions") || b.attr("data-o_dimensions", b.text());
            n.sku ? g.text(n.sku) : g.text(g.attr("data-o_sku"));
            n.weight ? y.text(n.weight) : y.text(y.attr("data-o_weight"));
            n.dimensions ? b.text(n.dimensions) : b.text(b.attr("data-o_dimensions"));
            m.find(".quantity").show();
            !n.is_in_stock && !n.backorders_allowed && i.find(".variations_button").css({'opacity': 0.3});
            n.min_qty ? m.find("input[name=quantity]").attr("min", n.min_qty).val(n.min_qty) : m.find("input[name=quantity]").removeAttr("min");
            n.max_qty ? m.find("input[name=quantity]").attr("max", n.max_qty) : m.find("input[name=quantity]").removeAttr("max");
            if (n.is_sold_individually == "yes") {
                m.find("input[name=quantity]").val("1");
                m.find(".quantity").hide();
            }
            
            if(n.is_purchasable) {
                i.find('.nasa-mess-unavailable').remove();
                m.css({'opacity': 1}).trigger("show_variation", [n]);
            } else {
                if(i.find('.nasa-mess-unavailable').length <= 0) {
                    m.before('<p class="nasa-mess-unavailable">' + mess_unavailable + '</p>');
                }
                m.css({'opacity': 0.3});
            }
        });
        $form.trigger("wc_variation_form_lightbox");
        return $form;
    };
    
    e(function() {
        e(".product-lightbox .variations_form").wc_variation_form_lightbox('');
        e(".product-lightbox .variations_form .variations select").change();
        if(e('.product-lightbox .variations_form .variations select option[selected="selected"]').length) {
            e('.product-lightbox .variations_form .variations .reset_variations').css({'visibility': 'visible'}).show();
        }
    });
})(jQuery, window, document);