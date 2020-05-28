<?php

try {
    $dbh = new PDO('mysql:host=localhost:3308;dbname=hotel', 'lev', '123');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . '<br/>';
    die();
}

function addNewApplication($dbh ,$destination, $checkIn, $checkOut, $rooms, $adults, $children){
    $sql = 'INSERT INTO applications (destination, start_date, end_date, rooms, adults, children) VALUES (:destination, :start_date, :end_date, :rooms, :adults, :children)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':destination', $destination, PDO::PARAM_STR);
    $stmt->bindValue(':start_date', $checkIn, PDO::PARAM_STR);
    $stmt->bindValue(':end_date', $checkOut, PDO::PARAM_STR);
    $stmt->bindValue(':rooms', $rooms, PDO::PARAM_INT);
    $stmt->bindValue(':adults', $adults, PDO::PARAM_INT);
    $stmt->bindValue(':children', $children, PDO::PARAM_INT);
    $stmt->execute();
};

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destination = strip_tags(trim($_POST['data'][0]['value']));
    $checkIn = strip_tags(trim($_POST['data'][1]['value']));
    $checkOut = strip_tags(trim($_POST['data'][2]['value']));
    $rooms = strip_tags(trim($_POST['data'][3]['value']));
    $adults = strip_tags(trim($_POST['data'][4]['value']));
    $children = strip_tags(trim($_POST['data'][5]['value']));
    addNewApplication($dbh, $destination, $checkIn, $checkOut, $rooms, $adults, $children);
}