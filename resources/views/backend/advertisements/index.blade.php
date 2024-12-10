@extends('adminlte::page')

@section('title', 'Advertisement Settings')

@section('content_header')
<div class="row">
  <div class="col-6">
    <h1>Advertisement Settings</h1>
    <p class="small"><a href="/admin">Dashboard</a> / <a href="/admin/settings/general-settings">System Settings</a> /
      Ads Settings</p>
  </div> <!-- /.col -->
  <div class="col-6">
    <p><a href="javascript:void(0)" class="btn btn-flat btn-primary float-right" id="addNew"><i class="fas fa-plus"></i>
        Add New</a></p>
  </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('content')

@include('notifications')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Advertisements</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <div id="data-table">
          <table id="AdvertisementsTable" class="table table-striped">
            <thead>
              <tr>
                <th width="5%">ID</th>
                <th>Ad Title</th>
                <th>Embed Code</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach( $advertisements as $advertisement )
              <tr>
                <td width="5%">{{ $advertisement->id }}</td>
                <td>{{ $advertisement->title }}</td>
                <td>&#123;&#33;&#33; showAdvertise({{ $advertisement->id }}) &#33;&#33;&#125;</td>
                <td width="10%">
                  <a href="javascript:void(0)" data-id="{{ $advertisement->id }}"
                    class="btn btn-block btn-flat btn-primary" id="editAd"><i class="far fa-edit"></i> Edit</a>
                </td>
                <td width="10%">
                  <a href="javascript:void(0)" data-id="{{ $advertisement->id }}"
                    class="btn btn-block btn-flat btn-danger" id="showDeleteModal"><i class="far fa-trash-alt"></i>
                    Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="5%">ID</th>
                <th>Ad Title</th>
                <th>Embed Code</th>
                <th></th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div> <!-- /.#data-table -->
      </div> <!-- /.card-body -->
    </div> <!-- /.card -->
  </div> <!-- /.col -->
</div> <!-- /.row -->

<!-- Add/Edit Advertisement -->
<div class="modal fade" id="adModel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modelHeading"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="advertiseForm" name="advertiseForm" class="form-horizontal">
        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="title">Ad Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Ad Title" value=""
              maxlength="50" required>
          </div>
          <div class="form-group">
            <label for="content">Ad Content</label>
            <textarea name="content" class="form-control" id="content" placeholder="Enter Ad Content"
              required></textarea>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-flat btn-primary" id="saveAd" value="create">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modelHeading">Confirm Delete</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteAdvertiseForm" name="deleteAdvertiseForm" class="form-horizontal">
        <input type="hidden" name="adId" id="adId">
        <div class="modal-body">
          Do you really want to delete this advertisement?
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-flat btn-danger" id="deleteAd" value="delete">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>

@stop
@section('adminlte_js')
<script>
  $(function () {
    $('#AdvertisementsTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "columnDefs": [{
        "targets": [2,3,4],
        "orderable": false
      }]
    })

    // Header Token
    $.ajaxSetup({        
      headers: {        
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')        
      }        
    });

    // Add New Button
    $('#addNew').click(function () {
      $('#id').val('');
      $('#advertiseForm').trigger("reset");
      $('#modelHeading').html("Add New Advertisement");
      $('#saveAd').html('Save');
      $('#adModel').modal('show');
    });

    // Click to Edit Button    
    $('body').on('click', '#editAd', function () {
      $('#saveAd').html('Update');
      var id = $(this).data('id');
    
      $.get('/admin/settings/ads-settings/' + id +'/edit', function (data) {
        $('#modelHeading').html("Edit Advertisement");
        $('#saveBtn').val("edit-ad");
        $('#adModel').modal('show');
        $('#id').val(data.id);
        $('#title').val(data.title);
        $('#content').val(data.content);
      })
    });
    
    // Create/Update Ad
    $('#saveAd').click(function (e) {
      e.preventDefault();
      $(this).html('Sending..');
      $.ajax({
        data: $('#advertiseForm').serialize(),
        url: "{{ route('admin.ads.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#advertiseForm').trigger("reset");
          $('#adModel').modal('hide');
          $('#saveAd').html('Save');

          // Reload the table
          $('#data-table').html(data.datatable);          
          $('#AdvertisementsTable').DataTable({
              'paging' : true,
              'lengthChange': false,
              'searching' : true,
              'ordering' : true,
              'info' : true,
              'autoWidth' : false,
              "columnDefs": [{
              "targets": [2,3,4],
              "orderable": false
              }]
          });

          $(document).Toasts('create', {
            class: 'bg-success',
            autohide: true,
            delay: 2000,
            title: 'Success',
            body: data.success
          });
        },
        error: function (data) {
          $(document).Toasts('create', {
            class: 'bg-danger',
            autohide: true,
            delay: 2000,
            title: 'Error',
            body: data.responseJSON.error
          })
          $('#saveAd').html('Save');        
        }
      });
    });

    // Show Delete Confirmation Modal
    $('body').on('click', '#showDeleteModal', function () {
      var id = $(this).data('id');
      $('#adId').val(id);
      $('#deleteModel').modal('show');      
    });

    // Delete Advertisement
    $('#deleteAd').click(function (e) {
      e.preventDefault();
      var id = $("#adId").val();
      $.ajax({
        type: "DELETE",
        url: '/admin/settings/ads-settings/'+id,
        success: function (data) {

          $('#deleteModel').modal('hide');

          // Reload the table
          $('#data-table').html(data.datatable);
            $('#AdvertisementsTable').DataTable({
            'paging' : true,
            'lengthChange': false,
            'searching' : true,
            'ordering' : true,
            'info' : true,
            'autoWidth' : false,
            "columnDefs": [{
            "targets": [2,3,4],
            "orderable": false
            }]
          });

          // Show Toast
          $(document).Toasts('create', {
            class: 'bg-success',
            autohide: true,
            delay: 2000,
            title: 'Success',
            body: data.success
          });
        },
        error: function (data) {
          // console.log('Error:', data);
          $(document).Toasts('create', {
            class: 'bg-danger',
            autohide: true,
            delay: 2000,
            title: 'Error',
            body: data.responseJSON.error
          })
        }
      });
    });

  })
</script>
@stop
@section('plugins.jQuery-UI', true)
@section('plugins.Datatables', true)