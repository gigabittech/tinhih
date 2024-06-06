@extends('admin.layout.template')

@section('body')
    <!-- Table Area Start -->
    <div class="container-fluid p-5 bg-black vh-100">

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <h1 class="text-white text-center">TINHIH Events & Workshops</h1>
                <p class="text-white mb-5 text-center">You can find the list of events and/or workshops organized by There is
                    No Hero in Heroin Foundation.
                </p>
                @foreach ($events as $i => $event)
                    <div class="row bg-dark1 p-4 mt-4">
                        <div class="col-lg-5">
                            <img class="rounded w-100" src="{{ asset($event->image) }}" alt="">
                        </div>
                        <div class="col-lg-7">
                            <ul class="p-0 text-white">
                                <li class="d-inline-block"><i class="fa-solid fa-calendar-days link-primary m-2"></i>
                                    {{ $event->date }}</li>
                                <li class="d-inline-block"><i class="fa-regular fa-clock link-primary m-2"></i>
                                    {{ $event->start_time }} - {{ $event->end_time }}</li>
                            </ul>
                            <h2 class="text-white">{{ $event->title }}</h2>

                            <p class="text-white-50" id="event-description_{{ $event->id }}"
                                data-bs-desc="{{ $event->description }}" data-bs-id="{{ $event->id }}"
                                style="text-align: justify">
                                {!! Str::length($event->description) > 450
                                    ? Str::substr($event->description, 0, 450) .
                                        '... ' .
                                        '<a href="javascript:void(0);" onclick="showEventLongDescription(' .
                                        $event->id .
                                        ')">More</a>'
                                    : $event->description !!}
                            </p>
                            {{-- script for show full description --}}
                            <p class="text-white"><i class="fa-solid fa-location-dot link-primary m-2"></i>
                                {{ $event->location }}
                            </p>
                            <a class="btn btn-primary" target="_blank" href="{{ $event->external_link }}">
                                Get A Ticket <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);

    };
    var loadNid = function(event) {
        var image = document.getElementById('nid');
        image.src = URL.createObjectURL(event.target.files[0]);

    };
</script>

@section('extra-script')
    <script>
        // var oldDesc;

        function showEventLongDescription(id) {

            var element = document.getElementById('event-description_' + id);
            var longDesc = element.getAttribute('data-bs-desc');
            var btn = '<a href="javascript:void(0);" onclick="showEventLessDescription(' + id + ')" data-bs-desc="' +
                longDesc +
                '" class="text-primary">Less</a>'
            document.getElementById('event-description_' + id).innerHTML = longDesc + ' ' + btn;
        }

        function showEventLessDescription(id) {
            var element = document.getElementById('event-description_' + id);
            var oldDesc = element.getAttribute('data-bs-desc');
            var shortDescription;
            if (oldDesc.length > 450) {
                shortDescription = oldDesc.substring(0, 450);
            }
            var btn = '<a href="javascript:void(0);" onclick="showEventLongDescription(' + id + ')" data-bs-desc="' +
                shortDescription +
                '" class="text-primary">More</a>'
            document.getElementById('event-description_' + id).innerHTML = shortDescription + ' ' + btn;
        }
    </script>
@endsection
