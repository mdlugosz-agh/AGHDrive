{extends file="layout01.tpl"}

{block name="header"}
	Documentation
{/block}


{block name="body"}
    <div class="w3-container">
        <ul class="w3-ul w3-card-4" style="width:auto">
            <li>
                <a href="{$PAGE.ROUTER->generate(['controller'=>'Documentation', 'key' => 'vehicle_sensor_setup'])}" class="w3-xlarge">
                    Vehicle sensor setup
                </a>
                <p>Description of vehciel setup sensor with their parameters and configuration</p>
            </li>
            <li>Data structure</li>
        </ul>
    </div>
{/block}