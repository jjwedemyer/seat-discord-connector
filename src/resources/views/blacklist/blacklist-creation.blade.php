<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{ trans('discord-connector::seat.quick_create_blacklist') }}</h3>
    </div>
    <div class="panel-body">
        <form role="form" action="{{ route('discord-connector.add') }}" method="post">
            {{ csrf_field() }}

            <div class="box-body">

                <div class="form-group">
                    <label for="discord-discord-role-id">{{ trans('discord-connector::seat.discord_role') }}</label>
                    <select name="discord-discord-role-id" id="discord-discord-role-id" class="form-control">
                        @foreach($discord_roles as $discord_role)
                            <option value="{{ $discord_role->id }}">{{ $discord_role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="discord-enabled">{{ trans('web::seat.enabled') }}</label>
                    <input type="checkbox" name="discord-enabled" id="discord-enabled" checked="checked" value="1" />
                </div>

            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">{{ trans('web::seat.add') }}</button>
            </div>

        </form>
    </div>
</div>