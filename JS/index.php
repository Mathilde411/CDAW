<html>
<head>
    <title>JS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .like-b > i {
            cursor: pointer;
            padding: 10px 12px 8px;
            background: #fff;
            border-radius: 50%;
            display: inline-block;
            margin: 0 0 15px;
            color: #aaa;
            transition: .2s;
        }

        .like-b > i:hover {
            color: #666;
        }

        .like-b > span {
            position: absolute;
            bottom: 70px;
            left: 0;
            right: 0;
            visibility: hidden;
            transition: .6s;
            z-index: 2;
            font-size: 2px;
            color: transparent;
            font-weight: 400;
        }

        .like-b > i.press {
            animation: size .4s;
            color: #e23b3b;
        }

        .like-b > span.press {
            bottom: 120px;
            font-size: 14px;
            visibility: visible;
            animation: fade 1s;
        }

        @keyframes fade {
            0% {
                color: rgba(0, 0, 0, 1);
            }
            50% {
                color: #e23b3b;
            }
            100% {
                color: rgba(0, 0, 0, 1);
            }
        }

        @keyframes size {
            0% {
                padding: 10px 12px 8px;
            }
            50% {
                padding: 14px 16px 12px;
                margin-top: -4px;
            }
            100% {
                padding: 10px 12px 8px;
            }
        }
    </style>
    <meta charset="utf-8">
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 4px;
        }

        th {
            cursor: pointer;
        }

        th:hover {
            background: yellow;
        }
    </style>
</head>
<body>
<!-- Exo préliminaire -->
<div>
    <button id="b1">b1</button>
    <button id="b2">b2</button>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const b1 = document.getElementById("b1");
        const b2 = document.getElementById("b2");
        const btnListener = function (event) {
            console.log('click ' + event.target.id)
            if (event.target.id === "b1") {
                b1.removeEventListener('click', btnListener)
                b2.addEventListener('click', btnListener)
            } else {
                b2.removeEventListener('click', btnListener)
                b1.addEventListener('click', btnListener)
            }
        }

        b1.addEventListener('click', btnListener)
    });
</script>

<!-- Exo 1 -->
<div>
    <h4>Mon média 1</h4>
    <div class="like-b">
        <span>Liked!</span>
        <i class="like-b fa fa-heart"></i>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const likeButton = document.getElementsByClassName("like-b")[0];
        likeButton.addEventListener('click', function (event) {
            Array.prototype.filter.call(
                likeButton.children,
                (el) => el.classList.toggle('press'),
            );

        })
    });
</script>

<!-- Exo 2 -->

<div>

    <div id="medias">
        <div id="m0" hidden>
            <h4 class="title">Bulbizarre</h4>
            <p class="descr" hidden>Au début de sa vie, il se nourrit des nutriments accumulés dans la graine sur son
                dos. Cela lui permet de grandir.</p>
            <img class="img" alt="an-img" src="https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png">
        </div>
        <div id="m1" hidden>
            <h4 class="title">Salamèche</h4>
            <p class="descr" hidden>Quand il est en bonne santé, la flamme au bout de sa queue continue de flamboyer
                même si elle est légèrement aspergée d’eau.</p>
            <img class="img" alt="an-img" src="https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png">
        </div>
        <div id="m2" hidden>
            <h4 class="title">Carapuce</h4>
            <p class="descr" hidden>Lorsqu’il naît, sa carapace est molle, mais elle gagne tout de suite en élasticité
                et reprend sa forme initiale quand on appuie dessus.</p>
            <img class="img" alt="an-img" src="https://assets.pokemon.com/assets/cms2/img/pokedex/full/007.png">
        </div>
    </div>
    <div id="focus"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let im = 0;
        const total = 3;
        const focus = document.getElementById('focus');

        function updateDisplay() {
            for (let i = 0; i < total; i++) {
                let media = document.getElementById("m" + i)
                media.hidden = (i !== im);
                if (i === im) {
                    focus.textContent = '';
                    let descr = media.getElementsByClassName('descr')[0].cloneNode(true)
                    focus.appendChild(descr);
                    descr.hidden = false;
                }
            }
        }

        document.addEventListener('keydown', function (event) {
            if (event.ctrlKey) {
                if (event.code === "ArrowRight") {
                    im = (((im + 1) % total) + total) % total
                } else if (event.code === "ArrowLeft") {
                    im = (((im - 1) % total) + total) % total
                }
            }
            updateDisplay();
        });
        updateDisplay();
    });
</script>

<div>
    <table id="grid">
        <thead>
        <tr>
            <th data-type="number">ID</th>
            <th data-type="string">Name</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>7</td>
            <td>John</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Pete</td>
        </tr>
        <tr>
            <td>36</td>
            <td>Ann</td>
        </tr>
        <tr>
            <td>87</td>
            <td>Eugene</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Ilya</td>
        </tr>
        </tbody>
    </table>
</div>

<script>
    fetch('https://api.github.com/repos/ceri-num/uv-cdaw/commits')
        .then(response => response.json())
        .then(commits => fetch("https://api.github.com/users/" + commits[2].author.login))//deuxième fetch !
        .then(response => response.json())
        .then(githubUser => {
            let img = document.createElement('img');
            img.src = githubUser.avatar_url;
            img.className = "promise-avatar-example";
            document.body.append(img);

            setTimeout(() => img.remove(), 3000); // async callback, removing the img
        });
</script>

</body>
</html>
