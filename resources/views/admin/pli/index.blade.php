@extends('layouts.admin')

@section('content')


<div class="d-flex justify-content-between mb-3">
    <h2>PLI Management</h2>
        
    <div class="d-flex gap-2">

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            + Add PLI
        </button>
        <!-- 🖨 PRINT BUTTON -->
      <a href="{{ route('pli.print') }}?search={{ request('search') }}&classification={{ request('classification') }}&region={{ request('region') }}&province={{ request('province') }}"
   class="btn btn-danger" target="_blank">
   🖨 Print
</a>

       
    </div>
</div>

<form method="GET" id="filterForm" class="row mb-3">

    <!-- SEARCH -->
    <div class="col-md-3">
        <input type="text"
               name="search"
               id="search"
               class="form-control"
               placeholder="Search code or name..."
               value="{{ request('search') }}">
    </div>

    <!-- CLASSIFICATION -->
    <div class="col-md-3">
        <select name="classification" id="classification" class="form-control">
            <option value="">All Classification</option>
            @foreach([
                'association'=>'Association',
                'banks'=>'Banks',
                'cooperative'=>'Cooperative',
                'cooperative_bank'=>'Cooperative Bank',
                'financial_company'=>'Financial Company',
                'insurance'=>'Insurance',
                'insurance_company'=>'Insurance Company',
                'mutual_aid_system'=>'Mutual Aid System',
                'mutual_benefit_association'=>'Mutual Benefit Association',
                'non_stock_saving_and_loan_association'=>'Non-Stock Saving and Loan Association',
                'teachers_association'=>'Teachers Association'
            ] as $key => $label)
                <option value="{{ $key }}" {{ request('classification')==$key?'selected':'' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- REGION -->
    <div class="col-md-3">
        <select name="region" id="filter_region" class="form-control">
            <option value="">All Region</option>
            @foreach($regions as $r)
                <option value="{{ $r->REGCODE }}" {{ request('region')==$r->REGCODE?'selected':'' }}>
                    {{ $r->Region }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- PROVINCE -->
    <div class="col-md-3">
        <select name="province" id="filter_province" class="form-control">
            <option value="">All Province</option>
            @foreach($provinces as $p)
                @if(!request('region') || $p->Region == request('region'))
                    <option value="{{ $p->ProvID }}" {{ request('province')==$p->ProvID?'selected':'' }}>
                        {{ $p->Province }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>

</form>

<div style="max-height: 350px; overflow-y: auto;">
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>APDS Code</th>
            <th>Name of PLI</th>
            <th>Classification</th>
            <th>Accredited</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($plis as $pli)
        <tr>
            <td>{{ $pli->code }}</td>
            <td>{{ $pli->name }}</td>
            <td>{{ $pli->classification }}</td>
            <td>
                <span class="badge bg-success">{{ $pli->accredited }}</span>
            </td>
            <td>
            <a href="{{ route('pli.show', $pli->id) }}" class="btn btn-info btn-sm">
                View
            </a>
                </button>
                <button 
                    class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#editModal{{ $pli->id }}">
                    Edit
                </button>
            </td>
               
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<div>
@foreach($plis as $pli)
<div class="modal fade" id="editModal{{ $pli->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('pli.update', $pli->id) }}" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5>Edit PLI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <label>Deduction Code:</label>
                <input type="text" name="code" class="form-control" value="{{ $pli->code }}" readonly>

                <label>PLI Name:</label>
                <input type="text" name="name" class="form-control mb-2"
                       value="{{ $pli->name }}" required>

                <label>Classification:</label>
                <select name="classification" class="form-control mb-2">
                    <option value="association" {{ $pli->classification == 'association' ? 'selected' : '' }}>Association</option>
                    <option value="banks" {{ $pli->classification == 'banks' ? 'selected' : '' }}>Banks</option>
                    <option value="cooperative" {{ $pli->classification == 'cooperative' ? 'selected' : '' }}>Cooperative</option>
                    <option value="insurance" {{ $pli->classification == 'insurance' ? 'selected' : '' }}>Insurance</option>
                </select>

                <label>Accredited:</label>
                <select name="accredited" class="form-control">
                    <option value="YES" {{ $pli->accredited == 'YES' ? 'selected' : '' }}>YES</option>
                    <option value="NO" {{ $pli->accredited == 'NO' ? 'selected' : '' }}>NO</option>
                </select>

            </div>

            <div class="modal-footer">
                <button 
                    class="btn btn-warning btn-sm"
                    onclick="confirmEdit({{ $pli->id }})">
                    Edit
                </button>
            </div>

        </form>
    </div>
</div>
@endforeach
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('pli.store') }}" class="modal-content">
        @csrf

        <div class="modal-header">
            <h5>Add PLI</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
           
            @error('code')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="name">Deduction Code: </label>
            <input type="text" name="code" class="form-control" placeholder="PLI Code" required>

            <label for="name">Private Lending Institution Name: </label>
            <input type="text" name="name" class="form-control mb-2" placeholder="PLI Name" required>

            <label for="classification">Classification: </label>
            <select name="classification" class="form-control mb-2">
                <option value="association">Association</option>
                <option value="banks">Banks</option>
                <option value="cooperative">Cooperative</option>
                <option value="cooperative_bank">Cooperative Bank</option>
                <option value="financial_company">Financial Company</option>
                <option value="insurance">Insurance</option>
                <option value="insurance_company">Insurance Company</option>
                <option value="mutual_aid_system">Mutual Aid System</option>
                <option value="mutual_benefit_association">Mutual Benefit Association</option>
                <option value="non_stock_saving_and_loan_association">Non-Stock Saving and Loan Association</option>
                <option value="teachers_association">Teachers Association</option>
            
            </select>

            <Label>Accredited: </Label>
            <select name="accredited" class="form-control mb-2">
                <option value="YES">Yes</option>
                <option value="NO">No</option>
            </select>
        </div>

        <div class="modal-footer">
            <button class="btn btn-success">Save</button>
        </div>
    </form>
  </div>
</div>

<tfoot>
   <div class="mt-3 fw-bold">
    Total PLI: {{ $plis->count() }} |
    
    @foreach($classificationCounts as $type => $count)
        {{ ucfirst(str_replace('_', ' ', $type)) }}: {{ $count }}@if(!$loop->last) | @endif
    @endforeach
</div>

</div>
</tfoot>

@endsection

<script>
function confirmEdit(id) {
    if (confirm("Are you sure you want to edit this PLI?")) {
        var modal = new bootstrap.Modal(document.getElementById('editModal' + id));
        modal.show();
    }
}

function confirmDelete() {
    return confirm("Are you sure you want to delete this PLI?");
}
</script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('filterForm');
    const search = document.getElementById('search');
    const classification = document.getElementById('classification');

    // 🔍 SEARCH AUTO (DEBOUNCE)
    let timer;
    if (search) {
        search.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(() => {
                form.submit();
            }, 500);
        });
    }

    // 🎯 DROPDOWN AUTO SUBMIT (ONCE LANG)
    if (classification) {
        classification.addEventListener('change', function () {
            form.submit();
        });
    }

    const region = document.getElementById('filter_region');
    const province = document.getElementById('filter_province');

    // 🔄 REGION → LOAD PROVINCE
    if (region) {
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

                    form.submit(); // auto refresh
                });
        });
    }

    // 🎯 PROVINCE → AUTO SUBMIT
    if (province) {
        province.addEventListener('change', function () {
            form.submit();
        });
    }

});




</script>
@endpush
