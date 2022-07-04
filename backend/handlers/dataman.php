<?php

declare(strict_types = 1);

//set the private database credential parameters
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'efacility4';
$dbconnection = new mysqli($hostname, $username, $password, $database); //connect to the database

//return error if failed to connect to the database
if($dbconnection->connect_error) {
    die("connection error " . $dbconnection->connect_error);
}

class Dataman {


    //clean to remove html tags from given arguments
    static function clean_param($param) {
        return htmlspecialchars($param);
    }

    //fetch data for a single facility
    function fetch_floors(string $facility_name, string $facility_type) {
        global $dbconnection;
        $facility_name = self::clean_param($facility_name); //remove all html tags from the arguments
        $facility_type = self::clean_param($facility_type); //remove all html tags from the arguments
        
        $sql     = 'select floors.*, facility_description from floors, facilities where floors.facility_name = ? and floors.facility_type = ? and floors.facility_name = facilities.facility_name and floors.facility_type = facilities.facility_type'; //sql to select floors with the specified facility_name
        $dbconnection = $dbconnection;
        $command = $dbconnection->prepare($sql); //test sql for errors

        $command->bind_param('ss', $facility_name, $facility_type); //provide sql with facility name
        $command->execute(); //execute sql command
        
        $result_array = array(); //array to store query result
        $result       = $command->get_result(); //fetch query result

        //add result to array
        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }

        return $result_array;

    }

    function upload_image(string $purpose, string $image_url) {
        global $dbconnection;

        $purpose   = self::clean_param($purpose);
        // $image_url = self::clean_param($image_url);

        $sql = 'insert into images set purpose = ?, image_url = ?';
        $command = $dbconnection->prepare($sql);
        $command->bind_param('ss', $purpose, $image_url);
        $command->execute();
    }

    function fetch_images(int $id, int $limit) {
        global $dbconnection;

        $sql = 'select * from images where id >= ?  order by id desc limit ?;';
        $command = $dbconnection->prepare($sql);
        $command->bind_param('ii', $id, $limit);
        $command->execute();

        $result_array = array();
        $result       = $command->get_result();

        //add result to array
        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }

        return $result_array;
    }

    function fetch_facility(string $facility_name, string $facility_type) {

        global $dbconnection;
        $facility_name = self::clean_param($facility_name);
        $facility_type = self::clean_param($facility_type);
        $sql           = "select * from facilities where facility_name = ? and facility_type = ?;";
        $command       = $dbconnection->prepare($sql);
        $command->bind_param('ss', $facility_name, $facility_type);
        $command->execute();

        $result_array = array();
        $result       = $command->get_result();

        //add result to array
        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }

        return $result_array;
    }

    function fetch_comments(string $facility_name, string $facility_type) {

        global $dbconnection;
        $facility_name = self::clean_param($facility_name);
        $facility_type = self::clean_param($facility_type);
        $sql           = "select * from comments where facility_name = ? and facility_type = ?;";
        $command       = $dbconnection->prepare($sql);
        $command->bind_param('ss', $facility_name, $facility_type);
        $command->execute();

        $result_array = array();
        $result       = $command->get_result();

        //add result to array
        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }

        return $result_array;
    }

    function fetch_facilities(int $start_id, int $limit, string $start_date, string $end_date) {

        global $dbconnection;

        $start_date    = self::clean_param($start_date);
        $end_date      = self::clean_param($end_date);

        $sql           = "select * from facilities where id > ? and facility_date >= ? and facility_date <= ? limit ?;";
        $command       = $dbconnection->prepare($sql);
        $command->bind_param('issi', $start_id, $start_date, $end_date, $limit);
        $command->execute();

        $result_array = array();
        $result       = $command->get_result();

        //add result to array
        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }

        return $result_array;
    }

    function search_facilities(string $search_query, int $start_id, int $limit, string $start_date, string $end_date) {

        $search_query = self::clean_param($search_query);
        $start_date   = self::clean_param($start_date);
        $end_date     = self::clean_param($end_date);
        $search_query = "%$search_query%";

        global $dbconnection;

        $sql           = "select * from facilities where (facility_name like ? or facility_type like ? or facility_location like ? or facility_state like ? or facility_description like ? or facility_contact like ?) and id > ? and facility_date >= ? and facility_date <= ? limit ?;";
        $command       = $dbconnection->prepare($sql);
        $command->bind_param('ssssssissi', $search_query, $search_query, $search_query, $search_query, $search_query, $search_query, $start_id, $start_date, $end_date, $limit);
        $command->execute();

        $result_array = array();
        $result       = $command->get_result();

        //add result to array
        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }

        return $result_array;
    }

    function search_bookings(string $search_query, int $start_id, int $limit, string $start_date, string $end_date) {

        $search_query = self::clean_param($search_query);
        $start_date   = self::clean_param($start_date);
        $end_date     = self::clean_param($end_date);
        $search_query = "%$search_query%";

        global $dbconnection;

        $sql           = "select * from booking where (user_name like ? or user_email like ? or user_number like ? or facility_name like ? or facility_type like ? or facility_location like ? or facility_floor like ? or room_type like ? or booking_id like ? or amount_paid like ? or payment_verification like ? or booking_state like ? or booking_date like ?) and id > ? and booking_date >= ? and booking_date <= ? limit ?;";
        $command       = $dbconnection->prepare($sql);
        $command->bind_param('ssssssssissssissi', $search_query, $search_query, $search_query, $search_query, $search_query, $search_query, $search_query, $search_query, $search_query, $search_query, $search_query, $search_query, $search_query, $start_id, $start_date, $end_date, $limit);
        $command->execute();

        $result_array = array();
        $result       = $command->get_result();

        //add result to array
        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }

        return $result_array;
    }

    function add_facility(
        string $facility_name, string $facility_type, string $facility_contact, 
        string $facility_description, string $facility_location, string $location_cordinates, 
        string $facility_state, array $facility_floors
    )
    {
        global $dbconnection;
        //clean for html characters
        $facility_name        = self::clean_param($facility_name);
        $facility_type        = self::clean_param($facility_type);
        $facility_contact     = self::clean_param($facility_contact);
        $facility_description = self::clean_param($facility_description);
        $facility_location    = self::clean_param($facility_location);
        $location_cordinates  = self::clean_param($location_cordinates);
        $facility_state       = self::clean_param($facility_state);

        $facility_contact = (int)$facility_contact;

        //prepare statement
        $sql     = 'insert into facilities set facility_name = ?,
                    facility_type = ?, facility_contact = ?, facility_description = ?,
                    facility_location = ?, location_coordinates = ?, facility_state = ?;';
        
        $command = $dbconnection->prepare($sql);
        $command->bind_param('ssissss', $facility_name, $facility_type, $facility_contact, $facility_description, $facility_location, $location_cordinates, $facility_state);

        //return result
        if($command->execute()) {

            $floor_names = array_keys($facility_floors);

            foreach( $facility_floors as $floor_name => $room_types) {
                foreach( $room_types as $room_type => $room_values) {

                    $room_images     = json_encode($room_values['room_images']);
                    $room_price      = (int)$room_values["price"];
                    $number_of_rooms = (int)$room_values["number_of_rooms"];

                    $sql     = 'insert into floors set facility_name = ?, facility_type = ?, floor_name = ?, room_type = ?, room_images = ?, price = ?, number_of_rooms = ?;';
                    $command = $dbconnection->prepare($sql);

                    $command->bind_param('sssssii', $facility_name, $facility_type, $floor_name, $room_type, $room_images, $room_price, $number_of_rooms);

                    if(!$command->execute()) echo 'floor not added';
                    echo "Floor Name: $floor_name, Room Type: $room_type, Room Key: adf, Room Images: $room_images, Room Price: $room_price, Number of rooms: $number_of_rooms";

                }
            }
        }
    }

    function delete_floor($facility_name, $facility_type, $floor_name, $room_type) {
        global $dbconnection;

        $facility_name = self::clean_param($facility_name);
        $facility_type = self::clean_param($facility_type);
        $floor_name = self::clean_param($floor_name);
        $room_type = self::clean_param($room_type);

        $sql = 'delete from floors where facility_name = ? and facility_type = ? and floor_name = ? and room_type = ?';
        $command = $dbconnection->prepare($sql);
        $command->bind_param('ssss', $facility_name, $facility_type, $floor_name, $room_type);
        $command->execute();
        $command->close();

    }

    function delete_facility($facility_name, $facility_type) {
        global $dbconnection;

        $facility_name = self::clean_param($facility_name);
        $facility_type = self::clean_param($facility_type);
        echo $facility_name;

        // $sql = 'delete from floors where facility_name = ? and facility_type = ?;';
        // $command = $dbconnection->prepare($sql);
        // $command->bind_param('ss', $facility_name, $facility_type);

        // if($command->execute()) {
            // $sql = 'delete from facilities where facility_name = ? and facility_type = ?';
            // $command = $dbconnection->prepare($sql);
            // $command->bind_param('ss', $facility_name, $facility_type);
            // $command->execute();

        // };

        $command->close();

    }

    function update_facility( 
        string $old_facility_name, string $old_facility_type,
        string $facility_name, string $facility_type, string $facility_contact, 
        string $facility_description, string $facility_location, string $location_cordinates, 
        string $facility_state, array $facility_floors
    ) {
        global $dbconnection;
        //clean for html characters
        $old_facility_name    = self::clean_param($old_facility_name);
        $old_facility_type    = self::clean_param($old_facility_type);
        $facility_name        = self::clean_param($facility_name);
        $facility_type        = self::clean_param($facility_type);
        $facility_contact     = self::clean_param($facility_contact);
        $facility_description = self::clean_param($facility_description);
        $facility_location    = self::clean_param($facility_location);
        $location_cordinates  = self::clean_param($location_cordinates);
        $facility_state       = self::clean_param($facility_state);

        $facility_contact = (int)$facility_contact;

        //prepare statement
        $sql     = '
        update facilities set facility_name = ?,
        facility_type = ?, facility_contact = ?, facility_description = ?,
        facility_location = ?, location_coordinates = ?, facility_state = ? where facility_name = ? and facility_type = ?;
        ';

        $sql1 = 'update booking set facility_name = ?, facility_type = ? where facility_type = ? and facility_name = ?;';
        $sql2 = 'update floors set facility_type = ? where facility_type = ? and facility_name = ?;';
        $sql3 = 'update comments set facility_type = ? where facility_type = ? and facility_name = ?;';
        
        $command = $dbconnection->prepare($sql);
        $sql1 = $dbconnection->prepare($sql1);
        $sql2 = $dbconnection->prepare($sql2);
        $sql3 = $dbconnection->prepare($sql3);
        $command->bind_param('ssissssss', $facility_name, $facility_type, $facility_contact, $facility_description, $facility_location, $location_cordinates, $facility_state, $old_facility_name, $old_facility_type);
        $sql1->bind_param('ssss', $facility_name, $facility_type, $old_facility_type, $old_facility_name);
        $sql2->bind_param('sss', $facility_type, $old_facility_type, $old_facility_name);
        $sql3->bind_param('sss', $facility_type, $old_facility_type, $old_facility_name);


        //return result
        if($command->execute() && $sql1->execute() && $sql2->execute() && $sql3->execute()) {

            $floors = $this->fetch_floors($facility_name, $facility_type);
            
            foreach($floors as $floor) {
                
                if(!isset($facility_floors[$floor['floor_name']][$floor['room_type']])) {
                    $this->delete_floor($facility_name, $facility_type, $floor['floor_name'], $floor['room_type']);
                }
                else if(isset($facility_floors[$floor['floor_name']][$floor['room_type']])) {
        
                    $room_images     = json_encode($facility_floors[$floor['floor_name']][$floor['room_type']]['room_images']);
                    $room_price      = (int)$facility_floors[$floor['floor_name']][$floor['room_type']]["price"];
                    echo $room_price;
                    $number_of_rooms = (int)$facility_floors[$floor['floor_name']][$floor['room_type']]["number_of_rooms"];

                    $sql     = 'update floors set room_images = ?, price = ?, number_of_rooms = ? where facility_name = ? and facility_type = ? and floor_name = ? and room_type = ?;';
                    $command = $dbconnection->prepare($sql);

                    $command->bind_param('sssssss', $room_images, $room_price, $number_of_rooms, $facility_name, $facility_type, $floor['floor_name'], $floor['room_type']);
                    $command->execute();
                    echo "update floors set room_images = $room_images, price = $room_price, number_of_rooms = $number_of_rooms where facility_name = $facility_name and facility_type = $facility_type and floor_name = ". $floor['floor_name'] ." and room_type = ". $floor['room_type'] ."";

                    if(!$command->execute()) {
                        unset($facility_floors[$floor['floor_name']][$floor['room_type']]);
                        $facility_floors[$floor['floor_name']] = array_values($facility_floors[$floor['floor_name']]);
                    }
                }
            }

            foreach( $facility_floors as $floor_name => $room_types) {
                foreach( $room_types as $room_type => $room_values) {

                    $room_images     = json_encode($room_values['room_images']);
                    $room_price      = (int)$room_values["price"];
                    $number_of_rooms = (int)$room_values["number_of_rooms"];

                    $sql     = 'insert into floors set facility_name = ?, facility_type = ?, floor_name = ?, room_type = ?, room_images = ?, price = ?, number_of_rooms = ?;';
                    $command = $dbconnection->prepare($sql);

                    $command->bind_param('sssssii', $facility_name, $facility_type, $floor_name, $room_type, $room_images, $room_price, $number_of_rooms);

                    if(!$command->execute()) echo 'floor not added';
                    echo "Floor Name: $floor_name, Room Type: $room_type, Room Key: adf, Room Images: $room_images, Room Price: $room_price, Number of rooms: $number_of_rooms";

                }
            }

        } 
        
    }

    function make_booking(string $username, string $useremail, string $usernumber, string $facility_name, string $facility_type, string $facility_location, string $facility_floor, string $room_type, string $booking_id, int $amount_paid) {
        global $dbconnection;
        $username               = self::clean_param($username);
        $useremail              = self::clean_param($useremail);
        $usernumber             = self::clean_param($usernumber);
        $facility_name          = self::clean_param($facility_name);
        $facility_type          = self::clean_param($facility_type);
        $facility_location      = self::clean_param($facility_location);
        $facility_floor         = self::clean_param($facility_floor);
        $room_type              = self::clean_param($room_type);
        $booking_id             = self::clean_param($booking_id);

        $sql = "INSERT INTO booking SET user_name = ?, user_email = ?, user_number = ?, facility_name = ?, facility_type = ?, facility_location = ?, facility_floor = ?, room_type = ?, booking_id = ?, amount_paid = ?;";

        $sql = $dbconnection->prepare($sql);
        $sql->bind_param('sssssssssi', $username, $useremail, $usernumber, $facility_name, $facility_type, $facility_location, $facility_floor, $room_type, $booking_id, $amount_paid);
        
        if($sql->execute()) {
            $sql->close();
            return true;
        };

        return false;

    }
    
    function verify_booking(string $booking_id) {
        global $dbconnection;

        $booking_id = self::clean_param($booking_id);

        $sql = 'UPDATE booking SET payment_verification = "verified" where booking_id = ?';
        $sql = $dbconnection->prepare($sql);
        $sql->bind_param('s', $booking_id);

        $sql->execute();
        $sql->close();

    }

    function check_booking(string $username, string $useremail) {
        global $dbconnection;

        $username = self::clean_param($username);
        $useremail = self::clean_param($useremail);

        $sql = 'select * from booking where user_name = ? && user_email = ? order by id desc';
        // echo $sql . "'" . $username . "'";
        $sql = $dbconnection->prepare($sql);
        $sql->bind_param('ss', $username, $useremail);
        $sql->execute();

        $result_array = [];
        $result = $sql->get_result();

        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }

        return $result_array;
    }

    function fetch_bookings(int $start_id, int $limit, string $start_date, string $end_date) {

        global $dbconnection;

        $start_date    = self::clean_param($start_date);
        $end_date      = self::clean_param($end_date);

        if($start_id == 0) {
            $sql = 'select * from booking order by id desc limit 1;';
            $sql = $dbconnection->prepare($sql);
            $sql->execute();
            $result = $sql->get_result();
            $result = $result->fetch_assoc();
            // return var_dump($result);
            $start_id = $result['id'];
            $start_id = (int) $start_id;
            $start_id++;
        }

        $sql           = "select * from booking where id < ? and booking_date >= ? and booking_date <= ? order by id desc limit ?;";
        $command       = $dbconnection->prepare($sql);
        $command->bind_param('issi', $start_id, $start_date, $end_date, $limit);
        $command->execute();

        $result_array = array();
        $result       = $command->get_result();

        //add result to array
        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }

        return $result_array;
    }

    function fetch_booking(string $booking_id) {
        global $dbconnection;

        $booking_id = self::clean_param($booking_id);

        $sql = 'select * from booking where booking_id = ?';
        $sql = $dbconnection->prepare($sql);
        $sql->bind_param('s', $booking_id);
        $sql->execute();

        $result_array = [];
        $result = $sql->get_result();

        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }

        return $result_array;
    }

    function admin_home() {
        
        
        function fetch_result(string $sql) {
            global $dbconnection;
            $sql = $dbconnection->prepare($sql);
            $sql->execute();
            return $sql->get_result()->fetch_assoc();
        }
        
        
        $sql = 'select count(*) from booking where payment_verification = "verified"';
        $number_of_bookings = fetch_result($sql)['count(*)'];

        $sql = 'select sum(amount_paid) from booking where payment_verification = "verified"';
        $booking_cash = fetch_result($sql)['sum(amount_paid)'];
        // echo $booking_cash . "</br>";

        $sql = 'select count(*) from booking where payment_verification = "verified" and facility_type like "Hostel"';
        $number_of_hostels = fetch_result($sql)['count(*)'];
        // echo $number_of_hostels . "</br>";

        $sql = 'select count(*) from booking where payment_verification = "verified" and facility_type like "Homestel"';
        $number_of_homestels = fetch_result($sql)['count(*)'];
        // echo $number_of_homestels . "</br>";

        $sql = 'select count(*) from booking where payment_verification = "verified" and facility_type like "Guest House"';
        $number_of_guesthouses = fetch_result($sql)['count(*)'];
        // echo $number_of_guesthouses . "</br>";

        $sql = 'select count(*) from booking where payment_verification = "verified" and facility_type like "Hotel"';
        $number_of_hotels = fetch_result($sql)['count(*)'];
        // echo $number_of_hotels . "</br>";

        $sql = 'select count(*) from booking where payment_verification = "unverified" and facility_type like "Hostel"';
        $pending_hostels = fetch_result($sql)['count(*)'];
        // echo $pending_hostels . "</br>";

        $sql = 'select count(*) from booking where payment_verification = "unverified" and facility_type like "Hotel"';
        $pending_hotels = fetch_result($sql)['count(*)'];
        // echo $pending_hotels . "</br>";

        $sql = 'select count(*) from booking where payment_verification = "unverified" and facility_type like "Homestel"';
        $pending_homestels = fetch_result($sql)['count(*)'];
        // echo $pending_homestels . "</br>";

        $sql = 'select count(*) from booking where payment_verification = "unverified" and facility_type like "Guest House"';
        $pending_guesthouses = fetch_result($sql)['count(*)'];
        // echo $pending_guesthouses . "</br>";

        $result = [
            'total_booking' => $number_of_bookings,
            'total_booking_amount' => $booking_cash,
            'hostels' => $number_of_hostels,
            'homestels' => $number_of_homestels,
            'hotels' => $number_of_hotels,
            'guest_houses' => $number_of_guesthouses,
            'pending_hostels' => $pending_hostels,
            'pending_homestels' => $pending_homestels,
            'pending_hotels' => $pending_hotels,
            'pending_guesthouses' => $pending_guesthouses,
        ];

        return $result;
        
    }

}



// $dataman = new Dataman();
// $dataman->admin_home();

// $dataman->make_booking("David Shalom", "adedavid.tech@gmail.com", "0552595712", "Shalom's International Hostel", "Hostel", "Shalom City", "First Floor", "Four In A Room", "563902209", 12500);