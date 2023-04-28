(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["chunk-39a51c0e"], {
    "819d": function(e, n, s) {
        "use strict";
        s.r(n);
        var t = function() {
            var e = this
              , n = e.$createElement
              , s = e._self._c || n;
            return s("div", {
                staticClass: "container padtopbot"
            }, [e.isLoadingModule ? s("div", [e._v(" Chargement en cours... ")]) : s("div", [s("h1", [e._v(e._s(e.module.name))])]), e.isLoadingCourses ? s("div", [e._v(" Chargement en cours... ")]) : s("div", [e.courses.length > 0 ? s("div", {
                staticClass: "courses"
            }, e._l(e.courses, (function(n) {
                return s("div", {
                    key: n._id,
                    staticClass: "course"
                }, [s("router-link", {
                    attrs: {
                        to: "/cours/" + n._id
                    }
                }, [e._v(e._s(n.name))])], 1)
            }
            )), 0) : s("div", [e._v("Aucun cours.")])])])
        }
          , a = []
          , o = s("5530")
          , u = (s("d3b7"),
        s("d634"))
          , i = s("bc3a")
          , c = s.n(i)
          , r = {
            name: "PageMatiere",
            data: function() {
                return {
                    isLoadingModule: !0,
                    isLoadingCourses: !0,
                    courses: []
                }
            },
            created: function() {
                var e = this;
                c.a.get("/api/modules/" + this.$route.params.moduleId).then((function(n) {
                    var s = n.data;
                    e.module = s
                }
                )).finally((function() {
                    return e.isLoadingModule = !1
                }
                )),
                c.a.get("/api/modules/" + this.$route.params.moduleId + "/courses").then((function(n) {
                    var s = n.data;
                    e.courses = s
                }
                )).finally((function() {
                    return e.isLoadingCourses = !1
                }
                ))
            },
            computed: Object(o["a"])({}, u["a"])
        }
          , d = r
          , l = (s("cc27"),
        s("2877"))
          , v = Object(l["a"])(d, t, a, !1, null, "07011c5c", null);
        n["default"] = v.exports
    },
    cc27: function(e, n, s) {
        "use strict";
        s("e006")
    },
    e006: function(e, n, s) {}
}]);
//# sourceMappingURL=chunk-39a51c0e.e86d933d.js.map
