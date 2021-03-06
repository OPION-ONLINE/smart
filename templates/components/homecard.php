<?php

function homecard($facility_name, $facility_loc, $facility_type, $facility_image) {
    echo "
    <div class = 'homecard ov-hidden p-rel' onclick = 'location.href = \"booking?facility_name=$facility_name&facility_type=$facility_type&facility_location=$facility_loc\"'>
        <div class = 'card-img p-rel'>
            <img src = '$facility_image' class = 'obj-fit'>
        </div>
        <div class = 'card-txt text-center'>
            <h3>$facility_name</h3>
            <p>$facility_loc</p>
        </div>
        <div class = 'card-price p-abs flex-row'>
            <div class = 'value'>$facility_type</div>
        </div>
    </div>
         ";
}