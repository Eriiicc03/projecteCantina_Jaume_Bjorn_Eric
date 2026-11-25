<?php include __DIR__ . '/../includes/header.php'; ?>
<main class="pagina-condicions">

    <h1>Avís legal i condicions</h1>
    <p class="actualitzacio">Darrera actualització: <?= date('d/m/Y') ?></p>

    <nav class="index-condicions" aria-label="Índex">
        <a href="#avis-legal">Avís legal</a>
        <a href="#privacitat">Privacitat</a>
        <a href="#cookies">Cookies i sessions</a>
        <a href="#compra">Condicions de compra</a>
    </nav>

    <section id="avis-legal">
        <h2>1. Avís legal</h2>
        <p>
            En compliment de la Llei 34/2002, de serveis de la societat de la informació i de comerç
            electrònic (LSSI-CE), s'informa de les dades del titular d'aquest lloc web:
        </p>
        <ul>
            <li><strong>Titular:</strong> La Cantina</li>
            <li><strong>Adreça:</strong> [Adreça del centre]</li>
            <li><strong>Correu electrònic:</strong> [correu@lacantina.cat]</li>
            <li><strong>Telèfon:</strong> [000 000 000]</li>
        </ul>
        <p>
            L'accés i l'ús d'aquest web atribueixen la condició d'usuari i impliquen l'acceptació
            d'aquestes condicions. L'usuari es compromet a fer-ne un ús correcte, d'acord amb la llei
            i la bona fe.
        </p>
        <p>
            Els textos, imatges, logotips i el disseny del web són propietat de La Cantina o
            s'utilitzen amb autorització. No se'n permet la reproducció sense permís previ.
        </p>
        <p>
            La Cantina no es fa responsable dels danys derivats d'un mal ús del web ni de les
            interrupcions del servei per causes tècniques alienes.
        </p>
    </section>

    <section id="privacitat">
        <h2>2. Política de privacitat</h2>
        <p>
            D'acord amb el Reglament (UE) 2016/679 (RGPD) i la Llei Orgànica 3/2018 (LOPDGDD),
            t'informem de com tractem les teves dades personals.
        </p>

        <h3>Responsable del tractament</h3>
        <p>La Cantina, amb les dades de contacte indicades a l'apartat d'Avís legal.</p>

        <h3>Quines dades recollim</h3>
        <ul>
            <li><strong>Nom</strong>: per identificar qui fa la comanda.</li>
            <li><strong>Telèfon</strong>: per avisar-te si hi ha cap incidència amb la comanda.</li>
            <li><strong>Correu electrònic</strong>: per enviar-te la confirmació de la comanda.</li>
        </ul>
        <p>No demanem cap altra dada ni recollim dades bancàries a través del web.</p>

        <h3>Per a què les fem servir</h3>
        <p>
            Únicament per gestionar i preparar la teva comanda i comunicar-nos amb tu sobre aquesta.
            No les utilitzem per a publicitat ni les cedim a tercers, excepte per obligació legal.
        </p>

        <h3>Base legal</h3>
        <p>
            L'execució de la comanda que sol·licites (art. 6.1.b RGPD) i el teu consentiment en
            enviar el formulari (art. 6.1.a RGPD).
        </p>

        <h3>Quant de temps les guardem</h3>
        <p>
            El temps necessari per gestionar la comanda i, després, durant els terminis que exigeixi
            la llei. Passat aquest temps, s'eliminen.
        </p>

        <h3>Els teus drets</h3>
        <p>
            Pots exercir els drets d'<strong>accés, rectificació, supressió, oposició, limitació</strong>
            i <strong>portabilitat</strong> escrivint al correu indicat a l'Avís legal. Si consideres
            que no hem tractat bé les teves dades, pots presentar una reclamació a l'Autoritat
            Catalana de Protecció de Dades (<a href="https://apdcat.gencat.cat" target="_blank" rel="noopener">apdcat.gencat.cat</a>).
        </p>
    </section>

    <section id="cookies">
        <h2>3. Cookies i sessions</h2>
        <p>
            Aquest web <strong>no utilitza cookies publicitàries ni d'anàlisi</strong>. Només fa servir
            una cookie tècnica de sessió, imprescindible perquè el web funcioni.
        </p>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Tipus</th>
                    <th>Finalitat</th>
                    <th>Durada</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>PHPSESSID</code></td>
                    <td>Tècnica (pròpia)</td>
                    <td>Recordar els productes que has afegit a la comanda mentre navegues.</td>
                    <td>Fins que tanques el navegador</td>
                </tr>
            </tbody>
        </table>
        <p>
            Com que és una cookie estrictament necessària, no cal demanar-te el consentiment
            (art. 22.2 LSSI-CE). Pots esborrar-la des de la configuració del navegador, però
            llavors no es podrà guardar la teva comanda.
        </p>
    </section>

    <section id="compra">
        <h2>4. Condicions de compra</h2>

        <h3>Com fer una comanda</h3>
        <ol>
            <li>Tria els productes a la pàgina de <a href="compra.php">Compra</a> amb el botó «+ Afegir».</li>
            <li>Revisa la teva comanda i el total.</li>
            <li>Prem «Confirmar compra» i omple les teves dades.</li>
            <li>Rebràs la confirmació i podràs recollir la comanda a La Cantina.</li>
        </ol>

        <h3>Preus</h3>
        <p>
            Tots els preus es mostren en euros (€) i inclouen l'IVA. La Cantina pot modificar els
            preus en qualsevol moment, però s'aplicarà sempre el preu vigent en el moment de
            confirmar la comanda.
        </p>

        <h3>Pagament i recollida</h3>
        <p>
            El pagament es fa en el moment de recollir la comanda a La Cantina. No es fan
            enviaments a domicili.
        </p>

        <h3>Disponibilitat</h3>
        <p>
            Les comandes estan subjectes a la disponibilitat dels productes. Si algun producte
            s'ha exhaurit, t'avisarem per oferir-te una alternativa o anul·lar-lo.
        </p>

        <h3>Cancel·lacions i devolucions</h3>
        <p>
            Pots cancel·lar la comanda abans que es comenci a preparar contactant amb La Cantina.
            Com que es tracta de productes alimentaris peribles, d'acord amb l'art. 103 de la Llei
            general per a la defensa dels consumidors i usuaris, <strong>no s'aplica el dret de
            desistiment</strong> un cop preparada la comanda. Si un producte està en mal estat, te'l
            canviarem o te'n retornarem l'import.
        </p>

        <h3>Al·lèrgens</h3>
        <p>
            Si tens alguna al·lèrgia o intolerància alimentària, consulta-ho al personal de
            La Cantina abans de fer la comanda.
        </p>

        <h3>Llei aplicable</h3>
        <p>
            Aquestes condicions es regeixen per la legislació espanyola i catalana vigent en
            matèria de consum.
        </p>
    </section>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
