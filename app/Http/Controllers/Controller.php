<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getPaginateStatus(Request $request): bool
    {
        $paginate = true;
        if ($request->has('paginate') && $request->input('paginate') == 'false') {
            $paginate = false;
        }

        return $paginate;
    }
}
