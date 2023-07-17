@extends('admin.app.app_admin')


@section('title')
{{-- type the title --}}
   Admin
@endsection

@section('subtitle')
{{-- type the Subtitle --}}
Blood manage
@endsection


@section('main_content_admin')
   
   {{-- place your content here --}}
   <div class="row row-sm mg-t-20">
      {{-- new role adding form --}}
      <div class="col-xl-5">
        <div class="card pd-20 pd-sm-40 mg-t-20">
            <form action="{{ route("blood_group_submit") }}" method="POST">
               @csrf
               <div class="form-layout">
                  <div class="row mg-b-25">
                  <div class="col-lg-8">
                     <div class="form-group">
                        <label class="form-control-label">Blood Group: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="blood_group" value="{{ old('blood_group') }}" placeholder="A+....">
                     </div>
                     @if ($errors->has('blood_group')) <h6 class="text-danger">{{ $errors->first('blood_group') }} </h6> @endif
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

      <div class="col-xl-5">
         <div class="card pd-20 pd-sm-40 mg-t-20"> 
            <div class="table-responsive">
               <table class="table mg-b-0">
                  <thead>
                     <tr>
                        <th>SL No.</th>
                        <th>Blood Group</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse ($bloods as $blood)
                           <tr>
                              <td>{{ $loop->iteration }}</td>  
                              <td style="color: red; font-weight: bold">{{ $blood->blood_group }}</td>  
                              <td>
                                 <a href="{{ route('blood_del',$blood->id) }}" class="btn btn-danger btn-icon">
                                    <div><i class="fa fa-trash"></i></div>
                                 </a>
                              </td>      
                           
                              @empty
                                 <td style="text-align: center" colspan="3">No Data Available</td> 
                           </tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div><!-- card -->

       
      </div> 
   </div>



@endsection