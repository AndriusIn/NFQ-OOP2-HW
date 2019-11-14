<?php

namespace App\Interfaces;

interface ReservableInterface
{
    public const ROOM_TYPE_STANDARD = 'Standard';
    public const ROOM_TYPE_GOLD = 'Gold';
    public const ROOM_TYPE_DIAMOND = 'Diamond';

    public function addReservation($reservation): void;
    public function removeReservation($reservation): void;
}
?>