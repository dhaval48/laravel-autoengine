@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mtop-10">
            <div class="card">
            
            @if(!isset($data['lists'])) 
                <div class="card-header">
                    
                    {{ $data['id'] != 0 ? $data['lang']['edit_title'] : $data['lang']['create_title'] }}
                </div>

            @else

                <div class="card-header">{{ $data['lang']['list'] }}</div>
               
            @endif
                <div class="card-body">
                    <language_translets-view :module="{{json_encode($data)}}"></language_translets-view>
                    
                </div> 
            </div>
        </div>
    </div>  
</div>


{{-- [Modal_path] --}}
@endsection
