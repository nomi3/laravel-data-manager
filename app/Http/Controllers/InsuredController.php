<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInsuredRequest;
use App\Models\Insured;
use App\Usecases\Insured\Search;
use App\Usecases\Insured\Store;
use Illuminate\Http\Request;

class InsuredController extends Controller
{
    public function index()
    {
        $insureds = Insured::all();

        return view('insureds.index', [
            'insureds' => $insureds,
        ]);
    }

    public function create()
    {
        return view('insureds.create');
    }

    public function store(
        StoreInsuredRequest $request,
        Store $usecase
    ) {
        $usecase($request->file('csv_file'));

        return redirect()->route('insureds.index');
    }

    public function search(
        Request $request,
        Search $usecase
    ) {
        return response()->json($usecase($request->query()));
    }
}
