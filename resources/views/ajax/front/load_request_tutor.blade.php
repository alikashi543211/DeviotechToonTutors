@if (auth()->user()->role == "parent")
<form action="{{ route('parent.request.tutor') }}" method="POST">
    @csrf
    <input type="hidden" id="tutor_id" name="tutor_id" value="{{ $id }}">
    <div class="modal-body">
        <div class="form-group">
            <label for="parent_student_id">Student</label>
            <select name="parent_student_id" id="parent_student_id" class="form-control">
                <option value="" disabled selected>Select Student</option>
                @foreach (auth()->user()->parent_students as $item)
                    <option value="{{ $item->id }}">{{ $item->student_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="message">Write a message to Tutor</label>
            <textarea name="message" id="message" class="form-control" rows="3" disabled></textarea>
        </div>
        <div class="form-group">
            <label for="data">Book Slot</label>
            <input type="text" name="slot" id="data" class="form-control tutordatepicker" autocomplete="off" disabled>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default btn-square" type="submit">Submit</button>
    </div>
</form>
@else
<form action="{{ route('student.request.tutor') }}" method="POST">
    @csrf
    <input type="hidden" id="tutor_id" name="tutor_id" value="{{ $id }}">
    <div class="modal-body">
        <div class="form-group">
            <label for="message">Write a message to Tutor</label>
            <textarea name="message" id="message" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="data">Book Slot</label>
            <input type="text" name="slot" id="data" class="form-control tutordatepicker" autocomplete="off">
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default btn-square" type="submit">Submit</button>
    </div>
</form>
@endif
