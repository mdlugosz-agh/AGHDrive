<a href="{$PAGE.ROUTER->generate(['controller'=>'Download', 'action'=>'info', 'id' => $download.id])}" class="neutral">
    <div class="w3-card-2">
        <header class="w3-container w3-light-grey">
            <h3>{$download.title}</h3>
        </header>

        <div class="w3-container">
            {$download.short}
        </div>
        
        <footer class="w3-container w3-light-grey">
            <h6 class="w3-small w3-left">{$download.date}</h6>
            
            <h6 class="w3-small w3-right">
                <a><b>MORE&nbsp;>></b></a>
            </h6>
        </footer>
    </div>
</a>