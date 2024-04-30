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
        $result = $usecase($request->file('csv_file'));

        if (!$result) {
            return redirect()->route('insureds.create')->with('error', 'CSVファイルの読み込みに失敗しました。ファイルを確認してください。');
        }

        return redirect()->route('insureds.index')->with('success', 'CSVファイルが正常に処理されました。');
    }

    public function search(
        Request $request,
        Search $usecase
    ) {
        return response()->json($usecase($request->query()));
    }
}
