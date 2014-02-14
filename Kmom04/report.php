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
</article>
EOD;

include(SHIRE_THEME_PATH);