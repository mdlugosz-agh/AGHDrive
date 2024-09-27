{block name="header"}
	Vehicle sensor setup
{/block}

{block name="body"}
    <h3>Vehicle and sensors localisation</h3>
    <p>
    As the base platform in our experiment, we use one car BMW series 7. 
    The car has been adapted so that the sensors can be properly installed in it. 
    A data logging system from the Vigem model... was installed in the trunk, which allows recording data from all sensors in real time. 
    In addition, a PC was installed in the car to monitor and manage the data logging process
    The sensors localizastions are pressented on figure below.
    </p>
    <div class="w3-center w3-content w3-display-container">
        <img src= "img/content/documentation/vehicle_sensor_setup/vehicle_sensor_configuration.png" 
        class="w3-image w3-round w3-card w3-border w3-margin" />
    </div>

    <h3>Lidar</h3>
    <p>
    For distance measurements the Pandar 40P lidar (Hesai Technologies) was used. It is mounted on a roof rack, allowing unobscured 360 degree FOV. 
    This device has 40 horizontal channels and a refresh rate of 10Hz. Detailed information on this sensor can be found in official manual.
    The Pandar 40P lidar from Hesai Technologies was used for distance measurements. 
    Lidar was mounted on a dedicated rack on the roof of the car (Fig. ...). 
    According to the specification, the Pandar 40P emits and receives 40 pairs of laser beams rotating around the Z axis clockwise using a built-in motor. 
    The Y axis corresponds to an~angle of 0 degrees (Fig....)
    </p>
    <div class="w3-center w3-content w3-display-container">
        <img src= "img/content/documentation/vehicle_sensor_setup/lidar_coordinate_frame1.png" 
        class="w3-image w3-round w3-card w3-border w3-margin" />
    </div>

{/block}