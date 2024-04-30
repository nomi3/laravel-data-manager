<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInsuredRequest;
use App\Usecases\Insured\Index;
use App\Usecases\Insured\Search;
use App\Usecases\Insured\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InsuredController extends Controller
{
    public function index(
        Index $usecase
    ): View {
        return view('insureds.index', [
            'insureds' => $usecase(),
        ]);
    }

    public function create(): View
    {
        return view('insureds.create');
    }

    public function store(
        StoreInsuredRequest $request,
        Store $usecase
    ): RedirectResponse {
        $result = $usecase($request->file('csv_file'));

        if (! $result) {
            return redirect()->route('insureds.create')->with('error', 'CSVファイルの読み込みに失敗しました。ファイルを確認してください。');
        }

        return redirect()->route('insureds.index')->with('success', 'CSVファイルが正常に処理されました。');
    }

    public function search(
        Request $request,
        Search $usecase
    ): JsonResponse {
        return response()->json($usecase($request->query()));
    }
}
