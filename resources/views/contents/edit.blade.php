@extends('layout.index')


@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1>Edit Kangaroo</h1>
        </div>
        <div class="d-flex justify-content-center">
            <form class="col-md-8" id="editForm">
                <div class="form-row">
                    <div id="message" class="p-2 mb-3 col-md-12"></div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input name="name" type="text" value="{{ old('name') ?? $kangaroo->name }}" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nickname">Nickname</label>
                        <input name="nickname" type="text" value="{{ old('nickname') ?? $kangaroo->nickname }}" class="form-control" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="weight">Weight</label>
                        <input name="weight" type="text" min="0" value="{{ old('weight') ?? $kangaroo->weight }}" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="height">Height</label>
                        <input name="height" type="text" min="0" value="{{ old('height') ?? $kangaroo->height }}" class="form-control" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            @foreach(App\Kangaroo::GENDER as $value => $name)
                                @php $selected = $value == $kangaroo->gender ? 'selected' : '' @endphp
                                <option value="{{ $value }}" {{ $selected }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>   
                    <div class="form-group col-md-6">
                        <label for="friendliness">Friendliness</label>
                        <select name="friendliness" class="form-control">
                            @foreach(App\Kangaroo::FRIENDLINESS as $friendliness)
                                @php $selected = $friendliness['id'] == $kangaroo->friendliness ? 'selected' : '' @endphp
                                <option value="{{ $friendliness['id'] }}" {{ $selected }}>{{ $friendliness['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="birthday">Birthday</label>
                        <input name="birthday" max="{{ now()->format('Y-m-d') }}" type="date" value="{{ old('birthday') ?? $kangaroo->birthday }}" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="color">Color</label>
                        <input name="color" type="text" value="{{ old('color') ?? $kangaroo->color }}" class="form-control" />
                    </div>
                </div>
                <div class="form-row">
                    <button type="button" id="updateBtn" class="btn btn-success">Save</button>
                    <a href="{{ route('kangaroos.index') }}" class="btn btn-outline-secondary ml-2">Cancel</a>
                </div>
            </form> 
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            const updateData = async () => {
                try {
                    var data = $('#editForm').serialize();
                    var response = await axios.put("{{ route('api.kangaroos.update', $kangaroo->id) }}", data)
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
                            $('#message').empty().removeClass(response.data.class);
                        }, 3000);
                    }
                } catch (error) {
                    console.log(error);
                }
            }

            $('#updateBtn').on('click', function() {
                updateData();    
            });
        });
    </script>
@endsection