@extends('layouts.adminLayout')

@section('title')
    User Dashboard
@endsection

@section('metaTags')
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Newsletters</h4>

                <a href="{{route('newsletters.create')}}" class="btn btn-primary">Add new</a>
            </div>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Newsletters </h5>
                <x-generic-table :columns="$columns" :items="$newsletters" :routeBaseName="'newsletters'" :allowDelete="FALSE"/>

            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>
        $(document).ready(function() {
            // add for deleting confirmation with confirm alert dialog
            $('.deletingForm').submit(function(e) {
                e.preventDefault();
                var form = this;
                confirm('Are you sure you want to delete this record?') ? form.submit() : true;
            });

        });
    </script>
@endsection
