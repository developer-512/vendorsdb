<?php

namespace App\Exports;

use App\Models\Vendors;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;

class VendorsExport implements FromQuery, WithHeadings, WithMapping,WithStrictNullComparison,ShouldAutoSize,WithStyles
{
    use Exportable;
    private $ids;
    public function Ids(array $ids)
    {
        $this->ids = $ids;

        return $this;
    }
    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A1:W1')->applyFromArray($styleArray);
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true,'size'=>'14','color'=>['argb' => Color::COLOR_WHITE]],
                'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '95a5a6'],
                    ],
                ],

        ];
    }
    public function query()
    {
        if(is_countable($this->ids)&&count($this->ids)>1){
            return Vendors::query()->whereIn('id', $this->ids);
        }
        return Vendors::query();
    }
    public function headings(): array
    {
        return [
            'id',
            'counter',  'category','sub_category',
            'contact_name',  'keywords','website',  'first_name',
            'last_name',  'date',  'company_name',
            'email',  'job_title',  'business_phone',
            'mobile_phone_1',  'mobile_phone_2',
            'address',  'city',  'zip_code',  'country',
            'approval',  'active',  'data_by_user'
        ];
    }

    public function map($vendor): array
    {
        $category=$vendor->_category->category_name;
        $subcategory='';
        if($vendor->_category->parent>0){
            $category=$vendor->_category->get_parent->category_name;
            $subcategory=$vendor->_category->category_name;
        }
        return [
            $vendor->id,
            $vendor->counter,  $category,$subcategory,
            $vendor->contact_name,  $vendor->keywords,$vendor->website,  $vendor->first_name,
            $vendor->last_name,  $vendor->date,  $vendor->company_name,
            $vendor->email,  $vendor->job_title,  $vendor->business_phone,
            $vendor->mobile_phone_1,  $vendor->mobile_phone_2,
            $vendor->address,  $vendor->city,  $vendor->zip_code,  $vendor->country,
            ($vendor->approval==1?'Approved':'Not Approved' ),  ($vendor->active==1?'Active':'Not Active'),  (isset($vendor->_user->name)?$vendor->_user->name:'')
        ];
    }
}
