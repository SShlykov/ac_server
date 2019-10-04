@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Оповещения</div>

                <div class="card-body" id="dashboard">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Вы вошли в панель администратора, {{Auth::user()->name}}!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
