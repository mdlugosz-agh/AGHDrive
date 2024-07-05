<a href="{$PAGE.ROUTER->generate(['controller'=>'News', 'id' => $news.id])}" class="neutral">
    <div class="w3-card-2">
        <header class="w3-container w3-light-grey">
            <h3>{$news.title|truncate:{$title_truncate|default:50}}</h3>
        </header>

        <div class="w3-container">
            {$news.short|truncate:{$short_truncate|default:125}}
        </div>

        <footer class="w3-container w3-light-grey">
            <h6 class="w3-small">{$news.date}</h6>
        </footer>
    </div>
</a>