@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mtop-10">
            <div class="card">

                <div class="card-header">{{ $data['lang']['list'] }}</div>
               
                <div class="card-body">
                    
                    <[TNAME]-list :module="{{json_encode($data)}}"></[TNAME]-list>
                    
                </div> 
            </div>
        </div>
    </div>  
</div>

{{-- [Modal_path] --}}
@endsection
