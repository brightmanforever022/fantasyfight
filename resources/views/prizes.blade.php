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
        <div class="prize-support-button-area">
            <button type="button" class="btn prize-support-button" data-dismiss="modal" onClick="handleSupportButtonClick({{$sports}})">Support</button>
        </div>  
    </div>
    <!-- Modal -->
    <div class="modal fade show" id="splashSupportModal" tabindex="-1" role="dialog" data-show="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="modal-sport-description">
                        For questions or to make updates to your account, please email joe@fantasyfightleague.com
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>
    function handleSupportButtonClick() {
        $("#splashSupportModal").modal();
    }
</script>
@endsection