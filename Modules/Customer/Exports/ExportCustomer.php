<?php
namespace Modules\Customer\Exports;

use Modules\Customer\Entities\Customers;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Bus\Queueable;

class ExportCustomer implements WithHeadings, FromCollection, WithMapping
{
    use Exportable;
    private $request;
    private $data;

    public function __construct($request)
    {
        $this->request = $request;
        $this->data = $this->query();
    }
    
    public function headings(): array
    {
        return [
            trans('customer::customers.export.fullname'),
            trans('customer::customers.export.phone'),
            trans('customer::customers.export.email'),
            trans('customer::customers.export.address'),
            trans('customer::customers.export.created')
        ];
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function map($data): array
    {
        return [
            $data['fullname'],
            $data['phone'],
            $data['email'],
            $data['address'],
            date('d-m-Y H:i:s', strtotime($data['created_at'])),
        ];
    }


    public function query()
    {
        $query = (new Customers())->filter($this->request)->where('type', 'customer');
        return $query->paginate(10000)->items();
    }

}
