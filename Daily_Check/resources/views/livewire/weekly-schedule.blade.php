<div>
    <div class="mt-4">
        @foreach($weeklySchedule as $date => $sites)
        <div class="mb-2">
            <strong>{{ \Carbon\Carbon::parse($date)->format('Y-m-d (l)') }}</strong>
            <ul>
                @foreach($sites as $site)
                <li>{{ $site }}</li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</div>
