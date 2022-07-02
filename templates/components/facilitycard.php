<?php

function facilitycard($facility_name, $facility_loc, $facility_price, $facility_image, $type, $rating) {
    global $environment_link;
    echo "
    <div class='card' onclick = 'location.href = \"booking?facility_name=$facility_name&facility_type=$type&facility_location=$facility_loc\"'>
    <div class='image'>

        <img src='$environment_link"."$facility_image'>

    </div>
    <div class='description'>
        <div class='name'>
            <h6>$facility_name</h6>
            <div class='location'><p>$facility_loc</p></div>
        </div>
        <div class='price'>
            <div class='box'>
                <h6>$facility_price <br><span>GHC</span></h6>
            </div>

        </div>
    </div>

    <div class='sub'>
        <div class='type'>
            <h5>$type</h5>
        </div>
        <div class='rating'>
            <i class='bi bi-star-fill'></i>
            <h5>$rating</h5>
        </div>
    </div>
    
</div>
         ";
}

 