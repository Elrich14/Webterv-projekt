<?php require_once("./php/head.php") ?>

    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="./media/image/reklam1.jpg" style="width:100%" alt="reklam">
        </div>
        <div class="mySlides fade">
            <img src="./media/image/reklam2.jpg" style="width:100%" alt="reklam">
        </div>

        <div class="mySlides fade">
            <img src="./media/image/reklam3.jpg" style="width:100%" alt="reklam">
        </div>

        <div class="mySlides fade">
            <img src="./media/image/reklam4.jpg" style="width:100%" alt="reklam">
        </div>

        <div class="mySlides fade">
            <img src="./media/image/reklam5.jpg" style="width:100%" alt="reklam">
        </div>
    </div>

    <div class="panel">
        <img class="kep bal" src="media/ruha_img/pulcsi_1.jpg" alt="Emoji pulóver">
        <div>
            <h2>PRÉMIUM KAPUCNIS PULÓVER</h2>
            <q id="idezet"><i>Előbb jön mindig a megértés és<br>
                azután a szó.<br>
                Öntudatlan örökkévalóság.<br>
                Minden félrecsúszott<br>
                nyakkendőmben.<br>
                Sorsomnak alkatrésze légy.<br>
                Játékban élni, mely valóra vált.<br>
                Álom az élet. A víz az úr.<br>
                Csupa nyom vagy magad is.<br>
                És magaddal viszed életem.<br>
                Míg odaérne, elhervadna rég!<br>
                A Minden kellett<br>
                s megillet a Semmisem.<br>
                Halandóból így lettem<br>
                halhatatlan.<br>
                És jó volt élni, mint ahogy soha.<br>
                Az álom kárpótol mindenért.</i>
            </q>
            <div class="szoveg">
                <p>
                    Puha, könnyed és lezser stílus. Kényelmes és laza szabású pulóver.
                </p>
                <ul>
                    <li><a><b>100% magyar</b>, egyedi design a pulóver két ujján, mellkasán és hátán is</a></li>
                    <li><a>Anyagösszetétel: <b>100% pamut</b></a></li>
                    <li><a><b>Kiváló minőség</b> és tartósság</a></li>
                    <li><a>Géppel mosható lehetőleg 30°-on, kifordítva</a></li>
                </ul>

                <p>A fiú modell 174 cm magas és M méretet hord, a lány modell 172 cm magas és S méretet hord.</p>
            </div>

        </div>

    </div>

    <div class="panel">
        <img class="kep jobb" src="media/ruha_img/nadrag_2.jpg" alt="Kényelmes nadrág 2 színben">
        <div class="szoveg">
            <h2>PRÉMIUM ZSEBES GATYA</h2>
            <p>A férfiak esetében a mai napig töretlenül hódít ez a fajta nadrág.
                Most a cargo nadrág férfi modelljei idei trendek szerint pedig még
                változatosabb dizájnban és színben érhetőek el. A megszokott fekete
                cargo nadrág, khaki, terepmintás és földszínek mellett a 2022-es divatnak
                megfelelően egészen érdekes színekben is kaphatunk férfi cargókat. Ilyen
                színek többek között a különféle neon színek, vagy éppen a türkizek és a vidámabb
                zöldek is. Nem kell megijedni azonban. Ezek a színek ugyanolyan erőteljesen és
                férfiasan hatnak, mint az eredeti földszínek. Ráadásul elképesztően sokféle férfi
                cargo fazont kapni. Több csoportja oszthatjuk ugyanis a cargókat attól függően, mire
                használjuk. Léteznek sportoláshoz való cargók, amelyek leginkább pamutból vagy kevert
                műszálas anyagból készültek. A legnagyobb sportmárkák szép számmal gyártanak már ilyen
                cargókat mint például az Adidas vagy a Nike. Ugyanakkor kapni kifejezetten félelegáns,
                sőt elegáns cargót is. Ezeket megtekinthetjük szép számmal a Ralph Lauren, Hugo Boss,
                Calvin Kelin márkáknál is többek között. Valóban sikkes nadrágokról van szó, amelyek
                nem csak laza, de minőségi érzetet is keltenek egyben. Aztán érdemes még szót ejteni
                a cargók harmadik típusáról, amelyek már inkább a sportos, outdoor fazon felé tolják
                el a dizájnt. Az ilyen cargókat érdemes túrához, vagy épp az extrém eleganciát kedvelők
                esetében bakancshoz és zakóhoz felvenni. A cargo férfiak esetében ugyanis tökéletesen
                passzol magasszárú cipőkhöz, ugyanakkor a sneakernek, de még a loafernek is jó barátja.
            </p>
        </div>
    </div>



    <script>
        /* Reklam képek slideshow */
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            slides[slideIndex - 1].style.display = "block";

            setTimeout(showSlides, 2000);
        }
    </script>

<?php require_once("./php/footer.php")?>