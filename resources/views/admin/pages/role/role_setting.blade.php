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
      {{-- new role adding form --}}
      <div class="col-xl-5">
        <div class="card pd-20 pd-sm-40 mg-t-20">
            <form action="{{ route("role_submit") }}" method="POST">
               @csrf
               <div class="form-layout">
                  <div class="row mg-b-25">
                  <div class="col-lg-4">
                     <div class="form-group">
                        <label class="form-control-label">Role Title: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="role_title" value="{{ old('role_title') }}" placeholder="Admin....">
                     </div>
                  </div><!-- col-4 -->

                  <div class="col-lg-4">
                     <div class="form-group">
                        <label class="form-control-label">age: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="date" name="date" value="{{ old('date') }}" placeholder="Admin....">
                     </div>
                  </div><!-- col-4 -->

                  <div class="col-lg-4">
                     <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Choose Authority: <span class="tx-danger">*</span></label>
                        <select class="form-control select2" data-placeholder="Choose authority" name="role_authority">
                        <option label="Choose authority"></option>
                        <option value="1">Top</option>
                        <option value="2">Good</option>
                        <option value="3">Average</option>
                        <option value="4">Basic</option>
                        <option value="5">No</option>
                        </select>
                     </div>
                  </div><!-- col-4 -->
                  </div><!-- row -->
      
                  <div class="form-layout-footer">
                  <button type="submit" class="btn btn-info mg-r-5">Submit Form</button>
                  <button class="btn btn-secondary">Cancel</button>
                  </div><!-- form-layout-footer -->
               </div><!-- form-layout -->
            </form>
         </div>
      </div>

      <div class="col-xl-7">
         {{-- role list --}}
         <div class="card  pd-20 pd-sm-40 mg-t-20">
            <h6 class="card-body-title">List of All Roles</h6>
         
            <div class="table-responsive">
              <table class="table mg-b-0">
                <thead>
                  <tr>
                    <th>SL No.</th>
                    <th>Role</th>
                    <th>Authority</th>
                    <th>Active</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roles as $role)
                      
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->role_title }}</td>
                        <td>
                           @php
                               switch ($role->role_authority) {
                                 case 1:
                                    echo 'Top';
                                    break;
                                 case 2:
                                    echo 'Good';
                                    break;
                                 case 3:
                                    echo 'Average';
                                    break;
                                 case 4:
                                    echo 'Basic';
                                    break;
                                 default:
                                    echo 'No';
                                    break;
                              }
                           @endphp
                        </td>
                        <td>{{ $role->active === 1 ? "On" : "Off" }}</td>
                        <td>
                           <a href="{{ route('role_del',$role->id) }}" class="btn btn-danger btn-icon">
                              <div><i class="fa fa-trash"></i></div>
                            </a>
                        </td>
                      </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div><!-- card -->
      </div>


   </div><!-- row -->

   



@endsection

