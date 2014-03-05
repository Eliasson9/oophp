<?php

include(__DIR__.'/config.php');

$shire['title'] = "Mina Redovisningar";

$shire['main'] = <<<EOD
<article>
<h1>Mina Redovisningar</h1>
<h2>Kmom01</h2>
<p>Detta var ett helt nytt sätt för mig att använda php på och var ganska smidigt ändå men tog en stund att komma in i rätt tänkt för att kunna förstå hur funktionalliteten hängde ihop. En väldigt bra sak tyckte jag var att i navigeringa menyn så slapp jag använda ex. ?p=me.php utan kunde skriva direkt vilken fil jag ville referera till. Detta besparade även mig kod för att kontollera min p-variabel hela tiden. Sen gjorde jag en tabbe när de gällde source.php för jag lyckades skriva över min array då jag inkluderade min CNavigation class i alla sidor istället för endast i config.php. Exakt hur detta lyckades ske förstår jag inte helt men löste det iallafall. Såg även nu efter att i exempelkoden så behåller du din template som den är och har inte allt i ett som jag gjorde. Ska ändra det till nästa kursmoment tänkte jag så blir mina filer mer strukturerade.</p>
<p>Som utvecklingsmiljö så använder jag mig utav både Windows 8.1 och Elementary OS Luna med tanke på att jag inte alltid vill sitta vid min bärbara dator. GitHub är som sagt ett väldigt effektivt verktyg för mig då jag använder mig utav mer än en dator. Har haft git ett tag nu och kommer att fortsätta att använda det. När det gäller program så kör jag med Sublime Text 3 på windows och Aptana Studio på Elemtary. Som servrar så använder jag wamp i windows och xampp i Elementary. En ganska klantig sak jag gjorde här var att jag laddade ner en gammal version utan wamp med php 5.3. Detta gav resultatet att när jag hade suttit och gjort min template på den bärbara och laddade över koden till Windows så fungerade inte extract() funktionen. Det skumma var att jag fick ingen error eller något utan sidan blev bara helt tom. Detta tog några timmars huvudbröj innan jag kom fram till vad problemet var.</p>
<p>Jag tog och döpte min template till Shire och tycker att strukturen fungerar hur bra som helst.</p> 

<h2>Kmom02</h2>
<p>Detta kursmoment var väldigt roligt och smått utmanande på vissa delar. Mina tidigare erfarenheter med obejkt orienterad programmering har sin grund i C++ eller rättare sagt all min programmering har sin grud där då det var de första språket jag lärde mig. Har suttit en del med Java efter det och lite med C och Python. PHP har jag aldrig riktigt använt på detta sätt förrän nu.</p>
<p>När det gällde oophp20-guiden så var den väldigt användbar men en del jag var lite fundersam över var destrukturn. Den kändes väldigt meningslös då alla variabler 'nollställs' när sidan laddas om men kan finnas lägen då den är väldigt användbar och effektiv kom jag på senare.</p>
<p>Nu till uppgiftern. Jag valde att göra månadens babe då tärningsspelet hade blivit mer eller mindre samma som guiden. Det jobbigaste med denna uppgift var nog alla checkar man var tvungen att göra för att kunna få ut den specifika informationen man var ute efter. Som grundstruktur på min kalender valde jag att börja på sönd och sluta på lörd och detta valet berodde på att <code>getdate()</code> beskriver sönd som 0 och lörd som 6. Med andra ord jag gjorde de lätt för mig :). Som klasser valde jag att ha en klass som hanterar all information som behövs <code>CMonth</code> och sedan en klass som hämtar nödvändig information och gererar själva kalendern i html (<code>CMonthBabe</code>). När grunden var klar så fixade jag så söndagar visas som röda och de dagar som inte tillhör den aktuella månaden var gråa. Valde att skapa en funktion som genererar hur många dagar föregående månad har så att det visas korrekt på kalendern. Nu kom jag till den klurigaste delen på uppgiften och det var att hantera min information, spec angående byte utav år.
Till en början så hoppade jag två år tillbaka istället för ett och tog ett tag innan jag klurade ut var detta skulle fixas. Det visade sig bara att jag gjorde allt så mycket rörigare för mig än nödvändigt. För att min information skulle sparas så valde jag att spara undan aktuell information i <code>SESSEION['calendar']</code> genom att använda destruktorn i <code>CMonth</code>. Denna information kollas sedan i construktorn i <code>CMonthBabe</code>. Som avslutning så när jag laddade upp koden så fick jag error pga att jag inte hade satt tidszon. Tyckte det var konstigt att de inte dök upp när jag körde den lokalt men var snabbt fixat och satte den till default för tiden i sig är ej relevant till denna uppgift.</p>

<h2>Kmom03</h2>
<p>Jag såg detta kursmoment som en repetition utav sql och gjorde inte riktigt alla övningar. Läste Databasteknik i höstas så är ganska bekant med databaser och syntaxen i MsSQL och MySQL. Under den kursen var största fokus dock på MsSQL så blev lite extra kollar nu när jag skulle använda MySQL. Använde även SQLite under kursen htmlphp även om de inte riktigt kan ses som samma.</p>
<p>Det ända problemet som upstod var min misstolkning med lösenordet till skolans databas men efter ett mail till mos så klarades det ut. Men förövrigt så fungerar utvecklingsmiljön ganska bra. Jag gör som så att ja skriver min sql-fil och laddar sedan in den i phpmyadmin.</p>
<p>Blev en ganska kort redovisning denna gång men har ju sin förklaring till varför.</p>

<h2>Kmom04</h2>
<p></p>
</article>
EOD;

include(SHIRE_THEME_PATH);