create table users (
    user_id int not null auto_increment primary key,
    user_name varchar(100) not null,
    index uname(user_name),
    user_email varchar(100) not null unique key,
    index uemail(user_email),
    user_number varchar(20) not null,
    index unumber(user_number),
    user_password varchar(100) not null,
    user_role varchar(100) not null default 'user',
    user_permission varchar(50) not null default 'user',
    user_date date default current_date not null
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
    facility_state varchar(50) not null,
    constraint unique_facility unique key (facility_name, facility_type)
)default charset 'utf8';

create table floors (
    id int not null auto_increment primary key,
    facility_name varchar(200) not null,
    foreign key (facility_name) references facilities(facility_name) on update cascade on delete cascade,
    facility_type varchar(200) not null,
    floor_name varchar(200) not null,
    index fname(floor_name),
    room_type varchar(200) not null,
    index rtype(room_type),
    room_images text not null,
    price int not null,
    number_of_rooms int not null,
    foor_date date default current_date not null,
    constraint unique_floor unique key (facility_name, facility_type, floor_name, room_type)
) default charset 'utf8';

create table comments (
    id int not null auto_increment primary key,
    facility_name varchar(200) not null,
    foreign key (facility_name) references facilities(facility_name) on update cascade on delete cascade,
    facility_type varchar(200) not null,
    comment varchar(500) not null,
    user_name varchar(100) not null,
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
    facility_floor varchar(200) not null,
    room_type varchar(200) not null,
    booking_id varchar(10) not null unique key,
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


