@extends ('layout')

@push('page_specific_css')
    <link rel="stylesheet" href="/css/internships.css">
@endpush

@push ('page_specific_js')
    <script src="/js/internship.js"></script>
@endpush

@section ('content')
    <div id="filtersBoxButton">
        Filtres <i class="arrow {{$isOneFilterActive?"up":"down"}}"></i>
    </div>
    <div id="expandedfilters" class="simple-box filters
        @if(!$isOneFilterActive) d-none  @endif
            ">
        <h4 class="internshipsFilterText">Afficher les stages dans l'état </h4>
        <form name="filterInternships" method="post">
            {{ csrf_field() }}
            @foreach ($filter->getStateFilter() as $state)
                <span class="onefilter" >
                    <input type="checkbox" id="state{{ $state->id }}" name="state{{ $state->id }}" @if ($state->checked) checked @endif >
                    <label for="state{{ $state->id }}">{{ $state->stateDescription }}</label>
                </span>
            @endforeach
            <br>
            <button type="submit">Ok</button>
        </form>
    </div>
    <br><br>
    @include ('internships._internshipslist',['iships' => $iships])
@stop
