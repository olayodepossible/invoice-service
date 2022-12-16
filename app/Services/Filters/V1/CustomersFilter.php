<?php

namespace App\Services\Filters\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Services\Filters\ApiFilter;

class CustomersFilter extends ApiFilter {

    protected $allowedParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'country' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt'],
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '=<',
        'gt' => '>',
        'gte' => '>=',
    ];

    
    public function transform(Request $request) {
        $eloQuery = [];
        foreach ($this->allowedParams as $param => $operators) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        // Log::info('Returned eloQuery: '. json_encode($eloQuery));
/*
         filtering one param at a time
        if (isset($query)) {
                $column = $this->columnMap[$param] ?? $param;

                foreach ($operators as $operator) {
                    if (isset($query[$operator])) {
                        $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                    }
                }
                return $eloQuery;
        } */
        return $eloQuery;
    }
}