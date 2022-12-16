<?php

namespace App\Services\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiFilter {

    protected $allowedParams = [];

    protected $columnMap = [];

    protected $operatorMap = [];

    
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