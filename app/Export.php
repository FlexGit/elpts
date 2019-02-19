<?php

namespace App;

use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
//use Maatwebsite\Excel\Concerns\WithMapping;

class Export implements FromView, ShouldAutoSize, WithColumnFormatting
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exports.xlsx', [
            'data' => $this->data
        ]);
    }

	/**
     * @return array
     */
    public function columnFormats(): array
    {    	$data = $this->data;

		if(!empty($data[0]['Наименование организации']))
		{
			$arr = [
	            'E' => NumberFormat::FORMAT_NUMBER,
	            'F' => NumberFormat::FORMAT_NUMBER,
	            'G' => NumberFormat::FORMAT_NUMBER,
	            'J' => NumberFormat::FORMAT_NUMBER,
	            'R' => NumberFormat::FORMAT_NUMBER,
	            'S' => NumberFormat::FORMAT_NUMBER,
	        ];
	    }
	    elseif(!empty($data[0]['Регистрационный номер заявления - основания']))
	    {
	        $arr = [
	        	'D' => NumberFormat::FORMAT_NUMBER,
	        ];
	    }

        return $arr;
    }
}
