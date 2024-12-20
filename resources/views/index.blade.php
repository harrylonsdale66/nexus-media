@extends('_layout')
@section('title', 'NexusMedia Test')

@section('content')

<div class="container-fluid">

    <div class="page-layout-header">
        <h1 class="page-layout-title">Orders page</h1>
    </div>
    <div class="page-layout-section">
        <div class="card">
            <div class="card-header">
                <div class="card-heading align-items-center">
                    <h2 class="card-title mb-0">To update data, click the button "Import"</h2>
                    @if(Session::has('success'))
                        <span class="badge badge-success">{{ Session::get('success') }}</span>
                    @else
                        <a href="{{ route('import') }}" class="btn btn-primary">Import</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card">
            <div class="index-table-wrapper">
                <div class="index-table-inner">
                    <div class="index-table-header-action">
                        <div class="index-table-header-inner">
                            <div class="form-checkbox">
                                <label>
                                    <input type="checkbox">
                                    <span class="checkbox-icon"></span>
                                    <span class="label-text">2 Selected</span>
                                </label>
                            </div>
                            <button class="link">Cancel</button>
                        </div>
                    </div>
                    <div class="index-table-header-filter">
                        <div class="col-left">
                            <div class="form-input">
                                <input id="search" type="search" class="input-icon icon-search" placeholder="Search by Financial status..">
                            </div>
                        </div>
                    </div>
                    <table id="data-table" class="index-table">
                        <thead>
                            <tr>
                                <th>Customer name</th>
                                <th>Customer email</th>
                                <th>Total price</th>
                                <th>Financial status</th>
                                <th>Fulfillment status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
