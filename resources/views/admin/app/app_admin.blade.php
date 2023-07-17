@include('admin.layout.header_admin')
@include('admin.layout.nav_admin')

<div class="sl-mainpanel">

    <!-- ########## START: MAIN PANEL ########## -->
   <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">
         @yield('title')
      </a>
      <span class="breadcrumb-item active">
         @yield('subtitle')
      </span>
   </nav>

   {{-- alert --}}

   @include('admin.layout.alert_admin')
   
   
   
   
   <div class="sl-pagebody">
      @yield('main_content_admin')
   </div>
   

</div><!-- sl-mainpanel -->

@include('admin.layout.footer_admin')