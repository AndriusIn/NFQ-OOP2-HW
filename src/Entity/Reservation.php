<?php declare(strict_types = 1);

namespace App\Entity;

class Reservation
{
    private $startDate;
    private $endDate;
    private $guest;

    public function __construct(\DateTime $startDate, \DateTime $endDate, Guest $guest)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->guest = $guest;
    }

    public function __toString()
    {
        return 'from <time>' . $this->getStartDate()->format('Y-m-d') . '</time> to <time>' . $this->getEndDate()->format('Y-m-d') . '</time>';
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    public function getGuest(): Guest
    {
        return $this->guest;
    }
}
?>