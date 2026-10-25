{{-- Self-hosted Umami analytics (config/services.php). Loaded async so a slow analytics
     server never holds up the page; resources/js/analytics.js queues events until it's ready. --}}
@if(config('services.umami.script_url') && config('services.umami.website_id'))
    <script async id="umami-script"
            src="{{ config('services.umami.script_url') }}"
            data-website-id="{{ config('services.umami.website_id') }}"
            @if(config('services.umami.host_url')) data-host-url="{{ config('services.umami.host_url') }}" @endif
            @if(config('services.umami.domains')) data-domains="{{ config('services.umami.domains') }}" @endif></script>
@endif
