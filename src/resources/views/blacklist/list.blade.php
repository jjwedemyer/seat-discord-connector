@extends('web::layouts.grids.3-9')

@section('title', trans('web::seat.access'))
@section('page_header', trans('web::seat.access'))

@section('left')

    @include('discord-connector::access.includes.mapping-creation')
    
@stop

@section('right')

    <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{ trans_choice('discord-connector::seat.blacklist', 2) }}</h3>
    </div>
    <div class="panel-body">

        <table class="table table-condensed table-hover table-responsive">
    <thead>
    <tr>
        <th>{{ trans('discord-connector::seat.discord_role') }}</th>
        <th>{{ trans('web::seat.created') }}</th>
        <th>{{ trans('web::seat.updated') }}</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($role_blacklist as $filter)
        <tr>
            <td>{{ $filter->role->title }}</td>
            <td>{{ $filter->discord_role->name }}</td>
            <td>{{ $filter->created_at }}</td>
            <td>{{ $filter->updated_at }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('discord-connector.role.remove', ['role_id' => $filter->role_id, 'discord_role_id' => $filter->discord_role_id]) }}" type="button" class="btn btn-danger btn-xs col-xs-12">
                        {{ trans('web::seat.remove') }}
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
    </div>
</div>

@stop

@push('javascript')
    <script type="application/javascript">
        function getCorporationTitle() {
            $('#discord-title-id').empty();

            $.ajax('{{ route('discord-connector.json.titles') }}', {
                data: {
                    corporation_id: $('#discord-corporation-id').val()
                },
                dataType: 'json',
                method: 'GET',
                success: function(data){
                    for (var i = 0; i < data.length; i++) {
                        $('#discord-title-id').append($('<option></option>').attr('value', data[i].title_id).text(data[i].name));
                    }
                }
            });
        }

        $('#discord-type').change(function(){
            $.each(['discord-group-id', 'discord-role-id', 'discord-corporation-id', 'discord-title-id', 'discord-alliance-id'], function(key, value){
                if (value === ('discord-' + $('#discord-type').val() + '-id')) {
                    $(('#' + value)).prop('disabled', false);
                } else {
                    $(('#' + value)).prop('disabled', true);
                }
            });

            if ($('#discord-type').val() === 'title') {
                $('#discord-corporation-id, #discord-title-id').prop('disabled', false);
            }
        }).select2();

        $('#discord-corporation-id').change(function(){
            getCorporationTitle();
        });

        $('#discord-group-id, #discord-role-id, #discord-corporation-id, #discord-title-id, #discord-alliance-id, #discord-discord-role-id').select2();

        $('#discord-tabs').find('a').click(function(e){
            e.preventDefault();
            $(this).tab('show');
        });

        $(document).ready(function(){
            getCorporationTitle();
        });
    </script>
@endpush

