@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Phone Numbers') }}</div>

                <div class="card-body">
                    <div class="alert alert-success" role="alert"></div>
                    <table id="table" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Number</th>
                                <th>Provider</th>
                                <th width="50"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($phones as $phone)
                            <tr>
                                <td>{{$phone->id}}</td>
                                <form action="{{route('updatenumberajax', $phone->id)}}" method="post">
                                    {{csrf_field()}}
                                    <td class="text-center">
                                        <label for="number" hidden></label>
                                        <a href="#" id="number" class="number" data-url="{{ route('updatenumberajax', $phone->id) }}" data-pk="{{ $phone->id }}" data-type="text" data-title="Edit number">{{$phone->number}}</a>
                                    </td>
                                </form>
                                <td>
                                    <a
                                        href="#"
                                        class="provider"
                                        data-type="select"
                                        data-name="provider"
                                        data-pk="{{ $phone->id }}"
                                        data-value="{{ $phone->provider }}"
                                        data-title="Select Provider"
                                        data-url="{{ route('updateproviderajax') }}"
                                    ></a>
                                </td>
                                <td width="50" class="text-center">
                                    <button class="btn btn-danger btn-block delete" type="button" data-id="{{$phone->id}}"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    $(function(){
        $(".alert").hide();
        $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete').on('click', function(e) { //working on it....
            e.preventDefault();
            console.log('Delete clicked!');
            var id = $(this).data("id");
            // row to be deleted
            var row = $(this).parent("td").parent("tr");
            $.ajax({
                type:'DELETE',
                url: '{{ url('phones') }}/'+encodeURI(id),
                dataType: "JSON",
                success: (data) => {
                    jQuery(row).fadeOut('slow');
                    $(".alert").fadeTo(2000, 500).slideUp(500, function() {
                        $(".alert").slideUp(500);
                    });
                    $(".alert").empty().append('<strong>Success!</strong> '+data.message+'');
                },
                error: function(data){
                    console.log("Error: ", data);
                }
            });
        });
        $('#table').DataTable({
            "fnRowCallback": function( nRow, mData, iDisplayIndex, iDisplayIndexFull) {
                $.fn.editable.defaults.mode = 'inline';
                product_id = $(this).data('pk');
                url = $(this).data('url');
                $('.number').editable({
                    url: url,
                    pk: product_id,
                    type:"text",
                    validate:function(value){
                      if($.trim(value) === '')
                      {
                        return 'This field is required';
                      }
                    },
                    success: (data) => {
                        $(".alert").fadeTo(2000, 500).slideUp(500, function() {
                            $(".alert").slideUp(500);
                        });
                        $(".alert").empty().append('<strong>Success!</strong> '+data.message+'');
                    }
                });
                $('.provider').editable({
                    source: [
                        @foreach($providers as $pp)
                            { value: '{{ $pp }}', text: '{{ $pp }}' }
                            @unless ($loop->last)
                                ,
                            @endunless
                        @endforeach
                    ],
                    success: (data) => {
                        $(".alert").fadeTo(2000, 500).slideUp(500, function() {
                            $(".alert").slideUp(500);
                        });
                        $(".alert").empty().append('<strong>Success!</strong> '+data.message+'');
                    }
                });
            },
        });
    });
</script>
@endsection
