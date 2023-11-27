<div>
    <x-page.header>
        Kalender Ulang Tahun Murid
    </x-page.header>
    <x-slot name='button'>
    </x-slot>

    <x-page.style>
        <style>
            label {
                font-weight: 600 !important;
            }

            .no-resize {
                resize: none !important;
            }
        </style>

    </x-page.style>

    <x-page.content-white>
        <div class="px-4 py-2">
            <div class="header">
                <h1 id="header">Calendar.js - Pin-Up</h1>
                <p>A test that shows Calendar.js in Pin-Up mode.</p>
            </div>

            <div class="contents">
                <div id="calendar" style="max-width: 800px;"></div>
            </div>

        </div>

        <script src="{{asset('js/calendar-js/calendar.js')}}"></script>
        <script>
            var calendarInstance1 = new calendarJs( "calendar", { 
                exportEventsEnabled: true,
                useAmPmForTimeDisplays: true
            } );

        document.title += " v" + calendarInstance1.getVersion();

        var event1 = {
                from: new Date(),
                to: new Date(),
                title: "New Event 1",
                description: "A description of the new event"
            },
            event2 = {
                from: new Date(),
                to: new Date(),
                title: "New Event 2",
                description: "A description of the new event"
            };

        calendarInstance1.addEvent( event1 );
        calendarInstance1.addEvent( event2 );
        </script>
    </x-page.content-white>
</div>