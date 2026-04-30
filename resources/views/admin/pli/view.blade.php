@extends('layouts.admin')

@section('content')

<h3>PLI Details</h3>

<button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addCoverageModal">
    + Add Coverage
</button>

<div class="card p-3 mb-3">

    <label>Deduction Code:</label>
    <input type="text" class="form-control mb-2" value="{{ $pli->code }}" readonly>

    <label>PLI Name:</label>
    <input type="text" class="form-control mb-2" value="{{ $pli->name }}" readonly>

</div>

<div class="card p-3 mb-3">

    <form method="GET" id="filterForm">

        <div class="row g-2">

            <!-- SEARCH -->
            <div class="col-md-3">
                <input type="text" name="search"
                       class="form-control auto-filter"
                       placeholder="Search..."
                       value="{{ request('search') }}">
            </div>

            <!-- REGION -->
            <div class="col-md-3">
                <select name="region" id="filter_region" class="form-control auto-filter">
                    <option value="">All Region</option>
                    @foreach($regions as $r)
                        <option value="{{ $r->REGCODE }}"
                            {{ request('region') == $r->REGCODE ? 'selected' : '' }}>
                            {{ $r->Region }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- PROVINCE -->
            <div class="col-md-3">
                <select name="province" id="filter_province" class="form-control auto-filter">
                    <option value="">All Province</option>
                    @foreach($provinces as $p)
                        <option value="{{ $p->ProvID }}"
                            {{ request('province') == $p->ProvID ? 'selected' : '' }}>
                            {{ $p->Province }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- BUTTONS -->
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary w-50">Filter</button>

                <a href="{{ route('pli.show', $pli->id) }}"
                   class="btn btn-secondary w-50">
                    Clear
                </a>
            </div>

        </div>

    </form>

</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    
    <h4 class="mb-0">Coverage List</h4>

   <a href="{{ route('coverage.print', $pli->id) }}"
   target="_blank"
   class="btn btn-primary">
    🖨️ Print PDF
    </a>

</div>

<div style="max-height: 300px; overflow-y: auto;">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Region</th>
                <th>Province</th>
                <th>Division</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($coverages as $c)
            <tr>
                <td>{{ $c->region_name }}</td>
                <td>{{ $c->province_name }}</td>
                <td>{{ $c->division_name ?? '-' }}</td>
                <td>
                <form method="POST"
                    action="{{ route('coverage.destroy', $c->id) }}"
                    onsubmit="return confirm('Are you sure you want to delete this coverage?')">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm">
                        Delete
                    </button>
                </form>
            </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">No coverage found</td>
            </tr>
            @endforelse
      </tbody>
    </table>
</div>


<h4>Verifier List</h4>

<table class="table table-bordered">
    <thead class="table-dark"> 
        <tr>
            <th>Name</th>
            <th>Region</th>
            <th>Province</th>
        </tr>
    </thead>

    <tbody>
        <!-- future data -->
        <tr>
            <td colspan="3" class="text-center">No verifiers yet</td>
        </tr>
    </tbody>
</table>


<div class="modal fade" id="addCoverageModal">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('coverage.store') }}" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5>Add Coverage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- AUTO -->
                <label>Deduction Code:</label>
                <input type="text" class="form-control mb-2" value="{{ $pli->code }}" readonly>

                <label>PLI Name:</label>
                <input type="text" class="form-control mb-2" value="{{ $pli->name }}" readonly>

                <input type="hidden" name="pli" value="{{ $pli->code }}">

                <!-- REGION -->
                <label>Region:</label>
                 <select name="region" id="region" class="form-control mb-2">
                    <option value="">Select Region</option>
                    @foreach($regions as $r)
                        <option value="{{ $r->REGCODE }}">{{ $r->Region }}</option>
                    @endforeach
                </select>

                <label>Province:</label>
                <select name="province" id="province" class="form-control mb-2">
                    <option value="">Select Province</option>
                </select>

            </div>

            <div class="modal-footer">
                <button class="btn btn-success">Save</button>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('filterForm');

    const region = document.getElementById('filter_region');
    const province = document.getElementById('filter_province');
    const search = document.querySelector('input[name="search"]');

    // =========================
    // 🔹 FILTER REGION → LOAD PROVINCE
    // =========================
    if(region){
        region.addEventListener('change', function () {

            fetch('/get-provinces/' + this.value)
                .then(res => res.json())
                .then(data => {

                    province.innerHTML = '<option value="">All Province</option>';

                    data.forEach(item => {
                        province.innerHTML += `
                            <option value="${item.ProvID}">
                                ${item.Province}
                            </option>
                        `;
                    });

                });

        });
    }

    // =========================
    // 🔹 FILTER PROVINCE → SUBMIT
    // =========================
    if(province){
        province.addEventListener('change', function () {
            form.submit();
        });
    }

    // =========================
    // 🔹 SEARCH AUTO SUBMIT
    // =========================
    let timer = null;

    if(search){
        search.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(() => {
                form.submit();
            }, 500);
        });
    }

    // =========================
    // 🔥 MODAL REGION → LOAD PROVINCE
    // =========================
    const modalRegion = document.getElementById('region');
    const modalProvince = document.getElementById('province');

    if (modalRegion) {
        modalRegion.addEventListener('change', function () {

            fetch('/get-provinces/' + this.value)
                .then(res => res.json())
                .then(data => {

                    modalProvince.innerHTML = '<option value="">Select Province</option>';

                    data.forEach(item => {
                        modalProvince.innerHTML += `
                            <option value="${item.ProvID}">
                                ${item.Province}
                            </option>
                        `;
                    });

                });

        });
    }

});
</script>
@endpush