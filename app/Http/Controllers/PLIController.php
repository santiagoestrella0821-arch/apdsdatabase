<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PLI;
use App\Models\Region;
use App\Models\Province;
use App\Models\Coverage;
use App\Models\Division;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;




class PLIController extends Controller
{
    //

  public function index(Request $request)
{
    $query = PLI::where('accredited', 'YES');

    // 🔍 SEARCH
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('code', 'like', '%' . $request->search . '%')
              ->orWhere('name', 'like', '%' . $request->search . '%');
        });
    }

    // 🎯 CLASSIFICATION
    if ($request->classification) {
        $query->where('classification', $request->classification);
    }

    // 🎯 REGION
    if ($request->region) {
        $query->whereHas('coverages', function ($q) use ($request) {
            $q->where('region', $request->region);
        });
    }

    // 🎯 PROVINCE
    if ($request->province) {
        $query->whereHas('coverages', function ($q) use ($request) {
            $q->where('prov_id', $request->province);
        });
    }

    // ✅ GET DATA
    $plis = $query->get();

    // ✅ CLONE QUERY FOR COUNTS (IMPORTANT)
    $classificationCounts = (clone $query)
        ->select('classification', DB::raw('COUNT(*) as total'))
        ->groupBy('classification')
        ->pluck('total', 'classification');

    // ✅ ADD THESE (FIX ERROR)
    $regions = Region::all();
    $provinces = Province::all();

    return view('admin.pli.index', compact(
        'plis',
        'classificationCounts',
        'regions',
        'provinces'
    ));
}

public function print(Request $request)
{
    $query = PLI::where('accredited', 'YES');

    // 🔍 SEARCH
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('code', 'like', '%' . $request->search . '%')
              ->orWhere('name', 'like', '%' . $request->search . '%');
        });
    }

    // 🎯 CLASSIFICATION
    if ($request->classification) {
        $query->where('classification', $request->classification);
    }

    // 🎯 REGION
    if ($request->region) {
        $query->whereHas('coverages', function ($q) use ($request) {
            $q->where('region', $request->region);
        });
    }

    // 🎯 PROVINCE
    if ($request->province) {
        $query->whereHas('coverages', function ($q) use ($request) {
            $q->where('prov_id', $request->province);
        });
    }

    $plis = $query->get();

    $pdf = Pdf::loadView('admin.pli.print', compact('plis'));

    return $pdf->stream('pli.pdf');
}

public function destroy($id)
{
    Coverage::findOrFail($id)->delete();

    return back()->with('success', 'Coverage deleted successfully!');
}



public function show(Request $request, $id)
{
    $pli = PLI::findOrFail($id);

    $query = DB::table('coverages')
        ->leftJoin('regions', 'coverages.region', '=', 'regions.REGCODE')
        ->leftJoin('provinces', 'coverages.prov_id', '=', 'provinces.ProvID')
        ->leftJoin('divisions', function ($join) {
            $join->on('coverages.region', '=', 'divisions.Region')
                 ->on('coverages.prov_id', '=', 'divisions.Province')
                 ->on('coverages.div_code', '=', 'divisions.DivCode');
        })
        ->where('coverages.ded_code', $pli->code);

    // 🔍 SEARCH
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('regions.Region', 'like', '%' . $request->search . '%')
              ->orWhere('provinces.Province', 'like', '%' . $request->search . '%')
              ->orWhere('divisions.DivName', 'like', '%' . $request->search . '%');
        });
    }

    // 🎯 FILTER REGION
    if ($request->region) {
        $query->where('coverages.region', $request->region);
    }

    // 🎯 FILTER PROVINCE
    if ($request->province) {
        $query->where('coverages.prov_id', $request->province);
    }

    $coverages = $query->select(
    'coverages.id', 
    'regions.Region as region_name',
    'provinces.Province as province_name',
    'divisions.DivName as division_name'
)->get();

    $regions = Region::all();
    $provinces = Province::all();

    return view('admin.pli.view', compact(
        'pli',
        'coverages',
        'regions',
        'provinces'
    ));
}

public function store(Request $request)
{
    $request->validate([
    'code' => 'required|unique:plis,code',
    'name' => 'required',
    'classification' => 'required',
    'accredited' => 'required',
]);

    PLI::create([
        'code' => $request->code,
        'name' => $request->name,
        'classification' => $request->classification,
        'accredited' => $request->accredited,
    ]);

    return redirect()->route('pli.index')->with('success', 'PLI added successfully');
}

public function update(Request $request, $id)
{
    $request->validate([
        'code' => 'required|unique:plis,code,' . $id,
        'name' => 'required',
        'classification' => 'required',
        'accredited' => 'required',
    ]);

    $pli = \App\Models\PLI::findOrFail($id);

    $pli->update([
        'code' => $request->code,
        'name' => $request->name,
        'classification' => $request->classification,
        'accredited' => $request->accredited,
    ]);

    return redirect()->route('pli.index')->with('success', 'PLI updated successfully');
}
public function coverages()
{
    return $this->hasMany(Coverage::class, 'ded_code', 'code');
}

    
}
