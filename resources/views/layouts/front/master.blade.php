@include('layouts.front.partials.head')
@include('layouts.front.partials.nav')


<main class="py-4">
    @include('layouts.messages.success')
    @yield('content')
</main>

@include('layouts.front.partials.footer')
