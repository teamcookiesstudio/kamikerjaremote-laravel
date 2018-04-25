@extends('admins.layouts.master')

@push('adminstyle')
{!! Html::style("admins/css/bootstrap.dataTables.min.css") !!}
{!! Html::style('admins/js/iCheck/all.css') !!}
@endpush

@section('btn-add-content')
<button class="btn btn-success btn-rounded" id="approve-selected" disabled data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait..."> Approve </button>
<button class="btn btn-danger btn-rounded" id="reject-selected" disabled data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait..."> Reject </button>
@endsection

@section('admincontent')

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="page-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover manage-u-table" id="table">
                            <thead>
                                <tr>
                                    <th><button type="button" class="btn btn-default btn-sm checkbox-toggle" id="checkAll"><i class="fa fa-square-o"></i></button></th>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('adminscript')
{!! Html::script('admins/js/iCheck/icheck.js') !!}
{!! Html::script('admins/js/jquery.dataTables.min.js') !!}
{!! Html::script('admins/js/dataTables.bootstrap.min.js') !!}

<script type="text/javascript">

	$(function() {

        function sendGetRequest(url, $selector) {

            $.get(url).done( function ( response ) {
                swal('Success', response['message'], response['status']);
                oTable.draw();
                $selector.button('reset');
            });
        }

        function sendPostRequest(url, $selector) {
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $("input[type='checkbox']").serializeArray(),
                dataType: 'json',
            }).done( function ( response ) {
                swal('Success', response['message'], response['status']);
                oTable.draw();
                $selector.button('reset');
            });
        }

        function recalculate(){
            var sum = 0;

            $("input[type=checkbox]:checked").each(function(){
                sum += parseInt($(this).length);
            });

            if (sum != 0) {
                $('#approve-selected').prop('disabled', false).text(' Approve ('+sum+')');
                $('#reject-selected').prop('disabled', false).text(' Reject ('+sum+')');
            } else {
                $('#approve-selected').prop('disabled', true).text(' Approve');
                $('#reject-selected').prop('disabled', true).text(' Reject');
            }
        }

        var oTable = $('#table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ route("admin.members.datatables") }}',
            columns: [
                { data: null, name: null, searchable: false, orderable: false },
                { data: 'rownum', name: 'rownum', searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'status', name: 'status', searchable: false },
                { data: 'created_at', name: 'created_at', render: function(data)
                    {
                        var d = new Date(data);
                        var month = ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];

                        var date = d.getDate() + " " + month[d.getMonth()] + " " + d.getFullYear();
                        var time = d.toLocaleTimeString().toLowerCase();

                        return date + " " + time;
                    },
                    searchable: false
                },
                { data: null, name: null, orderable: false, searchable: false }
            ],
            createdRow: function ( row, data, index ){

                $('td', row).eq(0).html('<input class="membercheckbox" id="membercheckbox" type="checkbox" name="id[]" value='+data.id+'>');
                $('td', row).eq(6).html('<button id="approve" data-loading-text="Please wait.." member_id='+data.id+' member_name='+data.name+' class="btn btn-xs btn-success"><i class="glyphicon glyphicon-ok"></i> Approve</button> <button type="submit" id="reject" member_id="'+data.id+'" member_name="'+data.name+'" class="btn btn-xs btn-danger" data-loading-text="Please wait.."><i class="glyphicon glyphicon-remove"></i> Reject</button>');
            },
            initComplete: function ( settings, json ) {
                $('input[type="checkbox"].membercheckbox').iCheck({
                    checkboxClass: 'icheckbox_flat-blue',
                });
            },
            drawCallback: function ( settings ) {
                $('input[type="checkbox"].membercheckbox').iCheck({
                    checkboxClass: 'icheckbox_flat-blue',
                });
                $('#approve-selected').button('reset').prop('disabled', true);
                $('#reject-selected').button('reset').prop('disabled', true);
                $(".fa", '.checkbox-toggle').removeClass("fa-check-square-o").addClass('fa-square-o');
            }
        });

        $(".checkbox-toggle").click(function () {

            var clicks = $(this).data('clicks');

            if (clicks) {

                $("input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {

                $("input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }

            $(this).data("clicks", !clicks);
        });

        $(document).on('click', '#approve', function() {
            var $btn        = $(this);
            var member_id   = $btn.attr('member_id');
            var url         = '{{ route("admin.members.approve", "") }}/'+member_id;
            $btn.button('loading');
            sendGetRequest(url, $btn);
        });

        $(document).on('click', '#reject', function() {
            var $btn        = $(this);
            var member_id   = $btn.attr('member_id');
            var url         = '{{ route("admin.members.reject", "") }}/'+member_id;
            $btn.button('loading');
            swal({
                title: "Are you sure ?",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                showCancelButton: true,
            }, function() {
                sendGetRequest(url, $btn);
            });
        });

        $(document).on('ifChanged', '#membercheckbox', function() {
            recalculate();
        });

        $(document).on('click', '#approve-selected', function() {
            var $btn    = $(this);
            $btn.button('loading')
            var url     = '{{ route("admin.members.approve-selected") }}';
            sendPostRequest(url, $btn); 
        });

        $(document).on('click', '#reject-selected', function() {
            var $btn    = $(this);
            $btn.button('loading');
            var url     = '{{ route("admin.members.reject-selected") }}';

            swal({
                title: "Are you sure ?",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                showCancelButton: true,
            }, function() {
                sendPostRequest(url, $btn); 
            });
        });
    });
</script>
@endpush
