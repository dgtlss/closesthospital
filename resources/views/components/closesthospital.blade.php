<div class="w-full text-center mt-12 p-4 overflow-hidden">
    <h2 class="text-white text-4xl font-bold">
        Your location is: <br>
        {{ $Api->location['city'] }}, {{ $Api->location['country'] }} <br>
    </h2>
    <p class=" text-gray-200 text-md font-semibold mt-2">The closest hospitals to you are below:</p>
    <div class="w-full mt-8 grid lg:grid-cols-3 gap-4 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-4">
        @foreach($Api->hospitals as $hospital)
            <div class="rounded">
                <div class="bg-white border-gray-900 p-2 rounded-md h-64 text-left relative shadow-sm">
                    <div class="absolute bottom-2 left-1">
                        @if($hospital->hasaande == 1)
                            <span class="bg-blue-600 text-white rounded-md px-2 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                A&amp;E
                            </span>
                        @endif
                    </div>
                    <h1 class="text-left font-bold text-2xl">
                        {{$hospital->hospital_name}}
                    </h1>
                    <p class="text-indigo-600 font-semibold">
                        Miles Away: {{number_format($hospital->distanceTo,2)}} Miles
                    </p>
                    <p>
                        {{$hospital->address}} <br>
                        {{$hospital->postcode}}
                    </p>
                    <p class="mt-2">
                        <a href="https://maps.google.com/?q={{$hospital->latitude}},{{$hospital->longitude}}" target="_blank">Find on google maps</a><br>
                        <a href="tel:{{$hospital->phone_number}}">Call: {{$hospital->phone_number}}</a> <br>
                        <a href="{{$hospital->website}}" target="_blank">Visit Website</a>
                    </p>
                    <div class="absolute bottom-2 right-1">
                        <span class="bg-red-600 text-white px-2 py-1 rounded-md">
                            <svg class="h-4 w-4 inline -mt-0.5" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.9043 40.5747C20.5573 40.5743 20.2154 40.4915 19.9066 40.3332C19.5979 40.1748 19.3311 39.9455 19.1282 39.664C18.9254 39.3825 18.7922 39.0569 18.7396 38.7139C18.6871 38.371 18.7167 38.0204 18.826 37.6911L27.5877 11.4044C27.7716 10.8532 28.1668 10.3976 28.6865 10.1379C29.2062 9.87811 29.8079 9.83545 30.3591 10.0193C30.9102 10.2031 31.3658 10.5983 31.6256 11.1181C31.8853 11.6378 31.928 12.2394 31.7442 12.7906L22.982 39.077C22.8366 39.5131 22.5577 39.8923 22.1848 40.1612C21.8119 40.43 21.3639 40.5747 20.9043 40.5747V40.5747Z" fill="white"/>
                                <path d="M7.7607 40.5747C7.41372 40.5743 7.07181 40.4915 6.76306 40.3332C6.45431 40.1748 6.18754 39.9455 5.98467 39.664C5.7818 39.3825 5.64863 39.0569 5.59609 38.7139C5.54355 38.371 5.57314 38.0204 5.68244 37.6911L14.4446 11.4044C14.6285 10.8532 15.0237 10.3976 15.5434 10.1379C16.0632 9.87811 16.6648 9.83545 17.216 10.0193C17.7671 10.2031 18.2227 10.5983 18.4825 11.1181C18.7422 11.6378 18.7849 12.2394 18.6011 12.7906L9.83895 39.077C9.69352 39.5131 9.41455 39.8925 9.04156 40.1613C8.66857 40.4301 8.22046 40.5747 7.7607 40.5747V40.5747Z" fill="white"/>
                                <path d="M34.047 40.5747C33.7 40.5743 33.3581 40.4915 33.0494 40.3332C32.7407 40.1748 32.4739 39.9455 32.271 39.664C32.0681 39.3825 31.935 39.0569 31.8825 38.7139C31.8299 38.3709 31.8595 38.0204 31.9689 37.6911L40.731 11.4044C40.9148 10.8532 41.3101 10.3976 41.8298 10.1379C42.3495 9.87811 42.9511 9.83545 43.5023 10.0193C44.0535 10.2031 44.5091 10.5983 44.7688 11.1181C45.0286 11.6378 45.0712 12.2394 44.8874 12.7906L36.1253 39.077C35.9799 39.5131 35.7009 39.8925 35.3279 40.1613C34.9549 40.4301 34.5068 40.5748 34.047 40.5747V40.5747Z" fill="white"/>
                            </svg>                                
                            {{$hospital->w3w}}
                        </span> <br>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="w-full mb-4 mt-12">
        <div class="text-center mx-auto text-slate-500 text-sm">
            Information accurate as of {{$Api->dateUpdated}} <br>
            Developed by <a href="https://twitter.com/nlangerdev" target="_blank">@nlangerdev</a>
        </div>
    </div>
</div>