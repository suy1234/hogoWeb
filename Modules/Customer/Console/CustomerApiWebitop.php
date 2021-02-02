<?php

namespace Modules\Customer\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Modules\Customer\Entities\CustomerWebitop;

class CustomerApiWebitop extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'erp:create_customer_by_api_webitops';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create customer by api webitops';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Config::set('database.connections.mysql.database', config('erp.database_default'));
        $api = config('erp.api.web_itop');
        $http = new \GuzzleHttp\Client;
        $response = $http->get($api['url']. '/get-websites/'.$api['partner'].'?page=1', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => $api['key'],
            ],
        ]);
        $data = json_decode((string) $response->getBody(), true);
        $data['recordsTotal'] = $data['total'];
        $data['recordsFiltered'] = $data['total'];
        $data_api = collect($data['data']);
        $phone_emails = $data_api->pluck('email', 'phone')->toArray();

        $data_phone_itops = CustomerWebitop::whereIn('phone', array_keys($phone_emails))->orWhereIn('email', array_values($phone_emails))->get()->pluck('phone');
        if(count($data_phone_itops)){
            foreach ($data_phone_itops as $phone) {
                if(!empty($phone_emails[$phone])){
                    unset($phone_emails[$phone]);
                }
            }
        }
        if(count($phone_emails)){
            $data_customers = $data_api->map(function ($customer, $key) {
                $item = array_merge($customer, [
                    'domain' => $customer['primary_domain'],
                    'domain_demo' => $customer['domain'],
                    'fullname' => $customer['full_name'],
                    'expired_at' => $customer['expire_date'],
                ]);
                unset($item['full_name']);
                unset($item['primary_domain']);
                unset($item['expire_date']);
                return $item;
            })->toArray();
            CustomerWebitop::insert($data_customers);
        }
    }
}
