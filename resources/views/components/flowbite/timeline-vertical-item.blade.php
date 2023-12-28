<li {{ $attributes->merge(['class' => 'mb-10 ms-6']) }}>
    <span
        class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
        {{-- <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
        </svg> --}}
        <svg class="w-2.5 h-2.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"/>
          </svg>
    </span>
    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
        {{$title}}
        @if ($latest == true)
        <span
            class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ms-3">Latest
        </span>
        @endif
    </h3>
    <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
        {{$time->format('d M Y H:i T')}}
    </time>
    <p class="mb-4 text-base font-normal text-gray-500 text-sm dark:text-gray-400">
        {{$description}}
    </p>
    @if ($link != null && $link != '')
    <a href="{{$link}}" {{isset($target) ? 'target="'.$target.'"' : ''}}
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
        <svg
            class="w-3.5 h-3.5 me-2.5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg> 
        {{$linkDesc}}</a>
    @endif
</li>