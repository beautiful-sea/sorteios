@extends('layouts.app')
@section('content')

    <div id="app">
        <div class="app-ganhadores mb-2 ">
            <div class="col-12">
                <div class="app-title"><h1>Termos de Uso</h1>
                </div>
            </div>
            <div class="col-12 m-2" style="background: white; width: 90%; margin: 5% !Important; padding: 2% 3%;">
                {{$termos->value}}
            </div>

        </div>

    </div>

@endsection
