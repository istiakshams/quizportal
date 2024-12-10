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
            <td>

            </td>
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