<?php

include(__DIR__.'/config.php');
include(__DIR__.'/dynamicMenu.php');


$menu = array(
	'home' => array('text' =>'Hem', 'url' =>'?p=home'),
	'report' => array('text' =>'Redovisning', 'url' =>'?p=report'),
	'source' => array('text' =>'Källkod', 'url' =>'?p=source'));
	
$shire['navMenu'] = CNavigation::GenerateMenu($menu);
$shire['title'] = "Me-Sida";
$shire['header'] = <<<EOD
<img class='sitelogo' src='img/blad.jpg' alt='Dbwebb logo' />
<span class='sitetitle'>Min Me-Sida</span>
<br />
<span class='siteslogan'>Detta är min me-sida i oophp</span>
EOD;

$shire['main'] = <<<EOD
<h1>Om Mig</h1>
<p>Denna sida visar en presentation utav mig själv och är ämnad till kursen oophp.</p>
<p>Mitt namn är Patrik Eliasson och jag är 22 år gammal. Jag är född och uppvuxen i Skåne och flyttade till Karlskrona för ca fyra år sedan. Anledningen till att jag flyttade var för att studera på BTH. Jag pluggar till Civilingengör data- och elektroteknik och håller för tillfället på med mitt fjärde år. Som speciallisering har jag valt teknisk datavetenskap vilket innebär en del AI och Machine Learning. Detta läsåret har visat sig vara det svåraste hittills och är inte så konstigt med tanke på att jag nästan bara läser kurser på avancerad nivå.</p> 
<p>De kurser som jag läser just nu är Agentsystem och Forskningsmetodik. I agent-kursen så håller jag på med ett projekt som innefattar att skapa en trading agent till TAC (Trading Agent Competition) vilket har visat sig bara väldigt komplicerat och utmanande vilket är väldigt roligt. Forskningsmetodik däremot är inte alls min favorit då den endast innefattar en massa skrivande utav akademiska texter på engelka. Däremot är kursen väldigt viktig och givande till mitt examensarbete som ska göras under år fem. Vi har dock varit smarta nog att skriva om TAC i forskningsmetodiken vilket gör att vi minskar arbetsbelastningen samt dubbelt arbete.</p>
<p>Mitt intresse för webbprogrammering slog igenom under mitt tredje år då jag hade ett projekt under hela våren (15hp, halvfart). Jobbade då i en grupp med fyra andra medlemmar. Vi utvecklade då en hemsida som skulle kommunicera/strya samt samla data från en pelletsbrännare via en raspberry pi. Jag anmälde mig då till hela webbprogrammerings blocket på 30hp och kvartsfart så att jag samtidigt skulle hinna med mina andra studier.</p>
<p>På min fritid så tränar jag en hel del på gym samt springer en del. Spenderar även en del tid med min nära och kära. Jag bor även tillsammans med en polare som läser samma program som mig och går även samma år. </p>
<p>Min svagaste sida gällande webbprogrammeringen är utan tvekan css/styling då jag saknar lite känslan för hur det ska se snyggt ut. Tror dock denna kurs kommer att passa mig väldigt bra då funktionallitet är något utav de roligaste men har inte riktigt använt php på ett sådant sätt innan.</p> 
EOD;

$shire['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Patrik Eliasson (pael10@student.bth.se) | <a href='https://github.com/Eliasson9/oophp'>Shire på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
include(SHIRE_THEME_PATH);