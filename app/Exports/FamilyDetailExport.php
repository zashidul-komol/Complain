<?php
namespace App\Exports;
use App\FamilyDetail;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;

class FamilyDetailExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithEvents {
    use Exportable;

    protected $param;
    protected $sl_no = 0;

    public function __construct(int $param = 0) {
        $this->param = $param;
    }

    public function query() {

        return FamilyDetail::query()->orderBy('employee_id');

    }

    public function headings(): array
    {

        return [
            'Employee Name',
            'Father Name',
            'Father Occupation',
            'Father Live Status',
            'Mother Name',
            'Mother Occupation',
            'Mother Live Status',
            'Wife Name',
            'Wife Occupation',
            'Wife Education',
            'Marriage date',
            'Spouse Name Of Company',
            'Present Position',
            'No of Brothers',
            'No of Sisters',
            'Brother Position',
            'Sister Position',
            'Overall Position'
           
        ];
    }

    /**
     * @var object $invoice
     */
    public function map($familyDetail): array
    {
       // $this->sl_no = $this->sl_no + 1;
        return [
            $familyDetail->employee_id,
            $familyDetail->father_name,
            $familyDetail->father_occupation,
            $familyDetail->father_live_status,
            $familyDetail->mother_name,
            $familyDetail->mother_occupation,
            $familyDetail->mother_live_status,
            $familyDetail->wife_name,
            $familyDetail->wife_occupation,
            $familyDetail->spouse_education,
            $familyDetail->marriage_date,
            $familyDetail->spouse_nameofcompany,
            $familyDetail->spouse_presentposition,
            $familyDetail->no_of_brothers,
            $familyDetail->no_of_sisters,
            $familyDetail->brother_position,
            $familyDetail->sister_position,
            $familyDetail->overall_position
             
        ];

    }

    /**
     * Description: Some coustom hook into events, The events will be activated by adding the WithEvents concern
     * @return array //return an array of events
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                 

                //inserts 1 new rows, right before row 1:
                //$event->sheet->getDelegate()->insertNewRowBefore(1, 1);

                //Set top row height:
                //$event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);

                //merge two or more cells together, to become one cell
                //$event->sheet->getDelegate()->mergeCells('A1:T1');

                //Set value to merge cells
                //$today = date("j F, Y");
                //Set value to merge cells
                //$event->sheet->getDelegate()->setCellValue("A1", "Dhaka Ice Cream Industries Ltd.\n Employee Lists.\n As On " . $today);

                //$cellRange = 'A2:T2';
                //$event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                //Style to merge cells
                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => 'FFA0A0A0',
                        ],
                        'endColor' => [
                            'argb' => 'FFFFFFFF',
                        ],
                    ],
                ];

                //apply style to merge cells
                //$event->sheet->getDelegate()->getStyle('A1:T1')->applyFromArray($styleArray);

                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'DDDDDDDD'],
                        ],
                    ],
                ];
                //apply style to Header cells
                $event->sheet->getDelegate()->getStyle('A1:T1')->applyFromArray($styleArray);

            },
        ];
    }
}

?>