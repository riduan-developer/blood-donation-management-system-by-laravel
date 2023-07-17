@extends('admin.app.app_admin')


@section('title')
{{-- type the title --}}
  Donor
@endsection

@section('subtitle')
{{-- type the Subtitle --}}
  Blood Donor List
@endsection


@section('main_content_admin')
   
   {{-- place your content here --}}
    <div class="table-wrapper">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
            
          <tr>
            <th class="wd-5p">SL No.</th>
            <th class="wd-20p">Name</th>
            <th class="wd-15p">Blood Group</th>
            <th class="wd-10p">Gender</th>
            <th class="wd-20p">Contact</th>
            <th class="wd-10p">Availability</th>
            <th class="wd-20p">Last Donate</th>
            <th class="wd-25p">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)  
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $user->name }}</td>
              <td style="font-weight: bold; color:darkred ">{{ $user->relation_to_donor->blood_group }}</td>
              <td>{{ $user->gender }}</td>
              <td>{{ $user->phone }}</td>
              <td>
                <button class="btn {{ $user->avail_to_donate == 1 ? "btn-outline-success" : "btn-outline-danger" }} btn-block">
                  {{ $user->avail_to_donate == 1 ? "Available" : "Not Available"}}</td>
                </button>
              <td>{{ $user->last_donate == NULL ? 'Not found' : $user->last_donate }}</td>
              <td>
                <a href="{{ route('donor_details_info',$user->id) }}" class="btn btn-primary btn-icon">
                  <div><i class="icon ion-share"></i></div>
                </a>
              </td>
            </tr>
                
            @empty 
            <td>No data available</td>
          @endforelse
        </tbody>
      </table>
    </div><!-- table-wrapper -->
  </div><!-- card -->


  
@endsection
