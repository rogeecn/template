<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>出错了</title>

    <style>
        html, body {
            height: 100%;
            min-height: 100%;
            background: #161B20;
            overflow: hidden
        }

        #block {
            width: 1px;
            height: 1px;
            font-size: 10px
        }

        #block:after {
            content: '';
            position: absolute;
            top: 36%;
            left: 50%;
            width: 1em;
            height: 1em;
            -webkit-transform: translateX(-14em);
            transform: translateX(-14em)
        }

        @media screen and (max-width: 320px) {
            #block:after {
                -webkit-transform: translateX(-11.5em) scale(.8);
                transform: translateX(-11.5em) scale(.8)
            }
        }

        .home {
            position: absolute;
            bottom: 30%;
            left: 50%;
            margin-left: -14px;
            text-decoration: none
        }

        .icon-home {
            position: relative;
            display: block;
            width: 30px;
            height: 30px;
            background: #484C4D
        }

        .icon-home:before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            top: -40px;
            left: -9px;
            border: 24px solid transparent;
            border-bottom-color: #484C4D
        }

        .icon-home:after {
            content: '';
            position: absolute;
            height: 0;
            width: 0;
            top: 16px;
            left: 7px;
            width: 16px;
            height: 14px;
            background: #161B20
        }
    </style>
</head>
<body>
<div id="block"></div>

<a href="<?= $this->setting("site.url"); ?>" class="home" title="返回主页">
    <span class="icon-home"></span>
</a>

<script>
    !function () {
        function n() {
            return "#" + ("00000" + (16777215 * Math.random() + .5 >> 0).toString(16)).slice(-6)
        }

        function e(e, t) {
            return e + "em " + t + "em " + n()
        }

        function t(n, e, t, u) {
            var r = document.getElementById(n);
            r || (r = document.createElement("style"), r.id = n),
                r.innerHTML = e + "{" + t + ":" + u + ";}",
                document.getElementsByTagName("head")[0].appendChild(r)
        }

        function u(n, t, u, r) {
            for (var o = [], s = 0, h = t - .5; n + u >= s; s++, h = t - .5 * (s + 1)) if (s === n) for (var i = h + .5; t + r >= i; i++) o.push(e(i, n));
            else o.push(e(t, s)),
                n > s && o.push(e(h, s + .5));
            return o.join(",")
        }

        function r(n, t, u) {
            for (var r = [], o = 0, s = 0; u > s; s++) r.push(e(n + s, 0)),
                r.push(e(n + s, t));
            for (r.push(e(n - .5, o + .5)), r.push(e(n + u - 1 + .5, o + .5)), o = t - 1, r.push(e(n - .5, o + .5)), r.push(e(n + u - 1 + .5, o + .5)), s = 1; t > s; s++) r.push(e(n - 1, s)),
                r.push(e(n + u, s));
            return r.join(",")
        }

        setInterval(function () {
                t("style", "#block:after", "box-shadow", u(10, 5, 2, 1) + "," + r(12, 12, 5) + "," + u(10, 26, 2, 1))
            },
            200)
    }();
</script>
</body>
</html>