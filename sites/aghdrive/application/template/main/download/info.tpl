{extends file="layout01.tpl"}

{block name=header}
    Download
{/block}

{block name="body"}
    <h2>{$download_info.title}</h2>

    {if isset($download_info.text)}
        <div class="w3-container">
            {$download_info.text}
        </div>
    {/if}

    <h3>Files</h3>
    <ul>
        {foreach $download_info.files as $key=>$file}
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

    <a  href="{$PAGE.ROUTER->generate(['controller'=>'Download', 'action' => 'list'])}" 
        class="w3-button w3-block w3-green w3-margin-top w3-round">
        Download list
    </a>
{/block}