@extends('layouts.main') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Dashboard") }}</div>

                <div class="card-body m-b-30">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session("status") }}
                    </div>
                    @endif

                    {{ __("You are logged in!") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('page-script')
<script type="text/javascript">
    $(document).ready(function () {});
</script>
@endsection
