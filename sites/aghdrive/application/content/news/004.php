<?php
$item = array(
    'title' => 'First Krakow drive dataset', 
    'short' => 'Pierwszy zbiór danych zalogowanych w takcie jazdy samochodem jest już dostępny. Zbiór zawiera dane z różnych sensorów takich jak: kamery, lidar, radar.
    Dane z kamer zostały również annotowane w 7 klasach (samochód, ciężarówka, autobus, motocylk, pojazd specjalny, znaki drogowe, pieszy).
    ',
    'text' =>  '
        W dniu 2022-01-02 zostały zarejestrowane dane z przejazdu specjalnego samochodu umożliwiającego logowanie danych. 
        Trasa przejazdu została wybrana w taki sposób aby 
        prowadził po różnych rodzajach drug takich jak: autostrady, drogi dwupasmowe, drogi lokalne. 
        Trasę przejazdu miała długość XXX km i przedstawiono ją na mapie.
        <div class="w3-center">
            <img src= "img/content/news/004/aghdrive_route.png" class="w3-image w3-round w3-card w3-border w3-margin"/>
        </div>
        Zbiór zawiera dane z różnych sensorów takich jak: kamery, lidar, radar.
    Dane z kamer zostały również annotowane w 7 klasach: samochód, ciężarówka, autobus, motocylk, pojazd specjalny, znaki drogowe, pieszy.
    <div class="w3-center w3-content w3-display-container">
        <img src= "img/content/news/004/agh_drive_00001.png" class="mySlides w3-image w3-round w3-card w3-border w3-margin" />
        <img src= "img/content/news/004/agh_drive_00002.png" class="mySlides w3-image w3-round w3-card w3-border w3-margin"/>
        <img src= "img/content/news/004/agh_drive_00003.png" class="mySlides w3-image w3-round w3-card w3-border w3-margin"/>
        <img src= "img/content/news/004/agh_drive_00004.png" class="mySlides w3-image w3-round w3-card w3-border w3-margin"/>

        <div class="w3-section">
            <button class="w3-button w3-light-grey" onclick="plusDivs(-1)">❮ Prev</button>
            <button class="w3-button w3-light-grey" onclick="plusDivs(1)">Next ❯</button>
        </div>
    </div>
    <p>
    Samochód który został wykorzystany do logowania danych wyposażony był w następujące sensory: jeden lidar 32-dwu wiązkowy, trzy kamery kolorowe (1920x1200), jeden sensor GPS o wysokiej dokładności. 
    Dokładna konfiguracja samochodu opisana jest pod linkiem.
    </p>
    <p>
    Zbiór danych jest do pobrania w sekcji <a href="/download/info/004">Download</a> (po wcześniejszej <a href="/register">rejestracji</a>) i może być wykorzystywany w celach badawczych i naukowych.
    </p>
    <script type="text/javascript">
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
            x[slideIndex-1].style.display = "block";  
        }
    </script>
    ',
    'date' => '2022-01-02');

return $item;
