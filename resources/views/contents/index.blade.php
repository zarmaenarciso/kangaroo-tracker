@extends('layout.index')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/21.1.4/css/dx.light.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container mb-5">
        <div class="row ml-1"><h1>Kangaroo Tracker</h1></div>
        <div class="row p-2 ml-1" id="message"></div>
    </div>
    <div class="container">
        <div id="loading" class="d-flex justify-content-center">
            <h1>Loading... Please wait</h1>
        </div>
        <div id="gridContainer"></div>
        <div id="action-add"></div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/devextreme/21.1.4/js/dx.all.js"></script>

    <script>
        $(function() {
            const getData = async () => {
                try {
                    const response = await axios.get("{{ route('api.kangaroos.index') }}");
                    const friendliness = {!! json_encode(App\Kangaroo::FRIENDLINESS) !!}

                    if (response.status == 200) {
                        $('#loading').remove();                   

                        var grid =  $("#gridContainer").dxDataGrid({
                            dataSource: response.data,
                            loadPanel: {
                                enabled: true
                            },
                            keyExpr: 'id',
                            selection: {
                                mode: "single"
                            },
                            onToolbarPreparing: function (e) {
                                let toolbarItems = e.toolbarOptions.items;
                    
                                // Transition add button to create page
                                toolbarItems.forEach(function(item) {    
                                    if (item.name === "addRowButton") {
                                        item.options = {
                                            icon: "add",
                                            onClick: function(e) {
                                                window.location = "{{ route('kangaroos.create') }}";
                                            }
                                        }
                                    }
                                });
                            },
                            editing: {
                                allowUpdating: true,
                                allowDeleting: true,
                                allowAdding: true
                            },
                            columns: ["name", "birthday", "weight", "height",
                                {
                                    dataField: "friendliness",
                                    caption: "Friendliness",
                                    lookup: {
                                        dataSource: friendliness,
                                        displayExpr: "name",
                                        valueExpr: "id"
                                    }
                                },
                                {
                                    type: "buttons",
                                    buttons: [{
                                        text: "Edit",
                                        hint: "Edit",
                                        onClick: function (e) {
                                            window.location = '/kangaroos/' + e.row.data.id + '/edit';
                                        }
                                    },
                                    "delete"
                                    ]
                                }
                            ],
                            showBorders: true,
                            searchPanel: {
                                visible: true
                            },
                            paging: {
                                pageSize: 10
                            },
                            pager: {
                                visible: true,
                                allowedPageSizes: [5, 10, 'all'],
                                showPageSizeSelector: true,
                                showInfo: true,
                                showNavigationButtons: true
                            },
                            onSaving: function(e) {
                                $(e.changes).each(function(key, item) {
                                    if (item.type == 'remove') {
                                        axios.delete('/api/kangaroos/' + item.key).then(response => {
                                            $('#message').text(response.data.message).addClass(response.data.class);
                                            setTimeout(function() {
                                                $('#message').empty().removeClass(response.data.class);
                                            }, 3000);
                                        });
                                    }
                                });
                            }
                        }).dxDataGrid("instance");
                    }
                } catch (error) {
                    console.log(error);
                }
            }

            getData();
        });
    </script>
@endsection