@extends('layouts.master')
@section('content')
<div class="container" style="padding-top:50px;">
   <div class="row">
       <div class="col-12">
            
            <h1 style="text-align:center;">{{ auth()->user()->name }}</h1>
           
        </div>
    </div>
</div>

@endsection