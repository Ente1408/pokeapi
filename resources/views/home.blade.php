@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>

            </div>

            <table id="pokeapi" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Favorite</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Favorite</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
