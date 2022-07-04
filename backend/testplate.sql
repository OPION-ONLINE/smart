update booking set facility_name = ?, facility_type = ? where facility_type = ? and facility_name = ?;

update floors set facility_type = ? where facility_type = ? and facility_name = ?;
        
update comments set facility_type = ? where facility_type = ? and facility_name = ?;
        
update facilities set facility_name = ?,
        facility_type = ?, facility_contact = ?, facility_description = ?,
        facility_location = ?, location_coordinates = ?, facility_state = ? where facility_name = ? and facility_type = ?



insert into users set user_name = "David Shalom", user_email = "adedavid.tech@gmail.com", user_number = "0552595712", user_password = 'somethinggood' user_role = 'user', user_permission = 'user';

INSERT INTO booking SET user_name = "David Shalom", user_email = "adedavid.tech@gmail.com", user_number = "0552595712", facility_name = "Shalom's International Hostel", facility_type = " Hostel", facility_location = "Shalom City", facility_floor = "First Floor", room_type = "Four In A Room", booking_id = "563902209", amount_paid = 12500;