<?php declare(strict_types = 1);

namespace App\Entity;

use App\Exceptions\ReservationException;

class BookingManager
{
    public function __toString()
    {
        return var_export($this, true) . PHP_EOL;
    }

    public static function bookRoom($room, $reservation): void
    {
        try
        {
            $room->addReservation($reservation);

            echo 'Room ' . $room 
                . ' successfully booked for ' . $reservation->getGuest() 
                . ' ' . $reservation . '!' . PHP_EOL;
        }
        catch (ReservationException $e)
        {
            echo $e->getMessage() . PHP_EOL;
        }
    }
}
?>