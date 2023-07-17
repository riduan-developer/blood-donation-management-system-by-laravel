<!doctype html>
<html class="no-js" lang="zxx">
    <body>

        @include('front_end.layout.header')
        @include('front_end.layout.nav')
        
        <main>
                @yield('main')
        
        </main>
            
        @include('front_end.layout.script')

        
    </body>
</html>