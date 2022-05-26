<?php

namespace App\Http\Service\Statistics;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DateFormatStatistics
{
    private $dateStart;
    private $dateFinish;
    private $rangResponse;
    private $sqlFormatRang;

    /**
     *
     */
    public function __construct(int $countMonth)
    {
        $this->dateStart = Carbon::now()->subMonth($countMonth)->startOfMonth();
        $this->dateFinish = Carbon::now()->endOfMonth();

        foreach (CarbonPeriod::create($this->dateStart, '1 month', $this->dateFinish) as $period) {
            $this->rangResponse[] = $period->format('M ’ y');
            $this->sqlFormatRang[] = $period->format('Y/m');
        }
    }

    /**
     * @return Carbon
     */
    public function getDateStart(): Carbon
    {
        return $this->dateStart;
    }

    /**
     * @return Carbon
     */
    public function getDateFinish(): Carbon
    {
        return $this->dateFinish;
    }

    /**
     * @return array
     */
    public function getRangResponse(): array
    {
        return $this->rangResponse;
    }

    /**
     * @return array
     */
    public function getSqlFormatRang(): array
    {
        return $this->sqlFormatRang;
    }


}
