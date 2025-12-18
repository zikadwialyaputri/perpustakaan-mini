@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <h3>Dashboard Staff</h3>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6>Total Buku</h6>
                    <h3>{{ $totalBuku }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
