@extends('layouts.admin')

@section('content')

<h4>Coverage Management</h4>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('coverage.store') }}">
    @csrf

    <select name="pli" class="form-control mb-2">
    <option value="">Select PLI</option>
    @foreach($plis as $pli)
        <option value="{{ $pli->code }}">{{ $pli->name }}</option>
    @endforeach
    </select>

    <select name="region" id="region" class="form-control mb-2">
        <option value="">Select Region</option>
        @foreach($regions as $r)
            <option value="{{ $r->REGCODE }}">{{ $r->Region }}</option>
        @endforeach
    </select>

    <select name="province" id="province" class="form-control mb-2">
        <option value="">Select Province</option>
    </select>
        <button class="btn btn-primary">Add Coverage</button>

    </form>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const region = document.getElementById('region');
    const provinceDropdown = document.getElementById('province');

    region.addEventListener('change', function () {

        let value = this.value;

        if (!value) {
            provinceDropdown.innerHTML = '<option value="">Select Province</option>';
            provinceDropdown.disabled = true;
            return;
        }

        fetch('/get-provinces/' + value)
            .then(response => response.json())
            .then(data => {

                provinceDropdown.disabled = false;
                provinceDropdown.innerHTML = '<option value="">Select Province</option>';

                data.forEach(function (item) {
                    provinceDropdown.innerHTML += `
                        <option value="${item.ProvCode}">
                            ${item.Province}
                        </option>
                    `;
                });

            });
    });

});
</script>

@endsection