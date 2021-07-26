@extends('layouts.app')

@section('title', "prizes")

@section('headerbar')
    @parent
@stop

@section('content')
    <div class="lead-body">
        <span class="lead-title">PRIZES</span>
        <div class="row" id="filter-area">
            <div class="filter-box">
                <span class="filter-label">Sport:</span>
                <div class="form-group filter-by-sport">
                    <select class="form-control" id="select_prize_sport">
                        @foreach($sports as $index => $sport)
                            @if (!$index)
                                <option value="{{$sport->sport_id}}" selected>{{$sport->name}}</option>
                            @else 
                                <option value="{{$sport->sport_id}}">{{$sport->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="prize-table-box">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">PLACE</th>
                    <th scope="col">PRIZE</th>
                    </tr>
                </thead>
                <tbody class="prize-results">
                    @foreach($results as $index => $result)
                    <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td><a href="{{ $result->url }}" class="prize-redirect-url">{{$result->prize}}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="button" class="btn prize-support-button mt-3" data-dismiss="modal" onClick="handleSupportButtonClick({{$sports}})">Support</button>
    </div>
    <!-- Modal -->
    <div class="modal fade show" id="splashSupportModal" tabindex="-1" role="dialog" data-show="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                    </div>
                </div>
            </div>
        </div>
@stop

@section('scripts')
<script>
    function handleSupportButtonClick(sports) {
        let sportId = $("#select_prize_sport").val();
        currentSport = sports.filter(sport => sport.sport_id === sportId);
        let element = '<div class="modal-sport-description">' + currentSport[0].description + '</div>';
        $("#splashSupportModal .modal-body").empty();
        $("#splashSupportModal .modal-body").append(element);
        $("#splashSupportModal").modal();
    }
</script>
@endsection