@if(session()->has("message"))
    <div
        {{-- x-data comes from AlpineJS --}}
        {{-- x-init comes from AlpineJS --}}
        {{-- x-show comes from AlpineJS --}}
        {{-- used so that the message doesn't remain there forever or until you reload the page --}}

        x-data="{show: true}"
        x-init="setTimeout(() => show = false, 3000)" 
        x-show="show"
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
        <p>{{ session("message") }}</p>
    </div>
@endif