@for ($i = 0; $i < sizeof($available); $i++)
    <option value="{{ $tutor_time_zone[$i] }}">{{ $parent_time_zone[$i] }}</option>
@endfor
