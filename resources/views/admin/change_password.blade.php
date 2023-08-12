@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    
    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <img class="wd-100 rounded-circle" src="{{ (!empty($profile->photo) ? url('/upload/admin_images/'.$profile->photo) : url('no_image.jpg') ) }}" alt="profile">
                    <span class="h4 ms-3">{{ $profile->username }}</span>
                  </div>
           
            </div>
           
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
              <p class="text-muted">{{$profile->name}}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
              <p class="text-muted">{{$profile->email}}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
              <p class="text-muted">{{$profile->phone}}</p>
            </div>
           
            <div class="mt-3 d-flex social-links">
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="github"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="twitter"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
         
            <div class="card">
                <div class="card-body">
  
                                  <h6 class="card-title">Update Password</h6>
  
                                  <form class="forms-sample" action="{{route('admin.savepassword')}}" method="POST" >
                                   @csrf

                                   <div class="mb-3">
                                    <label for="old_password" class="form-label">Old Password</label>
                                    <input type="password" name="old_password" value="{{ old('old_password')}}" class="form-control" id="old_password" autocomplete="off">
                                </div>
                                    @error('old_password')
                                    <span  style="color: red">{{ $message }}</span>
                                    @enderror


                                    <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" name="new_password" value="{{ old('new_password')}}" class="form-control" id="new_password" autocomplete="off">
                                </div>
                                    @error('new_password')
                                    <span  style="color: red">{{ $message }}</span>
                                    @enderror


                                    <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" name="confirm_password" value="{{ old('confirm_password')}}" class="form-control" id="confirm_password" autocomplete="off" >
                                </div>
                                    @error('confirm_password')
                                    <span  style="color: red">{{ $message }}</span>
                                    @enderror
                                    
                                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                                  </form>
  
                </div>
              </div>
          
        </div>
      </div>
     
    </div>

        </div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#photo').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
             $('#show_image').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection