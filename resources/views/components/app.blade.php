
    @if(View::exists($templatePath))
        @include($templatePath)
    @else
        <p>Template not found: {{ $templatePath }}</p>
    @endif

