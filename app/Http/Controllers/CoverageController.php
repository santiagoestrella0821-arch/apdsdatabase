<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coverage;
use App\Models\PLI;
use App\Models\Region;
use App\Models\Province;
use App\Models\Division; 
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;



class CoverageController extends Controller
{

    public function index()
    {
    $plis = PLI::all();
    $coverages = Coverage::all();
    $regions = Region::all(); 
    $provinces = Province::all(); 

        
    return view('admin.coverage.index', compact(
        'plis',
        'coverages',
        'regions',
        'provinces'
    ));
    }



    public function destroy($id)
    {
        Coverage::findOrFail($id)->delete();

        return back()->with('success', 'Coverage deleted successfully!');
    }


   public function store(Request $request)
    {
    $request->validate([
        'pli' => 'required',
        'region' => 'required',
        'province' => 'required',
    ]);
   //dd($request->region, $request->province);
    $exists = Coverage::where('ded_code', $request->pli)
        ->where('prov_id', $request->province)
        ->exists();

    if ($exists) {
        return back()->with('error', 'Entity already exists in that Province.');
    }

   $divisions = Division::where('Region', $request->region)
    ->where('Province', $request->province) 
    ->get();

    if ($divisions->isEmpty()) {
        return back()->with('error', 'No divisions found (check data).');
    }

    foreach ($divisions as $div) {
        Coverage::create([
            'region' => $div->Region,
            'prov_id' => $div->Province,
            'div_code' => $div->DivCode, 
            'ded_code' => $request->pli,
            'added_by' => auth()->user()->name ?? 'system',
            'date_time_added' => now(),
        ]);
    }

    return back()->with('success', 'Coverage added successfully!');
    }

    public function getProvinces($region)
    {
        $provinces = Province::where('Region', $region)->get();

        return response()->json($provinces);
    }

    public function print($id)
{
    $pli = PLI::findOrFail($id);

    $coverages = DB::table('coverages')
    ->leftJoin('regions', 'coverages.region', '=', 'regions.REGCODE')
    ->leftJoin('provinces', 'coverages.prov_id', '=', 'provinces.ProvID')
    ->leftJoin('divisions', function ($join) {
        $join->on('coverages.region', '=', 'divisions.Region')
             ->on('coverages.prov_id', '=', 'divisions.Province')
             ->on('coverages.div_code', '=', 'divisions.DivCode');
    })
    ->where('coverages.ded_code', $pli->code)
    ->select(
        'regions.Region as region_name',
        'provinces.Province as province_name'
    )
    ->orderBy('regions.Region')
    ->orderBy('provinces.Province')
    ->distinct()
    ->get()
    ->groupBy('region_name'); // ✅ FI

    $pdf = Pdf::loadView('admin.coverage.print', compact('pli', 'coverages'));

    return $pdf->stream('coverage.pdf');
}

    

    
}


