@extends('admin.app.app_admin')


@section('title')
{{-- type the title --}}

@endsection

@section('subtitle')
{{-- type the Subtitle --}}

@endsection
   
   


@section('main_content_admin')

   {{-- place your content here --}}
   <div class="row row-sm mg-t-20">
      <div class="col-xl-5">
        <div class="card pd-20 pd-sm-40 form-layout form-layout-4">

            <h6 class="card-body-title mg-b-20 mg-sm-b-30">Add an Administrator</h6>
            <form action="{{ route('role_manage_search') }}" method="POST">
               @csrf
                  <div class="row">
                     <label class="col-sm-4 form-control-label">Search Email: <span class="tx-danger"></span></label>
                     <div class="col-sm-8 mg-t-10 mg-sm-t-0 mg-b-20">
                        <div class="input-group">
                           <input type="text" class="form-control" name="email" placeholder="example@example.com...">
                           <span class="input-group-btn">
                           <button class="btn bd bg-white tx-gray-600" type="submit"><i class="fa fa-search"></i></button>
                           </span>
                        </div><!-- input-group -->
                     </div>
                  </div>

                  <div class="row">
                     <label class="col-sm-4 form-control-label">Search by Number: <span class="tx-danger">*</span></label>
                     <div class="col-sm-8 mg-t-10 mg-sm-t-0 mg-b-20">
                        <div class="input-group">
                           <input type="text" class="form-control" name="phone" placeholder="Search for...">
                           <span class="input-group-btn">
                           <button class="btn bd bg-white tx-gray-600" type="submit"><i class="fa fa-search"></i></button>
                           </span>
                        </div><!-- input-group -->
                     </div>
                  </div>
            </form>
        </div><!-- card -->
      </div><!-- col-6 -->

      @if ($user = session()->get('user'))
         <div class="col-xl-7">
            <div class="card pd-20 pd-sm-40">
               <div class="col-xl-5 m-auto">
                  <img class="card-img-top img-fluid" src="{{ asset('../admin/img/img12.jpg') }}" alt="Image">
                  <div class="card-body">
                     <h6 class="mg-b-3"><a href="" class="tx-dark">{{ $user->name }}</a></h6>
                     <span class="tx-12">{{ $user->role_id }}</span>
                  </div>
               </div>  
               <div class="table-responsive">
               <table class="table mg-b-0">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                     </tr>
                  </thead>
                  <tbody>
                        <tr>
                           <td>{{ $user->name }}</td>
                           <td>{{ $user->email }}</td>
                           <td>{{ $user->phone }}</td>
                           <td>{{ $user->gender }}</td>
                        </tr>
                  </tbody>
               </table>
               
               <form action="{{ route("admin_add", $user->id) }}" method="POST">
                  @csrf
                  <div class="d-flex align-items-center justify-content-center bg-gray-100 ht-md-80 bd">
                     <div class="d-md-flex pd-y-20 pd-md-y-0">
                      <label for="">Choose Role</label>
                       <select name="role_id" class="form-control select2" data-placeholder="Choose Browser" style="height: calc(2.39375rem + 12px)">
                           <option label="Choose any.."></option>
                              @foreach ($admin_roles as $role)
                                 <option value="{{ $role->id }}">{{ $role->role_title }}</option>
                              @endforeach
                           </select>
                        <button type="submit" class="btn btn-sm btn-primary btn-icon">
                           done
                         </button>
                     </div>
                   </div><!-- d-flex -->
               </form>
               </div>
            </div><!-- card -->

          
         </div> 
      @endif
         



   </div><!-- row -->

   



@endsection

