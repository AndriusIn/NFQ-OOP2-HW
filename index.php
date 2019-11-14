<?php declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Entity\Room;
use App\Entity\SingleRoom;
use App\Entity\Bedroom;
use App\Entity\Apartment;
use App\Entity\Guest;
use App\Entity\Reservation;
use App\Entity\BookingManager;

$room = new SingleRoom(1408, 99);
$guest = new Guest('Vardenis', 'Pavardenis');

$startDate = new \DateTime('2019-04-20');
$endDate = new \DateTime('2019-04-25');
$reservation = new Reservation($startDate, $endDate, $guest);

BookingManager::bookRoom($room, $reservation);
?>