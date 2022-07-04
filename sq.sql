create table users (
    user_id int not null auto_increment primary key,
    user_name varchar(100) not null,
    user_email varchar(100) not null unique key,
    user_number varchar(20) not null,
    user_password varchar(500) not null,
    user_status varchar(100) not null,
    user_gender varchar(100) not null,
    user_role varchar(100) not null default 'user',
    user_permission varchar(50) not null default 'user',
    user_date date default current_date not null
) default charset 'utf8';

create table verification (
    id int not null auto_increment primary key,
    user_name varchar(100) not null,
    user_number varchar(20) not null,
    link varchar(500) not null,
    user_date datetime default current_datetime not null
) default charset 'utf8';

create table facilities (
    id int not null auto_increment primary key,
    facility_name varchar(200) not null,
    index fname(facility_name),
    facility_type varchar(200) not null,
    facility_contact int not null,
    facility_description text,
    facility_location varchar(200) not null,
    location_coordinates varchar(100),
    facility_date date default current_date not null,
    facility_state varchar(50) not null default "active",
    cover_image varchar(500) not null,
    clicks int not null default 0,
    rating float not null default 4.1,
    constraint unique_facility unique key (facility_name, facility_type, facility_location)
)default charset 'utf8';

insert into facilities set facility_name = "Good Man Facility", facility_type = "hostel", facility_contact = "0552595712", facility_description = "This is a fantastic hostel that is sure to leave you with the most exciting and relaxing experience of your life, equipted width smart technology and internet of things this 5 star hostel is going to 'wow' you. "
, facility_location = "Ayeduase", cover_image = "opion_header_image.jpg";

insert into facilities set facility_name = "Good Man Facility", facility_type = "hostel", facility_contact = "0552595712", facility_description = "This is a fantastic hostel that is sure to leave you with the most exciting and relaxing experience of your life, equipted width smart technology and internet of things this 5 star hostel is going to 'wow' you. "
, facility_location = "Ayeduase town", cover_image = "opion_header_image.jpg";

insert into facilities set facility_name = "Good Man Facility", facility_type = "hostel", facility_contact = "0552595712", facility_description = "This is a fantastic hostel that is sure to leave you with the most exciting and relaxing experience of your life, equipted width smart technology and internet of things this 5 star hostel is going to 'wow' you. "
, facility_location = "Kotei", cover_image = "opion_header_image.jpg";

insert into facilities set facility_name = "Good Man Facility", facility_type = "hostel", facility_contact = "0552595712", facility_description = "This is a fantastic hostel that is sure to leave you with the most exciting and relaxing experience of your life, equipted width smart technology and internet of things this 5 star hostel is going to 'wow' you. "
, facility_location = "Gabon", cover_image = "opion_header_image.jpg";


insert into facilities set facility_name = "Good Man Facility", facility_type = "hostel", facility_contact = "0552595712", facility_description = "This is a fantastic hostel that is sure to leave you with the most exciting and relaxing experience of your life, equipted width smart technology and internet of things this 5 star hostel is going to 'wow' you. "
, facility_location = "Ayeduase Midcity", cover_image = "opion_header_image.jpg";

insert into facilities set facility_name = "Good Man Facility", facility_type = "hostel", facility_contact = "0552595712", facility_description = "This is a fantastic hostel that is sure to leave you with the most exciting and relaxing experience of your life, equipted width smart technology and internet of things this 5 star hostel is going to 'wow' you. "
, facility_location = "Ayeduase westcity", cover_image = "opion_header_image.jpg";

insert into facilities set facility_name = "Good Man Facility", facility_type = "hostel", facility_contact = "0552595712", facility_description = "This is a fantastic hostel that is sure to leave you with the most exciting and relaxing experience of your life, equipted width smart technology and internet of things this 5 star hostel is going to 'wow' you. "
, facility_location = "Ayeduase coastal", cover_image = "opion_header_image.jpg";

insert into facilities set facility_name = "Good Man Facility", facility_type = "hostel", facility_contact = "0552595712", facility_description = "This is a fantastic hostel that is sure to leave you with the most exciting and relaxing experience of your life, equipted width smart technology and internet of things this 5 star hostel is going to 'wow' you. "
, facility_location = "Ayeduase configura", cover_image = "opion_header_image.jpg";

insert into facilities set facility_name = "Good Man Facility", facility_type = "hostel", facility_contact = "0552595712", facility_description = "This is a fantastic hostel that is sure to leave you with the most exciting and relaxing experience of your life, equipted width smart technology and internet of things this 5 star hostel is going to 'wow' you. "
, facility_location = "Apticon", cover_image = "opion_header_image.jpg";

insert into facilities set facility_name = "Good Man Facility", facility_type = "hostel", facility_contact = "0552595712", facility_description = "This is a fantastic hostel that is sure to leave you with the most exciting and relaxing experience of your life, equipted width smart technology and internet of things this 5 star hostel is going to 'wow' you. "
, facility_location = "Ayeduase Good", cover_image = "opion_header_image.jpg";


create table blocks (
    id int not null auto_increment primary key,
    facility_name varchar(200) not null,
    facility_type varchar(200) not null,
    facility_location varchar(200) not null,
    facility_block varchar(200) not null,
    block_date date default current_date not null,
    constraint unique_block unique key (facility_name, facility_type, facility_location, facility_block)
)

insert into blocks set facility_name = "Good Man Facility", facility_type = "hostel", facility_location = "Ayeduase Good", facility_block = 'BLOCKA';

create table floors (
    id int not null auto_increment primary key,
    facility_name varchar(200) not null,
    facility_type varchar(200) not null,
    facility_location varchar(200) not null,
    facility_block varchar(200) not null,
    floor_name varchar(200) not null,
    floor_date date default current_date not null,
    constraint unique_floor unique key (facility_name, facility_type, facility_location, facility_block, floor_name)
) default charset 'utf8';

insert into floors set facility_name = "Good Man Facility", facility_type = "hostel", facility_location = "Ayeduase Good", facility_block = 'BLOCKA', floor_name = 'FIRST FLOOR';

create table comments (
    id int not null auto_increment primary key,
    facility_name varchar(200) not null,
    facility_type varchar(200) not null,
    facility_location varchar(200) not null,
    comment varchar(500) not null,
    user_name varchar(100) not null,
    user_number varchar(100) not null,
    comment_date date default current_date not null
) default charset 'utf8';

create table booking (
    id int not null auto_increment primary key,
    user_name varchar(100) not null,
    user_email varchar(100) not null,
    user_number varchar(20) not null,
    facility_name varchar(200) not null,
    facility_type varchar(200) not null,
    facility_location varchar(200) not null,
    facility_block varchar(200) not null,
    facility_floor varchar(200) not null,
    room_type varchar(200) not null,
    gender varchar(100) not null default 'Male',
    booking_id varchar(10) not null unique key,
    selected_plan varchar('100') not null,
    amount_paid int not null,
    payment_verification varchar(50) not null default "unverified",
    booking_state varchar(50) not null default "unapproved",
    booking_date date default current_date not null
) default charset 'utf8';

create table images (
    id int not null primary key auto_increment,
    purpose varchar(200),
    image_url varchar(500) not null,
    image_date date default current_date()
) default charset 'utf8';


create table rooms (
    id int not null auto_increment primary key,
    facility_name varchar(200) not null,
    facility_type varchar(200) not null,
    facility_location varchar(200) not null,
    facility_block varchar(200) not null,
    floor_name varchar(200) not null,
    room_type varchar(200) not null,
    gender varchar(100) not null default 'Male',
    outer_image varchar(500) not null,
    room_image varchar(500) not null,
    lavatory_image varchar(500) not null,
    room_count int not null default 0,
    room_price int not null default 0,
    constraint unique_room unique key (facility_name, facility_type, facility_location, facility_block, floor_name, room_type, gender),
    room_date  date default current_date not null
)

insert into rooms set facility_name = "Good Man Facility", facility_type = "hostel", facility_location = "Ayeduase Good", facility_block = 'BLOCKA', floor_name = 'FIRST FLOOR', room_type = 'FOUR IN A ROOM',
outer_image = 'opion_header_image.jpg', room_image = 'opion_header_image.jpg', lavatory_image = 'opion_header_image.jpg';

create table plans (
    id int not null auto_increment primary key,
    facility_name varchar(200) not null,
    facility_type varchar(200) not null,
    facility_location varchar(200) not null,
    facility_block varchar(200) not null,
    floor_name varchar(200) not null,
    room_type varchar(200) not null,
    gender varchar(100) not null default 'Male',
    plan_info_one varchar(200) not null, 
    plan_info_two varchar(200) not null,
    price int not null default 0,
    constraint unique_plan unique key (facility_name, facility_type, facility_location, facility_block, floor_name, room_type, gender, plan_info_one, plan_info_two),
    plan_date date default current_date not null
)


insert into plans set facility_name = "Good Man Facility", facility_type = "hostel", facility_location = "Ayeduase Good", facility_block = 'BLOCKA', floor_name = 'FIRST FLOOR', room_type = 'THREE IN A ROOM',
plan_info_one = '1 year', plan_info_two = '2000';

insert into plans set facility_name = "Good Man Facility", facility_type = "hostel", facility_location = "Ayeduase Good", facility_block = 'BLOCKA', floor_name = 'FIRST FLOOR', room_type = 'THREE IN A ROOM',
plan_info_one = '2 year', plan_info_two = '5000';

insert into plans set facility_name = "Good Man Facility", facility_type = "hostel", facility_location = "Ayeduase Good", facility_block = 'BLOCKA', floor_name = 'FIRST FLOOR', room_type = 'THREE IN A ROOM',
plan_info_one = '3 year', plan_info_two = '8000';

insert into plans set facility_name = "Good Man Facility", facility_type = "hostel", facility_location = "Ayeduase Good", facility_block = 'BLOCKA', floor_name = 'FIRST FLOOR', room_type = 'THREE IN A ROOM',
plan_info_one = '4 year', plan_info_two = '12000';

insert into plans set facility_name = "Good Man Facility", facility_type = "hotel", facility_location = "Ayeduase Good", facility_block = 'BLOCKA', floor_name = 'FIRST FLOOR', room_type = 'THREE IN A ROOM',
plan_info_one = '3', plan_info_two = '30', price = 5000;

insert into plans set facility_name = "Good Man Facility", facility_type = "hotel", facility_location = "Ayeduase Good", facility_block = 'BLOCKA', floor_name = 'FIRST FLOOR', room_type = 'EXECUTIVE',
plan_info_one = '3', plan_info_two = '30';

insert into plans set facility_name = "Good Man Facility", facility_type = "hotel", facility_location = "Ayeduase Good", facility_block = 'BLOCKA', floor_name = 'FIRST FLOOR', room_type = 'VIP',
plan_info_one = '3', plan_info_two = '30', price = 2000;

insert into plans set facility_name = "Good Man Facility", facility_type = "hotel", facility_location = "Ayeduase Good", facility_block = 'BLOCKA', floor_name = 'FIRST FLOOR', room_type = 'REGULAR',
plan_info_one = '3', plan_info_two = '30', price = 200;

insert into plans set facility_name = "Good Man Facility", facility_type = "hotel", facility_location = "Ayeduase Good", facility_block = 'BLOCKA', floor_name = 'FIRST FLOOR', room_type = 'VIP EXECUTIVE',
plan_info_one = '3', plan_info_two = '30', price = 9000;


