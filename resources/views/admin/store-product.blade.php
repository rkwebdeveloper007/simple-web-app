@extends('layouts.master')
@section('content')
<div class="container" style="padding-top:50px;">
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
   <form action="{{route('admin.storeProduct')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
         <div class="col">
            <div class="mb-3">
               <label for="exampleFormControlInput1" class="form-label">Name</label>
               <input type="text" class="form-control" name="name" id="exampleFormControlInput1" placeholder="Name">
               @if ($errors->has('name'))
               <span class="text-danger">{{ $errors->first('name') }}</span>
               @endif
            </div>
         </div>
         <div class="col">
            <div class="mb-3">
               <label for="exampleFormControlInput1" class="form-label">Price</label>
               <input type="text" class="form-control" name="price" id="exampleFormControlInput1" placeholder="Price">
               @if ($errors->has('price'))
               <span class="text-danger">{{ $errors->first('price') }}</span>
               @endif
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col">
            <div class="mb-3">
               <label for="exampleFormControlInput1" class="form-label">Unique Product Code</label>
               <input type="text" class="form-control" name="upc" id="exampleFormControlInput1" placeholder="Product code">
               @if ($errors->has('upc'))
               <span class="text-danger">{{ $errors->first('upc') }}</span>
               @endif
            </div>
         </div>
         <div class="col">
            <div class="mb-3">
               <label for="exampleFormControlInput1" class="form-label">Status</label>
               <select  class="form-control" name="status">
                  <option value="">Select Status</option>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
               </select>
               @if ($errors->has('status'))
               <span class="text-danger">{{ $errors->first('status') }}</span>
               @endif
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col">
            <div class="mb-3">
               <label for="exampleFormControlInput1" class="form-label">Upload Product Image</label>
               <input type="file" class="form-control"  name="image">
               @if ($errors->has('image'))
               <span class="text-danger">{{ $errors->first('image') }}</span>
               @endif
            </div>
         </div>
         <div class="col">
         </div>
      </div>
      <div class="row">
         <div class="col">
            <button  type="submit" value="submit" class="btn btn-success" style="width:150px;">Save</button>
         </div>
         <div class="col">
         </div>
         <div class="col">
         </div>
      </div>
   </form>
</div>
@endsection
