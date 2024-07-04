<h3>Files</h3>
<ul>
    {foreach $files as $key=>$file}
        <li>
            <h4>
                <a href="{$PAGE.ROUTER->generate([
                        'controller'=>'Download', 
                        'action'    => 'download',
                        'file' => str_replace('/', '#', $file.file)])}">
                    {$file.fileName|default:$file.file}
                </a>
            </h4>
            {if isset($file.text)}
                <p>{$file.text}</p>
            {/if}
        </li>
    {/foreach}
</ul>