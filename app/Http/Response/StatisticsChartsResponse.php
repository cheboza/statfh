<?php

namespace App\Http\Response;

use Illuminate\Contracts\Support\Arrayable;

class StatisticsChartsResponse implements Arrayable
{
    private $axisX;
    private $axisY;
    private $statistics;

    /**
     * @param array $axisX
     * @param array $axisY
     * @param array $statistics
     */
    public function __construct(array $axisX, array $axisY, array $statistics)
    {
        $this->axisX = $axisX;
        $this->axisY = $axisY;
        $this->statistics = $statistics;
    }

    /**
     * @return array
     */
    public function getAxisX(): array
    {
        return $this->axisX;
    }

    /**
     * @return array
     */
    public function getAxisY(): array
    {
        return $this->axisY;
    }

    /**
     * @return array
     */
    public function getStatistics(): array
    {
        return $this->statistics;
    }

    public function toArray():array
    {
        return [
            "axis_x" => $this->getAxisX(),
            "axis_y" => $this->getAxisY(),
            "stat" => $this->getStatistics(),
        ];
    }
}
