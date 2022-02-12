@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Add New Number') }}</div>

                <div class="card-body">

                    <div class="alert alert-success" role="alert"></div>

                    <form id="SubmitForm">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-12">
                                <label for="number">Number *</label>
                                <input type="text" name="number" id="number" onkeypress='if(event.which < 48 || event.which > 57 ) if(event.which != 8) return false;' class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="provider">Provider *</label>
                                <select name="provider" id="provider" class="form-select">
                                    <option disabled selected>Select One</option>
                                    @foreach($providers as $provider)
                                    <option value="{{$provider}}">{{$provider}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="button" class="saveBtn btn btn-primary">Save</button>
                                <button type="button" class="generate btn btn-success">Auto Generate</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        $(".alert").hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.generate').on('click', function(e) {
            e.preventDefault();
            console.log('Auto Generate clicked!');
            $.ajax({
                type:'POST',
                url: '{{ url('autoGenerate') }}',
                dataType: "json",
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    // $(".alert").fadeTo(2000, 500).slideUp(500, function() {
                    //     $(".alert").slideUp(500);
                    // });
                    // $(".alert").empty().append('<strong>Success!</strong> '+data.message+'');
                },
                error: function(data){
                    console.log("Error: ", data);
                }
            });
        });
        $('.saveBtn').on('click', function(e) {
            e.preventDefault();
            console.log('Save button clicked!');
            let number = $('#number').val();
            let provider = $('#provider').val();
            $.ajax({
                type:'POST',
                url: '{{ route('phones.store') }}',
                data:{
                    "_token": "{{ csrf_token() }}",
                    number:number,
                    provider:provider,
                },
                success: (data) => {
                    document.getElementById("number").value = "";
                    document.getElementById("provider").value = "";
                    // $(".alert").fadeTo(2000, 500).slideUp(500, function() {
                    //     $(".alert").slideUp(500);
                    // });
                    // $(".alert").empty().append('<strong>Success!</strong> '+data.message+'');
                },
                error: function(data){
                    console.log("Error: ", data);
                }
            });
        });
    });
</script>
@endsection
