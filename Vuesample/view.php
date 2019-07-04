@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mtop-10">
            <div class="card">
            
            @if(!isset($data['lists'])) 
                <div class="card-header">                    
                    <a class="card-title theme-color" href="{{ $data['list_route'] }}"> 
                        <div class="back-arrow theme-color">&lsaquo;</div>
                        <div class="card-header-text">
                            {{ $data['id'] != 0 ? $data['lang']['edit_title'] : $data['lang']['create_title'] }}
                        </div>
                    </a>
                </div>

            @else

                <div class="card-header">{{ $data['lang']['list'] }}</div>
               
            @endif
                <div class="card-body">
                    
                    <[TNAME]-view :module="{{json_encode($data)}}"></[TNAME]-view>
                    
                </div> 
            </div>
        </div>
    </div>  
</div>

{{-- [Modal_path] --}}
@endsection
