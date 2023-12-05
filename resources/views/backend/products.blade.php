@extends("layouts.admin.app")
@section('dashboard')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card mt-5">
        <div class="card-body">

            @if(Session::has("success"))
            <p class='alert alert-success my-2'>{{Session::get("success")}} <button class='close' data-dismiss="alert">&times;</button> </p>

            @endif
           
            <p class="card-title mb-0">Products</p>
            <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                Add New product
              </button>

              <!-- Modal -->
              <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New product</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{route('products.upload')}}" id='noticeForm' method='POST' enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Product Title:</label>
                            <input type="text" value="" name='product_title' class='form-control mb-3'>
                        </div>
                        <div class="form-group">
                            <label for="">Product Images:</label>
                            <input type="file" name='product_image' class='form-control mb-3'>
                        </div>
                        <div class="form-group">
                          <label for="">Images 2:</label>
                          <input type="file" name='images2' class='form-control mb-3'>
                      </div>

                      <div class="form-group">
                        <label for="">Images 3:</label>
                        <input type="file" name='images3' class='form-control mb-3'>
                    </div>
                        <div class="form-group">
                            <label for="">Product Description:</label>
                            <textarea type="text" name='product_description'  class='form-control mb-3'></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value='Upload Product' class='btn btn-info addNotice'>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
           
              <input type="text" name="search" id='searchId' placeholder="Search here...." class='form-control my-3'>
              <div id="msg" class='my-4'>

              </div>
                                
          <div class="table-responsive" id="data-table">
            <table style='overflow-x: visiable;' class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th>#.</th>
                  <th>Notice Title</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Upload Time</th>
                  <th>Action</th>
                </tr>  
              </thead>
              <tbody>
              

                @php
                $i=0;
            @endphp

            @foreach($products as $post)
    

            @php
                $i++;
            @endphp
                

                
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$post->product_name}}</td>
                  <td style='width: 100%;'><p>{{$post->product_description}}</p></td>
                  <td><img style="width: 200px;" src="{{URL::asset('uploads/products/'. $post->product_images)}}" alt=""></td>
                  <td></td>
                  <td>
                    {{-- here is the edit modal --}}
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn sm" data-toggle="modal" data-target="#staticBackdrop2">
                      Edit 
                    </button>
                    <div class="modal fade editModal" id="staticBackdrop2" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdrop2Label">Edit Notice</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="{{route('products.update', $post->id)}}" id="formupdate" method='POST' enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="up_id" value="{{$post->id}}">
                              <div class="form-group">
                                  <label for="up_notice_title">Notice Title:</label>
                                  <input type="text" value="{{$post->product_name}}" name='up_product_title' id="up_product_title" class='form-control mb-3'>
                              </div>
                              <div class="form-group">
                                  <label for="up_notice_image">Notice Image:</label>
                                  <input type="file" name='up_product_image' id="up_notice_image" class='form-control mb-3'>
                              </div>

                              <div class="form-group">
                                <label for="">Images 2:</label>
                                <input type="file" name='images2' class='form-control mb-3'>
                            </div>
      
                            <div class="form-group">
                              <label for="">Images 3:</label>
                              <input type="file" name='images3' class='form-control mb-3'>
                          </div>
                              <div class="form-group">
                                  <label for="up_product_description">Notice Description:</label>
                                  <textarea type="text" name='up_product_description' id="up_notice_description" class='form-control mb-3'>{{$post->product_description}}</textarea>
                              </div>
                             
                              <div class="form-group">
                                  <input type="submit" value='Update Notice' class='btn btn-primary btn-sm updateNotice'>
                              </div>
                          </form>  
                  
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
        
                  
                    <form action="{{route('delete.products')}}" id="deleteNotice" method='POST'>
                      @csrf
                      <input type="hidden" name="delete_id" value="{{$post->id}}">
                      <input type="submit" class='btn btn-danger btn-sm' value="Delete">
                    </form>
                    
                  </td>    
                </tr>
                @endforeach
               
              </tbody>
            </table>
       
           
          </div>
          
        </div>
      </div>
    </div>
</div>


@endsection