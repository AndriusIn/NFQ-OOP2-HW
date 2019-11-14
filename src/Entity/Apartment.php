<?php declare(strict_types = 1);

namespace App\Entity;

use App\Interfaces\ReservableInterface;

class Apartment extends Room
{
    public function __construct(int $roomNumber, float $price)
    {
        parent::__construct($roomNumber, $price);
        $this->setBedCount(4);
        $this->setRoomType(ReservableInterface::ROOM_TYPE_DIAMOND);
        $this->setHasRestRoom(true);
        $this->setHasBalcony(true);
        $this->setExtras(array('TV', 'air-conditioner', 'refrigerator', 'kitchen box', 'mini-bar', 'bathtub', 'free Wi-fi'));
    }

    public function __toString()
    {
        return '<strong>' . $this->getRoomNumber() . '</strong>';
    }

    public function getRoomType(): string
    {
        return parent::getRoomType();
    }

    public function hasRestRoom(): bool
    {
        return parent::hasRestRoom();
    }

    public function hasBalcony(): bool
    {
        return parent::hasBalcony();
    }

    public function getBedCount(): int
    {
        return parent::getBedCount();
    }

    public function getExtras(): array
    {
        return parent::getExtras();
    }
}
?>