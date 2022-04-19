<?php

namespace App\View\Components\Molecules\Bootstrap;

use Illuminate\View\Component;
use phpDocumentor\Reflection\PseudoTypes\NumericString;
use phpDocumentor\Reflection\Types\Integer;

class DatePicker extends Component
{
    public $format,
        $name,
        $firstDay,
        $defaultDate,
        $setDefaultDate,
        $pickWholeWeek,
        $weekend,
        $minDate,
        $maxDate,
        $yearRange,
        $showWeekNumber,
        $yearSuffix,
        $disableWeekends,
        $showMonthAfterYear;

    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function day($day): string
    {
        $days = [];
        $days[0] = 'sunday';
        $days[1] = 'monday';
        $days[2] = 'tuesday';
        $days[3] = 'wednesday';
        $days[4] = 'thursday';
        $days[5] = 'friday';
        $days[6] = 'saturday';

        $daysFlip = array_flip($days);
        $daysKeys = array_keys(($days));
        return $daysFlip[$day];
    }

    public function days($days)
    {
        $arr = [];
        foreach ($days as $value => $day) {
            $arr[$value] = $this->day($day);
        }

        return $arr;
    }

    public function __construct($name, $format, $firstDay, $defaultDate, $minDate,$maxDate,$setDefaultDate, $pickWholeWeek, $weekend, $disableWeekends, $yearRange, $showWeekNumber, $yearSuffix,$showMonthAfterYear)
    {
        $firstDay = $this->day($firstDay);
        if ($yearRange == '') $yearRange = 0;
        if ($showWeekNumber == '') $showWeekNumber = false;

        $this->name = $name;
        $this->format = $format;
        $this->firstDay = $firstDay;
        $this->defaultDate = $defaultDate;
        $this->setDefaultDate = $setDefaultDate;
        $this->minDate=$minDate;
        $this->maxDate=$maxDate;
        $this->weekend = $weekend;
        $this->disableWeekends = $disableWeekends;
        $this->pickWholeWeek = $pickWholeWeek;
        $this->yearRange = $yearRange;
        $this->showWeekNumber = $showWeekNumber;
        $this->yearSuffix = $yearSuffix;
        $this->showMonthAfterYear=$showMonthAfterYear;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.bootstrap.date-picker');
    }
}
