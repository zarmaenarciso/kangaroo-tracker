@extends('layout.index')


@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1>Add Kangaroo</h1>
        </div>
        <div class="d-flex justify-content-center">
            <form class="col-md-8" id="addForm">
                <div class="form-row">
                    <div id="message" class="p-2 mb-3 col-md-12"></div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input name="name" type="text" value="{{ old('name') }}" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nickname">Nickname</label>
                        <input name="nickname" type="text" value="{{ old('nickname') }}" class="form-control" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="weight">Weight</label>
                        <input name="weight" type="text" min="0" value="{{ old('weight') }}" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="height">Height</label>
                        <input name="height" type="text" min="0" value="{{ old('height') }}" class="form-control" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            @foreach(App\Kangaroo::GENDER as $value => $name)
                                <option value="{{ $value }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>   
                    <div class="form-group col-md-6">
                        <label for="friendliness">Friendliness</label>
                        <select name="friendliness" class="form-control">
                            @foreach(App\Kangaroo::FRIENDLINESS as $friendliness)
                                <option value="{{ $friendliness['id'] }}">{{ $friendliness['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="birthday">Birthday</label>
                        <input name="birthday" type="date" max="{{ now()->format('Y-m-d') }}" value="{{ old('birthday') }}" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="color">Color</label>
                        <input name="color" type="text" value="{{ old('color') }}" class="form-control" />
                    </div>
                </div>
                <div class="form-row">
                    <button type="button" id="addBtn" class="btn btn-success">Save</button>
                    <a href="{{ route('kangaroos.index') }}" class="btn btn-outline-secondary ml-2">Cancel</a>
                </div>
            </form> 
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            const addData = async () => {
                try {
                    var data = $('#addForm').serialize();
                    var response = await axios.post("{{ route('api.kangaroos.store') }}", data)
                        .catch((error) => {
                            var errors = error.response.data.errors;
                            errorsHtml = '<div class="alert alert-danger"><ul>';

                            $.each( errors, function( key, value ) {
                                errorsHtml += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                            errorsHtml += '</ul></div>';

                            $('#message').html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form  
                        });

                    if (response.data) {
                        $('#message').text(response.data.message).addClass(response.data.class);
                        setTimeout(function() {
                            window.location = "{{ route('kangaroos.index') }}";
                        }, 3000);
                    }
                } catch (error) {
                    console.log(error);
                }
            }

            $('#addBtn').on('click', function() {
                addData();    
            });
        });
    </script>
@endsection