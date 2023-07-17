@extends('admin.app.app_admin')


@section('title')
{{-- type the title --}}
 Donation
@endsection

@section('subtitle')
{{-- type the Subtitle --}}
Donation Information
@endsection


@section('main_content_admin')
   
   {{-- place your content here --}}
   <div class="card pd-20 pd-sm-40">
    <h4 class="card-body-title text-center">Donation Information</h4>
    <hr>

    <div class="table-wrapper">
      <table id="datatable1" class="table display responsive nowrap">
        <thead>
            
          <tr>
            <th class="wd-5p">SL No.</th>
            <th class="wd-15p">Code Name</th>
            <th class="wd-15p">Blood Group</th>
            <th class="wd-10p">Quantity</th>
            <th class="wd-20p">Requested at</th>
            <th class="wd-10p">Status</th>
            <th class="wd-25p">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($donations as $donation)
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $donation->b_req_code }}</td>
              <td style="font-weight: bold;color:darkred">{{ $donation->relation_to_donate_req->relation_to_blood->blood_group }}</td>
              <td style="font-weight: bold;">{{ $donation->relation_to_donate_req->quantity }}</td>
              <td>{{ $donation->relation_to_donate_req->created_at }}</td>
              <td>
                <button class="btn {{ $donation->donation_completed == NULL ? "btn-outline-danger" : "btn-outline-success" }} btn-block">
                  {{ $donation->donation_completed == NULL ? 'processing' : 'completed' }}</td>
                </button>
              </td>
              <td>
                <a href="{{ route('donation_details_info',$donation->id) }}" class="btn btn-primary btn-icon">
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
