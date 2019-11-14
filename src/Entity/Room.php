<?php declare(strict_types = 1);

namespace App\Entity;

use App\Interfaces\ReservableInterface;
use App\Exceptions\ReservationException;

class Room implements ReservableInterface
{
    private $roomType;
    private $hasRestRoom;
    private $hasBalcony;
    private $bedCount;
    private $roomNumber;
    private $extras;
    private $price;
    private $reservations;

    public function __construct(int $roomNumber, float $price)
    {
        $this->roomNumber = $roomNumber;
        $this->price = $price;
    }

    public function __toString()
    {
        return '<strong>' . $this->getRoomNumber() . '</strong>';
    }

    public function addReservation($reservation): void
    {
        if (empty($this->getReservations()))
        {
            $this->reservations = [];
            array_push($this->reservations, $reservation);
        }
        else
        {
            // Gets reservations that are already in that period
            // $r = existing reservation
            // $reservation = new reservation
            // ------------------------
            // FIRST SITUATION EXAMPLES
            // ------------------------
            // (Existing start date)              (Existing end date)    (Existing start date)  (Existing end date)
            //           |                                 |                       |                     |
            //           {#################################}                       {#####################}
            //           {#################################}                          {###############}
            //           |                                 |                          |               |
            //    (New start date)                   (New end date)            (New start date) (New end date)
            // -------------------------
            // SECOND SITUATION EXAMPLES
            // -------------------------
            //              (Existing start date) (Existing end date)            (Existing start date)  (Existing end date)
            //                        |                    |                               |                     |
            //                        {####################}                               {#####################}
            //        {###############}                                         {#####################}
            //        |               |                                         |                     |
            // (New start date) (New end date)                           (New start date)       (New end date)
            // ------------------------
            // THIRD SITUATION EXAMPLES
            // ------------------------
            // (Existing start date) (Existing end date)                 (Existing start date)  (Existing end date)
            //          |                    |                                     |                     |
            //          {####################}                                     {#####################}
            //                               {###############}                                {#####################}
            //                               |               |                                |                     |
            //                        (New start date) (New end date)                  (New start date)       (New end date)
            $reservationsInPeriod = array_filter($this->getReservations(), function($r) use ($reservation) {
                return ($reservation->getStartDate() >= $r->getStartDate() && $reservation->getEndDate() <= $r->getEndDate()) 
                    || ($reservation->getStartDate() < $r->getStartDate() && $reservation->getEndDate() >= $r->getStartDate() && $reservation->getEndDate() <= $r->getEndDate()) 
                    || ($reservation->getStartDate() >= $r->getStartDate() && $reservation->getStartDate() <= $r->getEndDate() && $reservation->getEndDate() > $r->getEndDate());
            });

            if (empty($reservationsInPeriod))
            {
                array_push($this->reservations, $reservation);
            }
            else
            {
                throw new ReservationException('Reservation already exists in that period!');
            }
        }
    }

    public function removeReservation($reservation): void
    {
        $key = array_search($reservation, $this->reservations, true);

        if ($key === false)
        {
            throw new ReservationException('Reservation does not exist!');
        }

        array_splice($this->reservations, $key, 1);
    }

    protected function getRoomType(): string
    {
        return $this->roomType;
    }

    protected function hasRestRoom(): bool
    {
        return $this->hasRestRoom;
    }

    protected function hasBalcony(): bool
    {
        return $this->hasBalcony;
    }

    protected function getBedCount(): int
    {
        return $this->bedCount;
    }

    public function getRoomNumber(): int
    {
        return $this->roomNumber;
    }

    protected function getExtras(): array
    {
        return $this->extras;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getReservations(): ?array
    {
        return $this->reservations;
    }

    protected function setRoomType(string $roomType): void
    {
        $this->roomType = $roomType;
    }

    protected function setHasRestRoom(bool $hasRestRoom): void
    {
        $this->hasRestRoom = $hasRestRoom;
    }

    protected function setHasBalcony(bool $hasBalcony): void
    {
        $this->hasBalcony = $hasBalcony;
    }

    protected function setBedCount(int $bedCount): void
    {
        $this->bedCount = $bedCount;
    }

    protected function setExtras(array $extras): void
    {
        $this->extras = $extras;
    }
}
?>