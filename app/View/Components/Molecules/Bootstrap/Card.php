<?php

namespace App\View\Components\Molecules\Bootstrap;

use Illuminate\View\Component;

class Card extends Component
{
    public $cardClass;
    public $size;
    public $bodyClass;
    public $headerClass;
    public $headerText;
    public $image;
    public $imageClass;
    public $imageAlt;
    public $headingSize;
    public $headingClass;
    public $headingName;
    public $headingIcon;
    public $subHeadingSize;
    public $subHeadingClass;
    public $subHeadingName;
    public $columnWidth;
    public $textClass;
    public $footerClass;
    public $footerText;
    public $crudButtons;
    public $crudButtonsHeader;
    public $cardList;
    public $equalHeight;



    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $cardClass,
        $size,
        $bodyClass,
        $headerClass,
        $headerText,
        $image,
        $imageClass,
        $imageAlt,
        $headingSize,
        $headingClass,
        $headingName,
        $subHeadingSize,
        $subHeadingClass,
        $subHeadingName,
        $columnWidth,
        $textClass,
        $footerClass,
        $footerText,
        $crudButtons,
        $crudButtonsHeader,
        $cardList,
        $equalHeight,
        $headingIcon=null
    )
    {
        $this->cardClass=$cardClass;
        $this->size=$size;
        $this->bodyClass=$bodyClass;
        $this->headerClass=$headerClass;
        $this->headerText=$headerText;
        $this->image=$image;
        $this->imageClass=$imageClass;
        $this->imageAlt=$imageAlt;
        $this->headingSize=$headingSize;
        $this->headingClass=$headingClass;
        $this->headingName=$headingName;
        $this->headingIcon=$headingIcon;
        $this->subHeadingSize=$subHeadingSize;
        $this->subHeadingClass=$subHeadingClass;
        $this->subHeadingName= $subHeadingName;
        $this->columnWidth=$columnWidth;
        $this->textClass=$textClass;
        $this->footerClass= $footerClass;
        $this->footerText=$footerText;
        $this->crudButtons=$crudButtons;
        $this->crudButtonsHeader=$crudButtonsHeader;
        $this->cardList=$cardList;
        $this->equalHeight=$equalHeight;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.molecules.bootstrap.card');
    }
}
