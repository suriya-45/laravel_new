@extends('admin.admin_dashboard')
@section('admin')

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<div class="page-content">

    
    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <img class="wd-100 rounded-circle" src="{{ (!empty($profile->photo) ? url('/upload/admin_images/'.$profile->photo) : url('no_image.jpg') ) }}" alt="profile">
                    <span class="h4 ms-3 text-dark">{{ $profile->username }}</span>
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
  
                                  <h6 class="card-title">Basic Form</h6>
  
                                  <form class="forms-sample" action="{{route('admin.profilestore')}}" method="POST" enctype="multipart/form-data">
                                   @csrf
                                    <div class="mb-3">
                                          <label for="exampleInputUsername1" class="form-label">Name</label>
                                          <input type="text" name="name" value="{{ $profile->name}}" class="form-control" id="name" autocomplete="off" placeholder="Username">
                                      </div>
                                      <div class="mb-3">
                                          <label for="exampleInputEmail1" class="form-label">Email</label>
                                          <input type="email" name="email" value="{{ $profile->email}}" class="form-control" id="email" placeholder="Email">
                                      </div>
                                      
                                      <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $profile->phone}}" id="phone" autocomplete="off" placeholder="Phone">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Profile</label>
                                        <input type="file" name="photo" class="form-control" id="photo">
                                    </div>
                                        <div class="mb-3">
                                            <img id="show_image" class="wd-70 rounded-circle" src="{{ (!empty($profile->photo) ? url('/upload/admin_images/'.$profile->photo) : url('no_image.jpg') ) }}" alt="profile">
                                          </div>
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