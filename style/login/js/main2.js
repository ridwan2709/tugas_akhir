Modernizr.load([{
    load: ["https://code.jquery.com/jquery-2.1.3.min.js"],
    complete: function () {
        window.jQuery || Modernizr.load("/js/jquery.js")
    }
}, {
    test: Modernizr.cssanimations,
    nope: "geo.js",
    both: ["/js/app.js"],
    complete: function () {
        Handlebars.registerHelper("caption-imgs", function () {
            for (var t = "", a = 1; a < parseFloat(arguments[2]) + 1; a++) t = t + "<img src='img/works/" + (arguments[0] + "/" + arguments[1] + "-" + a) + ".jpg' />";
            return console.log(t), t
        });
        var is_chrome = navigator.userAgent.indexOf("Chrome") > -1,
            is_explorer = navigator.userAgent.indexOf("MSIE") > -1,
            is_firefox = navigator.userAgent.indexOf("Firefox") > -1,
            is_safari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/),
            is_Opera = navigator.userAgent.indexOf("Presto") > -1;
        (is_chrome || is_firefox && !is_safari) && $("html").addClass("workAnimation"), $("body").on("click", ".hamburger", function (t) {
            $("body").hasClass("menu-open") || ($("body").addClass("menu-open"), t.preventDefault())
        }), $("body").on("click", ".closeMenu", function (t) {
            $("body").removeClass("menu-open"), t.preventDefault(), t.stopPropagation()
        }), $("#loader").velocity("transition.fadeOut"), $(document).pusher({
            watch: "nav a, #logo a, .pusher",
            before: function (t) {
                $(".spinner").addClass("show"), $("[data-transitionIn]:not([data-transitionPersist])").velocity("transition.fadeOut", {
                    stagger: 80,
                    duration: 500,
                    complete: function () {
                        $("#animatedBack").velocity({
                            opacity: 0
                        }, 400, function () {
                            $(this).remove()
                        }), setTimeout(t, 700)
                    }
                }), $("nav a").removeClass("active")
            },
            after: function () {
                $(".spinner").removeClass("show"), $("[data-transitionIn]:not([data-transitionPersist])").each(function () {
                    $this = $(this), $this.velocity($this.attr("data-transitionIn"), {
                        duration: 1e3,
                        delay: $this.attr("data-transitionDelay") ? $this.attr("data-transitionDelay") : 0,
                        display: $this.attr("data-transitionDisplay") ? $this.attr("data-transitionDisplay") : "block"
                    })
                }), window.clickedElem.addClass("active"), eval("customFunction." + $("body").attr("class") + "()")
            },
            handler: function () {
                this.updateText("title"), $("body").scrollTop(0), this.updateHtml("main"), $("body").attr("class", this.res.match(/body class=\"(.*?)\"/)[1]), backgrounds.stop()
            },
            fail: function () {},
            onStateCreation: function (t, a) {
                a && (window.clickedElem = $(a))
            }
        }), eval("customFunction." + $("body").attr("class") + "()"), setTimeout(function () {}, 4e3), $("[data-transitionIn]").css("opacity", 0), setTimeout(function () {
            $("[data-transitionIn]").each(function () {
                $this = $(this), $this.velocity($this.attr("data-transitionIn"), {
                    duration: 1200,
                    delay: $this.attr("data-transitionDelay") ? $this.attr("data-transitionDelay") : 0,
                    display: $this.attr("data-transitionDisplay") ? $this.attr("data-transitionDisplay") : "block"
                })
            })
        }, 500), mouse_tap.init()
    }
}]);