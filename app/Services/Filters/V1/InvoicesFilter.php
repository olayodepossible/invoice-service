<?php

namespace App\Services\Filters\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Services\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter {

    protected $allowedParams = [
        'customerId' => ['eq'],
        'status' => ['eq', 'ne'],
        'amount' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'billedDate' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'paidDate' => ['eq', 'gt', 'lt', 'lte', 'gte'],
    ];

    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '=<',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!=',
    ];
}