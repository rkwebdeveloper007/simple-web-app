@extends('layouts.master')
@section('content')
<div class="container" style="padding-top:50px;">
   <div class="row">
      <div class="col-12">
         <div class="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-header">
               <h3 class="card-title">Products</h3>
               <div class="card-tools">
                  <a class="btn btn-success" style="color:white;" href="{{route('admin.addProduct')}}">
                  Add Product
                  </a>
               </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
               <button style="margin-bottom: 30px; margin-top:10px; margin-left:20px;" class="btn btn-danger delete_all" data-selected_ids="{{route('admin.selectedProductDelete')}}">Delete All Selected</button>
               <table class="table table-hover text-nowrap">
                  <thead>
                     <tr>
                        <th><input type="checkbox" id="master"></th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Upc</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if(count($products) > 0)
                     @foreach($products as $key=>$product)
                     <tr>
                        <td><input type="checkbox" class="sub_chk" data-id="{{$product->id}}"></td>
                        <td>{{++$key}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->upc}}</td>
                        <td>{{$product->image}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                           @if($product->status === 'Active')
                           <span class="badge bg-success">Active</span>
                           @else 
                           <span class="badge bg-danger">Inactive</span>
                           @endif
                        <td>
                        <td>
                           <a  style="color:white" data-specific_id="{{route('admin.deleteProduct',['id'=>$product->id])}}" id="{{$product->id}}" class="delete_product btn btn-danger" >delete</a>
                        </td>
                     </tr>
                     @endforeach
                     @endif
                  </tbody>
               </table>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
   </div>
</div>

<!----CONFIRMATION MODAL-------->
<div class="modal fade" id="confirmModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type = "text/javascript" >
    $(document).ready(function() {
        $('#master').on('click', function(e) {
            if ($(this).is(':checked', true))
            {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });
    //deleting selected products (ids)
        $('.delete_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            if (allVals.length <= 0)
            {
                alert("Please select row.");
            } else {
                var check = confirm("Are you sure you want to delete this row?");
                if (check == true) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('selected_ids'),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + join_selected_values,
                        success: function(data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });

                    $.each(allVals, function(index, value) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            }
        });
        
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function(event, element) {
                element.trigger('confirm');

            }
        });
    //confirmation message displying before deleting products
        $(document).on('confirm', function(e) {
            var ele = e.target;
            e.preventDefault();
            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });
            return false;

        });

    });

    //delete specific product
    $('.delete_product').click(function(){
        var check = confirm("Are you sure you want to delete this row?");
        if(check == true)
        {
            $.ajax({
                url: $(this).data('specific_id'),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data)
                {
                    if (data['success']) {
                        alert(data['success']);
                        location.reload();
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                }
            })

        }
           
 });
</script>
@endsection
@endsection
