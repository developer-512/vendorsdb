<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @can('vendors_access')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vendors </h5>
                    <p class="card-text">{{$total_v}} Total Vendors' data in this system</p>
                    <a href="{{route('vendors.index')}}" class="btn btn-primary">Vendors List</a>
                    <a href="{{route('vendors.create')}}" class="btn btn-info">Add New Vendor</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vendors Categories</h5>
                    <p class="card-text">{{$total_cat}} Total Vendors' Categories in System</p>
                    <a href="{{route('categories.index')}}" class="btn btn-primary">Categories List</a>
                    <a href="{{route('categories.create')}}" class="btn btn-info">Add New Category</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">Type here for Search Vendor</h5>
                    <form action="{{route('vendors.index')}}" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search Here" name="q" id="searchq" aria-label="Search Here" aria-describedby="basiaddon2">
                            <input type="submit" value="Search" class="btn btn-primary" id="sbmt-btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">Export All Vendors in Excel Format</h5>
                    <a href="{{route('vendors.exportexcel')}}" class="btn btn-primary">Export</a>
                </div>
            </div>
        </div>
    </div>
</div>
    @endcan
</x-app-layout>