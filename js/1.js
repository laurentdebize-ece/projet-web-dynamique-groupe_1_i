(function(e) {
    function t(t) {
        for (var r, a, o = t[0], c = t[1], s = t[2], d = 0, l = []; d < o.length; d++)
            a = o[d],
            Object.prototype.hasOwnProperty.call(i, a) && i[a] && l.push(i[a][0]),
            i[a] = 0;
        for (r in c)
            Object.prototype.hasOwnProperty.call(c, r) && (e[r] = c[r]);
        m && m(t);
        while (l.length)
            l.shift()();
        return u.push.apply(u, s || []),
        n()
    }
    function n() {
        for (var e, t = 0; t < u.length; t++) {
            for (var n = u[t], r = !0, a = 1; a < n.length; a++) {
                var o = n[a];
                0 !== i[o] && (r = !1)
            }
            r && (u.splice(t--, 1),
            e = c(c.s = n[0]))
        }
        return e
    }
    var r = {}
      , a = {
        app: 0
    }
      , i = {
        app: 0
    }
      , u = [];
    function o(e) {
        return c.p + "js/" + ({}[e] || e) + "." + {
            "chunk-059d6829": "4dfe6450",
            "chunk-06bb6e48": "1f87a4f3",
            "chunk-1f716f17": "338dc72d",
            "chunk-2d0b3229": "6160e7fc",
            "chunk-2d0b6ad7": "772c7b9b",
            "chunk-2d0e5ad4": "c8e408b8",
            "chunk-362b5566": "d1fcc0d0",
            "chunk-3704b010": "a00a0689",
            "chunk-39a51c0e": "e86d933d",
            "chunk-4860d1b0": "b26f045a",
            "chunk-4cd70efc": "d482f956",
            "chunk-4e6d8004": "798ad1e4",
            "chunk-4fea0a7a": "c95dd66a",
            "chunk-7754e8ba": "94a13a88",
            "chunk-b1b6aaaa": "0b14a613",
            "chunk-edea1be0": "54e8b81d"
        }[e] + ".js"
    }
    function c(t) {
        if (r[t])
            return r[t].exports;
        var n = r[t] = {
            i: t,
            l: !1,
            exports: {}
        };
        return e[t].call(n.exports, n, n.exports, c),
        n.l = !0,
        n.exports
    }
    c.e = function(e) {
        var t = []
          , n = {
            "chunk-059d6829": 1,
            "chunk-362b5566": 1,
            "chunk-3704b010": 1,
            "chunk-39a51c0e": 1
        };
        a[e] ? t.push(a[e]) : 0 !== a[e] && n[e] && t.push(a[e] = new Promise((function(t, n) {
            for (var r = "css/" + ({}[e] || e) + "." + {
                "chunk-059d6829": "6e43630b",
                "chunk-06bb6e48": "31d6cfe0",
                "chunk-1f716f17": "31d6cfe0",
                "chunk-2d0b3229": "31d6cfe0",
                "chunk-2d0b6ad7": "31d6cfe0",
                "chunk-2d0e5ad4": "31d6cfe0",
                "chunk-362b5566": "6e43630b",
                "chunk-3704b010": "25127921",
                "chunk-39a51c0e": "d5411f29",
                "chunk-4860d1b0": "31d6cfe0",
                "chunk-4cd70efc": "31d6cfe0",
                "chunk-4e6d8004": "31d6cfe0",
                "chunk-4fea0a7a": "31d6cfe0",
                "chunk-7754e8ba": "31d6cfe0",
                "chunk-b1b6aaaa": "31d6cfe0",
                "chunk-edea1be0": "31d6cfe0"
            }[e] + ".css", i = c.p + r, u = document.getElementsByTagName("link"), o = 0; o < u.length; o++) {
                var s = u[o]
                  , d = s.getAttribute("data-href") || s.getAttribute("href");
                if ("stylesheet" === s.rel && (d === r || d === i))
                    return t()
            }
            var l = document.getElementsByTagName("style");
            for (o = 0; o < l.length; o++) {
                s = l[o],
                d = s.getAttribute("data-href");
                if (d === r || d === i)
                    return t()
            }
            var m = document.createElement("link");
            m.rel = "stylesheet",
            m.type = "text/css",
            m.onload = t,
            m.onerror = function(t) {
                var r = t && t.target && t.target.src || i
                  , u = new Error("Loading CSS chunk " + e + " failed.\n(" + r + ")");
                u.code = "CSS_CHUNK_LOAD_FAILED",
                u.request = r,
                delete a[e],
                m.parentNode.removeChild(m),
                n(u)
            }
            ,
            m.href = i;
            var f = document.getElementsByTagName("head")[0];
            f.appendChild(m)
        }
        )).then((function() {
            a[e] = 0
        }
        )));
        var r = i[e];
        if (0 !== r)
            if (r)
                t.push(r[2]);
            else {
                var u = new Promise((function(t, n) {
                    r = i[e] = [t, n]
                }
                ));
                t.push(r[2] = u);
                var s, d = document.createElement("script");
                d.charset = "utf-8",
                d.timeout = 120,
                c.nc && d.setAttribute("nonce", c.nc),
                d.src = o(e);
                var l = new Error;
                s = function(t) {
                    d.onerror = d.onload = null,
                    clearTimeout(m);
                    var n = i[e];
                    if (0 !== n) {
                        if (n) {
                            var r = t && ("load" === t.type ? "missing" : t.type)
                              , a = t && t.target && t.target.src;
                            l.message = "Loading chunk " + e + " failed.\n(" + r + ": " + a + ")",
                            l.name = "ChunkLoadError",
                            l.type = r,
                            l.request = a,
                            n[1](l)
                        }
                        i[e] = void 0
                    }
                }
                ;
                var m = setTimeout((function() {
                    s({
                        type: "timeout",
                        target: d
                    })
                }
                ), 12e4);
                d.onerror = d.onload = s,
                document.head.appendChild(d)
            }
        return Promise.all(t)
    }
    ,
    c.m = e,
    c.c = r,
    c.d = function(e, t, n) {
        c.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: n
        })
    }
    ,
    c.r = function(e) {
        "undefined" !== typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }),
        Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }
    ,
    c.t = function(e, t) {
        if (1 & t && (e = c(e)),
        8 & t)
            return e;
        if (4 & t && "object" === typeof e && e && e.__esModule)
            return e;
        var n = Object.create(null);
        if (c.r(n),
        Object.defineProperty(n, "default", {
            enumerable: !0,
            value: e
        }),
        2 & t && "string" != typeof e)
            for (var r in e)
                c.d(n, r, function(t) {
                    return e[t]
                }
                .bind(null, r));
        return n
    }
    ,
    c.n = function(e) {
        var t = e && e.__esModule ? function() {
            return e["default"]
        }
        : function() {
            return e
        }
        ;
        return c.d(t, "a", t),
        t
    }
    ,
    c.o = function(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }
    ,
    c.p = "/",
    c.oe = function(e) {
        throw console.error(e),
        e
    }
    ;
    var s = window["webpackJsonp"] = window["webpackJsonp"] || []
      , d = s.push.bind(s);
    s.push = t,
    s = s.slice();
    for (var l = 0; l < s.length; l++)
        t(s[l]);
    var m = d;
    u.push([0, "chunk-vendors"]),
    n()
}
)({
    0: function(e, t, n) {
        e.exports = n("56d7")
    },
    "429b": function(e, t, n) {},
    "458c": function(e, t, n) {
        "use strict";
        n("429b")
    },
    "45f9": function(e, t, n) {
        e.exports = n.p + "img/logo-ece.8ea108d9.svg"
    },
    "56d7": function(e, t, n) {
        "use strict";
        n.r(t);
        n("e260"),
        n("e6cf"),
        n("cca6"),
        n("a79d"),
        n("d3b7");
        var r = n("2b0e")
          , a = n("bc3a")
          , i = n.n(a)
          , u = function() {
            var e = this
              , t = e.$createElement
              , r = e._self._c || t;
            return r("div", {
                attrs: {
                    id: "app"
                }
            }, [r("header", [r("div", {
                staticClass: "container"
            }, [r("nav", [r("ul", [r("li", [r("router-link", {
                attrs: {
                    to: "/"
                }
            }, [r("img", {
                staticClass: "logo",
                attrs: {
                    alt: "Logo ECE Paris-Lyon, école d'ingénieurs",
                    src: n("45f9")
                }
            })])], 1), e.loggedIn ? r("li", [r("router-link", {
                attrs: {
                    to: "/"
                }
            }, [e._v("Mes compétences")])], 1) : e._e(), e.isAdmin ? r("li", [r("router-link", {
                attrs: {
                    to: "/admin"
                }
            }, [e._v("Administration")])], 1) : e._e(), e.loggedIn ? e._e() : r("li", [r("router-link", {
                attrs: {
                    to: "/inscription"
                }
            }, [e._v("Inscription")])], 1), e.loggedIn ? e._e() : r("li", [r("router-link", {
                attrs: {
                    to: "/connexion"
                }
            }, [e._v("Connexion")])], 1), e.loggedIn ? r("li", [r("a", {
                on: {
                    click: e.logout
                }
            }, [e._v("Déconnexion")])]) : e._e()])])])]), r("notifications", {
                staticClass: "notifs",
                attrs: {
                    group: "notifs"
                }
            }), r("transition", {
                attrs: {
                    name: "slide-fade",
                    mode: "out-in"
                }
            }, [r("router-view")], 1), e._m(0)], 1)
        }
          , o = [function() {
            var e = this
              , t = e.$createElement
              , n = e._self._c || t;
            return n("footer", [n("div", {
                staticClass: "container"
            }, [n("span", {
                staticClass: "degrade-text"
            }, [e._v("ECE - Mes compétences")]), n("p", [e._v("©2021 ECE & Antoine Hintzy. Tous droits réservés.")])])])
        }
        ]
          , c = n("5530")
          , s = n("d634")
          , d = {
            computed: Object(c["a"])({}, s["a"]),
            methods: {
                logout: function() {
                    var e = this;
                    this.$store.dispatch("logout").then((function() {
                        e.$router.push({
                            name: "accueil"
                        })
                    }
                    ))
                }
            }
        }
          , l = d
          , m = (n("5c0b"),
        n("2877"))
          , f = Object(m["a"])(l, u, o, !1, null, null, null)
          , h = f.exports
          , p = (n("3ca3"),
        n("ddb0"),
        n("7db0"),
        n("fb6a"),
        n("d81d"),
        n("a630"),
        n("159b"),
        n("b64b"),
        n("8c4f"))
          , b = function() {
            var e = this
              , t = e.$createElement
              , n = e._self._c || t;
            return n("div", {
                staticClass: "container padtopbot"
            }, [e.loggedIn ? n("div", [n("h2", [e._v("Matières")]), n("div", {
                staticClass: "skills"
            }, e._l(e.modules, (function(t) {
                return n("div", {
                    key: t._id,
                    staticClass: "skill"
                }, [n("router-link", {
                    attrs: {
                        to: "/matiere/" + t._id
                    }
                }, [e._v(e._s(t.name))])], 1)
            }
            )), 0), e.isLoading ? n("div", [e._v(" Chargement en cours... ")]) : e._e()]) : n("div", {
                staticClass: "loggin"
            }, [e._v(" Vous devez "), n("router-link", {
                attrs: {
                    to: "/inscription"
                }
            }, [e._v("créer un compte")]), e._v(" ou vous "), n("router-link", {
                attrs: {
                    to: "/connexion"
                }
            }, [e._v("connecter")]), e._v(" . ")], 1)])
        }
          , v = []
          , g = {
            name: "PageAccueil",
            data: function() {
                return {
                    isLoading: !0,
                    modules: []
                }
            },
            created: function() {
                var e = this;
                this.loggedIn && i.a.get("/api/modules").then((function(t) {
                    var n = t.data;
                    e.modules = n,
                    e.isLoading = !1
                }
                ))
            },
            computed: Object(c["a"])({}, s["a"])
        }
          , k = g
          , A = (n("458c"),
        Object(m["a"])(k, b, v, !1, null, "9bd7b858", null))
          , _ = A.exports;
        r["default"].use(p["a"]);
        var C = [{
            path: "/",
            name: "accueil",
            component: _,
            meta: {
                title: "ECE Compétences",
                metaTags: [{
                    name: "description",
                    content: "Application de l'ECE permettant à ses étudiants de faire le bilan de leurs compétentes en temps réel."
                }]
            }
        }, {
            path: "/connexion",
            name: "connexion",
            component: function() {
                return n.e("chunk-4e6d8004").then(n.bind(null, "b7ad"))
            },
            meta: {
                title: "ECE Compétences - Connexion"
            }
        }, {
            path: "/inscription",
            name: "inscription",
            component: function() {
                return n.e("chunk-2d0b3229").then(n.bind(null, "26a0"))
            },
            meta: {
                title: "ECE Compétences - Inscription"
            }
        }, {
            path: "/matiere/:moduleId",
            name: "matiere",
            component: function() {
                return n.e("chunk-39a51c0e").then(n.bind(null, "819d"))
            },
            meta: {
                requiresAuth: !0,
                title: "Matière"
            }
        }, {
            path: "/cours/:courseId",
            name: "cours",
            component: function() {
                return n.e("chunk-059d6829").then(n.bind(null, "f3e0"))
            },
            meta: {
                requiresAuth: !0,
                title: "Cours"
            }
        }, {
            path: "/admin",
            name: "admin",
            component: function() {
                return n.e("chunk-2d0b6ad7").then(n.bind(null, "1dd2"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin"
            }
        }, {
            path: "/admin/cours",
            name: "adminCourss",
            component: function() {
                return n.e("chunk-1f716f17").then(n.bind(null, "3c40"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin - Cours"
            }
        }, {
            path: "/admin/nouveau-cours",
            name: "adminNewCours",
            component: function() {
                return n.e("chunk-4860d1b0").then(n.bind(null, "1f10"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin - Nouveau Cours"
            }
        }, {
            path: "/admin/nouvelle-matiere",
            name: "adminNewMatiere",
            component: function() {
                return n.e("chunk-06bb6e48").then(n.bind(null, "0bc9"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin - Nouvelle matière"
            }
        }, {
            path: "/admin/matieres",
            name: "adminMatieres",
            component: function() {
                return n.e("chunk-edea1be0").then(n.bind(null, "a1ff"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin - Matières"
            }
        }, {
            path: "/admin/matiere/:moduleId",
            name: "adminMatiere",
            component: function() {
                return n.e("chunk-4cd70efc").then(n.bind(null, "edf8"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin - Matière"
            }
        }, {
            path: "/admin/matiere/:moduleId/nouveau-cours",
            name: "adminMatiereNewCours",
            component: function() {
                return n.e("chunk-4860d1b0").then(n.bind(null, "1f10"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin - Matière"
            }
        }, {
            path: "/admin/cours/:courseId",
            name: "adminCours",
            component: function() {
                return n.e("chunk-4fea0a7a").then(n.bind(null, "b7b5"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin - Cours"
            }
        }, {
            path: "/admin/competences",
            name: "adminCompetences",
            component: function() {
                return n.e("chunk-7754e8ba").then(n.bind(null, "458c4"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin - Compétences"
            }
        }, {
            path: "/admin/nouvelle-competence",
            name: "adminNewCompetence",
            component: function() {
                return n.e("chunk-b1b6aaaa").then(n.bind(null, "87d9"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin - Compétence"
            }
        }, {
            path: "/admin/cours/:courseId/nouvelle-competence",
            name: "adminCoursNewCompetence",
            component: function() {
                return n.e("chunk-b1b6aaaa").then(n.bind(null, "87d9"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin - Compétence"
            }
        }, {
            path: "/admin/utilisateurs",
            name: "adminUtilisateurs",
            component: function() {
                return n.e("chunk-3704b010").then(n.bind(null, "dcf1"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin - Utilisateurs"
            }
        }, {
            path: "/admin/utilisateur/:userId",
            name: "adminUtilisateur",
            component: function() {
                return n.e("chunk-362b5566").then(n.bind(null, "43ea"))
            },
            meta: {
                requiresAuth: !0,
                requiresAdmin: !0,
                title: "Admin - Utilisateur"
            }
        }, {
            path: "*",
            name: "404",
            component: function() {
                return n.e("chunk-2d0e5ad4").then(n.bind(null, "9601"))
            },
            meta: {
                title: "Erreur 404 - Page introuvable"
            }
        }]
          , E = new p["a"]({
            mode: "history",
            base: "/",
            routes: C
        });
        E.beforeEach((function(e, t, n) {
            var r = localStorage.getItem("user");
            !e.matched.some((function(e) {
                return e.meta.requiresAdmin
            }
            )) || r && JSON.parse(r).admin ? e.matched.some((function(e) {
                return e.meta.requiresAuth
            }
            )) && !r ? n("/") : n() : n("/")
        }
        )),
        E.beforeEach((function(e, t, n) {
            var r = e.matched.slice().reverse().find((function(e) {
                return e.meta && e.meta.title
            }
            ))
              , a = e.matched.slice().reverse().find((function(e) {
                return e.meta && e.meta.metaTags
            }
            ))
              , i = t.matched.slice().reverse().find((function(e) {
                return e.meta && e.meta.metaTags
            }
            ));
            if (r ? document.title = r.meta.title : i && (document.title = i.meta.title),
            Array.from(document.querySelectorAll("[data-vue-router-controlled]")).map((function(e) {
                return e.parentNode.removeChild(e)
            }
            )),
            !a)
                return n();
            a.meta.metaTags.map((function(e) {
                var t = document.createElement("meta");
                return Object.keys(e).forEach((function(n) {
                    t.setAttribute(n, e[n])
                }
                )),
                t.setAttribute("data-vue-router-controlled", ""),
                t
            }
            )).forEach((function(e) {
                return document.head.appendChild(e)
            }
            )),
            n()
        }
        ));
        var y = E
          , q = n("2f62");
        r["default"].use(q["a"]);
        var S = new q["a"].Store({
            state: {
                user: null
            },
            mutations: {
                SET_USER_DATA: function(e, t) {
                    e.user = t,
                    localStorage.setItem("user", JSON.stringify(t)),
                    i.a.defaults.headers.common["authorization"] = "Bearer ".concat(t.token)
                },
                CLEAR_USER_DATA: function(e) {
                    e.user = null,
                    localStorage.removeItem("user"),
                    location.reload()
                }
            },
            actions: {
                register: function(e, t) {
                    var n = e.commit;
                    return i.a.post("/api/users", t).then((function(e) {
                        var t = e.data;
                        n("SET_USER_DATA", t)
                    }
                    ))
                },
                login: function(e, t) {
                    var n = e.commit;
                    return i.a.post("/api/auth/login", t).then((function(e) {
                        var t = e.data;
                        n("SET_USER_DATA", t)
                    }
                    ))
                },
                logout: function(e) {
                    var t = e.commit;
                    t("CLEAR_USER_DATA")
                }
            },
            modules: {},
            getters: {
                loggedIn: function(e) {
                    return !!e.user
                },
                isAdmin: function(e) {
                    return !!e.user && !!e.user.admin
                }
            }
        })
          , w = n("ee98")
          , O = n.n(w);
        r["default"].config.productionTip = !1,
        r["default"].use(O.a),
        new r["default"]({
            router: y,
            store: S,
            created: function() {
                var e = this
                  , t = localStorage.getItem("user");
                if (t) {
                    var n = JSON.parse(t);
                    this.$store.commit("SET_USER_DATA", n)
                }
                i.a.interceptors.response.use((function(e) {
                    return e
                }
                ), (function(t) {
                    return 401 === t.response.status ? e.$store.dispatch("logout") : 403 === t.response.status && e.$notify({
                        group: "notifs",
                        type: "error",
                        title: "Accès interdit",
                        text: "Vous n'avez pas les droits suffisants pour accéder à cette page."
                    }),
                    Promise.reject(t)
                }
                ))
            },
            render: function(e) {
                return e(h)
            }
        }).$mount("#app")
    },
    "5c0b": function(e, t, n) {
        "use strict";
        n("9c0c")
    },
    "9c0c": function(e, t, n) {},
    d634: function(e, t, n) {
        "use strict";
        n.d(t, "a", (function() {
            return i
        }
        ));
        var r = n("5530")
          , a = n("2f62")
          , i = Object(r["a"])(Object(r["a"])({}, Object(a["b"])(["loggedIn"])), Object(a["b"])(["isAdmin"]))
    }
});
//# sourceMappingURL=app.9012f6b5.js.map
